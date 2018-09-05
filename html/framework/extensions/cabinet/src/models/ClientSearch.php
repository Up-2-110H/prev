<?php

namespace krok\cabinet\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Request;

/**
 * ClientSearch represents the model behind the search form about `krok\cabinet\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * ClientSearch constructor.
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
            [['id', 'blocked'], 'integer'],
            [['login', 'createdAt', 'updatedAt'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Client::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'blocked' => $this->blocked,
        ]);

        $query
            ->andFilterWhere(['like', 'createdAt', $this->createdAt])
            ->andFilterWhere(['like', 'updatedAt', $this->updatedAt]);

        return $dataProvider;
    }
}
