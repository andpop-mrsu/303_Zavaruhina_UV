<?php

require_once('./includes/table.php');
require_once('./includes/services.php');
require_once('./includes/employee_validation.php');

try {
    $pdo = new PDO('sqlite:salon.db');

    $list_of_all_employee_query = "
        SELECT
            emp.id AS 'Master id', 
            emp.surname || ' ' || emp.name || ' ' || emp.patronymic AS 'Surname Name Patronymic'
        FROM employees AS emp";
    $statement = $pdo->query( $list_of_all_employee_query );
    $rows = $statement->fetchAll();
    $statement->closeCursor();
    
   create_table($rows);
    
    $employee_number = readline("Master number: ");

    if( (bool)employee_number_validation($employee_number , $rows) == True)
        list_of_services($pdo, array($employee_number), "ORDER BY `Work date`");
    else if( (bool)empty($employee_number) == True)
        list_of_services($pdo, get_array_of_employee_numbers( $rows ), "ORDER BY `Surname Name Patronymic`, `Work date`");
    else
        echo 'Master with the given number was not find';

} catch (PDOException $emp) {
    print "Error: " . $emp->getMessage();
    die();
}
?>