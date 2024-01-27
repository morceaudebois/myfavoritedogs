<?php require_once('../src/php/config.php');
    $db = new PDO('sqlite:../myfavoritedogs.db');

    try {
        $stmt = $db->prepare('SELECT * FROM lists WHERE link = :link');
        $stmt->execute(array(':link' => $_GET['q']));
        $list = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $breeds = json_decode(stripslashes($list['data']));

    try {
        $stmt = $db->prepare('SELECT photo_url FROM photos 
            INNER JOIN dogbreeds ON dogbreeds.id = photos.breed_id 
            WHERE dogbreeds.slug = :slug');
        $stmt->execute(array(':slug' => $breeds[0]));

        $mainImage = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

    $pageTitle = "{$list['name']}'s favorite dogs list";
    $thumbnail = $homeURL . "/src/images/" . $mainImage['photo_url'];
    $bodyClasses = 'savedList';
    include '../header.php';
?>
    
<div class="hero">     
    <div class="titleCard" style="background-image: url('<?php echo $homeURL . "/src/images/" . $mainImage['photo_url'] ?>')">

        <div class="gradient"></div>
        <h1 class="title"><?php echo $list['name'] ?>'s favorite dogs list</h1>
    </div>
</div>

<main>
    <div class="breedGrid">
    <?php 
    
        foreach ($breeds as $breed) { 
            try {
                $stmt = $db->prepare('SELECT * FROM dogbreeds WHERE slug = :slug');
                $stmt->execute(array(':slug' => $breed)); 
                
                $breedData = $stmt->fetch();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            try {
                $stmt = $db->prepare('SELECT photo_url FROM photos INNER JOIN dogbreeds WHERE dogbreeds.id = photos.breed_id AND dogbreeds.slug = ?');

                $stmt->bindParam(1, $breed);  
                $stmt->execute(); 
                
                $breedPhoto = $stmt->fetch();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    ?>

        <div class="breedBlock <?php echo $breedData['slug']?>">
            <img src='<?php echo $homeURL . "/src/images/small/" . $breedPhoto['photo_url']?>'>

            <h3><?php echo $breedData['title']?></h3>
            <span class="medal"></span>
            
        </div>

        <?php } ?>
    </div>
</main>

<div class="overlay"></div>

<?php include '../footer.php' ?>