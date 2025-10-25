<?php include("include/is-admin.php") ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanisoft dashboard - Boîte de messages</title>
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
    <!-- Start messages -->
    <div class="col-md-10 messages" class="main-area">
        <h1 class="section-title"><i class="fa-solid fa-message"></i> Boîte de messages</h1>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-number" id="totalMessages">0</div>
                <div class="stat-label">Total messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="unreadMessages">0</div>
                <div class="stat-label">Non lus</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="todayMessages">0</div>
                <div class="stat-label">Aujourd'hui</div>
            </div>
        </div>

        <div class="controls">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="unread">Non lus</button>
                <button class="filter-btn" data-filter="read">Lus</button>
            </div>
            <button class="mark-all-read" onclick="markAllAsRead()">
                ✓ Marquer tout comme lu
            </button>
        </div>

        <div class="messages-grid" id="messagesContainer">
            <!-- Les messages apparaîtront ici -->
        </div>

        <div class="empty-state" id="emptyState" style="display: none;">
            <h3><i class="fa-solid fa-envelope"></i> Aucun message</h3>
            <p>Votre boîte de messages est vide.</p>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/messages.js"></script>
</body>
</html>