<?php

namespace common\models\activeQuery;

/**
 * This is the ActiveQuery class for [[\common\models\UserParking]].
 *
 * @see \common\models\UserParking
 */
class UserParkingActiveQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\UserParking[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\UserParking|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
