<?php 
namespace common\models\receive;

abstract class BaseReceive{

    abstract public function getModel();

    public function run()
    {
        $model = $this->getModel();
        return clone $model;
    }

}

?>