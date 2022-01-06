<?php
    $pdo = new PDO('sqlite:../../data/salon.db');

    function get_array_of_employee_numbers( $rows ){
        $array = array( );
        for( $i = 0; $i < count( $rows ); $i++)
            $array[$i] = array($rows[$i][0], $rows[$i][1]);
        return $array;
    }

    $list_of_all_employee_query = "
        SELECT start_work_time, end_work_time
        from schedule
        where id_employees = ".$_POST['id']." and date(date_of_recording) = date('".$_POST['date']."')
        order by id desc
        limit 1
    ";


    $statement = $pdo->query( $list_of_all_employee_query );
    $rows = $statement->fetchAll();
    $statement->closeCursor();


    $employee_array = get_array_of_employee_numbers( $rows );


    if(!empty($employee_array)):
?>

        

  <div class="form-group col-md-4"></div>
  <div class="form-group col-md-4"></div>
  
    <div class="form-group col-md-4">
        <label for="inputStartTime">Начало работы</label>
        <input type="time" class="form-control" id="inputStartTime" name="inputStartTime" onChange="change(this.value)" value="<?= $employee_array[0][0]?>" max="<?= $employee_array[0][1]?>" required >
    </div>

<?php endif; ?>