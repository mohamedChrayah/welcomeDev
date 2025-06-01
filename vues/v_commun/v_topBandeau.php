<!-- GESTION DES COOKIES CHOIX MENU-UTILISATEUR -->
<?php if (!empty($_COOKIE["choixMenuUtilisateur"]) && $_COOKIE["choixMenuUtilisateur"] == "open") { ?>
    <div id="nav-info-utilisateur" class="main-content offset-md-2 col-md-10" style="padding: 0">
    <?php } else { ?>
        <div id="nav-info-utilisateur" class="main-content col-12" style="padding: 0">
        <?php } ?>
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom p-2">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="col">
                        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                            <li class="nav-item d-none d-md-flex">

                                <!-- GESTION DES COOKIES CHOIX MENU-UTILISATEUR -->
                                <?php if (!empty($_COOKIE["choixMenuUtilisateur"]) && $_COOKIE["choixMenuUtilisateur"] == "open") { ?>
                                    <span id="btn-menu-utilisateur" style="z-index: 0;cursor: pointer;" class="nav-link p-0 nav-open-vertical bg-gradient-default px-3 rounded-pill text-md font-weight-bold" role="button">
                                    <?php } else { ?>
                                        <span id="btn-menu-utilisateur" style="z-index: 0;cursor: pointer;" class="nav-link p-0 bg-gradient-default px-3 rounded-pill text-md font-weight-bold" role="button">
                                        <?php } ?>
                                        <div id="sidenav-icon" class="pr-3 sidenav-toggler sidenav-toggler-dark media align-items-center">
                                            <div class="sidenav-toggler-inner">
                                                <i class="sidenav-toggler-line"></i>
                                                <i class="sidenav-toggler-line"></i>
                                                <i class="sidenav-toggler-line"></i>
                                            </div>

                                            <span class="pl-2"> Menu</span>
                                        </div>
                                        </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        </div>

        <!-- VISIBLE UNIQUEMENT QUAND INFERIEUR A COL-MD -->
        <nav id="navbar-md-none" class="navbar navbar-dark sticky-top shadow bg-primary d-md-none ">
            <a class="navbar-brand col-9 mr-0" href="index.php" style="color: white">CAutomatique</a>

            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center justify-content-center col-3 ">
                <li class="nav-item">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark collapsed" data-toggle="collapse" data-action="sidenav-pin" data-target="#navbar-utilisateur" aria-controls="navbar-utilisateur" aria-expanded="false">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        
        <!-- Guirlande noel -->
        <?php
            if (date('m') == 12) {
                include 'vues\v_commun\v_christmas.php';
            }
        ?>
        <!-- Guirlande noel -->