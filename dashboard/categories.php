<?php include("include/is-admin.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hanisoft dashboard - Catégories</title>
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
                
                <div class="col-md-10" class="main-area">
                    <h1 class="section-title"><i class="fa-solid fa-tags"></i> Catégories</h1>
                    <!-- Start Add category -->
                    <div class="add-category">
                        <p id="error-sentence"></p>
                        <div class="form-group">
                            <label for="category">Nouvelle catégorie</label>
                            <input type="text" name="category" id="category" class="form-control">  
                        </div>
                        <button class="btn-custom form-control" id="submit_btn">Ajouter</button>
                    </div>
                    <!-- End Add category -->
                    <!--Start Display Categories -->
                    <table class="table  table-dark">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody id="table_content"></tbody>
                    </table>
                    <!--End Display Categories -->
                </div>
            </div>
        </div>
     </div>
    <!-- End Content -->

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/new-category.js"></script>
</body>
</html>