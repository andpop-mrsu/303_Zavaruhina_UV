<?php
include 'connection_with_base.php';

$master_id = $_GET['master_id'];
$sql = $pdo->prepare("SELECT id, surname || ' ' || name || ' ' || patronymic AS 'master' FROM employees
                                    WHERE id = ?");
$sql->execute([$master_id]);
$fio = $sql->fetchAll();

if (isset($_POST['addSсhedule'])) {


    $sql = ("INSERT INTO schedule (id_employees, date_of_recording,
                start_work_time, end_work_time) VALUES (?,?,?,?)");
    $query = $pdo->prepare($sql);
    $query->execute(
        [
            $master_id,
            $_POST['inputDate'],
            $_POST['inputStartTime'],
            $_POST['inputEndTime']
        ]
    );

    header("Location: " . $_SERVER['REQUEST_URI']);
}

$sql = $pdo->prepare("SELECT schedule.id AS id,
                        schedule.id_employees AS id_master,
                        schedule.date_of_recording AS day,
                        schedule.start_work_time AS start_work_time, 
                        schedule.end_work_time AS end_work_time
                      FROM schedule
                      WHERE id_employees = ?
                    ");
$sql->execute([$master_id]);
$result = $sql->fetchAll();


if (isset($_POST['edit-submit-schedule'])) {

    $id = $_GET['id'];

    $sql = "UPDATE schedule SET id_employees=?, date_of_recording=?,
                start_work_time=?, end_work_time=?
            WHERE id=?";

    $query = $pdo->prepare($sql);
    $query->execute([
        $master_id,
        $_POST['inputDate'],
        $_POST['inputStartTime'],
        $_POST['inputEndTime'], 
        $id
    ]);

    header("Location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['delete_submit_sh'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM schedule WHERE id=?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    header("Location: " . $_SERVER['REQUEST_URI']);
}