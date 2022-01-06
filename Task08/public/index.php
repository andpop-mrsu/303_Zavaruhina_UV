<!DOCTYPE html>
<html lang="en">
<head>
<h1 align="center">Меню</h1>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALON</title>
</head>
<body>

<div class="container" style="margin-top: 50px">
  <ul class="list-group">
    <li class="list-group-item"> <a class="nav-link <?php if($GET['form'] == 'employees') echo ' disabled'?>" href="?form=employees">Добавить мастера</a> </li>
    <li class="list-group-item"> <a class="nav-link <?php if($GET['form'] == 'schedule') echo ' disabled'?>" href="?form=schedule">Добавить время работы</a> </li>
    <li class="list-group-item"> <a class="nav-link <?php if($GET['form'] == 'work_accounting') echo ' disabled'?>" href="?form=work_accounting">Записаться к мастеру</a> </li>
  </ul>
</div>

<?php
    $pdo = new PDO('sqlite:../data/salon.db');
?>


<div class="container" style="margin-top: 50px; padding-bottom: 50px;">
<?php

  if( isset($_GET['form']) ){
    if( $_GET['form'] == 'employees' ) include_once('./forms/adding_employee.php');
    if( $_GET['form'] == 'schedule' ) include_once('./forms/adding_schedule.php');
    if( $_GET['form'] == 'work_accounting' ) include_once('./forms/adding_work_accounting.php');
  }
?>
</div>  
</body>
</html>