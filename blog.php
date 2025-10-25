<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hanisoft - blog</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/blog.css">
    <!--For icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--Start navbar-->
    <?php include("include/header.php") ?>
    <!--End navbar-->

    <!--Start Content-->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="search-bar">
                    <input onkeyup="searchArticles()" type="text" placeholder="Rechercher un article..." id="searchInput">
                    <button onclick="searchArticles()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="col-md-8" id=posts_container></div>
                <div class="col-md-4">
                    <!--Start Categories -->
                    <div class="categories">
                        <h4>Catégories</h4>
                        <ul id="categories"></ul>
                    </div>
                    <!--End Categories -->
                    <!--Start Latest posts -->

                    <div class="last-posts">
                        <h4>Derniers articles</h4>
                        <ul id="last-posts"></ul>
                    </div>

                    <!--End Latest posts -->
                </div>
            </div>
        </div>
    </div>
    <!--End Content-->

    <!--Start footer-->
    <?php include("include/footer.php") ?>
    <!--End footer-->
    <!-- Back to Top -->
    <button class="back-to-top" onclick="scrollToTop()"><i class="fas fa-chevron-up"></i></button>
    <script src="js/blog.js"></script>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>