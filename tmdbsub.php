<?php
include 'sql.php';


$user_ = $_POST["user_id"];
$movie_ = $_POST["movie_id"];
$subtomov = "INSERT INTO submoviedb(user_id, movie_id) VALUES ('$user_', '$movie_');";


$subtomov_res = mysqli_query($sql, $subtomov);

if($subtomov_res -> query($sql)){
    $out.="";
} else {
    $out.="Erooor";
}
?>



