<?php

// Vérifier si le champ est vide
if (empty($_POST['code'])) {
    header('location:sign-up-mail.php' . '?' . 'message=Code manquant.');
    exit;
}

// Vérifier si le code est valide

// Appeler la base de données
try {
    $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Écrire la requête SELECT à trous
$q = 'SELECT email,code,expiration FROM email_verif WHERE email = :email AND code = :code';

// Préparer la requête
$req = $bdd->prepare($q);

// Exécuter la requête
$req->execute([
    'email' => $_POST['email'],
    'code' => $_POST['code'],
]);

// Récupérer les résultats dans un tableau $email_verif
$email_verif = $req->fetchAll();


// Si le code n'existe pas > redirection
if (empty($email_verif[0]['code'])) {
    header('location:sign-up-mail.php' . '?' . 'message=Code invalide.');
    exit;
}

// Si le code est expiré > redirection
if ($email_verif[0]['expiration'] < time()) {
    header('location:sign-up-mail.php' . '?' . 'message=Code expiré.');
    exit;
}

// Si le mail est le même que celui du Get > redirection
if ($email_verif[0]['email'] != $_POST['email']) {
    header('location:sign-up-mail.php' . '?' . 'message=Email invalide.');
    exit;
}



// Si le code est valide > redirection
if ($email_verif[0]['code'] == $_POST['code']) {

    // Supprimer le code de la base de données
    $q = 'DELETE FROM email_verif WHERE email = :email AND code = :code';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => $_POST['email'],
        'code' => $_POST['code'],
    ]);

    // Supprime tout les autres codes avec une date de d'expiration inférieur à la date actuelle
    $q = 'DELETE FROM email_verif WHERE expiration < :date';
    $req = $bdd->prepare($q);
    $req->execute([
        'date' => time(),
    ]);
    


    // Si on arrive ici c'est que tout les tests sont passés on peut modifier le status de l'utilisateur
    $q = 'UPDATE users SET status = 1 WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => $_POST['email'],
    ]);



    header('location:index.php' . '?' . 'success=Compte vérifier avec succès.'); // FIXME: Renvoi vers la page des campagnes du joueur
    exit;
}



?>