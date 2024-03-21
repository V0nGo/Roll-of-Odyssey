<?php

$PDO = "'mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root'";

// Fichier de vérification d'inscription

function writeLogSignUp($success, $email)
{

    // Ouverture du fichier d'inscription
    $log = fopen($_SERVER['DOCUMENT_ROOT'] . '\logs\sign-up.txt', 'a+');
    // Création de la ligne à ajouter : AAAA/mm/jj - hh:mm:ss -  Tentative de connexion réussie/échouée de : {email}
    $line = getenv("REMOTE_ADDR") . ' - ' . date('d/m/Y - H:i:s') . ' - Tentative d\'inscription ' . ($success ? 'réussie ' : 'échoué ') . $email . "\n";

    // Ajout de la ligne au fichier ouvert 
    fputs($log, $line);

    // Fermeture du fichier ouvert
    fclose($log);
}

// Si un paramètre email à été envoyé via la méthode post et qu'il n'est pas vide > créer un cookie 'email' qui expire dans 30j
if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 3600);
}

// Si l'email ou le mot de passe n'existent pas > redirection avec message d'erreur
if (
    !isset($_POST['pseudo'])
    || empty($_POST['pseudo'])
    || !isset($_POST['email'])
    || empty($_POST['email'])
    || !isset($_POST['password'])
    || empty($_POST['password'])
    || !isset($_POST['password_confirm'])
    || empty($_POST['password_confirm'])
    || !isset($_POST['captcha_reponse'])
    || empty($_POST['captcha_reponse'])
    || !isset($_POST['captcha_id'])
    || empty($_POST['captcha_id'])
    || !isset($_POST['prenom'])
    || empty($_POST['prenom'])
    || !isset($_POST['nom'])
    || empty($_POST['nom'])
) {
    header('location:sign-up.php' . '?' . 'message=Veuillez remplir tout les champs.');
    exit;
}


// Si l'email n'est pas valide > redirection avec une erreur
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Email invalide');
    exit;
}

// Si le mot de passe ne fait pas entre 8 et 16 caractères > Redirection avec une erreur
if (strlen($_POST['password']) <= 8 || strlen($_POST['password']) > 100) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Le mot de passe doit être compris 8 et 100 caractères.');
    exit;
}



// Si le mot de passe ne possède pas au moins 1 lettre minuscule
if (!preg_match('@[a-z]@', $_POST['password'])) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Le mot de passe doit contenir au moins une lettre minuscule.');
    exit;
}

// Si le mot de passe ne possède pas au moins 1 lettre majuscule
if (!preg_match('@[A-Z]@', $_POST['password'])) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Le mot de passe doit contenir au moins une lettre majuscule.');
    exit;
}

// Si le mot de passe ne possède pas au moins 1 chiffre
if (!preg_match('@[0-9]@', $_POST['password'])) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Le mot de passe doit contenir au moins un chiffre.');
    exit;
}

// Si le mot de passe ne possède pas de caractère spécial
if (!preg_match('@[^\w]@', $_POST['password'])) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Le mot de passe doit contenir au moins un caractère spécial.');
    exit;
}


// Si le mot de passe ne correspond pas au mot de passe de confirmation
if ($_POST['password'] != $_POST['password_confirm']) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Les mots de passes ne correspondent pas.');
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





// Vérification si l'email ou le pseudo existe déjà dans la base de données

// Connexion à la BD
try {
    $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Écrire la requête SELECT à trous
$q = 'SELECT id,email,pseudo FROM users WHERE email = :email OR pseudo = :pseudo';

// Préparer la requête
$req = $bdd->prepare($q);


// Exécuter la requête 
$req->execute([
    'email' => $_POST['email'],
    'pseudo' => $_POST['pseudo']
]);

// Récupérer les résultats dans un tableau $results
$results = $req->fetchAll();

// Si il existe un même pseudo > redirection
if (!empty($results) && $results[0]['pseudo'] == $_POST['pseudo']) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Pseudo déjà utilisé.');
    exit;
}

// Si il existe un même email > redirection
if (!empty($results) && $results[0]['email'] == $_POST['email']) {
    writeLogSignUp(false, $_POST['email']);
    header('location:sign-up.php' . '?' . 'message=Email déjà utilisé.');
    exit;
}









// Si on arrive ici c'est que tout les tests sont passés

// Insertion d'une nouvelle ligne dans notre table users

// Requête préparée avec des marqueurs nominatifs

// Connexion à la BD
try {
    $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Écrire la requête INSERT INTO à trous
$q = 'INSERT INTO users (pseudo, email, password, prenom, nom) VALUES (:pseudo, :email, :password, :prenom, :nom)';

// Préparation de la requête
$req = $bdd->prepare($q);

// Salage de mot de passe
$salt = 'JimmyRohanYann';
$pass_salt = $_POST['password'] . $salt;
$pass_hash = hash('sha256', $pass_salt);

// Exécution de la requête
$result = $req->execute([
    'pseudo' => $_POST['pseudo'],
    'email' => $_POST['email'],
    'password' => $pass_hash,
    'prenom' => $_POST['prenom'],
    'nom' => $_POST['nom']
]);


if (!$result) {
    writeLogSignUp(false, 'Erreur BDD');
    header('location:sign-up.php' . '?' . 'message=Erreur lors de l\'inscription en base de données.');
    exit;
}


// Envoi d'un email de confirmation

// Génération d'un code à 6 caractères aléatoires
$code = bin2hex(random_bytes(3));


// Écrire la requête INSERT INTO à trous
$q = 'INSERT INTO email_verif (email, code, expiration) VALUES (:email, :code, :expiration)';
// Préparation de la requête
$req = $bdd->prepare($q);
// Exécution de la requête
$req->execute([
    'email' => $_POST['email'],
    'code' => $code,
    'expiration' => time() + 20 * 60
]);

// Envoi de l'email

require '../script.php';

sendMail($_POST['email'], 'Confirmation de votre inscription', 'Bonjour, voici votre code de vérification : ' . $code);

session_start();

$_SESSION['email'] = $_POST['email'];



// Si on arrive ici c'est que le nouveau compte à été créé en base de donnée
writeLogSignUp(true, $_POST['email']);
header('location:sign-up-mail.php');
exit;
