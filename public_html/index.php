<?php

$phoneGet = isset($_GET['phone']) ? htmlspecialchars(basename($_GET['phone'])) : '112';
$phone = $phoneGet;
$name = isset($_GET['name']) ? htmlspecialchars(basename($_GET['name'])) : 'Nežinomas numeris';
$short = isset($_GET['short']) ? htmlspecialchars(basename($_GET['short'])) : '';

$dataExists = false;
$smsDisable = false;

$data = array(
  "061600055" => array(
    "name" => "IT'menas",
    "short" => "#Kūrimas #Vystymas #Patikra",
    "description" => "Visokeriopa IT pagalba ➕ kūrybiniai sprendimai ☁",
    "image" => "061600055.jpg"
  ),
  "067466042" => array(
    "name" => "Lietuvos Caritas",
    "short" => "Tarptautinė katalikiška organizacija",
    "description" => "Lietuvos Caritas koordinuoja Caritas veiklą Lietuvoje, atstovauja organizacijai nacionaliniu lygiu ir užsienyje, gina pažeidžiamųjų interesus.",
    "image" => "caritas.png"
  ),
  "112" => array(
    "name" => "Skubi pagalba",
    "short" => "Bendrasis pagalbos centras",
    "description" => "Bendras telefono ryšio numeris, skirtas pranešti apie teisės pažeidimą, staiga iškilusią grėsmę gyvybei, sveikatai, saugumui, aplinkai ar turtui ir išsikviesti pagalbos tarnyboms: policijai, priešgaisrinei gelbėjimo tarnybai, greitajai medicinos pagalbai ar aplinkosaugai.",
    "image" => "112.png",
    "smsDisable" => true
  )
);

$description = "Telefono numeris nėra registruotas sistemoje, todėl papildomi duoemys apie savininką gali būti netikslūs. Jeigu esate šio numerio savininkas arba valdytojas, tuomet galite jį <a class='text-gree-500 underline' href='sms:+37061600055?body=Prašau užregistruoti mano telefono numerį sistemoje Skambink.TEL'>užregistruoti</a> ir nurodyti papildomą informaciją.";
$image = "https://skambink.tel/img/default.jpeg";

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

        <meta property="og:url" content="https://skambink.tel/<?= $phoneGet ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?= $title ?>"/>
        <meta property="og:description" content="<?= $description ?>"/>
        <meta property="og:image" content="<?= $image ?>"/>

        <script src="https://kit.fontawesome.com/d51de49024.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>

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

    <body class="bg-gradient-to-b from-gray-300 to-gray-50 flex flex-col">
    <div class="flex flex-col items-center justify-center space-y-6">
      <!-- Kontaktas -->
      <div class="relative w-full max-w-md">
        <div class="w-full aspect-square overflow-hidden">
          <img
            src="<?= $image ?>"
            alt="Adresato nuotrauka"
            class="w-full h-full object-cover object-center"
          />
        </div>
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-60 text-white text-center p-2">
          <h2 class="text-2xl font-semibold"><?= htmlspecialchars($name) ?>
            <a href="#" onclick="showModal()" class="ml-1 text-xl"><?= $dataExists ? '<i class="fa-solid fa-check text-green-500"></i>' : '<i class="fa-solid fa-triangle-exclamation text-yellow-500"></i>' ?></a></h2>
          <p class="mt-1"><?= htmlspecialchars($short) ?></p>
        </div>
      </div>
      <h1 class="text-3xl font-semibold text-gray-900 flex items-center"><?= $phone ?>
        <a href="#" onclick="copyToClipboard('<?= $phone ?>');return false;" class="text-gray-700 ml-2 text-xl"><i class="fa-solid fa-copy"></i></a>
      </h1>
      <!-- Skambinimo mygtukas -->
      <button
        class="text-green-500 flex items-center justify-center text-7xl mt-10"
      >
        <a href="tel:<?= $phone ?>"><i class="fa-solid fa-square-phone-flip"></i></a>
      </button>
      <?php if( !$smsDisable ): ?>
        <button
          class="text-blue-500 flex items-center justify-center text-4xl mt-10"
        >
          <a href="sms:<?= $phone ?>"><i class="fa-solid fa-comment-sms"></i></a>
        </button>
      <?php endif; ?>

    </div>

    <div id="copyMessageBox" class="fixed bottom-4 max-w-md w-3/4 left-1/2 transform -translate-x-1/2 text-center bg-gray-700 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-300 pointer-events-none z-50">
      <span id="copyMessage">Nukopijuota!</span>
    </div>

    <footer class="w-full text-center py-4 text-gray-800 text-sm mt-auto">
      <a href="./">Skambink.TEL</a>
    </footer>

    <!-- Modal fonas -->
    <div id="modal" onclick="closeModal()" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
      <!-- Modal langas -->
      <div onclick="event.stopPropagation()" class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center space-y-4">
        <p class="text-gray-600" id="modalMessage"><?= $description ?></p>
      </div>
    </div>

    <script>
      function showModal(message) {
        document.getElementById('modal').classList.remove('hidden');
      }

      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
      }
    </script>

    <script>
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        const msgBox = document.getElementById('copyMessageBox');
        const msg = document.getElementById('copyMessage');
        msg.textContent = "Nukopijuota: " + text;
        msgBox.classList.remove('opacity-0');
        setTimeout(() => {
          msgBox.classList.add('opacity-0');
        }, 2700);
      });
    }
    </script>
  </body>

</html>
