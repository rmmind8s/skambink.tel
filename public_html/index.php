<?php

    define("HOME_PHONE", "+37061649775");
    define("TITLE", "Susisiekti nurodytu telefono numeriu");

    $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    $phone = $uri[0] ?? HOME_PHONE;

    $phone = strtok($phone, '?');

    $phone = $phone == "" ? HOME_PHONE : $phone;

    $phone = str_starts_with($phone, "370") ? "+" . $phone : $phone;

    $phone = trim($phone);

    if ($phone == "" || strlen($phone) > 15 || !ctype_digit(substr($phone, 1)) ){

        header("Location: http://".$_SERVER['HTTP_HOST']);

    }

    $description = $phone ;

    $title = $uri[1] ?? TITLE;
    $title = strtok($title, '?');

    $details = urldecode($title);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $details; ?></title>
    
    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" >
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" >
    <link rel="shortcut icon" href="/favicon/favicon.ico" >
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" >
    <meta name="apple-mobile-web-app-title" content="Skambink TEL" >
    <link rel="manifest" href="/favicon/site.webmanifest" >

    <meta id="meta-application-name" name="application-name" content="">
    <meta id="meta-description" name="description" content="Nedidelė pagalba besidalinantirms telefono numeriu">
    <meta id="meta-keywords" name="keywords" content="">

    <meta name="theme-color" content="#00ca58" >

    <meta property="og:title" content="<?= $details; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://skambink.tel/<?= $phone; ?>/<?= $title; ?>">
    <meta property="og:image" content="https://skambink.tel/img/og.png">
    <meta property="og:site_name" content="Skambink.TEL">
    <meta property="og:description" content="<?= $description; ?>">

    <style>

        html, body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: #f5f5f5;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        main,header {
            display: flex;
            align-items: center;
            flex-direction: column;
            width:100%;
        }

        header {
            background-color: #777;
        }

        main {
            height: 100%;
            height: -moz-available;          /* WebKit-based browsers will ignore this. */
            height: -webkit-fill-available;  /* Mozilla-based browsers will ignore this. */
            height: fill-available;
        }

        h1 {
            margin-bottom: 0;
        }

        p {
            padding: 1.5em;
            margin:0;
        }

        a {
            text-decoration: none;
            color: #008b3d;
        }

        #call {
            width: 4.7em;
            margin: 1em;

            animation: shake 0.7s;
            animation-iteration-count: 7;
            animation-delay: 3s;
        }

        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }


        #copy {
            background: url("../img/copy.svg") center no-repeat;
            text-indent: -9999px;
            display: inline-block;
            height: 1em;
            width: 0.75em;
            margin-left: 0.27em;
            
        }

        #plus {
            vertical-align: top;
            height: 1em;
            margin: 0;
            width: 1.25em;
        }

        #notification {
            visibility: hidden;
            color: #fff;
            background-color: #333;
            font-size: 1em;

            border-radius: 5px;
            padding: 16px 30px;
            text-align: center;

            bottom: 2em;
            z-index: 1;
            position: fixed;

            left: 50%;
            transform: translate(-50%, -50%);
        }

        #notification.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 2em; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 2em; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 2em; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 2em; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

figure {
    width: 100%;
    max-width: 500px;
    
    margin: 0;
    margin-left: auto;
    margin-right: auto;

    position: relative;
}

figure img {
    display: block;
}

figcaption {
    background: rgba(0, 0, 0, 0.5);
    color: #FFF;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1.25em;
    text-align: center;
}

#profile{
    width: 100%;
    height: auto;
    margin-left: auto;
    margin-right: auto;
}

    </style>
</head>
<body>
    <header>
        <figure>
            <img id="profile" src="/img/pfp.png">
            <figcaption><?= $details; ?></figcaption>
        </figure>
    </header>
    <main>
        <h1><span id="phone"><?= $phone; ?></span><a id="copy" title="Kopijuoti" href="#" onclick="copy('<?= $phone ?>');return false;">Kopijuoti</a></h1>
        <a href="tel:<?= $phone; ?>" title="Skambinti"><img id="call" src="/img/phone.svg" alt="Skambink.TEL"></a>
    </main>
    <footer>
        <p><a href="https://skambink.tel">Skambink.TEL</a></p>
        <span id="notification"></span>
    </footer>
    <script src="../scripts.js?ver=0.0.5"></script>
</body>
</html>