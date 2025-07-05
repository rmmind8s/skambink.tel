<?php

$phone = isset($_GET['phone']) ? htmlspecialchars(basename($_GET['phone'])) : '112';
$name = isset($_GET['name']) ? htmlspecialchars(basename($_GET['name'])) : 'Nežinomas numeris';
$short = isset($_GET['short']) ? htmlspecialchars(basename($_GET['short'])) : '';

$dataExists = false;
$smsDisable = false;

$data = array(
  "061600055" => array(
    "name" => "IT'menas",
    "short" => "Informacinių technologijų specialistas",
    "description" => "Visokeriopa IT pagalba ➕ kūrybiniai sprendimai ☁",
    "image" => "061600055.jpg"
  ),
  "112" => array(
    "name" => "Skubi pagalba",
    "short" => "Bendrasis pagalbos centras",
    "description" => "Bendras telefono ryšio numeris, skirtas pranešti apie teisės pažeidimą, staiga iškilusią grėsmę gyvybei, sveikatai, saugumui, aplinkai ar turtui ir išsikviesti pagalbos tarnyboms: policijai, priešgaisrinei gelbėjimo tarnybai, greitajai medicinos pagalbai ar aplinkosaugai.",
    "image" => "112.png",
    "smsDisable" => true
  )
);

$description = "Telefono numeris nėra registruotas sistemoje. Jei esate šio numerio savininkas/valdytojas, galite <a>registruoti</a>.";
$image = "https://skambink.tel/img/default.png";

if( isset($data[$phone]) ) {

  $dataExists = true;

  $name = $data[$phone]["name"];
  $short = $data[$phone]["short"];

  if( isset($data[$phone]["image"]) ){
    $image = "https://skambink.tel/img/" . $data[$phone]["image"];
  }

  if( isset($data[$phone]["description"]) ){
    $description = $data[$phone]["description"];
  } else {
    $description = "Jeigu esate šio telefono numerio savininkas/valdytojas, tuomet galite <a>nurodyti papildomą informaciją</a>.";
  }

  if( isset($data[$phone]["smsDisable"]) ){
    $smsDisable = $data[$phone]["smsDisable"];
  }

}

$phone = str_starts_with($phone, '0') ? "+370" . substr($phone, 1) : $phone;

$title = '';

if($dataExists) {
  $title .= $name;
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
        <meta property="og:image" content="<?= $image ?>"/>

        <script src="https://kit.fontawesome.com/d51de49024.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <style>
        :root {
          --color-green-500: #28A745;
          --color-green-600: #1f8a38;
        }
        .text-green-500 {
          color: var(--color-green-500);
        }
        </style>
    </head>

    <body class="bg-gradient-to-b from-gray-300 to-gray-50 flex flex-col h-screen">
    <div class="flex flex-col items-center justify-center space-y-6">
      <!-- Kontaktas -->
      <div class="relative w-full max-w-md">
        <img
          src="<?= $image ?>"
          alt="Adresato nuotrauka"
          class="w-full object-cover"
        />
        <div
          class="absolute bottom-0 left-0 w-full bg-black bg-opacity-60 text-white text-center p-2"
        >
          <h2 class="text-2xl font-semibold"><?= $name ?></h2>
          <p class="mt-1"><?= $short ?></p>
        </div>
      </div>
      <h1 class="text-4xl font-bold"><?= $phone ?> <i class="fa-solid fa-copy"></i></h1>
      <!-- Skambinimo mygtukas -->
      <button
        class="text-green-500 flex items-center justify-center text-7xl shadow-xl mt-10"
      >
        <i class="fa-solid fa-square-phone-flip"></i>
      </button>
      <?php if( !$smsDisable ): ?>
        <button
          class="text-blue-500 flex items-center justify-center text-3xl shadow-xl mt-10"
        >
          <i class="fa-solid fa-comment-sms"></i>
        </button>
      <?php endif; ?>

    </div>

    <footer class="fixed bottom-0 left-0 w-full text-center py-4 text-gray-800 text-sm">
      Skambink.TEL
    </footer>
  </body>

</html>
