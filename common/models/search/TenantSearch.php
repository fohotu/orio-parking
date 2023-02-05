<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tenant;

/**
 * TenantSearch represents the model behind the search form of `common\models\Tenant`.
 */
class TenantSearch extends Tenant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'allocated_spaces_count', 'created_at', 'updated_at', 'created_by', 'deleted_at'], 'integer'],
            [['tenant_name', 'tin', 'bic', 'checking_account', 'address', 'bank_name', 'cost_per_hour'], 'safe'],
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
        $query = Tenant::find();  

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
            'allocated_spaces_count' => $this->allocated_spaces_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'tenant_name', $this->tenant_name])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'bic', $this->bic])
            ->andFilterWhere(['like', 'checking_account', $this->checking_account])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'cost_per_hour', $this->cost_per_hour]);

        return $dataProvider;
    }



    public function searchWithRelation($params)
    {
        $query = Tenant::find()->with(
            [
            'employee'=>function($query){
                $query->with([
                    'car'=>function($query){
                        $query->with([
                            'history'
                        ]);
                    },
                ]);
            }]
        ); 

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
            'allocated_spaces_count' => $this->allocated_spaces_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'tenant_name', $this->tenant_name])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'bic', $this->bic])
            ->andFilterWhere(['like', 'checking_account', $this->checking_account])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'cost_per_hour', $this->cost_per_hour]);

        return $dataProvider;
    }


}
