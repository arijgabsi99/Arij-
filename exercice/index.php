<!DOCTYPE html>
<html>

<head>
    <title>Rendez-vous</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="javascript.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>

<body>
    <div class="main-block">
        <a class="tiledBackground"></a>
        <form action="../rdv/" method="post">
            <div class="title">
                <i class="fas fa-pencil-alt"></i>
                <h2>Prendre un Rendez-vous</h2>
            </div>
            <div class="info">
                <input class="fname" type="text" name="nom" id="nom" placeholder="Nom" required autocomplete="on">
                <input class="fname" type="text" name="prenom" placeholder="Prenom" required autocomplete="on">
                <input class="fname" type="number" name="age" placeholder="Age" required autocomplete=" on">
                <input type="email" name="email" class="fname" id="inputmail" required placeholder="Email" autocomplete="on"> <span class="validity"></span>

                <input id="tel" name="numero_tel" type="text" placeholder="Numero Telephone" required pattern="(00216|\+216)*(2|5|9)[0-9][ ]{0,}[0-9]{3}[ ]{0,}[0-9]{3}" autocomplete="on"> <span class="validity"></span>

                <b>Veuillez choisir la date et l'heure du votre rendez-vous :</b>
                <li>
                    <label for="meeting-time">Date :</label>
                    <input type="date" id="meeting-time" name="daterdv" min="2023-02-14" required max="2023-06-31" required>
                    <span class="validity"></span>
                </li>
                <li>

                    <label for="appt">Heure :</label>
                    <input type="time" id="appt" name="heure" min="08:00" max="17:30" required> <br>

                </li>

                <label for="exampleFormControlFile1 ">Votre Dossier</label>
                <input type="file" id="file" name="file" accept="image/png, image/jpeg">

            </div>

            <button type="submit" class="btn" id="success" name="valider">Reserver !</button>


        </form>
    </div>
</body>

</html>
<?php
$serveur = "localhost";
$dbname = "rdv";
$user = "root";
$pass = "";
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET['nom'], $_GET['prenom'], $_GET['email'], $_GET['password'])) {

    $email = htmlspecialchars(urldecode($_GET['email']));
    $requser = $dbco->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $requser->execute(array($email));
    $userexist = $requser->rowCount();
    if ($userexist == 1) {
        $user = $requser->fetch();
        echo "L'utilisateur existe !";
    }
} else {
    echo "L'utilisateur n'existe pas !";
}
