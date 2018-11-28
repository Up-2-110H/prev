<?php

namespace krok\survey\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Request;

/**
 * SurveySearch represents the model behind the search form about `krok\survey\models\Survey`.
 */
class SurveySearch extends Survey
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * SurveySearch constructor.
     *
     * @param Request $request
     * @param array $config
     */
    public function __construct(Request $request, $config = [])
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
            [['title', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = Survey::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->get());

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'hidden' => $this->hidden,
        ]);

        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'createdAt', $this->createdAt])
            ->andFilterWhere(['like', 'updatedAt', $this->updatedAt]);

        return $dataProvider;
    }
}
