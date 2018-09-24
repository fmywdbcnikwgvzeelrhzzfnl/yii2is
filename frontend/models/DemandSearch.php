<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Demand;

/**
 * DemandSearch represents the model behind the search form of `common\models\Demand`.
 */
class DemandSearch extends Demand
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'ord', 'level', 'fk_version', 'fk_language', 'fk_document', 'is_complex', 'fk_parent', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'comment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Demand::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'uid' => $this->uid,
            'ord' => $this->ord,
            'level' => $this->level,
            'fk_version' => $this->fk_version,
            'fk_language' => $this->fk_language,
            'fk_document' => $this->fk_document,
            'is_complex' => $this->is_complex,
            'fk_parent' => $this->fk_parent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
