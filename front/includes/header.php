<header class="bg-body-tertiary">

        
    <nav class="navbar navbar-expand-sm bg-body-tertiary fixed-top">
  <div class="container-fluid flex-sm-wrap">
    <a href="#" class="navbar-brand">
        <img src="img/logo.png" alt="logo" height="150px">
        <span class="text-decoration-none m-1 fw-bold">Roll of Odyssey</span>
    </a>
    <!-- Bouton extend -->
    <button 
        class="navbar-toggler" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#offcanvasNavbar" 
        aria-controls="offcanvasNavbar" 
        aria-label="Toggle navigation"
        >
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- NavBar / OffCanvas -->
    <div 
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasNavbar" 
        aria-labelledby="offcanvasNavbarLabel"
        >

      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Roll of Odyssey</h5>
        <button 
            type="button" 
            class="btn-close" 
            data-bs-dismiss="offcanvas" 
            aria-label="Fermer"></button>
      </div>

      <div class="offcanvas-body justify-content-between text-nowrap flex-sm-wrap">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Règles</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Support</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">À propos</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item mx-2">
            <a
                id="sign-up"
                class="btn btn-primary fw-bold"
                href="#"
                role="button"
                >S'inscrire</a
            >
          </li>
          <li class="nav-item mx-2">
            <a
                id="log-in"
                class="btn btn-outline-primary fw-bold"
                href="#"
                role="button"
                >Se connecter</a
            >
          </li>

        </ul>
      </div>
    </div>
  </div>
</nav>
    
    
    
    
    
    
    
    
    
   <!--
    <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="navbar-brand">
                <a href="#"
                   class="text-decoration-none">
                    <img src="img/logo.png" alt="logo" height="150px">
                </a>
            </div>
            <!- Bouton extend ->
            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            id="navbarNav"
            class="collapse navbar-collapse"
          >
          <!- Boutons nav ->
          <ul class="navbar-nav">
              <li class="nav-item">
                <a href="#" class="nav-link">Accueil</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">Règles</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">Support</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">À propos</a>
              </li>
            </ul>
          


          <!- Not registered ->
          <div class="navbar-nav">

          <a
            name="sign-up"
            class="btn btn-primary me-2"
            href="#"
            role="button"
            >S'inscrire</a>
            
            <li class="nav-item">
            <a
                name="log-in"
                class="btn btn-primary"
                href="#"
                role="button"
            >Se connecter</a>
            </li>
          </ul>
          </div>
        </nav>
    </div>
</header>
