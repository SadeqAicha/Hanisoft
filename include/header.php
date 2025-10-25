<!--Start navbar-->
<nav class="navbar navbar-expand-lg fixed-top">
<div class="container">
    <a class="navbar-brand" href="index.php">
    <img src="images/logo.png" alt="Logo Hanisoft">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Menu">
    <span><i class="fas fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#services">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#about">À propos</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="blog.php">blog</a></li>
    </ul>

    <?php
    require_once __DIR__ . '/../auth/app/middleware/auth.php';
    if (!isset($_SESSION['user_id'])) {
        echo '<a href="login.php"><button class="btn-login ms-2" aria-label="Login"><i class="fas fa-user"></i></button></a>';
    }
    else{
        $u = current_user();
        $name=htmlspecialchars($u['name'],ENT_QUOTES,'UTF-8') ;
        echo '
        <div class="dropdown">
            <button id="login_btn" class="btn btn-primary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">'.$name.'</button>

            <ul id="account_btn" class="dropdown-menu" aria-labelledby="userMenu">';
            if($u['role']=='admin'){
                echo '<li><a class="dropdown-item" href="dashboard/new-post.php">Espace administrateur</a></li>';
            }
            echo
                '<li><a class="dropdown-item" href="profile.php">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="auth/routes/logout.php">Se déconnecter</a></li>
            </ul>
        </div>';
    }
    ?>
    </div>

</div>
</nav>
<!--End navbar-->