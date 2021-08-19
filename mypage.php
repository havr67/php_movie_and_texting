<?php

include 'session.php';
include 'sql.php';
include 'tmdbtoken.php';
$user_id = $_SESSION["user_id"];

?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="mystyle.css">
  <script src="js/jquery-3.6.0.js"> </script>
</head>
<body class="loginpage">
    <header>
        <div id="logo" onclick="slowScroll('#top')">
          <h2><span>My Page</span></h2>
        </div>
    </header>
    <div>Your Username: <?php echo $_SESSION["username"]; ?>
    <div><a href="https://khavronin.ursse.org/feed.php">Go to feed</a></div>
    <div><a href="https://khavronin.ursse.org/index.php">Go to movies</a></div>
    <form>
    <input type="text" size="30" onkeyup="showResult(this.value)">
    <div id="livesearch"></div>
    </form>
    <form>
	<table>
		<?php
		$posts_content = "SELECT * FROM posts WHERE user_id = 'user_id' ORDER BY `posts`.`post_id` DESC;";

		$posts_content_res = mysqli_query($sql, $posts_content);

		if (mysqli_num_rows($posts_content_res) > 0) {
		  while ($row = mysqli_fetch_row($posts_content_res)){
		    $out = "<tr><td>".$row[3]."</td><td>|</td><td>".$row[4]."</td><td>|Created by -</td><td>".$row[2]."</td></tr>";
		   echo $out;
		        }
			} else {
  			echo "There are no messeges";
			}

			?>		

	</table>
    </form>
    <form action="mypage.php" method="POST">
      <table>
      <div>Your subsribtions</div>
      <?php
$tmdbmovies = "SELECT * FROM `submoviedb` WHERE `user_id` = '$user_id';";

$tmdbmovies_res = mysqli_query($sql, $tmdbmovies);

if (mysqli_num_rows($tmdbmovies_res) > 0) {
    while ($row = mysqli_fetch_array($tmdbmovies_res)){
    $movieId = $row["movie_id"];
    $webtmdb = "https://api.themoviedb.org/3/movie/".$movieId."?api_key=".$tmdbtoken;
    $out = getMovieDB($webtmdb, $movieId);
    echo $out;
    }
} else {
    echo "You didnt subscribe to any Movie";
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
    $output = "<style>th,td{padding: 15px;text-align: left; border-bottom: 1px solid #ddd;}</style><tr><th><a href='tmdb.php/?movieId=".$mid."'>".$json['original_title']."</a></th></tr><tr><img height='200' src='https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path']."'></tr>";
    return $output;
}

?>
      </table>
    </form>
    <script src="js/searchbar.js"> </script>
</body>