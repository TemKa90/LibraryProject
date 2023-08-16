<?php
    require('connection.php');

    if(isset($_POST['book_card'])){
        $id_book = $_POST['book_card'];
        $sql_delete = mysqli_query($connection,"DELETE FROM books WHERE id = $id_book");

        if($sql_delete){
            header('Location: ../index.php');
        }
    }
?>