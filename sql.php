<?php

$sql = new mysqli("localhost", "root", "Olimp110", "employels");
if($sql->connect_error) {
die("connetion failed: " . $sql->connect_error);
}