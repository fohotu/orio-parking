<?php

namespace common\models\activeQuery;

/**
 * This is the ActiveQuery class for [[\common\models\UserCar]].
 *
 * @see \common\models\UserCar
 */
class UserCarActiveQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\UserCar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\UserCar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
