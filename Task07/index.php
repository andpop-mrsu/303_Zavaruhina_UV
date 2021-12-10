<?php
function get_array_of_employee_numbers( $rows ){
    $array = array( count( $rows ) );
    for( $i = 0; $i < count( $rows ); $i++)
        $array[$i] = $rows[$i][0];
    return $array;
}

$pdo = new PDO('sqlite:salon.db');

$list_of_all_employee_query = "
    SELECT
        emp.id
    FROM employees AS emp
";
$statement = $pdo->query( $list_of_all_employee_query );
$rows = $statement->fetchAll();
$statement->closeCursor();

$employee_array = get_array_of_employee_numbers( $rows );

$option_selected_id = -1;
if( isset( $_POST['employeeId'] ) )
    if( $_POST['employeeId'] != '' )
        $option_selected_id = $_POST['employeeId'];
?>
    

<h1>Master number: </h1>
<form action="" method="POST">
    <label>
        <select style="width: 200px;" name="employeeId">
            <option value=<?= null ?>></option>
            <?php
                foreach($employee_array as $id): 
                    $selected = '';
                    if( $id == $option_selected_id)
                        $selected = 'selected';
            ?>
                <option value=<?= $id ?> <?= $selected ?>>
                    <?= $id ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Find</button>
</form>

<?php

if( isset( $_POST['employeeId'] ) ):
    $id_list = $_POST['employeeId'] === '' ? implode(',', $employee_array) : $_POST['employeeId'];

    $list_of_all_services_query = "
        SELECT
            emp.id AS 'Master id', 
            emp.surname || ' ' || emp.name || ' ' || emp.patronymic AS 'Surname Name Patronymic',
            wa.date_of_recording AS 'Work date',
            serv.service_name AS 'Service',
            serv.price AS 'Price'
        FROM work_accounting AS wa
        INNER JOIN employees AS emp ON wa.id_employees = emp.id
        INNER JOIN service AS serv ON wa.id_service = serv.id
        WHERE emp.id IN(".$id_list.")
    ";

    $statement = $pdo->query( $list_of_all_services_query."ORDER BY `Surname Name Patronymic`, `Work date`" );
    $works = $statement->fetchAll();
    $statement->closeCursor();

    if( count($works) > 0):
?>
        <table class="doctors-table" cellpadding="7" cellspacing="0" border="1" width="100%">
            <tr class="table-header">
                <th>Master id</th>
                <th>Surname Name Patronymic</th>
                <th>Work date</th>
                <th>Service</th>
                <th>Price</th>
            </tr>
            <?php foreach($works as $work): ?>
                <tr>
                    <td><?= $work[0] ?></td>
                    <td><?= $work[1] ?></td>
                    <td><?= $work[2] ?></td>
                    <td><?= $work[3] ?></td>
                    <td><?= $work[4] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
<?php 
    endif;
endif;
?>

</body>
</html>