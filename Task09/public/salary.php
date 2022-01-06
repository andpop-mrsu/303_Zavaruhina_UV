<?php include 'func_schedule.php';
session_start();
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

  <title>График работы</title>
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
        <h3 class='headers '>График работы</h3>
        <h5 class='headers mt-3 '><?= $fio[0]['master'] ?></h5>
        <table class="table table-striped table-hover mt-4 text-center">
          <thead class="table table-primary">
            <th>День недели</th>
            <th>Начало работы</th>
            <th>Окончание работы</th>
            <th>Редактировать</th>
          </thead>
          <tbody>
            <?php foreach ($result as $value) { ?>
              <tr>
                <td><?= $value['day'] ?></td>
                <td><?= $value['start_work_time'] ?></td>
                <td><?= $value['end_work_time'] ?></td>
                <td>
                  <a href="?edit=<?= $value['id'] ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModalSchedule<?= $value['id'] ?>">
                    <i class="fa fa-edit"></i>
                  </a>
                  <a href="?delete=<?= $value['id'] ?>$master_id=<? $fio[0]['master'] ?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModalSchedule<?= $value['id'] ?>">
                    <i class="fa fa-trash"></i>
                  </a>
                  <?php require 'md_Salary.php'; ?>
                </td>
              </tr> <?php } ?>
          </tbody>
        </table>
        <div style="text-align: right">
          <button class="btn btn-success mt-3" data-toggle="modal" data-target="#addSсheduleModal"><i class="fa fa-calendar-plus"></i> Добавить</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade " tabindex="-1" role="dialog" id='addSсheduleModal'>
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content shadow">

        <div class="modal-header">
          <h5 class="modal-title">Добавить запись</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body ">
          <form action="" method='post'>

            <div class="form-row">
              <div class="form-group">
                <label for="inputDate">Дата работы</label>
                <input type="date" class="form-control" id="inputDate" name="inputDate" min="<?= date('Y-m-d', time()) ?>" required>
              </div>
            </div>


            <div class="form-row">
              <div class="form-group">
                <label for="inputStartTime">Начало работы</label>
                <input type="time" class="form-control" id="inputStartTime" name="inputStartTime" onChange="change(this.value)" value="08:00" required>
              </div>
            </div>

            <script type="text/javascript">
              function change(e) {
                console.log(e);
                document.getElementById("inputEndTime").min = e;
              }
            </script>

            <div class="form-row">
              <div class="form-group">
                <label for="inputEndTime">Окончание работы</label>
                <input type="time" class="form-control" id="inputEndTime" name="inputEndTime" value="19:00" required>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
              <button type="submit" class="btn btn-primary" name='addSсhedule'>Отправить</button>
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
