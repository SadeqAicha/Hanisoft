<?php include("include/is-admin.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hanisoft dashboard - Tous les articles</title>
    <!--For icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Start Content -->
     <div class="content text-white">
        <div class="container-fluid">
            <div class="row">
                <!-- Start Side area -->
                <?php include("include/dashboard-side-area.php") ?>
                <!-- End Side area -->
                <!-- Start all posts table -->
                <div class="col-md-10" class="main-area">
                    <h1 class="section-title"><i class="fa-solid fa-grip"></i> Tous les articles</h1>
                    <div class="search-box">
                        <input onkeyup="searchArticles()" type="text" id="searchInput" placeholder="Rechercher un article...">
                        <button onclick="searchArticles()" class="search-btn" onclick="searchArticles()">Recherche</button>
                    </div>
                    <table class="table  table-dark">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Categorie</th>
                                <th>Date</th>
                                <th>Mise à jour</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody id="table_content"></tbody>
                    </table>
                </div>
                <!-- End all posts table -->
            </div>
        </div>
    </div>
    <!-- Start Update window -->
    <div class="dark_membrane" id="dark_membrane"></div>
    <div id="articleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Mettre à jour</h2>
                <button class="close-btn" id="close-btn" onclick="closeModal()">X</button>
            </div>
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" id="articleTitle" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Categorie</label>
                    <select id="articleCategory" class="form-select" required>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post-img" class="form-label">Image</label>
                    <input type="file" name="post-img" id="post_image" class="form-control bg-dark text-light">  
                </div>
                <div class="form-group">
                    <label for="post-text" class="form-label">Contenu</label>
                    <textarea name="post-text" id="post_content" class="form-control bg-dark text-light"></textarea> 
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="update_btn">Enregistrer</button>
                </div>
        </div>
    </div>   
    <!-- End Content -->
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/all-posts.js"></script>
</body>
</html>