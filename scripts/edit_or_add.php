<?php
    require('connection.php');
    
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $year = $_POST['year'];
    $pages = $_POST['pages'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publisher = $_POST['publisher'];
    $issued_quantity = $_POST['issued_quantity'];
    $available_quantity = $_POST['available_quantity'];
    
    // Обработка картинки
    $image_name = $_FILES['imageFile']['name'];
    $image_tmp = $_FILES['imageFile']['tmp_name'];
    $target_dir = '../assets/img/books/';
    $target_path = $target_dir . $image_name;

    //  Редактирование
    if(isset($_POST['edit_confirm'])){
        $id_book = $_POST['edit_confirm'];

        $sql = mysqli_query($connection,"UPDATE books 
                                                    SET title = '$title',
                                                        description = '$description',
                                                        image = '$image_name',
                                                        author_id = $author,
                                                        genre_id = $genre,
                                                        publisher_id = $publisher,
                                                        pages_count = $pages,
                                                        publication_year = $year
                                                WHERE id = $id_book");
    }

    // Добавление книги
    if(isset($_POST['add_book_confirm'])){

        // Проверяем, был ли файл успешно загружен
        // if(isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
        // Перемещаем загруженный файл в целевую папку
        if(move_uploaded_file($image_tmp, $target_path)) {
            echo 'Файл успешно загружен и сохранен.';
        } else {
            echo 'Ошибка при загрузке файла.';
        }



        //     $fileType = $_FILES['imageFile']['type'];
        //     $fileSize = $_FILES['imageFile']['size'];

        //     // Продолжайте выполнение только для поддерживаемых типов файлов и разумных размеров
        //     if(($fileType === 'image/jpeg' || $fileType === 'image/png') && $fileSize < 5000000) {
        //         echo 'Работает';
        //     } else {
        //         echo "Неверный формат файла или слишком большой размер.";
        //     }
        // } else {
        //     echo "Произошла ошибка при загрузке файла.";
        // }

        // $stmt = mysqli_prepare($connection, "INSERT INTO books 
        //                                     (title, description, image, author_id, genre_id, publisher_id, pages_count, publication_year, issued_quantity, available_quantity)
        //                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // mysqli_stmt_bind_param($stmt, "ssbiiiisii", $title, $description, $imageData, $author, $genre, $publisher, $pages, $year, $issued_quantity, $available_quantity);



        // if (mysqli_stmt_execute($stmt)) {
        //     echo "Книга успешно добавлена!";
        // } else {
        //     echo "Ошибка добавления книги: " . mysqli_stmt_error($stmt);
        // }

        // mysqli_stmt_close($stmt);

        $sql = mysqli_query($connection,"INSERT INTO books 
                                                    (title, description, image, author_id, genre_id, publisher_id, pages_count, publication_year, issued_quantity, available_quantity)
                                                    VALUES ('$title', '$description', '$image_name', $author, $genre, $publisher, $pages, '$year', $issued_quantity, $available_quantity)");
    }

    // Добавление автора
    if(isset($_POST['add_author_confirm'])){

        $author_name = $_POST["author_name"];

        $sql = mysqli_query($connection,"INSERT INTO authors (author_name) VALUE ('$author_name')");
    }

    // Добавление жанра
    if(isset($_POST['add_genre_confirm'])){

        $genre_name = $_POST["genre_name"];

        $sql = mysqli_query($connection,"INSERT INTO genres (genre_name) VALUE ('$genre_name')");
    }

    // Добавление издательства
    if(isset($_POST['add_publisher_confirm'])){

        $publisher_name = $_POST["publisher_name"];

        $sql = mysqli_query($connection,"INSERT INTO publishers (publisher_name) VALUE ('$publisher_name')");
    }

    if($sql){
        header('Location: ../index.php');
    } else {
        echo "Ошибка выполнения запроса: " . mysqli_error($connection);
        echo '<button><a href="../index.php">На главную</a></button>';
    }
?>