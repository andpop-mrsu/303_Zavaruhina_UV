<?php
    
    if( isset($_POST['inputEmployee']) ){
        $sql = "INSERT INTO schedule (id_employees, date_of_recording, start_work_time, end_work_time) VALUES (?, ?, ?, ?)";
        

        $pdo->prepare($sql)->execute([
            $_POST['inputEmployee'], 
            $_POST['inputDate'], 
            $_POST['inputStartTime'],
            $_POST['inputEndTime']
        ]);
    }
?>

<?php
    function get_array_of_employee_numbers( $rows ){
        $array = array( );
        for( $i = 0; $i < count( $rows ); $i++)
            $array[$i] = array($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3]);
        return $array;
    }

    $list_of_all_employee_query = "
        SELECT
            id, surname, name, patronymic
        FROM employees
    ";

    $statement = $pdo->query( $list_of_all_employee_query );
    $rows = $statement->fetchAll();
    $statement->closeCursor();


    $employee_array = get_array_of_employee_numbers( $rows );

?>

<form role="form" action="" method="post">

  <div class="form-row">
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputEmployee">Мастер</label>
        <select class="form-control" id="inputEmployee" name="inputEmployee" required>
            <?php $isActive = True;?>
            <?php foreach($employee_array as $s): ?>
            <div class="form-row">
                <option value="<?= $s[0] ?>"  <?php if($isActive){ echo 'selected'; $isActive = False;}?>><?= $s[0].' '.$s[1].' '.$s[2].' '.$s[3] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputDate">Дата работы</label>
        <input type="date" class="form-control" id="inputDate" name="inputDate" min="<?=date('Y-m-d', time())?>" required >
    </div>
  </div>


  <div class="form-row">
  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputStartTime">Начало работы</label>
        <input type="time" class="form-control" id="inputStartTime" name="inputStartTime" onChange="change(this.value)" value="08:00" required >
    </div>
  </div>


  <div class="form-row">
  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
        <label for="inputEndTime">Окончание работы</label>
        <input type="time" class="form-control" id="inputEndTime" name="inputEndTime" value="19:00" required >
    </div>
  </div>

  <button type="submit" class="btn btn-primary float-right">Отправить</button>
</form>