<?php

if (isset($_SESSION['user']))
    $user = unserialize(serialize($_SESSION['user']));

?>

<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
    <div class="container">
        <a class="navbar-brand  text-white " href="/"
           rel="tooltip" title="Designed and Coded by Khalil Abid" data-placement="bottom">
            Khalil Abid, le développeur qu'il vous faut
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
        </button>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
            <ul class="navbar-nav navbar-nav-hover ms-auto">
                <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                       id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                        Pages
                        <img src="assets/img/down-arrow-white.svg" alt="down-arrow"
                             class="arrow ms-2 d-lg-block d-none">
                        <img src="assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3"
                         aria-labelledby="dropdownMenuPages8">
                        <div class="d-none d-lg-block">
                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                Liste des pages
                            </h6>
                            <a href="posts" class="dropdown-item border-radius-md">
                                <span>Nos posts</span>
                            </a>
                            <a href="index.php#contact-form" class="dropdown-item border-radius-md">
                                <span>Contactez Nous </span>
                            </a>
                            <a href="../assets/cv.pdf" class="dropdown-item border-radius-md">
                                <span>Mon CV</span>
                            </a>
                        </div>

                    </div>
                </li>

                <?php
                if (isset ($user) && $user->role == 'admin') { ?>


                    <li class="nav-item ms-lg-auto">
                        <a class="nav-link nav-link-icon me-2" href="dashboard">
                            <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip"
                               data-bs-placement="bottom">Dashboard</p>
                        </a>
                    </li>
                    <?php
                }
                ?>


                <li class="nav-item ms-lg-auto">
                    <a class="nav-link nav-link-icon me-2" href="https://www.linkedin.com/in/khalil-abid-2b12091b/"
                       target="_blank">
                        <i class="fa fa-linkedin me-1"></i>
                        <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip"
                           data-bs-placement="bottom" title="Visiter mon Linkedin">Linked in</p>
                    </a>
                </li>
                <li class="nav-item ms-lg-auto">
                    <a class="nav-link nav-link-icon me-2" href="https://github.com/khalil91" target="_blank">
                        <i class="fa fa-github me-1"></i>
                        <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip"
                           data-bs-placement="bottom" title="Visiter mon Github">Github</p>
                    </a>
                </li>
                <li class="nav-item my-auto ms-3 ms-lg-0">
                    <?php
                    if (isset($user) && $user->nom != "")
                        echo '<a href="logout" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0">Déconnexion</a>';
                    else
                        echo '<a href="sign-in" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0">Connexion</a>';
                    ?>


                </li>
            </ul>
        </div>
    </div>
</nav>