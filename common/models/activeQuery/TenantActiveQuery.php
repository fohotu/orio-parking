<?php
namespace common\models\activeQuery;

/**
 * This is the ActiveQuery class for [[Tenant]].
 *
 * @see Tenant
 */
class TenantActiveQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tenant[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tenant|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
