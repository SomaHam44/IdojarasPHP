<?php 

require_once "db.php";
require_once "Idojaras.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $deleteId = $_POST['deleteId'] ?? '';
    if ($deleteId != '') {
        Idojaras::torol($deleteId);
    }
    else {

    
     $ujHomerseklet = $_POST['homerseklet'];
     $ujLeiras = $_POST['leiras'] ?? '';
     $ujIdojaras = new Idojaras(new DateTime(), $ujHomerseklet, $ujLeiras);
     $ujIdojaras->uj();
    }
}

$idojarasok = Idojaras::osszes();






?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Időjárás</title>
</head>
<body>
    <form method="POST">
        <div>
            Hőmérséklet: <input type="number" name="homerseklet">
        </div>
        <div>
            Leírás: <input type="text" name="leiras">
        </div>
        <div>
            <input type="submit" value="Új időjárás előrejelzés">
        </div>
    </form>
    <?php
        foreach ($idojarasok as $idojaras) {
            echo "<h3>" . $idojaras->getDatum()->format('Y-m-d') . "</h3>";
            echo "<p>" . $idojaras->getHofok() . " C  <p>";
            echo "<p>" . $idojaras->getLeiras() . "<p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='deleteId' value='" . $idojaras->getId() . "'>";
            echo "<button type='submit'>Törlés</button>";
            echo "</form>";
            echo "<a href ='szerkesztoIdojaras.php?id=" . $idojaras->getId() . "'>Szerkeszt<a>";
        }




    ?>


</body>
</html>

