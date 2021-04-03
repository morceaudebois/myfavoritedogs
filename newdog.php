<?php require_once('includes/config.php');

    try {
        $stmt = $db->prepare('SELECT * FROM dogtags');

        $stmt->execute(array());
        
        $tags = $stmt->fetchAll();

    } catch(PDOException $e) {
        echo $e->getMessage();
    } 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Add a new dog ! · My Favorite Dogs</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='<?php echo $homeURL . "/css/style.css" ?>'>
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css"> -->

</head>
<body>
    
    <?php @include 'header.php'; ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="text" placeholder="Breed name" id="dogname" name="breedname">
        <input type="text" placeholder="Breed slug" id="breedslug" name="breedslug">

        <?php foreach ($tags as $tag) { ?>

            <input type="checkbox" name="<?php echo $tag['tag_id'] ?>" id="<?php echo $tag['name'] ?>">
            <label for="<?php echo $tag['name'] ?>"><?php echo $tag['name'] ?></label>
            
        <?php } ?>
        <br>

        <input type="text" placeholder="Photo URL" name="photoURL">
        <input type="text" placeholder="Photo author" name="photo_author">
        <input type="text" placeholder="Author URL" name="authorURL">
        <input type="text" placeholder="Name of the dog" name="dogName">


        <input type="submit" value="Submit now" />      
    </form>

    <?php
        // ce code est sans doute très très laid jugez pas svp ça fonctionne
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // collect value of input field
            $name = $_POST['breedname'];
            $slug = $_POST['breedslug'];

            $breedTags = array (
                'Primitives' => $_POST['1'],
                'Shepherds' => $_POST['2'],
                'Watchdogs' => $_POST['3'],
                'Hunting' => $_POST['4'],
                'Toy' => $_POST['5'],
                'Greyhounds' => $_POST['6'],
                'Giant' => $_POST['7']
            );

            $photoURL = $_POST['photoURL'];
            $photo_author = $_POST['photo_author'];
            $authorURL = $_POST['authorURL'];
            $dogName = $_POST['dogName'];
            
            if (empty($name)) {
                echo "Name is empty";
            } else {
                    
                // créée la nouvelle race
                try {
                    $stmt = $db->prepare('INSERT INTO dogbreeds (title, slug) VALUES (:title, :slug)');

                    $stmt->execute(array(
                        ':title' => $name,
                        ':slug' => $slug
                    ));
                    echo "New breed has been added.<br>";





                    $stmt = $db->prepare('SELECT id FROM dogbreeds ORDER BY id DESC LIMIT 1');
                    $stmt->execute();
                    $lastAdded = $stmt->fetch();

                    $index = 1;
                    foreach ($breedTags as $breedTag) {
                        if ($breedTag) {
                            $stmt = $db->prepare('INSERT INTO dogbreeds_meta (breed_id, tag_id) VALUES (:breed_id, :tag_id)');

                            $stmt->execute(array(
                                ':breed_id' => $lastAdded["id"],
                                ':tag_id' => $index
                            ));
                        }
                        $index++;
                    }

                    echo "dogbreeds_meta mis à jour. <br>";



                    


                    $stmt = $db->prepare('INSERT INTO photos (breed_id, photo_url, photo_author, author_url, dog_name) VALUES (:breed_id, :photo_url, :photo_author, :author_url, :dog_name)');

                    $stmt->execute(array(
                        ':breed_id' => $lastAdded["id"],
                        ':photo_url' => $photoURL,
                        ':photo_author' => $photo_author,
                        ':author_url' => $authorURL,
                        ':dog_name' =>$dogName
                    ));

                    echo "table photos mise à jour. <br>";


   

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }

            }
        }
    ?>
</body>

















