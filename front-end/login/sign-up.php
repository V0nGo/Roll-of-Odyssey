<head>
    <link rel="stylesheet" href="../css/login.css">
<?php $title = 'Inscription';
include('../includes/head.php'); ?>

<?php

    try {
        $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    
    // Écrire la requête SELECT à trous
    $q = 'SELECT id,question FROM captcha ORDER BY RAND() LIMIT 1;';
    
    // Préparer la requête
    $req = $bdd->prepare($q);

    // Exécuter la requête 
    $req->execute([]);

// Récupérer les résultats dans un tableau $captcha
$captcha = $req->fetchAll();

?>






<body>
    <?php include('../includes/header.php'); ?>

    <main>
            <form 
                class="d-flex flex-column my-4 mx-auto bg-secondary bg-opacity-75 p-3 rounded-4 login-window"
                action="verif-sign-up.php"
                method="post">
                <h2 class="text-center my-3">S'inscrire</h2>
                <?php if(isset($_GET['message']) && !empty($_GET['message'])) {
                    echo
                        '<div class="alert alert-warning alert-dismissible fade show my-4" role="alert">'
                      . '<strong>Erreur : </strong>' . htmlspecialchars($_GET['message']) .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                        </div>';
                }
                
                ?>

                <div class="form-floating mb-3">
                    <input type="surname" name="prenom" class="form-control" id="floatingSurname" placeholder="prénom" required>
                    <label for="floatingSurname">Prénom</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="name" name="nom" class="form-control" id="floatingName" placeholder="Nom" required>
                    <label for="floatingName">Nom</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="pseudo" name="pseudo" class="form-control" id="floatingPseudo" placeholder="SuperSananes98" required>
                    <label for="floatingPseudo">Pseudo</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" 
                    name="email"
                    class="form-control" 
                    id="floatingEmail"    
                    placeholder="mail@emplemple.com" 
                    required
                    value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>">
                    <label for="floatingPassword">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Mot de passe</label>
                </div>
                <ul>
                    <li>Minimum 8 caractères</li>
                    <li>Au moins 1 lettre minuscule</li>
                    <li>Au moins 1 lettre majuscule</li>
                    <li>Au moins 1 chiffre</li>
                    <li>Au moins 1 caractère spécial</li>
                </ul>
                <div class="form-floating mb-3">
                    <input type="password" name="password_confirm" class="form-control" id="floatingPasswordConfirm" placeholder="Re-Password" required>
                    <label for="floatingPasswordConfirm">Écrire à nouveau le mot de passe</label>
                </div>

                <h2 class="my-3 text-center">Captcha de vérification</h2>
                <?php
                
                echo '<span class="my-3 h4">' . $captcha[0]['question'] . '</span>';
                
                echo '<input type="hidden" name="captcha_id"' . 'value="' . $captcha['0']['id'] . '">';
                ?>
                <div class="form-floating">
                    <input type="captcha" name="captcha_reponse" class="form-control" id="floatingCaptcha" placeholder="Réponse" required>
                    <label for="floatingCaptcha">Réponse</label>
                </div>
                <button class="btn btn-primary align-self-end my-3" type="submit">S'inscrire</button>
            </form>

        </div>
    </div>
    </main>


<?php include('../includes/footer.php') ?>

</body>