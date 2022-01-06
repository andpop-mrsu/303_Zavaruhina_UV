<?php
    $pdo = new PDO('sqlite:../../data/salon.db');

    echo $_POST['val'];

    function get_array_of_employee_numbers( $rows ){
        $array = array( );
        for( $i = 0; $i < count( $rows ); $i++)
            $array[$i] = array($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3]);
        return $array;
    }

    $list_of_all_employee_query = "
        SELECT
        e.id,
        e.name,
        e.surname,
        e.patronymic 
        FROM employee_specialization as es
        inner join employees as e on e.id = es.id_employees 
        WHERE es.id_service = ".$_POST['val']."
    ";


    $statement = $pdo->query( $list_of_all_employee_query );
    $rows = $statement->fetchAll();
    $statement->closeCursor();


    $employee_array = get_array_of_employee_numbers( $rows );

?>

        
            <?php $isActive = True;?>
            <?php foreach($employee_array as $s): ?>
            <div class="form-row">
                <option value="<?= $s[0] ?>"  <?php if($isActive){ echo 'selected'; $isActive = False;}?>><?= $s[0].' '.$s[1].' '.$s[2].' '.$s[3] ?></option>
            <?php endforeach; ?>