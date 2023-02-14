<!DOCTYPE html>
<html>

<head>
    <title>S'inscrire </title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
            padding: 0;
            margin: 0;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
        }

        input,
        textarea {
            outline: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #3d5ff5;
        }

        h1 {
            margin-top: 0;
            font-weight: 500;
        }

        form {
            position: relative;
            width: 80%;
            border-radius: 30px;
            background: #fff;
        }

        .form-left-decoration,
        .form-right-decoration {
            content: "";
            position: absolute;
            width: 50px;
            height: 20px;
            border-radius: 20px;
            background: #3d5ff5;
        }

        .form-left-decoration {
            bottom: 60px;
            left: -30px;
        }

        .form-right-decoration {
            top: 60px;
            right: -30px;
        }

        .form-left-decoration:before,
        .form-left-decoration:after,
        .form-right-decoration:before,
        .form-right-decoration:after {
            content: "";
            position: absolute;
            width: 50px;
            height: 20px;
            border-radius: 30px;
            background: #fff;
        }

        .form-left-decoration:before {
            top: -20px;
        }

        .form-left-decoration:after {
            top: 20px;
            left: 10px;
        }

        .form-right-decoration:before {
            top: -20px;
            right: 0;
        }

        .form-right-decoration:after {
            top: 20px;
            right: 10px;
        }

        .circle {
            position: absolute;
            bottom: 80px;
            left: -55px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
        }

        .form-inner {
            padding: 40px;
        }

        .form-inner input,
        .form-inner textarea {
            display: block;
            width: 100%;
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            border-radius: 20px;
            background: #d0dfe8;
        }

        .form-inner textarea {
            resize: none;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border-radius: 20px;
            border: none;
            border-bottom: 4px solid #3d5ff5;
            background: #3d5ff5;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
        }

        button:hover {
            background: #3d5ff5;
        }

        @media (min-width: 568px) {
            form {
                width: 60%;
            }
        }
    </style>

</head>

<body>
    <form action="../conx/liste.php" class="decor">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h1>Dans le formulaire précédent, vous avez fourni les
                informations suivantes pour s'inscrire:</h1>
            <?php
            $serveur = "localhost";
            $dbname = "rdv";
            $user = "root";
            $pass = "";
            echo 'nom : ' . htmlspecialchars($_POST['nom']) . '<br>';
            echo 'Prénom : ' . $_POST['prenom'] . '<br>';
            echo 'CIN : ' . $_POST['cin'] . '<br>';
            echo 'Email : ' . $_POST["email"] . '<br>';
            echo 'Address : ' . $_POST["address"] . '<br>';
            echo 'DateNaissenceM : ' . $_POST["dateNaissence"] . '<br>';
            echo 'Numero Téléphone : ' . $_POST["numeroTel"] . '<br>';
            echo 'Mot de passe  : ' . $_POST['mdp'] . '<br>';
            echo 'Specialite  : ' . $_POST['specialite'] . '<br>';

            ?>


            </textarea>
            <button type="submit" href="/">Voir les rendez-vous</button>
        </div>
    </form>



</body>

</html>
<?php
$serveur = "localhost";
$dbname = "rdv";
$user = "root";
$pass = "";

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$cin = $_POST["cin"];
$email = $_POST["email"];
$address = $_POST["address"];
$dateNaissence = $_POST["dateNaissence"];

$numerotel = $_POST["numeroTel"];
$mdp = $_POST["mdp"];
$specialite = $_POST["specialite"];

try {
    //On se connecte à la BDD
    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //On insère les données reçues
    $sth = $dbco->prepare("
            INSERT INTO medecin(nomM,prenomM, cinM ,emailM ,addressM, dateNaissenceM,numeroTelM,mdpM,specialite )
            VALUES(:nomM , :prenomM, :cinM, :emailM , :addressM,:dateNaissenceM, :numeroTelM , :mdpM , :specialite )");
    $sth->bindParam(':nomM', $nom);
    $sth->bindParam(':prenomM', $prenom);
    $sth->bindParam(':cinM', $cin);
    $sth->bindParam(':emailM', $email);
    $sth->bindParam(':addressM', $address);
    $sth->bindParam(':dateNaissenceM', $dateNaissence);

    $sth->bindParam(':numeroTelM', $numerotel);
    $sth->bindParam(':mdpM', $mdpM);
    $sth->bindParam(':specialite', $specialite);
    $sth->execute();

    //On renvoie l'utilisateur vers la page de remerciement
    //header("Location:index.html");
} catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}
?>