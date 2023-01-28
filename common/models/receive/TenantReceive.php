<?php 
namespace common\models\receive;

use common\models\receive\BaseReceive;
use common\models\Tenant;

class TenantReceive extends BaseReceive{

    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function getModel(){
        return new $this->class();
    }

    public function getDropDownList()
    {
        $result = $this->run()
        ->find()
        ->select(['id','tenant_name'])
        ->asArray()
        ->all();
        return $result;
    }
}
?>