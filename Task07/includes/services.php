<?php
function list_of_services( $pdo, $id_list, $order_query=NULL){
    $id_list = implode(',', $id_list);

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
    WHERE emp.id IN (".$id_list.")";

    $statement = $pdo->query( $list_of_all_services_query.$order_query );
    $rows = $statement->fetchAll();
    create_table($rows);
    $statement->closeCursor();
}

function get_array_of_employee_numbers( $rows ){
    $array = array( count( $rows ) );
    for( $i = 0; $i < count( $rows ); $i++)
        $array[$i] = $rows[$i][0];
    return $array;
}
?>