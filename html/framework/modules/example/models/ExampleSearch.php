<?php

namespace app\modules\example\models;

use app\modules\example\interfaces\ExampleSearchInterface;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Request;

/**
 * ExampleSearch represents the model behind the search form about `app\modules\example\models\Example`.
 */
class ExampleSearch extends Example implements ExampleSearchInterface
{
    /**
     * @var null|Request
     */
    protected $request = null;

    /**
     * ExampleSearch constructor.
     *
     * @param Request $request
     * @param array $config
     */
    public function __construct(Request $request, array $config = [])
    {
        $this->request = $request;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hidden'], 'integer'],
            [['title', 'text', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Example::find()->language();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'hidden' => $this->hidden,
        ]);

        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'createdAt', $this->createdAt])
            ->andFilterWhere(['like', 'updatedAt', $this->updatedAt]);

        return $dataProvider;
    }
}
