<?php
    require('connection.php');

    $selected_student = $_POST["selected_student"];
    $selected_book_id = $_POST["selected_book"];
    $selected_book = mysqli_fetch_assoc(mysqli_query($connection, 
                        "SELECT * FROM books WHERE id = $selected_book_id"));
    $unique_number = $_POST["unique_number"];

    // Проверка на наличие книги
    if($selected_book['available_quantity'] > 0) {
        $issue_book_query = "INSERT INTO issues_magazine (student_id, book_id, status_id, unique_number) 
                                VALUES ($selected_student, $selected_book_id, 1, '$unique_number')";  
        $update_quantity_query = "UPDATE books SET issued_quantity = issued_quantity +1, 
                                    available_quantity = available_quantity -1 WHERE id = $selected_book_id";

        $issue_book = mysqli_query($connection, $issue_book_query);
        $update_quantity = mysqli_query($connection, $update_quantity_query);

        if($issue_book && $update_quantity){
            echo 'success';
        } else {
            echo 'failure';
        } 
    } else {
        echo 'quantity';
    }
?>
