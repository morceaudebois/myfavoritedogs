<?php require_once('includes/config.php');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



$data = $_GET['q'];
$races = explode("|", $data);

// va chercher les liens déjà existants
try {
    $db = new PDO('sqlite:myfavoritedogs.db'); // Replace with your SQLite database path

    $data = $_GET['q'];
    $races = explode("|", $data);

    // Check if the list already exists
    $stmt = $db->prepare('SELECT name, data, link FROM lists WHERE name = :name AND data = :data');
    $stmt->execute(array(
        ':name' => $races[1],
        ':data' => $races[0]
    ));
    $alreadyExists = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($alreadyExists) && !empty($alreadyExists)) {
        echo $homeURL . "/list/index.php?q=" . $alreadyExists['link'];
    } else {
        $link = '';
        do {
            $link = generateRandomString(); // Replace with your random string generation method
            $stmt = $db->prepare('INSERT OR IGNORE INTO lists (name, data, link, date) VALUES (:name, :data, :link, :date)');
            $stmt->execute(array(
                ':name' => $races[1],
                ':data' => $races[0],
                ':link' => $link,
                ':date' => date("Y/m/d")
            ));
        } while ($stmt->rowCount() == 0); // Continue generating a new link until it's unique

        echo $homeURL . "/list/index.php?q=" . $link;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}