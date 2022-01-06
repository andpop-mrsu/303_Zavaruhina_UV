<?php
include 'connection_with_base.php';
session_start();

$id = $_GET['master_id'];

$query = "SELECT employees.id AS 'id', 
employees.surname || ' ' || employees.name || ' ' || employees.patronymic AS 'master', 
work_accounting.date_of_recording AS 'date', 
service.service_name AS 'service_name', 
service.price AS 'price',
work_accounting.id AS 'wid'
FROM work_accounting INNER JOIN employees 
ON work_accounting.id_employees = employees.id 
INNER JOIN service 
ON work_accounting.id_service = service.id 
WHERE employees.id = ?
";

$query = $pdo->prepare($query);
$query->execute([$id]);
$result = $query->fetchAll(); ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

  <title>Выполненные работы </title>
  <style>
  .headers {
  text-align: center;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a href="index.php"><button class="btn btn-submit mt-3"><i class="fa fa-arrow-circle-left"></i> Назад</button></a>
        <h3 class='headers mt'>Выполненные работы</h2>
          <table class="table table-striped table-hover mt-4 text-center">
            <thead class="table-primary">
              <th>id</th>
              <th>Мастер</th>
              <th>Услуга</th>
              <th>Дата</th>
              <th>Стоимость</th>
            </thead>
            <tbody>
              <?php foreach ($result as $value) { ?>
                <tr>
                  <td><?= $value['wid'] ?></td>
                  <td><?= $value['master'] ?></td>
                  <td><?= $value['service_name'] ?></td>
                  <td><?= $value['date'] ?></td>
                  <td><?= $value['price'] ?></td>
                </tr> <?php } ?>
            </tbody>
          </table>

      </div>
    </div>
  </div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
