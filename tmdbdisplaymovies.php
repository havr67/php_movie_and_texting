<?php

include 'sql.php';
include 'tmdbtoken.php';


$tmdbmovies = "SELECT * FROM moviedb;";

$tmdbmovies_res = mysqli_query($sql, $tmdbmovies);

if (mysqli_num_rows($tmdbmovies_res) > 0) {
    while ($row = mysqli_fetch_row($tmdbmovies_res)){
    $movieId =  $row[0];
    $webtmdb = "https://api.themoviedb.org/3/movie/".$movieId."?api_key=".$tmdbtoken;
    $out = getMovieDB($webtmdb, $movieId);
    echo $out;
    }
} else {
    echo "No Movies";
}

function getGenras($json){
         $output = "";
    foreach($json['genres'] as $genres){
        $output .= "<td>".$genres['name']."</td>";
    }
    return $output;
}




function getMovieDB($webtmdb, $mid){
    $url = $webtmdb;

    if(!$curld = curl_init()){
            exit;
    }
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $prepros = curl_exec($curld);
    curl_close($curld);
    $json = json_decode($prepros, true);
    $output = "<style>th,td{padding: 15px;text-align: left; border-bottom: 1px solid #ddd;} .img{vertical-align:bottom;}</style><tr><th><a href='tmdb.php/?movieId=".$mid."'>".$json['original_title']."</a></th><td class='img'><a href='tmdb.php/?movieId=".$mid."'><img height='200'  class='img' src='https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path']."'></a></td></tr><div id='movie_number' style='display:none'>".$mid."</div>";
    return $output;
}

//echo '<pre>';
//echo getMovieDB($webtmdb);


?>