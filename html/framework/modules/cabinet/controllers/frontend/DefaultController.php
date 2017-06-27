<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.02.16
 * Time: 0:11
 */

namespace app\modules\cabinet\controllers\frontend;

use app\modules\cabinet\components\UserFactory;
use app\modules\cabinet\models\Client;
use app\modules\cabinet\models\OAuth;
use Yii;
use yii\authclient\ClientInterface;
use yii\base\Module;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Class DefaultController
 *
 * @package app\modules\cabinet\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @var string
     */
    public $layout = '//index';

    /**
     * @var string
     */
    public $defaultAction = 'login';

    /**
     * @var UserFactory|null
     */
    protected $factory = null;

    public function __construct($id, Module $module, UserFactory $factory, array $config = [])
    {
        $this->factory = $factory;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array
     */
    public function actions()
    {
        $url = Yii::$app->getUrlManager()->getHostInfo() . Yii::$app->getUser()->getReturnUrl();

        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'cmf2' : null,
            ],
            'oauth' => [
                'class' => 'yii\authclient\AuthAction',
                'clientCollection' => 'cabinetClientCollection',
                'successCallback' => [$this, 'OAuthCallback'],
                'successUrl' => $url,
                'cancelUrl' => $url,
            ],
        ];
    }

    /**
     * @param ClientInterface $client
     *
     * @throws \yii\db\Exception
     */
    public function OAuthCallback(ClientInterface $client)
    {
        $attributes = $client->getUserAttributes();

        /* @var $OAuth OAuth */
        $OAuth = OAuth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->getUser()->getIsGuest()) {
            if ($OAuth instanceof OAuth) {
                // login
                if ($OAuth->client->blocked == Client::BLOCKED_NO) {
                    Yii::$app->getUser()->login($OAuth->client);
                } else {
                    Yii::$app->getSession()->addFlash('danger', 'Ваш аккаунт заблокирован');
                }
            } else {
                // signUp
                if (isset($attributes['login']) && Client::find()->where(['login' => $attributes['login']])->exists()) {
                    Yii::$app->getSession()->addFlash('danger',
                        sprintf('Пользователь %s совпадает с учетной записью %s, но не связан с ней',
                            $attributes['login'], $client->getTitle()));
                } else {
                    $password = Yii::$app->getSecurity()->generateRandomString(8);
                    $user = new Client([
                        'login' => $attributes['login'],
                        'password' => $password,
                        'email' => ArrayHelper::getValue($attributes, 'email'),
                        'blocked' => Client::BLOCKED_YES,
                    ]);
                    $transaction = Client::getDb()->beginTransaction();
                    if ($user->save()) {
                        $OAuth = new OAuth([
                            'client_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($OAuth->save()) {
                            $transaction->commit();
                            if ($user->blocked == Client::BLOCKED_NO) {
                                Yii::$app->getUser()->login($user);
                            } else {
                                Yii::$app->getSession()->addFlash('success',
                                    'Ваш аккаунт зарегистрирован, дождитесь его активации администратором');
                            }
                        } else {
                            $transaction->rollBack();
                            throw new Exception('', $OAuth->getErrors());
                        }
                    } else {
                        $transaction->rollBack();
                        throw new Exception('', $user->getErrors());
                    }
                }
            }
        } else {
            // user already logged in
            if (!($OAuth instanceof OAuth)) {
                // add user provider
                $OAuth = new OAuth([
                    'client_id' => Yii::$app->getUser()->getId(),
                    'source' => $client->getId(),
                    'source_id' => (string)$attributes['id'],
                ]);
                if ($OAuth->save()) {
                    Yii::$app->getSession()->addFlash('success',
                        sprintf('Аккаунт <b>%s</b> привязан к социальной сети <b>%s</b>',
                            ArrayHelper::getValue(Yii::$app->getUser()->getIdentity(), 'login'),
                            $client->getTitle()));
                } else {
                    throw new Exception('', $OAuth->getErrors());
                }
            } elseif ($OAuth->client_id == Yii::$app->getUser()->getId()) {
                Yii::$app->getSession()->addFlash('info',
                    sprintf('Аккаунт <b>%s</b> уже привязан к социальной сети <b>%s</b>',
                        ArrayHelper::getValue(Yii::$app->getUser()->getIdentity(), 'login'), $client->getTitle()));
            } else {
                Yii::$app->getSession()->addFlash('danger',
                    sprintf('Социальная сеть <b>%s</b> уже привязана к другому аккаунту', $client->getTitle()));
            }
        }
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionRegistration()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $form = $this->factory->form('Registration');

        if ($form->load(Yii::$app->request->post())) {
            $service = $this->factory->service('Registration');
            $model = $this->factory->model('Client');

            if ($service->registration($form, $model)) {
                Yii::$app->getSession()->setFlash('alert', 'Вы успешно зарегистрированы');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ошибка регистрации, попробуйте позже');
            }
        }

        return $this->render('registration', [
            'model' => $form,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionRegistrationWithEmail()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $form = $this->factory->form('RegistrationWithEmail');

        if ($form->load(Yii::$app->request->post())) {
            $service = $this->factory->service('RegistrationWithEmail');
            $model = $this->factory->model('Client');

            if ($service->registration($form, $model)) {
                Yii::$app->getSession()->setFlash('alert', 'Вы успешно зарегистрированы');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ошибка регистрации, попробуйте позже');
            }
        }

        return $this->render('registrationWithEmail', [
            'model' => $form,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $form = $this->factory->form('Login');

        if ($form->load(Yii::$app->request->post())) {
            $service = $this->factory->service('Login');

            if ($service->login($form)) {
                return $this->redirect(Yii::$app->getUser()->getReturnUrl());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLoginWithEmail()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $form = $this->factory->form('LoginWithEmail');

        if ($form->load(Yii::$app->request->post())) {
            $service = $this->factory->service('LoginWithEmail');

            if ($service->login($form)) {
                return $this->redirect(Yii::$app->getUser()->getReturnUrl());
            }
        }

        return $this->render('loginWithEmail', [
            'model' => $form,
        ]);
    }

    /**
     * @return string|yii\web\Response
     */
    public function actionConfirm()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $form = $this->factory->form('Confirm');

        if ($form->load(Yii::$app->request->post())) {
            $service = $this->factory->service('ResetPassword');

            if ($service->confirm($form)) {
                Yii::$app->getSession()->setFlash('alert', 'Ссылка для восстановления пароля отправлена на E-mail');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ошибка отправки сообщения, попробуйте позже');
            }
        }

        return $this->render('confirm', [
            'model' => $form,
        ]);
    }

    /**
     * @param string $token
     *
     * @return string|\yii\web\Response
     */
    public function actionReset($token)
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $form = $this->factory->form('Reset', ['token' => $token]);

        if ($form->load(Yii::$app->request->post())) {
            $service = $this->factory->service('ResetPassword');

            if ($service->reset($form)) {
                Yii::$app->getSession()->setFlash('info', 'Пароль успешно изменен');
            } else {
                Yii::$app->getSession()->setFlash('info', 'Ошибка изменения пароля');
            }
        }

        return $this->render('reset', [
            'model' => $form,
        ]);
    }
}
