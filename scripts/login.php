<?php
    if (!empty($_POST['login']) and !empty($_POST['password'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];


      $query = "SELECT u.id AS user_id, u.login, u.password, u.first_name, u.second_name, 
                        u.patronymic_name, r.id AS role_id, r.role_name AS user_role
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.login = '".$login."'";
      $result = mysqli_query($connection, $query);
      $user = mysqli_fetch_assoc($result);
      $storedHashedPassword = $user['password'];

      if (!empty($user) and password_verify($password, $storedHashedPassword)) {
        session_start();
        $_SESSION['auth'] = true;
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['role'] = $user['user_role'];

        $_SESSION['user_id'] = $user['user_id'];

        header('Location:../index.php');
        exit();
      } else {
        echo "Неверный логин или пароль";
      }    
    }
?>
