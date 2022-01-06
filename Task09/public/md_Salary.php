<div class="modal fade" id="editModalSchedule<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Редактировать запись </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?id=<?= $value['id'] ?>&master_id=<?= $fio[0]['id'] ?>" method="post">


          <div class="form-row">
            <div class="form-group">
              <label for="inputDate">Дата работы</label>
              <input type="date" value="<?= $value['day'] ?>" class="form-control" id="inputDate" name="inputDate" min="<?= date('Y-m-d', time()) ?>" required>
            </div>
          </div>


          <div class="form-row">
            <div class="form-group">
              <label for="inputStartTime">Начало работы</label>
              <input type="time" value="<?= $value['start_work_time'] ?>" class="form-control" id="inputStartTime" name="inputStartTime" onChange="change(this.value)" required>
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
              <input type="time" value="<?= $value['end_work_time'] ?>" class="form-control" id="inputEndTime" name="inputEndTime" required>
            </div>
          </div>





          <div class="modal-footer">
            <button type="submit" name="edit-submit-schedule" class="btn btn-primary">Обновить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="deleteModalSchedule<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удалить запись </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <form action="?id=<?= $value['id'] ?>&master_id=<?= $fio[0]['id'] ?>" method="post">
          <button type="submit" name="delete_submit_sh" class="btn btn-danger">Удалить</button>
        </form>
      </div>
    </div>
  </div>
</div>