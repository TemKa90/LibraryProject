<?php 
    require("connection.php");

    $query = "SELECT im.id AS issue_id, im.*, s.*, b.*, sts.*, sg.* FROM issues_magazine im
                JOIN students s ON s.id = im.student_id
                JOIN books b ON b.id = im.book_id
                JOIN statuses sts ON sts.id = im.status_id
                JOIN study_groups sg ON sg.id = s.study_group AND sts.id = 1";

    $issues_magazine = mysqli_query($connection, $query);

    // Проверяем, есть ли результаты
    if ($issues_magazine->num_rows > 0) {
        // Выводим данные каждой записи
        while ($row = $issues_magazine->fetch_assoc()) {

            echo '<tr>
                    <td class="book_table_cell" id='.$row["book_id"].'>'.$row["title"].'</td>
                    <td>'.$row["full_name"].'</td>
                    <td>'.$row["group_name"].'</td>';
                    
                    if ($row["status_name"] === "Выдана") {
                        echo '<td>'.$row["status_name"].' <button id="'.$row["issue_id"].'" class="return_status_button" onclick="updateReturnStatus(this)">Отметить возврат</button></td>';
                    } else {
                        echo '<td>'.$row["status_name"].'</td>';
                    }
                    
                    echo '<td>'.$row["unique_number"].'</td>
                </tr>';
        }
    } else {
        echo "Записи не найдены";
    }
?>