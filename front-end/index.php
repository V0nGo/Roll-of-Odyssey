<?php $title = 'Accueil';

// Log de la page visitée
    // Ouverture du fichier d'inscription
    $log = fopen($_SERVER['DOCUMENT_ROOT'] . '\logs\pages.txt', 'a+');
    // Création de la ligne à ajouter : AAAA/mm/jj - hh:mm:ss -  Tentative de connexion réussie/échouée de : {email}
    $line = getenv("REMOTE_ADDR") . ' - ' . date('d/m/Y - H:i:s') . ' - ' . 'Visite de ' . $title . ' par ' . (isset($_SESSION['email']) ? $_SESSION['email'] : 'Anonyme') . "\n";

    // Ajout de la ligne au fichier ouvert 
    fputs($log, $line);

    // Fermeture du fichier ouvert
    fclose($log);

include('./includes/head.php'); ?>

<body>
    <?php include('./includes/header.php'); ?>
    <main class="mt-5">
        <section>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm">
                        <p class=" display-1 fw-bold">Redéfinissez les règles</p>
                        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos libero blanditiis dolor, eos provident expedita, ratione in, error debitis quo reprehenderit. Labore ducimus natus porro.</p>
                        <a class="btn btn-primary" href="#" role="button">S'inscrire maintenant</a>
                    </div>
                    <div class="col-md-6 col-sm">
                        <img src="img/screens.png" class="img-fluid" alt="" />
                    </div>
                </div>

            </div>
        </section>
        <section>
            <div class="container">
                <div class="flex-column">
                    <p class=" display-4 fw-bold col-md-7 col">
                        <span class="text-primary">One seamless</span>, end-to-end product design workflow.
                    </p>

                    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 ">
                        <div class="feature col">
                            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                                <img src="svg/amd.svg" width="30rem">
                            </div>
                            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
                            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.
                            </p>
                            <a href="#" class="icon-link">
                                Call to action
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="feature col">
                            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                                <img src="svg/amd.svg" width="30rem">
                            </div>
                            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
                            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                            <a href="#" class="icon-link">
                                Call to action
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="feature col">
                            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                                <img src="svg/amd.svg" width="30rem">
                            </div>
                            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
                            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                            <a href="#" class="icon-link">
                                Call to action
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="flex-column ">
                    <div class="row mb-5">
                        <div class="col-md-6 col-10">
                            <h1 class="fw-bold ">Découvrez les dernières campagnes</h1>
                        </div>
                        <div class="col-5 d-inline-flex align-items-end justify-content-end offset-">
                            <a class="btn btn-primary" href="#" role="button" style="height: fit-content;">
                                Tout voir <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>

                    <div class="row justify-content-center g-5">
                    <div class="col">
                            <div class="card" style="width: 20rem;">
                                <img src="https://picsum.photos/500/200" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title fw-bold">Warhammer</h5>
                                    <h6 class="card-subtitle mb-3 ms-2 text-secondary">Y. Cordonnier</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 20rem;">
                                <img src="https://picsum.photos/500/200" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title fw-bold">Warhammer</h5>
                                    <h6 class="card-subtitle mb-3 ms-2 text-secondary">Y. Cordonnier</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 20rem;">
                                <img src="https://picsum.photos/500/200" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title fw-bold">Warhammer</h5>
                                    <h6 class="card-subtitle mb-3 ms-2 text-secondary">Y. Cordonnier</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>





                    </div>
        </section>
    </main>

    <?php include('./includes/footer.php'); 
    ?>
</body>

</html>