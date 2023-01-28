<?php 
abstract class BaseQuery{

    abstract public function getModel();

    public function startQuery()
    {
        $model = $this->getModel();
        return clone $model;
    }

}

?>