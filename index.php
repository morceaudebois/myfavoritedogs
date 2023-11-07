<?php require_once('includes/config.php');
    $db = new SQLite3('myfavoritedogs.db');
    $tags = $db->query('SELECT * FROM dogtags ORDER BY name');

    $index = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <title>My Favorite Dogs · Make your list</title>
        <meta name="description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends."/>

        <!-- Open graph for social media -->
        <meta property="og:type" content="tool">
        <meta property="og:title" content="My Favorite Dogs · Make your list">
        <meta property="og:url" content="<?= $homeURL ?>">
        <meta property="og:image" content="<?= $homeURL . "/images/tarkan.jpg"?>">
        
        <meta name="twitter:card" content="summary_large_image"></meta>
        <meta name="twitter:title" content="My Favorite Dogs · Make a list of your favorite dog breeds"></meta>
        <meta name="twitter:creator" content="@morceaudebois" />
        <meta name="twitter:description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends!"></meta>
        <meta name="twitter:image" content="<?= $homeURL . "/images/tarkan.jpg"?>" />


        
        <link rel="apple-touch-icon" sizes="180x180" href="<?= $homeURL . '/images/favicons/apple-touch-icon.png' ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= $homeURL . '/images/favicons/favicon-32x32.png' ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= $homeURL . '/images/favicons/favicon-16x16.png' ?>">
        <link rel="manifest" href="<?= $homeURL . '/images/favicons/site.webmanifest' ?>">
        <link rel="mask-icon" href="<?= $homeURL . '/images/favicons/safari-pinned-tab.svg' ?>" color="#9dc88d">
        <link rel="shortcut icon" href="<?= $homeURL . '/images/favicons/favicon.ico' ?>">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="msapplication-config" content="<?= $homeURL . '/images/favicons/browserconfig.xml' ?>">
        <meta name="theme-color" content="#ffffff">

        <link rel='stylesheet' type='text/css' media='screen' href='<?= $homeURL . "/css/style.css" ?>'>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    </head>

    <body class="noSelection">
        <?php include 'header.php' ?>

        <section class="allDogs">

            <div class="bigTitle">
                <h2>All the dogs</h2> <div class="hr"></div>
                <p>Select your favorite dog breeds and share the list with your friends!</p>
            </div>

            <?php while ($tag = $tags->fetchArray()) { ?>
                
                <button class="accordion">
                    
                    <span><?= $tag['name'] ?></span>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.8 59.3"><path d="M41,57.2,2,18.2A6.8,6.8,0,0,1,2,8.5H2L8.5,2a6.8,6.8,0,0,1,9.7,0h0L45.9,29.7,73.5,2a6.8,6.8,0,0,1,9.7,0h.1l6.4,6.5a6.9,6.9,0,0,1,.1,9.7h-.1l-39,39a6.8,6.8,0,0,1-9.6.1Z" transform="translate(0 0)" fill="#505050"/></svg>
                </button>
                

                <div class="accordion-content">

                    <div class="breedGrid">
                    <?php

                        // va chercher toutes les races
                        $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN dogbreeds_meta ON dogbreeds.id = dogbreeds_meta.breed_id WHERE dogbreeds_meta.tag_id = :tag_id ORDER BY title');
                        $stmt->bindValue(':tag_id', $tag['tag_id'], SQLITE3_INTEGER);
                        $breeds = $stmt->execute();

                        // va chercher les photos des races
                        $breedPhotos = $db->query('SELECT breed_id, photo_url FROM photos');


                        // va chercher l'URL de la photo correspondante
                        while ($breed = $breeds->fetchArray()) {
                            while ($breedPhoto = $breedPhotos->fetchArray()) {
                                if ($breedPhoto['breed_id'] === $breed['breed_id']) {
                                    $photo_url = $breedPhoto['photo_url'];
                                }
                            } ?>

                            <div class="breedBlock <?= $breed['slug']?>">
                                
                                <img draggable='false' loading="lazy" src='<?= $homeURL . "/images/small/" . $photo_url ?>'>
                                <label><input type="checkbox" value="<?= $breed['slug']?>"><span class="checkmark"></span></label>

                                <h3><?= $breed['title']?></h3>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>
        </section>

        <?php include 'pannel.php' ?>

        <div class="overlay"></div>

        <?php include 'footer.php' ?>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js'></script>
        <script src='<?= $homeURL . "/includes/homepage.js" ?>'></script>
        
    </body>
</html>