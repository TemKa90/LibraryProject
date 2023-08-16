<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../assets/styles/login_page.css">
    <?php 
		  require('../scripts/connection.php');
	  ?>
</head>

<form class="login-form" method="post">
  <h2>Авторизация</h2>
  <div class="form-group">
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" placeholder="Введите логин" required>
  </div>
  <div class="form-group">
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" placeholder="Введите пароль" required>
  </div>
  <div class="form-group">
    <button type="submit">Войти</button>
  </div>
</form>

<?php
  require('../scripts/login.php');
?>
</html>
