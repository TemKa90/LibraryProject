<?php 
    $books_query = "SELECT b.* FROM books b 
                    JOIN authors a ON b.author_id = a.id 
                    ORDER BY b.id";
    $books_list = mysqli_query($connection, $books_query);

    // Проверяем, есть ли результаты
    if ($books_list->num_rows > 0) {
        // Выводим данные каждой книги
        while ($row = $books_list->fetch_assoc()) {
            $book_id = $row["id"];
            $title = $row["title"];
            // $author_name = $row["author_name"];

            // Декодинг картинки
            if ($row["image"] == NULL) {
                $image = 'alt.jpg';
            } else {
                $image = $row["image"];
            }

            echo '<div class="book_card" id="'.$book_id.'">
                    <div class="book_image_container">
                        <img src="assets/img/books/'.$image.'" alt="' . $title . '">
                    </div>
                    <h3 class="book-title">' . $title . '</h3>';


                        echo '<div class="book-info">
                        <p>Выдано: <span class="issued_quantity">'.$row["issued_quantity"].'</span> | 
                        В наличии: <span class="available_quantity">'.$row["available_quantity"].'</span></p>
                            </div>';
                        if ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) {
                            echo '<form method="post" action="scripts/delete_book.php">
                                    <input type="button" class="edit_book_button" name="edit_button" id="'.$book_id.'" value="Редактировать" class="edit_book_button">
                                    <input type="button" class="issue_book_button" name="issue_button" id="'.$book_id.'" value="Выдать книгу" class="issue_book_button">
                                    <input type="submit" class="delete_book_button" onclick="return confirmDelete();" value="Удалить" class="delete_book_button">
                                </form>';
                        }
            echo '</div>';
        }
    } else {
        echo "Нет книг для отображения.";
    }
?>
