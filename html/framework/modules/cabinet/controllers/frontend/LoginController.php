<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.02.16
 * Time: 0:11
 */

namespace app\modules\cabinet\controllers\frontend;

use app\modules\cabinet\models\Client;
use app\modules\cabinet\models\Confirm;
use app\modules\cabinet\models\Login;
use app\modules\cabinet\models\OAuth;
use app\modules\cabinet\models\Reset;
use Yii;
use yii\authclient\ClientInterface;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Class LoginController
 *
 * @package app\modules\cabinet\controllers\frontend
 */
class LoginController extends Controller
{
    /**
     * @var string
     */
    public $layout = '//index';

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
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $model = new Login();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        return $this->render('login', [
            'model' => $model,
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

        $model = new Confirm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = Yii::$app
                ->getMailer()
                ->compose('@app/modules/cabinet/mail/confirm.php', [
                    'model' => $model->getClient(),
                ])
                ->setSubject('Изменение пароля в Личном кабинете')
                ->setFrom(Yii::$app->params['email'])
                ->setTo($model->email)
                ->send();

            if ($result == true) {
                Yii::$app->getSession()->setFlash('alert', 'Ссылка для восстановления пароля отправлена на E-mail');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ошибка отправки сообщения, попробуйте позже');
            }
        }

        return $this->render('confirm', [
            'model' => $model,
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

        $model = new Reset(['reset_token' => $token]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $client = $model->getClient();
            $client->setAttribute('password', $model->password);
            if ($client->save()) {
                Yii::$app->getSession()->setFlash('info', 'Пароль успешно изменен');
            } else {
                Yii::$app->getSession()->setFlash('info', 'Ошибка изменения пароля');
            }
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }
}
