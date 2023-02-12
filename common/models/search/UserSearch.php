<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */

     public $fullName;
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'tenant_id'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'safe'],
            [['fullName'],'string'],
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
        $query = User::find()
        ->joinWith([
            'profile',
            ]    
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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tenant_id' => $this->tenant_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);


            $query->andFilterWhere(['like', 'profile.name', $this->fullName]);
            $query->orFilterWhere(['like', 'profile.last_name', $this->fullName]);
            $query->orFilterWhere(['like', 'profile.patronymic', $this->fullName]);

        return $dataProvider;
    }



    public function attributeLabels()
    {
        return [
            'fullName' => 'Полное имя',
            'username' => 'Логин',
            'email' => 'Электронная почта',
            'status' => 'Статус',
            'tenant_id' => 'Организация',
        ];
    }
}
