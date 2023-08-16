<div class="modal-content info-modal-content">
    <span class="close">&times;</span>
    <h2>Информация о книге</h2>
    <form  method="post" action="#" id="editForm" class="form-container">

    <?php
    session_start();
    require('../scripts/connection.php');
    $id = $_POST["id"];
    $path = $_POST["path"];

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

        echo '<section class="info-book-details">
                <div class="book-image">
                    <img src="'.$path.$image.'" alt="' . $title . '" width="200" height="283">
                </div>
                <div class="book-info">
                    <h2>' . $book["title"] . '</h2>
                    <p>' . $book["description"] . '</p>
                    <p>Жанр: <span class="genre">' . $book["genre_name"] . '</span></p>
                    <p>Автор: <span class="author">' . $book["author_name"] . '</span></p>
                    <p>Издательство: <span class="publisher">' . $book["publisher_name"] . '</span></p>
                    <p>Год издания: <span class="year">' . $book["publication_year"] . '</span></p>
                </div>
            </section>';

    } else {
        echo "Книга не найдена";
    }
    ?> 
    </form>
</div>
