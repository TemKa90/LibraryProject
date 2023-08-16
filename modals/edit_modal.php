<div class="modal-content edit-modal-content">
    <span class="close">&times;</span>
    <h2>Редактировать книгу</h2>
    <form method="post" action="scripts/edit_or_add.php" id="editForm" class="form-container">
    
    <?php
    session_start();
    require('../scripts/connection.php');
    $id = $_POST["id"];

    $book_query = "SELECT *
                    FROM books b
                    JOIN genres g ON b.genre_id = g.id
                    JOIN authors a ON b.author_id = a.id
                    JOIN publishers p ON b.publisher_id = p.id
                    WHERE b.id = " . $id;
    $book = mysqli_fetch_assoc(mysqli_query($connection, $book_query));

    // Проверяем, есть ли результат
    if (!empty($book)) {

        if ($book["image"] == NULL) {
            $image = 'alt.jpg';
        } else {
            $image = $book["image"];
        }

        echo '<section class="edit-book-details">
                <div class="book-image">
                    <img src="assets/img/books/'.$image.'" alt="' . $title . '" width="200" height="283">
                </div>
                <div class="book-info">
                    <input type="file" name="imageFile" accept="image/*">
                    <div>
                        <label for="title">Название:</label>
                        <input type="text" name="title" value="' . $book["title"] . '" required>
                    </div>
                    <div>
                        <label for="description">Описание:</label>
                        <input type="text" name="description" value="' . $book["description"] . '" required>
                    </div>';

                    echo '<div>
                            <label for="year">Год издания:</label>
                            <input type="text" name="year" value="' . $book["publication_year"] . '">
                        </div>
                        <div>
                            <label for="pages">Количество страниц:</label>
                            <input type="text" name="pages" value="' . $book["pages_count"] . '">
                        </div>
                </div>
                <div>';
                echo '<div>
                    <label for="author">Автор:</label>';
                        $query = "SELECT id, author_name FROM authors";
                        $authors_list = mysqli_query($connection, $query);
                    
                        // Проверка наличия результата
                        if ($authors_list && mysqli_num_rows($authors_list) > 0) {
                            echo '<select id="author" name="author">';
                            echo '<option value="'.$book["author_id"].'" selected>'.$book["author_name"].'</option>';
                    
                            while ($row = mysqli_fetch_assoc($authors_list)) {
                                if ($row['id'] != $book['author_id']) {
                                    echo '<option value="' . $row['id'] . '">' . $row['author_name'] . '</option>';
                                }
                            }
                    
                            echo '</select>';
                        } else {
                            echo 'Авторы не найдены.';
                        };
                echo '</div>';

                echo '<div>
                    <label for="genre">Жанр:</label>';
                        $query = "SELECT id, genre_name FROM genres";
                        $genres_list = mysqli_query($connection, $query);
                    
                        // Проверка наличия результата
                        if ($genres_list && mysqli_num_rows($genres_list) > 0) {
                            echo '<select id="genre" name="genre">';
                            echo '<option value="'.$book["genre_id"].'" selected>'.$book["genre_name"].'</option>';
                    
                            while ($row = mysqli_fetch_assoc($genres_list)) {
                                if ($row['id'] != $book["genre_id"]) {
                                    echo '<option value="' . $row['id'] . '">' . $row['genre_name'] . '</option>';
                                }
                            }
                    
                            echo '</select>';
                        } else {
                            echo 'Жанры не найдены.';
                        };
                        echo '</div>';

                echo '<div>
                    <label for="publisher">Издательство:</label>';
                        $query = "SELECT id, publisher_name FROM publishers";
                        $publishers_list = mysqli_query($connection, $query);
                    
                        // Проверка наличия результата
                        if ($publishers_list && mysqli_num_rows($publishers_list) > 0) {
                            echo '<select id="publisher" name="publisher">';
                            echo '<option value="'.$book["publisher_id"].'" selected>'.$book["publisher_name"].'</option>';
                    
                            while ($row = mysqli_fetch_assoc($publishers_list)) {
                                if ($row['id'] != $book["publisher_id"]) {
                                    echo '<option value="' . $row['id'] . '">' . $row['publisher_name'] . '</option>';
                                }
                            }
                    
                            echo '</select>';
                        } else {
                            echo 'Издательства не найдены.';
                        };
                        echo '</div>';
                    
                    echo '</div>
            </section>';

    } else {
        echo "Книга не найдена";
    }
    ?> 

    <grid-section-6>
        <?php
            echo '<button type="submit" name="edit_confirm" value="'.$id.'" onclick="return confirmEdit();" id="save_button" class="save-btn">Сохранить</button>';
        ?>
    </grid-section-6>
    
    </form>
</div>