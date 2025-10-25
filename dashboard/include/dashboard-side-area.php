<div class="col-md-2 side-area">
    <h4><span style="color: var(--secondary-color);">Admin</span>istration</h4>
    <p class="text-center">Bonjour <strong><?php echo e($u['name']); ?></strong> !</p>
    <ul>
        <li data-bs-toggle="collapse" data-bs-target="#menu">
            <span><i class="fa-solid fa-newspaper"></i></span>
            <span>Blog</span>
        </li>                        
        <!-- Début de la liste déroulante -->
        <ul class="collapse" id="menu">
            <a href="new-post.php" class="link-light">
                <li>
                    <span><i class="fa-solid fa-pen-to-square"></i></span>
                    <span>Nouveau article</span>
                </li>
            </a>
            <a href="all-posts.php" class="link-light">
                <li>
                    <span><i class="fa-solid fa-grip"></i></span>
                    <span>Tous les articles</span>
                </li>
            </a>
            <a href="categories.php" class="link-light">
            <li>
                <span><i class="fa-solid fa-tags"></i></span>
                <span>Catégories</span>
            </li>
            </a>
        </ul>
        <!-- Fin de la liste déroulante -->
        <a href="messages.php" class="link-light">
            <li>
                <span><i class="fa-solid fa-message"></i></span>
                <span>Messages</span>
            </li>
        </a>
        <a href="utilisateurs.php" class="link-light">
            <li>
                <span><i class="fa-solid fa-users"></i></span>
                <span>Utilisateurs</span>
            </li>
        </a>
        <a href="../index.php" class="link-light">
            <li>
                <span><i class="fa-solid fa-house"></i></span>
                <span>Accueil</span>
            </li>
        </a>
        <a href="../profile.php" class="link-light">
            <li>
                <span><i class="fa-solid fa-user-tie"></i></span>
                <span>Profile</span>
            </li>
        </a>
        <a href="../auth/routes/logout.php">
            <button type="submit" class="btn btn-danger mt-3">
                <span><i class="fa-solid fa-right-from-bracket"></i></span>Déconnexion
            </button>
        </a>
    </ul>
</div>
<!-- Back to Top -->
<button class="back-to-top" onclick="scrollToTop()"><i class="fas fa-chevron-up"></i></button>
<script>
    // Back to top functionality
window.addEventListener('scroll', () => {
  const backToTop = document.querySelector('.back-to-top');
  backToTop.classList.toggle('show', window.scrollY > 300);
});

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>