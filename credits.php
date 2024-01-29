<?php require_once('src/php/config.php');
    try {
        $db = new PDO('sqlite:myfavoritedogs.db');

        $stmt = $db->prepare('SELECT * FROM dogbreeds INNER JOIN photos ON dogbreeds.id = photos.breed_id ORDER BY title');
        $stmt->execute();
        $allData = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $pageTitle = "Photo credits";
    include 'header.php';
?>

<div class="hero">     
    <div class="titleCard" style="background-image: url('<?= $homeURL . "/src/images/large/" . $allData[rand(0, count($allData) - 1)]['photo_url'] ?>')">

        <div class="gradient"></div>
        <h1 class="title">Photo credits</h1>
    </div>
</div>

<?php include 'notice.php' ?>

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
                        <td><div class="imgContainer"><img src="<?= $homeURL . '/src/images/small/' . $photo['photo_url'] ?>" loading="lazy"></div></td>
                        <td><?= $photo['title'] ?></td>
                        <td><?php
                                if ($photo['author_url']) {
                                    echo '<a href="' . $photo['author_url'] . '">' . $photo['photo_author'] . '</a>';
                                } else {
                                    echo $photo['photo_author'];
                                }
                            ?>

                        
                        <td><?= $photo['dog_name'] ?></td>
                    </tr>
                <?php }
            ?>
        
        </tbody>
    </table>

</main>



<?php include 'footer.php' ?>

