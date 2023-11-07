<?php require_once('includes/config.php');

    try {
        $db = new PDO('sqlite:myfavoritedogs.db');

        $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN photos ON dogbreeds.id = photos.breed_id ORDER BY title');
        $stmt->execute();
        $allData = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

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
	<meta property="og:url" content="<?php echo $homeURL ?>">
	<meta property="og:image" content="<?php echo $homeURL . "/images/tarkan.jpg"?>">
    
    <meta name="twitter:card" content="summary_large_image"></meta>
    <meta name="twitter:title" content="My Favorite Dogs · Make a list of your favorite dog breeds"></meta>
    <meta name="twitter:creator" content="@morceaudebois" />
    <meta name="twitter:description" content="Make a list of your favorite dog breeds with myfavoritedogs.co. Discover new breeds and share them with your friends!"></meta>
    <meta name="twitter:image" content="<?php echo $homeURL . "/images/tarkan.jpg"?>" />
    
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $homeURL . '/images/favicons/apple-touch-icon.png' ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $homeURL . '/images/favicons/favicon-32x32.png' ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $homeURL . '/images/favicons/favicon-16x16.png' ?>">
    <link rel="manifest" href="<?php echo $homeURL . '/images/favicons/site.webmanifest' ?>">
    <link rel="mask-icon" href="<?php echo $homeURL . '/images/favicons/safari-pinned-tab.svg' ?>" color="#9dc88d">
    <link rel="shortcut icon" href="<?php echo $homeURL . '/images/favicons/favicon.ico' ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="<?php echo $homeURL . '/images/favicons/browserconfig.xml' ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo $homeURL . "/css/style.css" ?>'>

</head>

<body>
    <?php include 'header.php' ?>

    <div class="hero">     
        <div class="titleCard" style="background-image: url('<?= $homeURL . "/images/" . $allData[rand(0, count($allData) - 1)]['photo_url'] ?>')">

            <div class="gradient"></div>
            <h1 class="title">Photo credits</h1>
        </div>
    </div>

    <main>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Breed</th>
                <th>Author</th>
                <th>Name of the dog</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($allData as $photo) { ?>
                
                    <tr>
                        <td><div class="imgContainer"><img src="<?php echo $homeURL . '/images/smaller/' . $photo['photo_url'] ?>" loading="lazy"></div></td>
                        <td><?php echo $photo['title'] ?></td>
                        <td><?php
                                if ($photo['author_url']) {
                                    echo '<a href="' . $photo['author_url'] . '">' . $photo['photo_author'] . '</a>';
                                } else {
                                    echo $photo['photo_author'];
                                }
                            ?>

                        
                        <td><?php echo $photo['dog_name'] ?></td>
                    </tr>
                <?php }
            ?>
            
      
            <!-- and so on... -->
        </tbody>
    </table>

    </main>



    <?php include 'footer.php' ?>
</body>

</html>  
