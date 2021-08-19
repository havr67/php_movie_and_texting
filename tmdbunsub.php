<?php

include 'sql.php';

$user_id = $_POST["user_id"];
$movie_id = $_POST["movie_id"];


$unsubtomov = "DELETE FROM submoviedb WHERE user_id = '$user_id' AND movie_id = '$movie_id';";
$unsubtomov_res = mysqli_query($sql, $unsubtomov);

if($unsubtomov_res -> query($sql)){
    $out.="";
} else {
    $out.="Erooor";
}
?>

