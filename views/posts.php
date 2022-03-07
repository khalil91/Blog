<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Blog Khalil Abid
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-kit.css?v=3.0.0" rel="stylesheet"/>
</head>

<body class="blog-author bg-gray-200">
<!-- Navbar Transparent -->
<?php include "nav.php" ?>
<!-- End Navbar -->
<!-- -------- START HEADER 4 w/ search book a ticket form ------- -->
<header>
    <div class="page-header min-height-400" style="background-image: url('../assets/img/fond.jpg');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-8"></span>
    </div>
</header>
<!-- -------- END HEADER 4 w/ search book a ticket form ------- -->

</section>
<!-- END Testimonials w/ user image & text & info -->
<!-- START Blogs w/ 4 cards w/ image & text & link -->
<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-5">Nos derniers Posts</h3>
            </div>
        </div>
        <div class="row">

            <?php
            foreach ($posts as $post) { ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-plain">
                        <div class="card-header p-0 position-relative">
                            <a class="d-block blur-shadow-image">
                                <img src="assets/img/<?php echo $post->image ?>" alt="img-blur-shadow"
                                     class="img-fluid shadow border-radius-lg" loading="lazy">
                            </a>
                        </div>
                        <div class="card-body px-0">
                            <h5>
                                <a href="javascript:" class="text-dark font-weight-bold"><?php echo $post->titre ?></a>
                            </h5>
                            <p>
                                <?php echo $post->description ?>
                            </p>
                            <p>
                                <?php echo date("d/m/Y", strtotime($post->date_creation)); ?>
                            </p>
                            <a href="post-<?php echo $post->id_post ?>"
                               class="text-info text-sm icon-move-right">lire l'article
                                <i class="fas fa-arrow-right text-xs ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>


                <?php
            }
            ?>


        </div>
    </div>
</section>
<!-- END Blogs w/ 4 cards w/ image & text & link -->
</div>

<!-- -------- START FOOTER 5 w/ DARK BACKGROUND ------- -->
<footer class="footer py-5">
    <div class="container z-index-1 position-relative">
        <div class="row">
            <div class="col-lg-4 me-auto mb-lg-0 mb-4 text-lg-start text-center">
                <h6 class="text-dark font-weight-bolder text-uppercase mb-lg-4 mb-3">kHALIL ABID </h6>
                <ul class="nav flex-row ms-n3 justify-content-lg-start justify-content-center mb-4 mt-sm-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark opacity-8" href="https://www.creative-tim.com" target="_blank">
                            Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark opacity-8" href="https://www.creative-tim.com/presentation"
                           target="_blank">
                            nous
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark opacity-8" href="https://www.creative-tim.com/blog"
                           target="_blank">
                            Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark opacity-8" href="https://www.creative-tim.com" target="_blank">
                            contact
                        </a>
                    </li>
                </ul>
                <p class="text-sm text-dark opacity-8 mb-0">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    khalil Abid 2022.
                </p>
            </div>
            <div class="col-lg-6 ms-auto text-lg-end text-center">
                <p class="mb-5 text-lg text-dark font-weight-bold">
                    Pour plus d'informations, contactez nous!
                </p>
                <a href="javascript:" target="_blank" class="text-dark me-xl-4 me-4 opacity-5">
                    <span class="fab fa-dribbble"></span>
                </a>
                <a href="javascript:" target="_blank" class="text-dark me-xl-4 me-4 opacity-5">
                    <span class="fab fa-twitter"></span>
                </a>
                <a href="javascript:" target="_blank" class="text-dark me-xl-4 me-4 opacity-5">
                    <span class="fab fa-pinterest"></span>
                </a>
                <a href="javascript:" target="_blank" class="text-dark opacity-5">
                    <span class="fab fa-github"></span>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- -------- END FOOTER 5 w/ DARK BACKGROUND ------- -->
<!--   Core JS Files   -->
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="assets/js/plugins/parallax.min.js"></script>
<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="assets/js/material-kit.min.js?v=3.0.0" type="text/javascript"></script>
</body>

</html>