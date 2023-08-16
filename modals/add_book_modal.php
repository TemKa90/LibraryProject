<div id="add_book_modal" class="modal">
    <div class="modal-content add-book-modal-content">
        <span class="close">&times;</span>
        <h2>Добавить книгу</h2>
        <form  method="post" action="scripts/edit_or_add.php" enctype="multipart/form-data" id="editForm" class="form-container">
            <div class="add-book-details">
                <div>
                    <input type="file" name="imageFile">

                    <label for="title">Название:</label>
                    <input type="text" id="title" name="title" value="" required>

                    <label for="description">Описание:</label>
                    <input type="text" id="description" name="description" value="" required>

                    <label for="pages">Количество страниц:</label>
                    <input type="text" id="pages" name="pages" value="" required>

                    <label for="year">Год выпуска:</label>
                    <input type="text" id="year" name="year" value="" required>
                </div>

                <div style="display: flex; flex-direction: column; align-items: center;">
                    <label for="author">Автор:</label>
                    <?php
                        $query = "SELECT id, author_name FROM authors";
                        $authors_list = mysqli_query($connection, $query);
                    
                        // Проверка наличия результата
                        if ($authors_list && mysqli_num_rows($authors_list) > 0) {
                            echo '<select id="author" name="author" required>';
                            echo '<option value="" disabled selected></option>';
                    
                            while ($row = mysqli_fetch_assoc($authors_list)) {
                                echo '<option value="' . $row['id'] . '">' . $row['author_name'] . '</option>';
                            }
                    
                            echo '</select>';
                        } else {
                            echo 'Авторы не найдены.';
                        }     
                    ?>

                    <label for="genre">Жанр:</label>
                    <?php
                        $query = "SELECT id, genre_name FROM genres";
                        $genres_list = mysqli_query($connection, $query);
                    
                        // Проверка наличия результата
                        if ($genres_list && mysqli_num_rows($genres_list) > 0) {
                            echo '<select id="genre" name="genre" required>';
                            echo '<option value="" disabled selected></option>';

                            while ($row = mysqli_fetch_assoc($genres_list)) {
                                echo '<option value="' . $row['id'] . '">' . $row['genre_name'] . '</option>';
                            }
                    
                            echo '</select>';
                        } else {
                            echo 'Жанры не найдены.';
                        }         
                    ?>

                    <label for="publisher">Издательство:</label>
                    <?php
                        $query = "SELECT id, publisher_name FROM publishers";
                        $publishers_list = mysqli_query($connection, $query);
                    
                        // Проверка наличия результата
                        if ($publishers_list && mysqli_num_rows($publishers_list) > 0) {
                            echo '<select id="publisher" name="publisher" required>';
                            echo '<option value="" disabled selected></option>';
                    
                            while ($row = mysqli_fetch_assoc($publishers_list)) {
                                echo '<option value="' . $row['id'] . '">' . $row['publisher_name'] . '</option>';
                            }
                    
                            echo '</select>';
                        } else {
                            echo 'Издательства не найдены.';
                        }         
                    ?>

                    <label for="issued_quantity">Выдано:</label>
                    <input type="text" id="issued_quantity" name="issued_quantity" value="" required>

                    <label for="available_quantity">В наличии:</label>
                    <input type="text" id="available_quantity" name="available_quantity" value="" required>

                    <input type="hidden" name="book_id_storage" value="">
                    <button type="submit" id="save_button" name="add_book_confirm" class="save-btn" style="margin-top: 20px;">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>