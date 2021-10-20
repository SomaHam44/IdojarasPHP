<?php

require_once 'db.php';
require_once 'Idojaras.php';

$idojarasId = $_GET['id'] ?? null;

if ($idojarasId === null) {
    header("Location: index.php");
    exit();
}

//SELECT ...
$idojaras = Idojaras::getById($idojarasId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ujHomerseklet = $_POST['homerseklet'] ?? 0;
    $ujLeiras = $_POST['leiras'] ?? '';

    
    $idojaras->setHomerseklet($ujHomerseklet);
    $idojaras->setLeiras($ujLeiras);



    //UPDATE....
    $idojaras->mentes();
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Időjárás</title>
</head>
<body>
    <form method='POST'>
    <div>
            Hőmérséklet: <input type="number" name="homerseklet">
        </div>
        <div>
            Leírás: <input type="text" name="leiras">
        </div>
        <input type="submit" value="Szerkesztés">
    

    </form>



</body>
</html>

