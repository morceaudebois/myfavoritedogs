<?php
    include '../src/php/config.php';
    header("Status: 301 Moved Permanently", false, 301);
    header("Location: ${homeURL}/list/${_GET['q']}");
?>