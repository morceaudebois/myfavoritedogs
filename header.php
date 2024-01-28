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
        <a href="<?= $homeURL ?>"><h1>
            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 153 153" xmlns="http://www.w3.org/2000/svg"><path d="m795.265 356.019c92.802 155.401 41.98 356.912-113.422 449.715-155.401 92.803-356.912 41.98-449.714-113.421-92.803-155.402-41.981-356.913 113.421-449.715 155.401-92.803 356.912-41.981 449.715 113.421zm-228.516 310.111c1.724 30.212 1.794 45.782-5.098 58.136-13.611 24.399-38.332 26.12-62.745 12.501-10.761-6.003-17.7-9.892-30.16-28.818 0 0-5.569-16.755-32.785-30.536-26.275-16.051-43.534-11.867-43.534-11.867-22.646-.667-29.291-4.5-40.038-10.496-24.412-13.619-35.956-35.552-22.337-59.964 6.892-12.355 20.19-20.449 46.804-34.871 0 0 51.573-29.523 86.439-37.497 25.182-5.742 49.592 7.947 49.592 7.947l7.539 4.206.004-.007s25.544 14.168 32.831 38.041c10.39 34.216 13.484 93.232 13.488 93.225zm127.859-120.795c-13.973-19.182-49.507-17.08-79.385 4.684s-42.765 54.95-28.792 74.133c13.977 19.176 49.511 17.074 79.385-4.683s42.766-54.951 28.792-74.134zm-113.572-15.636c25.523 14.238 64.204-6.459 86.388-46.227 22.185-39.768 19.477-83.554-6.046-97.792s-64.197 6.463-86.382 46.231c-22.184 39.767-19.483 83.55 6.04 97.788zm-190.629-14.9c23.656 1.809 45.124-26.591 47.944-63.44 2.82-36.85-14.065-68.194-37.717-70.01s-45.118 26.594-47.945 63.44c-2.82 36.85 14.069 68.187 37.718 70.01zm83.19-45.035c25.524 14.238 64.197-6.463 86.382-46.231s19.483-83.55-6.04-97.788c-25.523-14.239-64.197 6.463-86.381 46.23-22.185 39.768-19.484 83.551 6.039 97.789z" fill="#9dc88d" transform="matrix(.233168 0 0 .233168 -43.309497 -45.750502)"/></svg>
            <div class="text">
                <span>myfavoritedogs</span>
                <span style="font-size: .6em" id="tagline">Doggo tier list maker 🐕</span>
            </div>
            
            </h1>
        </a>

        <?php $url = $_SERVER['REQUEST_URI'];    

        // bouton pour nouvelle liste 
        if (strpos($url, 'list') !== false) { ?>
            <a id="addList" title="Create my own list" href="<?= $homeURL ?>">
                <img src='<?= $homeURL . "/src/images/new.svg" ?>'>
            </a>
        <?php }  ?>
    </div>
</header>

<?php if (isset($bodyClasses) && str_contains($bodyClasses, 'homepage')) { 
    include 'notice.php'; 
} ?>