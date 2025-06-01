<style>
    .styleHover:hover{
        background-color: #d8dcdf;
    }
</style>


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


<!-- GESTION DES COOKIES CHOIX MENU-UTILISATEUR -->
<?php if (!empty($_COOKIE["choixMenuUtilisateur"]) && $_COOKIE["choixMenuUtilisateur"] == "open") { ?>
    <span class="btn-expand-collapse-middle d-none rounded-circle bg-default text-white"><i class="fas fa-angle-double-right ml-2"></i></span>

    <nav id="navbar-utilisateur" style="z-index: 1;" class="navbar navbar-vertical fixed-left navbar-expand-xs navbar-collapse navbar-light bg-white col-12 col-md-2 w-100 sidebar collapse d-md-flex border-0">
<?php } else { ?>
    <span class="btn-expand-collapse-middle rounded-circle bg-default text-white"><i class="fas fa-angle-double-right ml-2"></i></span>

    <nav id="navbar-utilisateur" style="z-index: 1;" class="navbar navbar-vertical fixed-left navbar-expand-xs navbar-collapse navbar-light bg-white col-12 col-md-2 w-0 sidebar collapse d-md-flex border-0">
<?php } ?>

    <div id="bandeauNavigation" class="scrollbar-inner col-12">
        <div class="sidenav-header align-items-center mt-md-0" style="margin-top: 65px">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logos/Credit_Agricole.png" style="max-height: 8rem; margin-top:10px;" alt=""/>
            </a>
        </div>

        <hr style="margin-top: 75px;">

        <div class="navbar-inner" style="margin-top: -30px; padding-bottom: 50px;">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <a class="nav-link" href="index.php?action=demandeAffichage" style="font-size: 17px; padding-left: 16px; font-weight: 400; color: #212529;">
                    <span class="nav-link-text">Liste des Contacts</span>
                </a>
            </div>
        </div>

    </div>

    <span class="btn-expand-collapse bg-default text-white"><i class="fas fa-angle-double-left"></i></span>

</nav>


<script>
    $('.dropdown-submenu > a').on("click", function(e) {
        var submenu = $(this);
        $('.dropdown-submenu .dropdown-menu').removeClass('show');
        submenu.next('.dropdown-menu').addClass('show');
        e.stopPropagation();
    });
</script>

<!-- GESTION DES COOKIES CHOIX MENU-UTILISATEUR -->
<?php if (!empty($_COOKIE["choixMenuUtilisateur"]) && $_COOKIE["choixMenuUtilisateur"] == "open") { ?>
    <div class="main-content offset-md-2 col-md-10 row justify-content-center mt-3" id="panel-vue">
<?php } else { ?>
    <div class="main-content col-12 row justify-content-center mt-3" id="panel-vue">
<?php } ?>
