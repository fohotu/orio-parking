<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParkingHistory;

/**
 * ParkingHistorySearch represents the model behind the search form of `common\models\ParkingHistory`.
 */
class ParkingHistorySearch extends ParkingHistory
{
    /**
     * {@inheritdoc}
     */

    public $employee;
    public $company;
    public $car_number;

    public function rules()
    {
        return [
            [['id', 'car_id', 'action_date', 'enter_date', 'exit_date'], 'integer'],
            [['car_number','employee','company'], 'string'],
            [['action_type'], 'safe'],
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
        $query = ParkingHistory::find()
            ->joinWith([
                'car'=>function($query){
                    $query->joinWith([
                        'employee'=>function($query){
                            $query->joinWith([
                                'profile'=>function($query){
                                    $query->where(
                                        [
                                        'like', 'profile.name', $this->employee
                                        ]
                                        );
                                }
                            ]);
                        }
                    ]);
                }, 
            ]);

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
            'car_id' => $this->car_id,
            'action_date' => $this->action_date,
            'enter_date' => $this->enter_date,
            'exit_date' => $this->exit_date,
        ]);

        $query->andFilterWhere(['like', 'action_type', $this->action_type]);
        $query->andFilterWhere(['like', 'car.car_number', $this->car_number]);
        // $query->andFilterWhere(['like', 'employee.name', $this->employee]);
        $query->andFilterWhere(['like', 'tenant.tenant_name', $this->company]);

        return $dataProvider;
    }
}
