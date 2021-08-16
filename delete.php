<?php
if(isset($_POST["id"]))
{
    $conn = mysqli_connect("localhost", "root", "", "Alterra");
    if (!$conn) {
      die("Ошибка: " . mysqli_connect_error());
    }
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sql = "DELETE FROM `contact_book` WHERE `id` = '$id'";
    if(mysqli_query($conn, $sql)){
        // echo "<script type='text/javascript'>console.log('lalala');</script>";
        // print_r ("user deleted");
        
        header("Location: index.php");
        
        
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}