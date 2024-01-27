<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title><?= $pageTitle ?? "Make your list" ?> · My Favorite Dogs</title>
    <meta name="description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends."/>

    <!-- Open graph for social media -->
	<meta property="og:type" content="tool">
	<meta property="og:title" content="<?= $pageTitle ?? "Make your list" ?> · My Favorite Dogs">
	<meta property="og:url" content="<?= $homeURL ?>">
	<meta property="og:image" content="<?= $thumbnail ?? $homeURL . "/src/images/tarkan.jpg" ?>">
    
    <meta name="twitter:card" content="summary_large_image"></meta>
    <meta name="twitter:title" content="My Favorite Dogs · Make a list of your favorite dog breeds"></meta>
    <meta name="twitter:creator" content="@morceaudebois" />
    <meta name="twitter:description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends!"></meta>
    <meta name="twitter:image" content="<?= $thumbnail ?? $homeURL . "/src/images/tarkan.jpg" ?>" />
    
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $homeURL . '/src/images/favicons/apple-touch-icon.png' ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $homeURL . '/src/images/favicons/favicon-32x32.png' ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $homeURL . '/src/images/favicons/favicon-16x16.png' ?>">
    <link rel="manifest" href="<?= $homeURL . '/src/images/favicons/site.webmanifest' ?>">
    <link rel="mask-icon" href="<?= $homeURL . '/src/images/favicons/safari-pinned-tab.svg' ?>" color="#9dc88d">
    <link rel="shortcut icon" href="<?= $homeURL . '/src/images/favicons/favicon.ico' ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="<?= $homeURL . '/src/images/favicons/browserconfig.xml' ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel='stylesheet' type='text/css' media='screen' href='<?= $homeURL . "/src/styles/style.css" ?>'>
</head>

<body class="<?= $bodyClasses ?? '' ?>">

<header>
    <div class="container">
        <a href="<?= $homeURL ?>"><h1>myfavoritedogs</h1></a>

        <?php $url = $_SERVER['REQUEST_URI'];    

        if (strpos($url, 'list') !== false) { ?>
            <a id="addList" title="Create my own list" href="<?= $homeURL ?>">
                <img src='<?= $homeURL . "/src/images/new.svg" ?>'>
            </a>
        <?php }  ?>
    </div>
</header>