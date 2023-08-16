<?php
    require('connection.php');

    $issue_id = $_POST["id"];
    $selected_book = mysqli_fetch_assoc(mysqli_query($connection, "SELECT book_id FROM issues_magazine WHERE id = $issue_id"));
    
    $update_status_query = "UPDATE issues_magazine SET status_id = 2 
                            WHERE id = $issue_id";  
    $update_status = mysqli_query($connection, $update_status_query);

    $update_quantity_query = "UPDATE books 
                                    SET issued_quantity = issued_quantity -1, 
                                    available_quantity = available_quantity +1 
                                WHERE id = ".$selected_book['book_id'];
    $update_quantity = mysqli_query($connection, $update_quantity_query);

    if($update_status && $update_quantity){
        echo 'success';
    } else {
        echo 'failure';
    }
?>