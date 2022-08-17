<?php if (empty($products)):?>    
<p>No products found</p>
<?php endif ?>

<div class="featured__products">
    <?php
        foreach ($products as $product):
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