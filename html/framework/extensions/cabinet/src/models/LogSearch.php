<?php

namespace krok\cabinet\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Request;

/**
 * LogSearch represents the model behind the search form about `krok\cabinet\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * @var string
     */
    public $createdAtFrom;

    /**
     * @var string
     */
    public $createdAtTo;

    /**
     * @var Request
     */
    protected $request;

    /**
     * LogSearch constructor.
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
            [['id', 'clientId', 'status'], 'integer'],
            [['ip', 'createdAtFrom', 'createdAtTo'], 'safe'],
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
        $query = Log::find()->joinWith('clientRelation');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'clientId',
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($this->request->getQueryParams());

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            Log::tableName() . '.[[id]]' => $this->id,
            Log::tableName() . '.[[clientId]]' => $this->clientId,
            Log::tableName() . '.[[status]]' => $this->status,
            Log::tableName() . '.[[ip]]' => $this->ip ? ip2long($this->ip) : null,
        ]);

        $query
            ->andFilterWhere(['>=', Log::tableName() . '.[[createdAt]]', $this->createdAtFrom])
            ->andFilterWhere(['<=', Log::tableName() . '.[[createdAt]]', $this->createdAtTo]);

        return $dataProvider;
    }
}
