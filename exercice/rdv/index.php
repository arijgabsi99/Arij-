<?php
$serveur = "localhost";
$dbname = "rdv";
$user = "root";
$pass = "";

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$age = $_POST["age"];
$email = $_POST["email"];
$numero_tel = $_POST["numero_tel"];
$date = $_POST["daterdv"];
$heure = $_POST["heure"];


try {
    //On se connecte à la BDD
    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $conn->prepare('SELECT * FROM utilisateur WHERE email = :email');
    $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($statement->fetch())) {
        echo 'User with such email exists.';
        exit;
    }

    //On insère les données reçues
    $sth = $dbco->prepare("
            INSERT INTO form(nom,prenom, age, email, numero_tel,daterdv,
            heure )
            VALUES(:nom ,:prenom,:age ,:email,:numero_tel ,:daterdv, :heure)");
    $sth->bindParam(':nom', $nom);
    $sth->bindParam(':prenom', $prenom);
    $sth->bindParam(':age', $age);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':numero_tel', $numero_tel);
    $sth->bindParam(':daterdv', $date);
    $sth->bindParam(':heure', $heure);
    $sth->execute();

    //On renvoie l'utilisateur vers la page de remerciement
    //header("Location:index.html");
} catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}

try {
    //On se connecte à la BDD
    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //On insère les données reçues
    $sth = $dbco->prepare("
            INSERT INTO utilisateur(nom,prenom, age, email, numero_tel )
            VALUES(:nom , :prenom,:age, :email, :numero_tel)");
    $sth->bindParam(':nom', $nom);
    $sth->bindParam(':prenom', $prenom);
    $sth->bindParam(':age', $age);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':numero_tel', $numero_tel);
    $sth->execute();

    //On renvoie l'utilisateur vers la page de remerciement
    //header("Location:index.html");
} catch (PDOException $e) {
    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
}

header("Location:../index.php");
