        <div class="slick" id="slick">
            <div class="slide-pics">
                <img src="images/slideImage1.png" alt="footBall image" class="slide-image">
                <div class="slide-pics__right">
                    <div class="slide-pics__right__content">
                        <p class="shop-now__top">View our brand new range of</p>
                        <p class="shop-now__middle">Sports balls</p>
                        <a class="shop-now__button" href="http://localhost/work/DeliverableD/itemsByCategory.php?cateId=5">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="slide-pics">
                <img src="images/slideImage2.png" alt="footBall image" class="slide-image">
                <div class="slide-pics__right">
                    <div class="slide-pics__right__content">
                        <p class="shop-now__top">Get protected with the new range of</p>
                        <p class="shop-now__middle">Protective helmets</p>
                        <a class="shop-now__button" href="http://localhost/work/DeliverableD/itemsByCategory.php?cateId=2">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="slide-pics">
                <img src="images/slideImage3.png" alt="footBall image" class="slide-image">
                <div class="slide-pics__right">
                    <div class="slide-pics__right__content">
                        <p class="shop-now__top">Get ready to race with our professional</p>
                        <p class="shop-now__middle">Training gear</p>
                        <a class="shop-now__button" href="http://localhost/work/DeliverableD/itemsByCategory.php?cateId=7">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="featured">
            <div class="featured__title">
                <h2>Featured products</h2>
            </div>
            <div class="featured__products">
                <?php
                    foreach ($featuredProducts as $product):
                        $photoPath = "images/productImages/photo-unavailable.png";

                        if (file_exists("images/productImages/".$product["photo"]) and strlen($product["photo"])>0){
                            $photoPath="images/productImages/".$product["photo"];
                        }
                ?>

                <a href="itemDetails.php?itemId=<?=$product["itemId"]?>" class="product-card">
                    <img src="<?=$photoPath?>" alt=<?=$product["itemName"]?> class="product-card__img">

                    <div class="product-card__price">
                        <?php if ($product["salePrice"]==null or $product["salePrice"]==0):?>
                        <span class="original-price">$<?=$product["price"]?></span>
                        
                        <?php else: ?>
                        <span class="sales-price">$<?=$product["salePrice"]?></span>
                        <span class="non-sales-price"><small>WAS</small> <del>$<?=$product["price"]?></del></span>
                        
                        <?php endif ?>
                    </div>
                    
                    <p class="product-card__description"><?=$product["itemName"]?></p>
                </a>    

                <?php endforeach ?>
            </div>
        </div>
        
        <div class="partner">
            <div class="partner__title">
                <h2>Our brands and partnerships</h2>
            </div>
            <div class="partner-content">
                <div class="partner-content__para">
                    <p>These are some of our top brands and partnership.<br><span>The best of the best is here.</span></p>
                </div>
                <div class="partner-content__logo-container">
                    <ul class="partner-logos">
                        <li class="partner-logo"><img src="images/logo_nike.png" alt="Nike"></li>
                        <li class="partner-logo"><img src="images/logo_adidas.png" alt="Adidas"></li>
                        <li class="partner-logo"><img src="images/logo_skins.png" alt="Skins"></li>
                        <li class="partner-logo"><img src="images/logo_asics.png" alt="ASICS"></li>
                        <li class="partner-logo"><img src="images/logo_newbalance.png" alt="New Balance"></li>
                        <li class="partner-logo"><img src="images/logo_wilson.png" alt="Wilson"></li>
                    </ul>
                </div>
            </div>
        </div>

