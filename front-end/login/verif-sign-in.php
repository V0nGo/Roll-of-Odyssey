<?php

function writeLogSignIn($success, $email) {

    // Ouverture du fichier d'inscription
    $log = fopen($_SERVER['DOCUMENT_ROOT'] . '\logs\sign-in.txt', 'a+');
    // Création de la ligne à ajouter : AAAA/mm/jj - hh:mm:ss -  Tentative de connexion réussie/échouée de : {email}
    $line = getenv("REMOTE_ADDR") . ' - ' . date('d/m/Y - H:i:s') . ' - Tentative de connexion ' . ($success ? 'réussie ' : 'échoué ') . $email . "\n";

    // Ajout de la ligne au fichier ouvert 
    fputs($log, $line);

    // Fermeture du fichier ouvert
    fclose($log);
}


// Si un paramètre email à été envoyé via la méthode post et qu'il n'est pas vide > créer un cookie 'email' qui expire dans 30j
if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 3600);
}


// Si email ou password n'existent pas vide > redirection vers connexion.php avec un message d'erreur
if (
    !isset($_POST['email'])
    || empty($_POST['email'])
    || !isset($_POST['password'])
    || empty($_POST['password'])
    || !isset($_POST['captcha_reponse'])
    || empty($_POST['captcha_reponse'])
    || !isset($_POST['captcha_id'])
    || empty($_POST['captcha_id'])
) {
    writeLogSignIn(false, $_POST['email']);
    header('location:sign-in.php' . '?' . 'message=Veuillez remplir tout les champs');
    exit;
}

// Si l'email n'est pas valide > redirection avec une erreur
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    writeLogSignIn(false, $_POST['email']);
    header('location:sign-in.php' . '?' . 'message=Email invalide');
    exit;
}


// CAPTCHA

// Connexion à la BD
try {
    $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$id = $_POST['captcha_id'];

// Écrire la requête SELECT à trous
$q = 'SELECT id,reponse FROM captcha WHERE id = :id';

// Préparer la requête
$req = $bdd->prepare($q);

// Exécuter la requête
$req->execute([
    'id' => $id,
]);

// Récupérer les résultats dans un tableau $captcha
$id = $req->fetchAll();
// Si le captcha n'existe pas > redirection

if (empty($id)) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Erreur lors de la validation du captcha.');
    exit;
}

// Si la réponse du captcha ne correspond pas à la réponse envoyée > redirection
if ($id[0]['reponse'] != $_POST['captcha_reponse']) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message= Mauvais captcha.');
    exit;
}



// Si le compte utilisateur n'existe pas en db > redirection
// Connexion à la BD
try {
    $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Écrire la requête SELECT à trous
$q = 'SELECT id FROM users WHERE email = :email AND password = :password';

// Préparer la requête
$req = $bdd->prepare($q);

// Salage du mot de passe
$salt = 'JimmyRohanYann';
$pass_salt = $_POST['password'] . $salt;
$pass_hash = hash('sha256', $pass_salt);

// Exécuter la requête 
$req->execute([
            'email' => $_POST['email'],
            'password' => $pass_hash
]);

// Récupérer les résultats dans un tableau $results
$results = $req->fetchAll();

// Si $results est vide > redirection
if (empty($results)) {
    writeLogSignIn(false, $_POST['email']);
    header('location:sign-in.php?message=Identifiants inconnue');
    exit;
}


// Si on arrive ici, c'est que tout est OK
// Connectons l'utilisateur

// Création d'une session
session_start();

// Ajout de l'email à la session
$_SESSION['email'] = $_POST['email'];

writeLogSignIn(true, $_POST['email']);

// Redirection vers la page d'accueil
header('location:../index.php'); // FIXME: Renvoi vers la page des campagnes du joueur
exit;


?>