<?php 
namespace common\models;

class Dummy{

    public static function getEvents($max)
    {

        $ev = [];
        for($i=0;$i<$max;$i++){
            $obj = new \stdClass();
            $obj->EventId = "{".$i."BD3E96A-99AF-ED11-9169-A08CFDEC63B0}"; 
            $obj->EventTypeId = 8200;
            $obj->EventDate = "2023-02-18T17:3".$i.":58.000+03:00";
            $obj->Description = "[M323KX16] Выезд";
            $obj->ComputerId = 1;
            $obj->ComPortNumber = 0;
            $obj->PKUAddress = 0;
            $obj->DevAddress = 0;
            $obj->ZoneAddress = 0;
            $obj->AccessPointId = 0;
            $obj->PassMode = 0;
            $obj->PersonId = 0;
            $obj->LastName = "";
            $obj->FirstName = "";
            $obj->MiddleName = "";
            $obj->BirthDate = "1899-12-30T00:00:00.000+03:00";
            $obj->TabNum ="";
            $obj->ItemId= 0;
            $obj->ItemType= "RECOGNITION_CHANNEL";
            $obj->SectionId= 0;
            $obj->ReaderId= -1;
            $obj->AccessFlags = new \stdClass;
            $obj->AccessFlags->IsBlocked = false; 
            $obj->AccessFlags->IsNoRights = false; 
            $obj->AccessFlags->IsBrokenAntipassback = false; 
            $obj->AccessFlags->IsBrokenTimeWindow = false; 
            $obj->AccessFlags->IsAdditionalCodeInputError = false; 
            $obj->AccessFlags->IsDuressCode = false; 
            $obj->AccessFlags->IsConfirmationCodeError = false; 
            $obj->AccessFlags->IsConfirmationWaiting = false; 

            $ev [] = $obj;
        }

        return $ev;
    }

}

?>