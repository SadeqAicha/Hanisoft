<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hanisoft</title>
  <meta name="description" content="Hanisoft - Solutions informatiques professionnelles : réseaux, sécurité, développement web et sauvegarde.">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <!--Start navbar-->
    <?php include("include/header.php") ?>
    <!--End navbar-->
  <!-- Hero Section -->
  <section id="home" class="hero">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-8 hero-content">
                  <h1>Bienvenue chez Hanisoft</h1>
                  <p>Votre partenaire de confiance pour tous vos besoins informatiques. Nous offrons des solutions innovantes et personnalisées pour faire évoluer votre entreprise.</p>
                  <button class="btn btn-primary-custom" onclick="scrollToServices()">
                      <i class="fas fa-arrow-right"></i> Découvrir nos services
                  </button>
              </div>
          </div>
      </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="services-section">
      <div class="container">
          <h2 class="section-title">Nos Services</h2>
          <div class="row">
              <div class="col-lg-6 col-md-6 mb-4">
                  <div class="service-card">
                      <div class="service-icon">
                          <i class="fas fa-network-wired"></i>
                      </div>
                      <h3>Service Technique & Réseaux</h3>
                      <p>Installation, configuration et maintenance de vos infrastructures réseau. Nous assurons la connectivité optimale de votre entreprise avec des solutions techniques adaptées à vos besoins.</p>
                      <ul class="list-unstyled mt-3">
                          <li><i class="fas fa-check text-success me-2"></i>Vente, installation et maintenance du <strong>matériel informatique</strong>.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Administration des systèmes et <strong>réseaux</strong> d'entreprise.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Support technique et assistance aux utilisateurs</li>
                          <li><i class="fas fa-check text-success me-2"></i>Optimisation des <strong>infrastructures</strong> pour une meilleure performance</li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-4">
                  <div class="service-card">
                      <div class="service-icon">
                          <i class="fas fa-shield-alt"></i>
                      </div>
                      <h3>Service Sécurité</h3>
                      <p>Protégez vos données et systèmes avec nos solutions de sécurité avancées. Audit, mise en place de pare-feu, et surveillance continue pour une sécurité maximale.</p>
                      <ul class="list-unstyled mt-3">
                          <li><i class="fas fa-check text-success me-2"></i><strong>Firewall</strong>, <strong>Antivirus</strong>, Filtrage web.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Systèmes de <strong>vidéosurveillance</strong> et contrôle d'accès.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Solutions <strong>VPN</strong> pour un accès distant sécurisé et confidentiel.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Protection proactive contre les cybermenaces et les intrusions.</li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-4">
                  <div class="service-card">
                      <div class="service-icon">
                          <i class="fas fa-code"></i>
                      </div>
                      <h3>Service Développement Web</h3>
                      <p>Création de sites web modernes et applications sur mesure. De la conception à la mise en ligne, nous développons des solutions web performantes et attractives.</p>
                      <ul class="list-unstyled mt-3">
                          <li><i class="fas fa-check text-success me-2"></i>Conception et développement de sites vitrines et e-commerce.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Applications web personnalisées selon les besoins métiers.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Intégration de solutions Cloud et d'outils collaboratifs</li>
                          <li><i class="fas fa-check text-success me-2"></i>Maintenance, mises à jour et optimisation des performances web</li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-4">
                  <div class="service-card">
                      <div class="service-icon">
                          <i class="fas fa-cloud-upload-alt"></i>
                      </div>
                      <h3>Service Sauvegarde</h3>
                      <p>Solutions de sauvegarde automatisées et sécurisées pour protéger vos données critiques. Récupération rapide et stockage cloud pour une tranquillité d'esprit totale.</p>
                      <ul class="list-unstyled mt-3">
                          <li><i class="fas fa-check text-success me-2"></i>Solutions de sauvegarde locales (<strong>NAS</strong>) hautement fiables.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Stockage et sauvegarde dans le <strong>Cloud</strong> avec accès sécurisé.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Plan de reprise après sinistre (PRA) et continuité d'activité.</li>
                          <li><i class="fas fa-check text-success me-2"></i>Restauration rapide des données en cas de perte..</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Stats -->
  <section class="stats-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-3 col-6 stat-item">
          <div class="stat-number" data-target="50" data-plus>0</div>
          <div class="stat-label">Clients satisfaits</div>
        </div>
        <div class="col-lg-3 col-6 stat-item">
          <div class="stat-number" data-target="100" data-plus>0</div>
          <div class="stat-label">Projets réalisés</div>
        </div>
        <div class="col-lg-3 col-6 stat-item">
          <div class="stat-number" data-target="24">0</div>
          <div class="stat-label">Support/7</div>
        </div>
        <div class="col-lg-3 col-6 stat-item">
          <div class="stat-number" data-target="4" data-plus>0</div>
          <div class="stat-label">Années d'expérience</div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-section">
      <div class="container">
          <h2 class="section-title">À Propos de HANISOFT</h2>
          <div class="row align-items-center">
              <div class="col-lg-6">
                  <p class="lead">Hanisoft est une entreprise spécialisée dans les solutions informatiques pour les petites et moyennes entreprises. Nous offrons une gamme complète de services pour accompagner votre croissance digitale.</p>
                  <p>Notre équipe d'experts techniques met son savoir-faire au service de votre réussite. Nous nous engageons à fournir des solutions innovantes, fiables et adaptées à vos besoins spécifiques.</p>
                  <div class="row mt-4">
                      <div class="col-6">
                          <h5><i class="fas fa-check-circle text-success me-2"></i>Expertise</h5>
                          <p>Solutions techniques avancées</p>
                      </div>
                      <div class="col-6">
                          <h5><i class="fas fa-check-circle text-success me-2"></i>Fiabilité</h5>
                          <p>Service client de qualité</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="text-center">
                      <img src="images/logo.png" style="width: 60%;" alt="Logo Hanisoft">
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact">
      <div class="container">
          <div class="row">
              <div class="col-12 text-center mb-5">
                  <h2>Contactez-nous</h2>
              </div>
          </div>
          
          <div class="row">
              <div class="col-lg-8 mx-auto">
                  <div class="contact-form">
                      <form id="contactForm">
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <input type="text" class="form-control" id="contact_name" placeholder="Nom" required>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <input type="email" class="form-control" id="contact_email" placeholder="Email" required>
                              </div>
                          </div>
                          <div class="mb-3">
                              <textarea class="form-control" rows="5" id="contact_message" placeholder="Votre message" required></textarea>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary-custom">
                                  <i class="fas fa-paper-plane"></i> Envoyer le message
                              </button>
                          </div>
                          <div class="contact-info text-center row m-5">
                              <div class="col-lg-4 text-center">
                                  <h5><i class="fas fa-map-marker-alt me-2"></i>Adresse</h5>
                                  <p>N° 33, rue 208 Jorf Inezgane, Inezgane - Ait Melloul</p>
                              </div>
                              <div class="col-lg-4 text-center">
                                  <h5><i class="fas fa-phone me-2"></i>Téléphone</h5>
                                  <p>+212 661535719</p>
                              </div>
                              <div class="col-lg-4 text-center">
                                  <h5><i class="fas fa-envelope me-2"></i>Email</h5>
                                  <p>contact@hanisoft.ma</p>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </section>

    <!--Start footer-->
    <?php include("include/footer.php") ?>
    <!--End footer-->

  <!-- Back to Top -->
  <button class="back-to-top" onclick="scrollToTop()"><i class="fas fa-chevron-up"></i></button>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/index.js"></script>
</body>
</html>
