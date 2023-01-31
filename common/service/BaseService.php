<?php 
namespace common\service;


abstract class BaseService{


    protected function mkTimeFromStr($dateString,$separator="-"){
        $dateArray = explode($separator,$dateString);
        return mktime(0,0,0,$dateArray[1],$dateArray[0],$dateArray[2]);
    }

} 
?>