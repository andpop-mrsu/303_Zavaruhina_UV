<?php include 'functions.php';
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
  <style>
  .headers {
  text-align: center;
  }
  </style>

  <title>Главная</title>
</head>

<body>

  <div class="container" style="padding-bottom: 100px;">
    <div class="row">
      <div class="col-12">
        <table class="table table-striped table-hover mt-3">
          <thead class="table table-primary text-center">
            <th>id</th>
            <th>ФИО мастера</th>
            <th>Специализация</th>
            <th>Редактировать</th>
          </thead>
          <tbody>
            <?php foreach ($result as $value) {
              $fio = $value['surname'] . ' ' . $value['name'] . ' ' . $value['patronymic'];
            ?>
              <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $fio ?></td>
                <td class="text-center"><?= $value['gender'] ?></td>
                <td class="text-center">
                  <a href="?edit=<?= $value['id'] ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?= $value['id'] ?>">
                    <i class="fa fa-edit"></i>
                  </a>
                  <a href="?delete=<?= $value['id'] ?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $value['id'] ?>">
                    <i class="fa fa-trash"></i>
                  </a>
                  <a href="salary.php?master_id=<?= $value['id'] ?> " class="btn btn-warning">График</a>
                  <a href="working.php?master_id=<?= $value['id'] ?>" class="btn btn-primary">Выполненные работы</a>
                  <?php require 'md.php'; ?>
                </td>
              </tr> <?php } ?>
          </tbody>
        </table>

        <div style="text-align: right">
          <button class="btn btn-success mt-3 pull-right" data-toggle="modal" data-target="#AddModal"><i class="fa fa-user-plus"></i> Добавить</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id='AddModal'>
    <div class="modal-dialog modal-dialog-centered" role="document" style="
    min-width: 70%;
">
      <div class="modal-content shadow">

        <div class="modal-header">
          <h5 class="modal-title">Добавить запись</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method='post'>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputLastName">Фамилия</label>
                <input type="text" value="<?= $value['surname'] ?>" class="form-control" id="inputSurname" name="inputSurname" placeholder="Фамилия" required pattern="[А-Яа-я]{1,32}">
              </div>
              <div class="form-group col-md-4">
                <label for="inputName">Имя</label>
                <input type="text" value="<?= $value['name'] ?>" class="form-control" id="inputName" name="inputName" placeholder="Имя" required pattern="[А-Яа-я]{1,32}">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPatronymic">Отчество</label>
                <input type="text" value="<?= $value['patronymic'] ?>" class="form-control" id="inputPatronymic" name="inputPatronymic" placeholder="Отчество" required pattern="[А-Яа-я]{1,32}">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="inputBirthDate">Дата рождения</label>
                <input type="date" value="<?= $value['date_of_birth'] ?>" class="form-control" id="inputBirthDate" name="inputBirthDate" placeholder="Дата рождения" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="inputPhoneNumber">Номер телефона</label>
                <input type="text" value="<?= $value['phone_number'] ?>" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber" placeholder="Номер телефона" required pattern="\8\[0-9]{3}\[0-9]{3}\[0-9]{2}\[0-9]{2}">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="inputGender">Пол</label>
                <select class="form-control" id="inputGender" name="inputGender" aria-label="Default select example" required>
                  <option value="М" <?php if ($value['gender'] == "М") echo 'selected'; ?>>М</option>
                  <option value="Ж" <?php if ($value['gender'] == "Ж") echo 'selected'; ?>>Ж</option>
                  <option value="Другое">Другое</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4">
                <script type="text/javascript">
                  function enforceMinMax(el) {
                    if (el.value != "") {
                      if (parseInt(el.value) < parseInt(el.min)) {
                        el.value = el.min;
                      }
                      if (parseInt(el.value) > parseInt(el.max)) {
                        el.value = el.max;
                      }
                    }
                  }
                </script>
                <label for="inputCostPercent">Процент с заказа</label>
                <input type="number" value="<?= $value['percent'] ?>" min="0" max="100" class="form-control" id="inputCostPercent" name="inputCostPercent" value="90" onkeyup=enforceMinMax(this) required>
              </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
              <button type="submit" class="btn btn-primary" name='add'>Отправить</button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
