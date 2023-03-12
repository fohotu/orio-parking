<?php 
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = "Security Page";

?>

<table id="sct" class="table table-bordered" style="display:none">

        <tr>
             <td>#</td>   
             <td>Номер</td>   
             <td>Время</td>   
             <td>Организация</td>
             <td>Водител</td>   
        </tr>
        <?php 
        for($i=1;$i<2;$i++){
        ?> 
            <tr>
             <td>въезд</td>   
             <td>Y<?=$i.rand(11,99)?>AA<?=rand(99,999)?></td>   
             <td>20.02.2023 18:26:48</td>   
             <td>--</td>
             <td>Ивановна</td>   
            </tr>

        <?php 
            }
        ?>
</table>

<?php 
 Pjax::begin(['id' => 'my_pjax']); 

echo GridView::widget([
    'dataProvider' => $provider,
]);

Pjax::end();

?>

<?php 
$url = Url::to(['parking']);
$js = "

fetch('$url')
.then((response)=>{
    const res = response.json();
    res.then((r)=>{
        let tb = document.querySelector('#sct tbody');
        r.forEach((e)=>{
            let tr = document.createElement('tr');
            let comp = document.createElement('td');
            let dt = document.createElement('td');
            let empl = document.createElement('td');
            let num = document.createElement('td');
            let type = document.createElement('td');

            let compText = document.createTextNode(e.company);
            let dtText = document.createTextNode(e.date_time);
            let emplText = document.createTextNode(e.employe);
            let typeText = document.createTextNode(e.type);
            let numText = document.createTextNode(e.number);

            comp.appendChild(compText);
            dt.appendChild(dtText);
            empl.appendChild(emplText);
            type.appendChild(typeText);
            num.appendChild(numText);

            tr.appendChild(type);
            tr.appendChild(num);
            tr.appendChild(dt);
            tr.appendChild(comp);
            tr.appendChild(empl);
           

            tb.appendChild(tr);


        });
    });
})
";

$reload ="
    setInterval(()=>{
        $.pjax.reload('#my_pjax');
    },5000);
";
$this->registerJS($reload);

?>