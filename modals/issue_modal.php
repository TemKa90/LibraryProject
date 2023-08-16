<div class="modal-content">
    <span class="close">&times;</span>
    <h2>Выдача книги</h2>
    <section id="editForm" class="form-container">

<?php
    session_start();
    require('../scripts/connection.php');
    $book_id = $_POST["id"];

    $book_query = "SELECT * FROM books WHERE id = $book_id";
    $book = mysqli_fetch_assoc(mysqli_query($connection, $book_query));

    // Проверяем, есть ли результат
    if (!empty($book)) {
       
        if ($book["image"] == NULL) {
            $image = 'alt.jpg';
        } else {
            $image = $book["image"];
        }
        

        echo '<div class="book-image">
                    <img src="assets/img/books/'.$image.'" alt="' . $title . '" width="200" height="283">
                </div>
                <div class="book-info">
                    <h2>' . $book["title"] . '</h2>
                </div>';

                $query = "SELECT id, group_name FROM study_groups";
                $groups_list = mysqli_query($connection, $query);
            
                // Проверка наличия результата
                if ($groups_list && mysqli_num_rows($groups_list) > 0) {
                    echo '<select id="group_select" name="group" onchange="studentsLoad()" required>';
                    echo '<option value="disabled" disabled selected>Группа</option>';
            
                    while ($row = mysqli_fetch_assoc($groups_list)) {
                        echo '<option value="' . $row['id'] . '">' . $row['group_name'] . '</option>';
                    }
            
                    echo '</select>';
                } else {
                    echo 'Группы не найдены.';
                };

                echo '<select id="students_select" name="student" required>
                        <option value="disable" disabled selected>Студент</option>
                    </select>
                <input type="text" id="unique_number" name="unique_number" placeholder="Идентификатор книги">
                <input type="hidden" id="selected_book" name="selected_book" value="'.$book_id.'">
                <input type="hidden" id="available_quantity" name="available_quantity" value="'.$book["available_quantity"].'">
                <button onclick="bookIssue()" ';
                
                if ($book["available_quantity"] < 1) {
                    echo 'disabled>Выдать</button>Книги нет в наличии';
                } else { echo '>Выдать</button>'; }

    } else {
        echo "Книга не найдена";
    }
?> 
</section>
</div>