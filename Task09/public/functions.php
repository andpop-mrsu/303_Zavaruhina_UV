<?php
include 'connection_with_base.php';

if (isset($_POST['add'])) {
    $sql = "INSERT INTO employees (surname, `name`, patronymic, date_of_birth, phone_number, salary_percent, gender) VALUES (?, ?, ?, ?, ?, ?, ?)";


    $pdo->prepare($sql)->execute([
        $_POST['inputSurname'],
        $_POST['inputName'],
        $_POST['inputPatronymic'],
        $_POST['inputBirthDate'],
        $_POST['inputPhoneNumber'],
        $_POST['inputSalaryPercent'],
        $_POST['inputGender']
    ]);

    header("Location: " . $_SERVER['REQUEST_URI']);
}

$sql = $pdo->prepare("SELECT master.id AS id,
                       master.surname AS surname,
                       master.name AS 'name',
                       master.patronymic AS patronymic,
                       master.salary_percent AS percent,
                       master.gender AS gender,
                       master.date_of_birth as date_of_birth,
                       master.phone_number as phone_number
                        FROM employees AS master
                    ");
$sql->execute();
$result = $sql->fetchAll();


if (isset($_POST['edit-submit'])) {
    $sqll = "UPDATE employees SET surname=?, `name`=?, patronymic=?, date_of_birth=?, phone_number=salary=?, gender=?
            WHERE id=?";

    $querys = $pdo->prepare($sqll);

    print_r($querys);

    $querys->execute([
        $_POST['inputSurname'],
        $_POST['inputName'],
        $_POST['inputPatronymic'],
        $_POST['inputBirthDate'],
        $_POST['inputPhoneNumber'],
        $_POST['inputSalaryPercent'],
        $_POST['inputGender'],
        $_GET['id']
    ]);

    header("Location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['delete_submit'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM employees WHERE id=?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    header("Location: " . $_SERVER['REQUEST_URI']);
}