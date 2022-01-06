<?php
    
    if( isset($_POST['inputSurname']) ){
        $sql = "INSERT INTO employees (surname, 'name', patronymic, date_of_birth, phone_number, salary_percent, gender) VALUES (?, ?, ?, ?, ?, ?, ?)";
        

        if($pdo->prepare($sql)->execute([
            $_POST['inputSurname'], 
            $_POST['inputName'], 
            $_POST['inputPatronymic'],
            $_POST['inputDateOfBirth'],
            $_POST['inputPhoneNumber'],
            $_POST['inputSalaryPercent'],
            $_POST['inputGender']
        ])){
            $last_id = $pdo->lastInsertId();

            $arraiID = 0;
            $data = [];
            for($i = 0; $i < $_POST['inputServiceCount']; $i++){
                if( isset($_POST['inputService'.$i])){
                    $data[$arraiID] = [$last_id, $i];
                    $arraiID++;
                }
            }

            $stmt = $pdo->prepare("INSERT INTO employee_specialization (id_employees, id_service) VALUES (?,?)");
            try {
                $pdo->beginTransaction();
                foreach ($data as $row)
                {
                    $stmt->execute($row);
                }
                $pdo->commit();
            }catch (Exception $e){
                $pdo->rollback();
                throw $e;
            }
        }
    }
?>

<?php

    function get_array_of_employees_numbers( $rows ){
        $array = array( );
        for( $i = 0; $i < count( $rows ); $i++)
            $array[$i] = array($rows[$i][0], $rows[$i][1]);
        return $array;
    }

    $list_of_all_employees_query = "
        SELECT
            id, service_name
        FROM service
    ";

    $statement = $pdo->query( $list_of_all_employees_query );
    $rows = $statement->fetchAll();
    $statement->closeCursor();


    $employees_array = get_array_of_employees_numbers( $rows );

?>

<form role="form" action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-4">
        <label for="inputSurname">Фамилия</label>
        <input type="text" class="form-control" id="inputSurname" name="inputSurname" placeholder="Введите фамилию" required pattern="[А-Яа-я]{1,32}">
    </div>
    <div class="form-group col-md-4">
         <label for="inputName">Имя</label>
        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Введите имя" required pattern="[А-Яа-я]{1,32}">
    </div>
    <div class="form-group col-md-4">
        <label for="inputPatronymic">Отчество</label>
        <input type="text" class="form-control" id="inputPatronymic" name="inputPatronymic" placeholder="Введите отчество" required pattern="[А-Яа-я]{1,32}">
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputDateOfBirth">Дата рождения</label>
        <input type="date" class="form-control" id="inputDateOfBirth" name="inputDateOfBirth" placeholder="Дата рождения" required>
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputPhoneNumber">Номер телефона</label>
        <input type="text" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber" placeholder="Номер телефона" required pattern="\8\[0-9]{3}\[0-9]{3}\[0-9]{2}\[0-9]{2}">
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputGender">Пол</label>
        <select class="form-control" id="inputGender" name="inputGender" aria-label="Default select example" required>
            <option value="М" selected>М</option>
            <option value="Ж">Ж</option>
            <option value="Другое">Другое</option>
        </select>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <script type="text/javascript">
        function enforceMinMax(el){
            if(el.value != ""){
                if(parseInt(el.value) < parseInt(el.min)){
                el.value = el.min;
                }
                if(parseInt(el.value) > parseInt(el.max)){
                el.value = el.max;
                }
            }
        }
        </script>
        <label for="inputSalaryPercent">Процент заработка</label>
        <input type="number" min="0" max="100"  class="form-control" id="inputSalaryPercent" name="inputSalaryPercent" value="90" onkeyup=enforceMinMax(this) required>
    </div>
  </div>


  <p class="font-weight-bold">Услуги</p>
<?php foreach($employees_array as $s): ?>
    <div class="form-row">
  <input type="checkbox" class="form-check-input" id="inputService<?= $s[0]; ?>" name="inputService<?= $s[0]; ?>">
    <label class="form-check-label" for="inputService<?= $s[0]; ?>"><?= $s[1]; ?></label>
    </div>
<?php endforeach; ?>

<input type="hidden" value="<?= count($employees_array);?>" name="inputServiceCount">

  <button type="submit" class="btn btn-primary float-right">Записать</button>
</form>