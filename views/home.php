<?php
if (isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "oukhalil@hotmail.com";
    $email_subject = "Message reçu!";

    function died($error)
    {
        // your error code can go here
        echo
            "Nous sommes désolés, mais des erreurs ont été détectées dans le" .
            " formulaire que vous avez envoyé. ";
        echo "Ces erreurs apparaissent ci-dessous.<br /><br />";
        echo $error . "<br /><br />";
        echo "Merci de corriger ces erreurs.<br /><br />";
        die();
    }


    // si la validation des données attendues existe
    if (!isset($_POST['nom']) ||
        !isset($_POST['prenom']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died(
            'Nous sommes désolés, mais le formulaire que vous avez soumis semble poser' .
            ' problème.');
    }


    $nom = $_POST['nom']; // required
    $prenom = $_POST['prenom']; // required
    $email = $_POST['email']; // required
    //$telephone = $_POST['telephone']; // not required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .=
            'L\'adresse e-mail que vous avez entrée ne semble pas être valide.<br />';
    }

    // Prend les caractères alphanumériques + le point et le tiret 6
    $string_exp = "/^[A-Za-z0-9 .'-]+$/";

    if (!preg_match($string_exp, $nom)) {
        $error_message .=
            'Le nom que vous avez entré ne semble pas être valide.<br />';
    }

    if (!preg_match($string_exp, $prenom)) {
        $error_message .=
            'Le prénom que vous avez entré ne semble pas être valide.<br />';
    }

    if (strlen($message) < 2) {
        $error_message .=
            'Le message que vous avez entré ne semble pas être valide.<br />';
    }

    if (strlen($error_message) == 0) {

        $email_message = "Bonjour,\n\n Vous avez reçu un mail de la part de : \n\n";
        $email_message .= "Nom: " . $nom . "\n";
        $email_message .= "Prenom: " . $prenom . "\n";
        $email_message .= "Email: " . $email . "\n";
        $email_message .= "Message: " . $message . "\n";

        // create email headers
        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($email_to, $email_subject, $email_message, $headers);
        $mailSent = true;
    }
}
?>
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
<?php include_once "nav.php" ?>
<!-- End Navbar -->
<!-- -------- START HEADER 4 w/ search book a ticket form ------- -->
<header>
    <div class="page-header min-height-400" style="background-image: url('assets/img/fond.jpg');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-8"></span>
    </div>
</header>
<!-- -------- END HEADER 4 w/ search book a ticket form ------- -->
<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
    <!-- START Testimonials w/ user image & text & info -->
    <section class="py-sm-7 py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="mt-n8 mt-md-n9 text-center">
                        <img class="avatar avatar-xxl shadow-xl position-relative z-index-2"
                             src="assets/img/khalilsmall.jpg" alt="bruce" loading="lazy">
                    </div>
                    <div class="row py-5">
                        <div class="col-lg-7 col-md-7 z-index-2 position-relative px-md-2 px-sm-5 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="mb-0">Khalil Abid</h3>
                                <div class="d-block">
                                    <button type="button" class="btn btn-sm btn-outline-info text-nowrap mb-0">Suivre
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-auto">
                                    <span class="h6">323</span>
                                    <span>Posts</span>
                                </div>
                                <div class="col-auto">
                                    <span class="h6">3.5k</span>
                                    <span>Followers</span>
                                </div>
                                <div class="col-auto">
                                    <span class="h6">260</span>
                                    <span>Following</span>
                                </div>
                            </div>
                            <p class="text-lg mb-0">
                                Je suis étudiant à OpenClassrooms et diplômé bac+3 Licence en Informatique Industielle .
                                J'adore le métier de développeur car c'eqst à la fois enrichissant et source de
                                satisfaction.


                                Quelques technos:
                                -Langages web (PHP, WordPress, SQL, CSS, HTML) <br><a href="javascript:"
                                                                                      class="text-info icon-move-right">Plus
                                    d'info
                                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <a href="javascript:"
                                       class="text-dark font-weight-bold"><?php echo $post->titre ?></a>
                                </h5>
                                <p>
                                    <?php echo $post->description ?>
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
<section class="py-lg-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card box-shadow-xl overflow-hidden mb-5">
                    <div class="row">
                        <div class="col-lg-5 position-relative bg-cover px-0"
                             style="background-image: url('assets/img/fond.jpg')" loading="lazy">
                            <div class="z-index-2 text-center d-flex h-100 w-100 d-flex m-auto justify-content-center">
                                <div class="mask bg-gradient-dark opacity-8"></div>
                                <div class="p-5 ps-sm-8 position-relative text-start my-auto z-index-2">
                                    <h3 class="text-white">CONTACT</h3>
                                    <p class="text-white opacity-8 mb-4">Contactez moi directement .</p>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-phone text-sm"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8">(+337) 68  35  03  91</span>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-envelope text-sm"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8">contact@abid.com</span>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-map-marker-alt text-sm"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8">Rue Gutenberg, CHOISY LE ROI 94600</span>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Log in with Facebook">
                                            <i class="fab fa-facebook"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Log in with Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Log in with Dribbble">
                                            <i class="fab fa-dribbble"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Log in with Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form class="p-3" id="contact-form" method="POST" action="#contact-form">
                                <div class="card-header px-4 py-sm-5 py-3">
                                    <h2>Bonjour!</h2>
                                    <p class="lead"> Nous voulons discuter.</p>
                                </div>

                                <?php
                                if (isset($error_message) && strlen($error_message) > 0) { ?>
                                    <div class="alert alert-danger text-white">
                                        <?php echo($error_message); ?>
                                    </div>
                                <?php } ?>

                                <?php
                                if (isset($mailSent) && $mailSent) { ?>
                                    <div class="alert alert-success text-white">
                                        Merci de nous avoir contacter. Nous vous contacterons très bientôt.
                                    </div>
                                <?php } ?>
                                <div class="card-body pt-1">
                                    <div class="row">
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Mon Nom</label>
                                                <input type="text" name="nom" class="form-control"
                                                       placeholder="Votre Nom">
                                            </div>

                                            <div class="input-group input-group-static mb-4">
                                                <label>Mon Prénom</label>
                                                <input type="text" name="prenom" class="form-control"
                                                       placeholder="Votre Prénom">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                       placeholder="votre email">

                                            </div>
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="input-group input-group-static mb-4">


                                                <label>Votre message</label>
                                                <textarea name="message" class="form-control" id="message" rows="6"
                                                          placeholder="Je veux..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-end ms-auto">
                                            <button type="submit" class="btn bg-gradient-info mb-0">Envoyer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
