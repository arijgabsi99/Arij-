<!DOCTYPE html>
<html>

<head>
    <title>S'inscrire </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../signUp/style1.css">
    <link rel="stylesheet" type="text/css" href="../signUp/S'inscrire.html">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">


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
            if (isset($_POST["submit1"])) {

                echo 'nom : ' . htmlspecialchars($_POST['nom']) . '<br>';
                echo 'Prénom : ' . $_POST['prenom'] . '<br>';
                echo 'CIN : ' . $_POST['cin'] . '<br>';
                echo 'Email : ' . $_POST["email"] . '<br>';
                echo 'Address : ' . $_POST["address"] . '<br>';
                echo 'DateNaissenceM : ' . $_POST["dateNaissence"] . '<br>';
                echo 'Numero Téléphone : ' . $_POST["numeroTel"] . '<br>';
                echo 'Mot de passe  : ' . $_POST['mdp'] . '<br>';
                echo 'Specialite  : ' . $_POST['specialite'] . '<br>';
                echo "Merci de s/inscrire en tant qu'un Medecin";
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
            }
            ?>


            </textarea>
            <button type="submit" href="/">Liste des rendez-vous</button>
        </div>
    </form>
    <form action="../RDV/form.html" class="decor">
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
            if (isset($_POST["submit2"])) {
                //header("Location:utilisateur.php");

                echo 'nom : ' . htmlspecialchars($_POST['nom']) . '<br>';
                echo 'Prenom : ' . $_POST['prenom'] . '<br>';
                echo 'CIN : ' . $_POST['cin'] . '<br>';
                echo 'Email : ' . $_POST["email"] . '<br>';
                echo 'Address : ' . $_POST["address"] . '<br>';
                echo 'DateNaissenceM : ' . $_POST["dateNaissence"] . '<br>';
                echo 'Numero Téléphone : ' . $_POST["numeroTel"] . '<br>';
                echo 'Mot de passe  : ' . $_POST['mdp'] . '<br>';


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

                echo "Merci de s/inscrire en tant qu'un Patient : " . $nom . '<br> ';

                try {
                    //On se connecte à la BDD
                    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
                    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    //On insère les données reçues
                    $sth = $dbco->prepare("
            INSERT INTO utilisateur(nomU, prenomU, cinU ,emailU ,addressU, dateNaissenceU,numeroTelU,mdpU )
            VALUES(:nomU , :prenomU, :cinU, :emailU , :addressU,:dateNaissenceU, :numeroTelU , :mdpU )");
                    $sth->bindParam(':nomU', $nom);
                    $sth->bindParam(':prenomU', $prenom);
                    $sth->bindParam(':cinU', $cin);
                    $sth->bindParam(':emailU', $email);
                    $sth->bindParam(':addressU', $address);
                    $sth->bindParam(':dateNaissenceU', $dateNaissence);

                    $sth->bindParam(':numeroTelU', $numerotel);
                    $sth->bindParam(':mdpU', $mdp);

                    $sth->execute();

                    //On renvoie l'utilisateur vers la page de remerciement
                    //header("Location:index.html");
                } catch (PDOException $e) {
                    echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
                }
            }
            ?>


            </textarea>
            <button type="submit" href="/">prendre un rendez-vous</button>
        </div>
    </form>



</body>

</html>