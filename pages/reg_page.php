<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../assets/styles/reg_page.css">
    <?php 
		  require('../scripts/connection.php');
	  ?>
</head>

<form class="registration-form" method="post" action="">
  <h2>Регистрация</h2>
  <div class="form-group">
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" placeholder="Введите логин" required>
  </div>
  <div class="form-group">
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" placeholder="Введите пароль" value="" required>
    <input type="button" name="password_generate" value="Сгенерировать пароль" onclick="generatePassword(8)">
  </div>
  <div class="form-group">
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" placeholder="Введите имя" value="" required>
  </div>
  <div class="form-group">
    <label for="surname">Фамилия:</label>
    <input type="text" id="surname" name="surname" placeholder="Введите фамилию"  value="" required>
  </div>
  <div class="form-group">
    <label for="patronymic">Отчество:</label>
    <input type="text" id="patronymic" name="patronymic" placeholder="Введите отчество" value="" required>
  </div>
  <div class="form-group">
    <label>
      <input type="radio" id="student" name="role" value="4"> Студент
    </label>
    <label>
      <input type="radio" id="teacher" name="role" value="3"> Преподаватель
    </label>
  </div>
  <div class="form-group" id="group-container">
    <label for="group">Группа:</label>
    <select id="group" name="group" disabled>
      <option value="" disabled selected>Выберите группу</option>
      <option value="group1">Группа 1</option>
      <option value="group2">Группа 2</option>
      <option value="group3">Группа 3</option>
    </select>
  </div>
  <div class="form-group">
    <button type="submit" name="reg-btn">Зарегистрировать</button>
  </div>
</form>

<?php
  // Проверка, была ли отправлена форма регистрации
  if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
      // Получаем данные из формы
      $login = $_POST['login'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $patronymic = $_POST['patronymic'];
      $role = $_POST['role'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `users` (`login`, `password`, `first_name`, `second_name`, `patronymic_name`, `role_id`) 
                  VALUES ('$login', '$hashedPassword', '$name', '$surname', '$patronymic', '$role')";
        $result = mysqli_query($connection, $query);

        if ($result) {
          echo 'Добавление прошло успешно!';
          echo '<a href="../index.php">На главную</a>';
        }
  }
?>

<script>
  const studentRadio = document.getElementById('student');
  const groupContainer = document.getElementById('group-container');
  const groupSelect = document.getElementById('group');

  let password_input = document.getElementById("password");

  function generatePassword(length) {
    let charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let password = "";

    for (let i = 0; i < length; i++) {
      let randomIndex = Math.floor(Math.random() * charset.length);
      password += charset.charAt(randomIndex);
    }

    return password_input.value = password;
  }

  studentRadio.addEventListener('change', function() {
    if (studentRadio.checked) {
      groupContainer.style.display = 'block';
      groupSelect.disabled = false;
    } else if (!studentRadio.checked) {
      groupContainer.style.display = 'none';
      groupSelect.disabled = true;
    }
  });
</script>

</html>