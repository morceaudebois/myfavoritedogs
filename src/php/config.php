<?php if ($_SERVER['HTTP_HOST'] == 'localhost' || str_contains($_SERVER['HTTP_HOST'], '192.168')) {
    $homeURL = "http://{$_SERVER['HTTP_HOST']}/myfavoritedogs";
} else {
    $homeURL = 'https://myfavoritedogs.tahoe.be';
} ?>