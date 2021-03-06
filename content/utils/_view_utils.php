<?php

function get_head()
{
    echo <<<HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Modalweb</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

HEAD;

}

function get_categories_select($selected = null)
{
    $categories = CategoryModel::getCategories();
    echo '<select class="input-select" name="category">';
    foreach ($categories as $cat) {
        echo "<option value='{$cat->id}' " . ($selected == $cat->id ? "selected" : "") . "> " . htmlspecialchars($cat->nom) . "</option>";
    }
    echo '</select>';
}


function get_search()
{
    $categories = CategoryModel::getCategories();
    $category = null;
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $category = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;
    }
    echo '
    <!-- SEARCH BAR -->
    <div class="col-md-8">
        <div class="header-search">
            <form class="form-inline" method="get" action="search.php">
            <select class="input-select" name="category">
            <option value="0"' . (!$category ? "" : "selected") . '>All Categories</option>';
    foreach ($categories as $cat) {
        echo "<option value='{$cat->id}'" . ($category == $cat->id ? "selected" : "") . "> " . htmlspecialchars($cat->nom) . "</option>";
    }
    echo '
                </select>
                <input class="input" placeholder="Search here" name="search" value="' . htmlspecialchars($search) . '">
                <button class="search-btn">Search</button>
            </form>
        </div>
    </div>
    <!-- /SEARCH BAR -->';

}

function get_header()
{

    $text = "Login";
    $url = "login.php";
    $bienvenue = "";
    $logout = "";
    $signup = '<li><a href="signup.php"><i class="fa fa-plus"></i>Signup</a></li>';
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if (isLoggedIn()) {
        $bienvenue = "Welcome " . htmlspecialchars($_SESSION["user"]->nom) . " " . htmlspecialchars($_SESSION['user']->prenom);
        $text = "My Account";
        $url = "profile.php";
        $logout = '<li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>';
        $signup = '';
    }

    echo '<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-right">
                <li style="color: white;">' . $bienvenue . '</li>
                <li><a href="' . $url . '"><i class="fa fa-user-o"></i>' . $text . '</a></li>
                ' . $logout . '
                ' . $signup . '
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="index.php" class="logo">
                            <img src="./img/logo.png" height="62" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->';
    get_search();

    echo '<!-- ACCOUNT -->
                <div class="col-md-1 clearfix">
                    <div class="header-ctn">
                        <!-- Cart 
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">3</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product01.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>

                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product02.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>
                                </div>
                                <div class="cart-summary">
                                    <small>3 Item(s) selected</small>
                                    <h5>SUBTOTAL: $2940.00</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="#">View Cart</a>
                                    <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                         /Cart -->
';

    if (isLoggedIn()) {
        echo '<div class="dropdown">
                            <a href="create_annonce.php">
                                <i class="fa fa-plus"></i>
                                <span>Add annonce</span>
                            </a>';
    } else echo '<div class="dropdown">';
    echo '
                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->';
}

function get_profile_navigation($tab = 0)
{
    $adminTab = '';
    if (isAdmin()) {
        $adminTab = '<li ' . ($tab == 3 ? 'class="active"' : '') . ' ><a href="users.php" style="color: red">Users</a></li>';
        $adminTab = $adminTab . '<li ' . ($tab == 4 ? 'class="active"' : '') . ' ><a href="categories.php" style="color: red">Categories</a></li>';
    }
    echo '
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li ' . ($tab == 0 ? 'class="active"' : '') . ' ><a href="profile.php">Personal</a></li>
                <li ' . ($tab == 1 ? 'class="active"' : '') . ' ><a href="mdp.php">Mot de Passe</a></li>
                <li ' . ($tab == 2 ? 'class="active"' : '') . ' ><a href="mes_annonces.php">Mes annonces</a></li>
                ' . $adminTab . '
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
';
}

function get_navigation($tab = -1)
{
    $categories = CategoryModel::getCategories();
    $categoriesNav = '';
    foreach ($categories as $category) {
        $categoriesNav = $categoriesNav . "<li " . ($tab == $category->id ? 'class="active"' : '') . "><a href='search.php?category=" . $category->id . "'>" . htmlspecialchars($category->nom) . "</a></li>";
    }
    echo '
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li ' . ($tab == 0 ? 'class="active"' : '') . ' ><a href="index.php">Home</a></li>
                ' . $categoriesNav . '
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
';

}


function get_annonce($annonce = null)
{
    $title = htmlspecialchars($annonce->title);
    $category = htmlspecialchars($annonce->category->nom);
    $description = htmlspecialchars($annonce->description);
    $price = htmlspecialchars($annonce->price);
    $photo = htmlspecialchars($annonce->photo);
    echo '
<div class="product">
<div class="product-img">
                                        <img src="./img/annonces/' . $photo . '" alt="">
                                        <div class="product-label">
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">' . $category . '</p>
                                        <h3 class="product-name"><a href="#">' . $title . '</a></h3>
                                        <h4 class="product-price">??? ' . $price . '
                                        <h5>' . $description . '</h5>
                                        
                                        </h4>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="details.php?id=' . $annonce->id . '"><button class="add-to-cart-btn"><i class="fa fa-info-circle"></i> Details
                                        </button></a>
                                    </div>
                                </div>
                                <!-- /product -->';
}

function get_annonce_details($annonce)
{
    $editButton = '';
    $deleteButton = '';

    if (checkAuthorization($annonce->user_email)) {
        $editButton = '<a href="edit_annonce.php?id=' . $annonce->id . '"><button class="add-to-cart-btn" ><i class="fa fa-edit"></i> Edit</button></a>';
        $deleteButton = '<a href="delete_annonce.php?id=' . $annonce->id . '"><button class="add-to-cart-btn"><i class="fa fa-trash"></i> Supprimer</button></a>';
    }
    echo '
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="./img/annonces/' . htmlspecialchars($annonce->photo) . '" alt="">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="./img/annonces/' . htmlspecialchars($annonce->photo) . '" alt="">
                    </div>

                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">' . htmlspecialchars($annonce->title) . '</h2>

                    <div>
                        <h3 class="product-price">??? ' . htmlspecialchars($annonce->price) . '</h3>
                    </div>
                    <p>' . nl2br(htmlspecialchars($annonce->description)) . '</p>
                    <p>Quantit?? : ' . htmlspecialchars($annonce->quantity) . '</p>
                    <p><b>O?? r??cup??rer l\'objet : ' . htmlspecialchars($annonce->place) . '</b></p>
                    <p><b>Annonced by: ' . htmlspecialchars($annonce->user->nom) . " " . htmlspecialchars($annonce->user->prenom) . '</b></p>
                    <p><b>Contact: ' . htmlspecialchars($annonce->user->phone) . '</b></p>
                    
                    
                    <div class="add-to-cart">
                    ' . $editButton . '
                    ' . $deleteButton . '
                    </div>
                </div>
            </div>
            <!-- /Product details -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
';
}


function list_products($annonces = null)
{
    echo '
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Annonces</h3>
                    <div class="section-nav">
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                ';
    if (!$annonces) {
        echo 'Aucune annonce trouv??e';
    } else {
        foreach ($annonces as $annonce) {
            get_annonce($annonce);
        }
    }
    echo '
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>';

}

function get_breadcrumb($annonce)
{
    $category = $annonce->category;
    echo '
        <!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">All Categories</a></li>
                    <li><a href="index.php?category=' . $category->id . '">' . htmlspecialchars($category->nom) . '</a></li>
                    <li class="active">' . htmlspecialchars($annonce->title) . '</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->';

}

function get_footer()
{
    echo <<<FOOTER

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-offset-5 col-xs-3">
                    <div class="footer">
                        <h3 class="footer-title">Modalweb</h3>
                        <p>Modalweb is a website for students.</p>
                    </div>
                </div>


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                    target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
FOOTER;

}

?>