<?php

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','rootroot');
define('DBNAME','myfavoritedogs');

try {
   $db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS);
   $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
   die($e -> getMessage());
}

$homeURL = 'https://myfavoritedogs.local/~tahoe/myfavoritedogs';

?>


