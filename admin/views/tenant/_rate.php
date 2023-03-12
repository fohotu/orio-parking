<?php

/*


1. Безлимитный - Администратор выставляет любому зарегистрированному в системе человеку 
без ограничений выезда и въезда



2. По количеству мест - выставляется количество мест. Действует в течении дня. 
В личном кабинете контрагента видно количество оставшихся мест. 
При превышении количества мест могут заводить по тарифу часовой.


3. Почасовой - любой может завести тариф. 
Стоимость часа выставляется в личном кабинета администратора



Когда создаешь сотрудника или организацию, будет дропдаун с тарифами-
2 тарифа: месяц, час.
Если выбираешь месяц - открывается инпут и вводишь цену за календарный месяц.
Если час - то вводишь цену за час .

*/


?>

<?php 
    echo   $form->field($model, 'day_rate')->checkBox(['maxlength' => true]);
    echo   $form->field($model, 'hour_rate')->checkBox(['maxlength' => true]);
    echo $form->field($model,'cost_per_hour')->textInput();
?>

<div class="card">
  <div class="card-body">
    
  <div class="form-row" >
            <div class="form-group col-md-2">
                
                <div class="form-check">
                    <input name="['Tenant']['unlime_rate_1']"  class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                        1-Тариф (Безлимитный)
                    </label>
                </div>
            </div>    
            <div class="form-group col-md-3">
            <label for="inputState">State</label>
            <select name="['Tenant']['unlime_users_1']" id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option name="user1">User 1</option>
                <option name="user2">User 2</option>
                <option name="user3">User 3</option>
            </select>
            </div>
        </div>  

  </div>
</div>

<div class="card">
  <div class="card-body">

    <div class="form-row">
        <div class="form-group col-md-2">
            <div class="form-check">
            <input name="['Tenant']['count_place_1']" class="form-check-input" type="checkbox" id="gridCheck2">
            <label class="form-check-label" for="gridCheck2">
                2-Тариф (По количеству мест) 
                
            </label>
            </div>
        
        </div>
        <div class="form-group col-md-3">
        <label for="inputEmail4">количество мест</label>
        <input name="['Tenant']['count_place2']" type="text" class="form-control" id="inputEmail4" placeholder="Email">
        </div>
        <div class="form-group col-md-3">
        <label for="inputPassword4">День</label>
        <input name="['Tenant']['count_day_2']" type="text" class="form-control" id="inputPassword4" placeholder="Password">
        </div>
        <div class="form-group col-md-4">
        <label for="inputPassword4_1">Сумма</label>
        <input name="['Tenant']['count_sum_4']" type="text" class="form-control" id="inputPassword_1" placeholder="Password">
        </div>
    </div>

    </div>
</div>

<div class="card">
  <div class="card-body">



  <div class="form-row">
    <div class="form-group col-md-2">
        <div class="form-check">
            <input name="['Tenant']['hour_rate_3']" class="form-check-input" type="checkbox" id="gridCheck3">
            <label class="form-check-label" for="gridCheck3">
                3-Тариф (Почасовой)
            
            </label>
        </div>
    
    </div>
    <div class="form-group col-md-3">
        <label  for="inputAddress2">Стоимость часа</label>
        <input name="['Tenant']['cost_hour_4']" type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
    </div>
  </div>  
 
    </div>
</div>  


