<?php

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','rootroot');
define('DBNAME','myfavoritedogs');

try {
   $db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
   die($e -> getMessage());
}

$homeURL = 'http://localhost/~tahoe/myfavoritedogs/';

?>


