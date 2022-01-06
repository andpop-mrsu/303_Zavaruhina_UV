<div class="modal fade" id="editModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="
    min-width: 70%;
">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Редактировать запись № <?= $value['id'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?id=<?= $value['id'] ?>" method="post">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputSurname">Фамилия</label>
              <input type="text" value="<?= $value['surname'] ?>" class="form-control" id="inputSurname" name="inputSurname" placeholder="Фамилия" required pattern="[А-Яа-я]{1,32}">
            </div>
            <div class="form-group col-md-4">
              <label for="inputName">Имя</label>
              <input type="text" value="<?= $value['name'] ?>" class="form-control" id="inputName" name="inputName" placeholder="Имя" required pattern="[А-Яа-я]{1,32}">
            </div>
            <div class="form-group col-md-4">
              <label for="inputParonymic">Отчество</label>
              <input type="text" value="<?= $value['patronymic'] ?>" class="form-control" id="inputParonymic" name="inputParonymic" placeholder="Отчество" required pattern="[А-Яа-я]{1,32}">
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
              <input type="text" value="<?= $value['phone_number'] ?>" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber" placeholder="89876806524" required pattern="\8\[0-9]{3}\[0-9]{3}\[0-9]{2}\[0-9]{2}">
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
              <label for="inputSalaryPercent">Процент с заказа</label>
              <input type="number" value="<?= $value['percent'] ?>" min="0" max="100" class="form-control" id="inputSalaryPercent" name="inputSalaryPercent" value="90" onkeyup=enforceMinMax(this) required>
            </div>
          </div>


          <input type="hidden" value="<?= count($service_array); ?>" name="inputServiceCount">

          <div class="modal-footer">
            <button type="submit" name="edit-submit" class="btn btn-primary">Обновить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Удаление -->
<div class="modal fade" id="deleteModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удалить запись № <?= $value['id'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <form action="?id=<?= $value['id'] ?>" method="post">
          <button type="submit" name="delete_submit" class="btn btn-danger">Удалить</button>
        </form>
      </div>
    </div>
  </div>
</div>