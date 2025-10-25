<?php include("include/is-admin.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hanisoft dashboard - Nouveau article</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <!--For icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Start Content -->
     <div class="content text-white">
        <div class="container-fluid">
            <div class="row">
                <!-- Start Side area -->
                <?php include("include/dashboard-side-area.php") ?>
                <!-- End Side area -->
                <!-- Start New post -->
                <div class="col-md-10" class="main-area">
                    <p id="error-sentence"></p>
                    <h1 class="section-title"><i class="fa-solid fa-pen-to-square"></i> Nouveau article</h1>
                    <div class="new-post">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="post-title" class="form-control bg-dark text-light">  
                        </div>
                        <div class="form-group">
                            <label for="category">Categorie</label>
                            <select name="post-category" id="category" class="form-control bg-dark text-light">
                            </select>  
                        </div>
                        <div class="form-group">
                            <label for="post-img">Image</label>
                            <input type="file" name="post-img" id="post-img" class="form-control bg-dark text-light">  
                        </div>
                        <div class="form-group">
                            <label for="post-text">Contenu</label>
                            <textarea name="post-text" id="post-text" class="form-control bg-dark text-light"></textarea> 
                        </div>
                        <button id='submit_btn' name='submit_btn' class="btn-custom form-control">Publier</button>
                    </div>

                </div>
                <!-- End New post -->
            </div>
        </div>
    </div>
    <!-- End Content -->
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/new-post.js"></script>
</body>
</html>