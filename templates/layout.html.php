<?php include "styles/styleCheck.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/normalize.min.css">
    <link rel="stylesheet" href="styles/myStyle.css">
    <?php if (isset($_COOKIE["siteStyle"])):?>
    <link rel="stylesheet" href="styles/background-colour/<?=$styleFile?>">
    <?php endif ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
    <script defer src="https://kit.fontawesome.com/b80a63e755.js" crossorigin="anonymous"></script>
    <title><?=$title?></title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>


<body>
        <div class="top-banner">
            <div class="top-banner__main">
                <div class="top-nav__menu">
                    <i class="fa-solid fa-bars" id="mobile-menu-hamburger"></i><span id="mobile-menu-menu">Menu</span>
                    <div class="mobile mobile-menu-expanded-container" id="mobile-expanded-menu">
                        <ul class="mobile-menu">
                            <li class="mobile-menu-login"><a href=""><i class="fa-solid fa-lock mobile-fa-lock"></i>
                            <span>
                                <?php if (isset($_SESSION["username"])):?>
                                <?=$_SESSION["username"]?><a class="top-account__logout" href="logout.php">[logout]</a>
                                <?php else: ?>
                                Login
                                <?php endif ?>
                            </span></a></li>
                            <li class="mobile-menu-items"><a href="index.php">Home</a></li>
                            <li class="mobile-menu-items"><a href="">About SW</a></li>
                            <li class="mobile-menu-items"><a href="contact.php">Contact Us</a></li>
                            <li class="mobile-menu-items"><a href="viewProducts.php">View Products</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="top-banner__main__left top-nav">
                    <li class="top-nav__item"><a href="index.php">Home</a></li>
                    <li class="top-nav__item"><a href="#">About SW</a></li>
                    <li class="top-nav__item"><a href="contact.php">Contact Us</a></li>
                    <li class="top-nav__item"><a href="viewProducts.php">View Products</a></li>
                </ul>
                <div class="top-banner__main__right top-account">
                    <div class="top-account__login"><a href="login.php"><i class="fa-solid fa-lock"></i>
                    <span>
                        <?php if (isset($_SESSION["username"])):?>
                        <?=$_SESSION["username"]?><a class="top-account__logout" href="logout.php">[logout]</a>
                        <?php else: ?>
                        Login
                        <?php endif ?>
                    </span></a></div>
                    <div class="top-account__cart">
                        <a href="viewCart.php" class="top-account__cart__view-cart">
                            <i class="fa-solid fa-cart-shopping"></i><span>View Cart</span>
                        </a>
                        <a href="viewCart.php" class="top-account__cart__item"><?=$cartItemQty?><?php if ($cartItemQty<2):?> item<?php else:?> items<?php endif ?></a>
                    </div>
                </div>
            </div>
        </div>
    <div class="body-wrapper">
        <div class="logo-row">
            <h1><a href="index.php" class="main-logo"><img src="images/sports-warehouse-logo-600.png" alt="SW Sports Warehouse"></a></h1>        
            <form class="logo-row__search" action="searchItem.php" method="GET">
                <input type="text" id="desktop-search-product" class="search-product" name="search-product" placeholder="Search products" required>
                <button type="submit" class="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <nav class="nav-container">
            <ul class="nav-list">
                <?php foreach ($categoryRows as $row):?>
                <li class="nav-list__item"><a id="<?php if (isset($_GET["cateId"]) and $_GET["cateId"]==$row["categoryId"]){echo "cateSelected";}?>" href="itemsByCategory.php?cateId=<?=$row["categoryId"]?>"><?=$row["categoryName"]?></a></li>
                <?php endforeach?>
            </ul>
        </nav>    

        <?=$output?>
    </div>
<footer class="botton-banner">
    <div class="footer-wrap">
        <div class="footer__nav-wrap">
            <div class="footer__nav__content">
                <h3 class="footer__title">Site navigation</h3>
                <ul class="footer-list">
                    <li class="footer-list-items footer-nav-item"><a href="index.php">Home</a></li>
                    <li class="footer-list-items footer-nav-item"><a href="#">About SW</a></li>
                    <li class="footer-list-items footer-nav-item"><a href="contact.php">Contact Us</a></li>
                    <li class="footer-list-items footer-nav-item"><a href="viewProducts.php">View Products</a></li>
                    <li class="footer-list-items footer-nav-item"><a href="privacyPolicy.php">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__cate-wrap">
            <div class="footer__cate__content">
                <h3 class="footer__title">Product categories</h3>
                <ul class="footer-list">
                    <?php foreach ($categoryRows as $row):?>
                    <li class="footer-list-items footer-cate-item"><a href="itemsByCategory.php?cateId=<?=$row["categoryId"]?>"><?=$row["categoryName"]?></a></li>
                    <?php endforeach?>
                </ul>
            </div>
        </div>
        <div class="footer__contact-wrap">
            <div>
                <h3 class="footer__title">Contact Sports Warehouse</h3>
                <ul class="footer__contact__content">
                    <li class="footer__contact-method">
                        <a href="https://www.facebook.com/" class="footer__social-media-icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <p>Facebook</p>
                    </li>
                    <li class="footer__contact-method">
                        <a href="https://twitter.com/" class="footer__social-media-icon"><i class="fa-brands fa-twitter"></i></a>
                        <p>Twitter</p>
                    </li>
                    <li class="footer__contact-method">
                        <a href="#" class="footer__social-media-icon"><i class="fa-solid fa-paper-plane"></i></a>
                        <p>Other</p>
                        <ul class="footer__other-contact">
                            <li class="footer__other-contact-method"><a href="">Online form</a></li>
                            <li class="footer__other-contact-method"><a href="">Email</a></li>
                            <li class="footer__other-contact-method"><a href="">Phone</a></li>
                            <li class="footer__other-contact-method"><a href="">Address</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>    
<p class="footer__copyright">Ⓒ Copyright 2020 Sports Warehouse. <span>All rights reserved.</span>Website made by Awesomesauce Design.</p>

<!-- Include JQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 

<!-- Load Slick Slider through CDN -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- Initialize the slide show -->
<script defer>
    $(document).ready(function(){
        $('.slick').slick({
            dots: true,//set control thumbnails
            autoplay:true,//set autoplay
            autoplaySpeed:2000 //change slide pictures every 2 seconds
        });
    });
</script>
<script src="scripts/myScripts.js"></script>

</body>    





</html>