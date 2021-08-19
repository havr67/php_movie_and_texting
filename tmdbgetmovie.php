<?php

include 'tmdbtoken.php';

$movieId =  $_POST["movieId"];
$webtmdb = "https://api.themoviedb.org/3/movie/".$movieId."?api_key=".$tmdbtoken;

function getGenras($json){
	 $output = "";
    foreach($json['genres'] as $genres){
        $output .= "<td>".$genres['name']."</td>";
    }
    return $output;
}




function getMovieDB($webtmdb, $movieId){
    $url = $webtmdb;
    $mid = $movieId;
    if(!$curld = curl_init()){
            exit;
    }
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $prepros = curl_exec($curld);
    curl_close($curld);
    $json = json_decode($prepros, true);
    $output = "<style>th,td{padding: 15px;text-align: left; border-bottom: 1px solid #ddd;}</style><table><tr><td>Original title - ".$json['original_title']."</td></tr><tr><td>Genres - </td>".getGenras($json)."</tr><tr><td>Homepage - <a href='".$json['homepage']."'>HomePage</a></td></tr><tr><td>".$json['overview']."</td></tr><tr><img height='200' src='https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path']."'></tr><div id='movie_number' style='display:none'>".$mid."</div></table>";
    return $output;
}

//echo '<pre>';
echo getMovieDB($webtmdb, $movieId);


?>