<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `common\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * {@inheritdoc}
     */

    public $fullName;
  

    public function rules()
    {
        return [
            [['id','created_at', 'updated_at', 'created_by', 'deleted_at','tenant_id'], 'integer'],
            [['fullName'], 'safe']
            //[['fullName'], 'string', 'max' => 255],
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
        $query = Employee::find()
        ->joinWith([
            'profile',
            'company',
            ]    
        );
        
     

        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()){
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           // $query->joinWith(['profile']);
            return $dataProvider;
        }

     
    
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employee.created_at' => $this->created_at,
            'employee.updated_at' => $this->updated_at,
            'employee.created_by' => $this->created_by,
            'employee.deleted_at' => $this->deleted_at,
            'tenant_id' => $this->tenant_id,
        ]);

       

     
         // filter by country name
        /*
         $query->joinWith(['profile' => function ($q) {
            $q->andWhere('profile.last_name LIKE "%' . $this->fullName . '%"');
        }]);
        */

        $query->andFilterWhere(['like', 'profile.name', $this->fullName]);
        $query->orFilterWhere(['like', 'profile.last_name', $this->fullName]);
        $query->orFilterWhere(['like', 'profile.patronymic', $this->fullName]);


        return $dataProvider;
    }

}
