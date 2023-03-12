<?php 
namespace common\service;


abstract class BaseService{

    private $soap = null; 
    protected function mkTimeFromStr($dateString,$separator="-"){
        $dateArray = explode($separator,$dateString);
        return mktime(0,0,0,$dateArray[1],$dateArray[0],$dateArray[2]);
    }

    protected static function soap()
    {
        try {
            if(!$this->soap)
                $this->soap = new SoapClient("http://127.0.0.1:8090/wsdl/IOrionPro");
            return $this->soap;
            
        } catch (\Throwable $th) {
            throw new \yii\web\HttpException(500, 'not connection with soap service!');
        }
    }

} 
?>