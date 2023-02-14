<?php
$serveur = "localhost";
$dbname = "rdv";
$user = "root";
$pass = "";
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET['nom'], $_GET['prenom'], $_GET['email'], $_GET['password'])) {

    $email = htmlspecialchars(urldecode($_GET['email']));
    $requser = $dbco->prepare("SELECT * FROM medecin WHERE email = ?");
    $requser->execute(array($email));
    $userexist = $requser->rowCount();
    if ($userexist == 1) {
        $user = $requser->fetch();
        echo "L'utilisateur existe !";
    }
} else {
    echo "L'utilisateur n'existe pas !";
}

// récupérer tous les utilisateurs
$sql = "SELECT * FROM form";

try {

    $stmt = $dbco->query($sql);

    if ($stmt === false) {
        die("Erreur");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Afficher la table rendez-vous </title>
    <link rel="stylesheet" type="text/css" href="../conx/style3.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>

<body>

    <div class="testbox">
        <form action="../conx/mail.php" method="GET">
            <div class="banner">
                <h1>Liste des rendez-vous</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>NumeroTel</th>
                        <th>Daterdv</th>
                        <th>Heure</th>
                        <th> Valide </th>

                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
                            <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['numero_tel']); ?></td>
                            <td><?php echo htmlspecialchars($row['daterdv']); ?></td>
                            <td><?php echo htmlspecialchars($row['heure']); ?></td>


                            <td>
                                <div class="btn-block">
                                    <button type="submit" name="valide1" href="/">Accepter</button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-block">
                                    <button type="submit" name="valide2" href="/">Refuser</button>
                                </div>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
</body>

</html>