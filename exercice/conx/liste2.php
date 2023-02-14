<!DOCTYPE html>
<html>

<head>
    <title>Cours PHP / MySQL</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="formulaire.css">
</head>

<body>
    <h1>Formulaire HTML</h1>

    <form action="xss.php" method="post">
        <div class="c100">
            <label for="prenom">Prénom : </label>
            <input type="text" id="prenom" name="prenom" style="width:30em">
        </div>
        <div class="c100">
            <label for="mail">Email : </label>
            <input type="email" id="mail" name="mail">
        </div>
        <div class="c100">
            <label for="age">Age : </label>
            <input type="number" id="age" name="age" min="12" max="99">
        </div>
        <div class="c100" id="submit">
            <input type="submit" value="Envoyer">
        </div>
    </form>


    <?php
    $serveur = "localhost";
    $dbname = "cours";
    $user = "root";
    $pass = "root";

    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $age = $_POST["age"];

    try {
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On insère les données reçues si les champs sont remplis
        if (!empty($prenom)  && !empty($mail) && !empty($age)) {
            $sth = $dbco->prepare("
                        INSERT INTO form(prenom, mail, age)
                        VALUES(:prenom, :mail, :age)");
            $sth->bindParam(':prenom', $prenom);
            $sth->bindParam(':mail', $mail);
            $sth->bindParam(':age', $age);
            $sth->execute();
        }

        //On récupère les infos de la table 
        $sth = $dbco->prepare("SELECT prenom, mail, age FROM form");
        $sth->execute();
        //On affiche les infos de la table
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        $keys = array_keys($resultat);
        for ($i = 0; $i < count($resultat); $i++) {
            $n = $i + 1;
            echo 'Utilisateur n°' . $n . ' :<br>';
            foreach ($resultat[$keys[$i]] as $key => $value) {
                echo $key . ' : ' . $value . '<br>';
            }
            echo '<br>';
        }
    } catch (PDOException $e) {
        echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
    }
    ?>
</body>

</html>