<?php 
namespace common\service;

use Yii;
use common\models\Profile;
use common\models\Employee;
use common\models\Car;

class HistoryService extends BaseService implements ServiceInterface{
        

    public function addPerson($obj)
    {
        return $this->soap()->AddPerson($obj);
    }
 

}

?>