<?php
    session_start();
    require('connection.php');

    $groupId = $_POST["group_id"];

    $query = "SELECT s.id, s.full_name FROM students s
                JOIN study_groups sg ON s.study_group = sg.id 
                WHERE  s.study_group = " . $groupId;

    $students_list = mysqli_query($connection, $query);

    // Проверка наличия результата
    if ($students_list && mysqli_num_rows($students_list) > 0) {
        echo '<option value="disable" disabled selected>Студент</option>';

        while ($row = mysqli_fetch_assoc($students_list)) {
            echo '<option value="' . $row['id'] . '">' . $row['full_name'] . '</option>';
        }
    } else {
        echo 'Студенты не найдены.';
    };
?>