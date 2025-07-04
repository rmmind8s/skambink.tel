<?php

$phone = isset($_GET['phone']) ? htmlspecialchars(basename($_GET['phone'])) : '112';
$short = isset($_GET['short']) ? htmlspecialchars(basename($_GET['short'])) : '';

$dataExists = false;

$data = array(
  "061600055" => array(
    "phone" => "+37061600055",
    "name" => "IT'menas",
    "short" => "Informacinių technologijų specialistas",
    "description" => "Visokeriopa IT pagalba ➕ kūrybiniai sprendimai ☁"
  ),
  "112" => array(
    "phone" => "112",
    "name" => "Skubi pagalba",
    "short" => "Bendrasis pagalbos centras",
    "description" => "Bendras telefono ryšio numeris, skirtas pranešti apie teisės pažeidimą, staiga iškilusią grėsmę gyvybei, sveikatai, saugumui, aplinkai ar turtui ir išsikviesti pagalbos tarnyboms: policijai, priešgaisrinei gelbėjimo tarnybai, greitajai medicinos pagalbai ar aplinkosaugai."
  )
);

if( isset($data[$phone]) ) {

  $dataExists = true;

  $name = $data[$phone]["name"];
  $short = $data[$phone]["short"];

  if( isset($data[$id]["description"]) ){
    $description = $data[$phone]["description"];
  } else {
    $description = "Jeigu esate šio telefono numerio savininkas/valdytojas, tuomet galite <a>nurodyti papildomą informaciją</a>.";
  }

} else {
  $name = "Nežinomas numeris";
  $description = "Telefono numeris nėra registruotas sistemoje. Jei esate šio numerio savininkas/valdytojas, galite <a>registruoti</a>.";
}

$title = '';

if($dataExists) {
  $title .= " | " . $name;
}

if (strlen($short) > 0) {
  $title .= " | " . $short;
}

?>



<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title ?></title>

        <meta name="theme-color" content="#205dcd" />

        <link rel="icon" type="image/png" href="https://skambink.tel/fav/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="https://skambink.tel/fav/favicon.svg" />
        <link rel="shortcut icon" href="https://skambink.tel/fav/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="https://skambink.tel/fav/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="Skambink.TEL" />
        <link rel="manifest" href="https://skambink.tel/fav/site.webmanifest" />

        <meta property="og:url" content="https://skambink.tel/<?= $phone . "/" . $short ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?= $title ?>"/>
        <meta property="og:description" content="<?= $description ?>"/>
        <meta property="og:image" content="https://skambink.tel/img/<?= $phone ?>.png"/>

        <script src="https://kit.fontawesome.com/d51de49024.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://skambink.tel/styles.css?ver=0.2.v5d1ocfgj2fckd1">

        <style>
            :root {
                --theme-color: #999999;
            }

            header {
                background: var(--theme-color);
            }
        </style>

    </head>

    <body>

        <header>
            <img id="profile" src="https://skambink.tel/img/<?= $phone ?>.png" alt="Header Image">
            <div class="header-content">
                <p id="description" style="visibility: hidden;"><?= $description ?></p>
                <h2><?= $name ?><a href="#" class="light" onclick="toggle_visibility('description');"><i class="fa-solid fa-circle-info info"></i></a></h2>
                <p>I<?= $short ?></p>
            </div>
        </header>

        <main>
            <h1> <span id="phone"><?= $phone ?></span><a id="copy" href="#" onclick="copy('phone');return false;"><i class="fa-solid fa-copy"></i></a></h1>
            <ul>
                <li id="tel"><a href="tel:<?= $phpne ?>"><i class="fa-solid fa-square-phone-flip"></i></a></li>
                <li id="sms" class="messenger" ><a href="sms:<?= $phpne ?>"><i class="fa-solid fa-comment-sms"></i></a></li>
            </ul>

        </main>

        <footer>
            <a href="https://skambink.tel/" class="grey">Skambink.TEL</a>
            <span id="notification"></span>
        </footer>
        <script src="https://skambink.tel/scripts.js?ver=0.1.0"></script>
    </body>
</html>
