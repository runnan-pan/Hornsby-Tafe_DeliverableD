<?php $photoPath = "images/productImages/photo-unavailable.png";

    if (file_exists("images/productImages/".$product->getPhotoPath()) and strlen($product->getPhotoPath())>0){
        $photoPath="images/productImages/".$product->getPhotoPath();
    }
?>

<div class="item-wrapper">

        <div class="itemDetailImage">
            <img src="<?=$photoPath?>" alt="<?=$product->getProductName();?>">
        </div>
        <form action="itemDetails.php?itemId=<?=$product->getProductId()?>" method="POST">
            <h2><?=$product->getProductName()?></h2>
            <p> 
                <!-- if item is NOT on sale -->
                <?php if ($product->getSalePrice()==null or $product->getSalePrice()==0):?> 
                <span class="original-price">$<?=$product->getPrice()?></span>
                    <input type="hidden" name="price" value="<?=$product->getPrice()?>">
                
                <!-- if item is on sale -->
                <?php else:?>
                <span class="sales-price">$<?=$product->getSalePrice()?></span>
                    <input type="hidden" name="price" value="<?=$product->getSalePrice()?>">
                <span class="non-sales-price"><small>WAS</small> <del>$<?=$product->getPrice()?></del></span>
                                        
                <?php endif ?>
            </p>
            <p>
                <label for="qty<?=$product->getProductId()?>">Quantity:</label>
                <input type="number" id="qty<?=$product->getProductId()?>" name="qty" value="1">
                <button type="submit" name="addToCart">Add to cart</button>
            </p>
            
            <?php if (isset($_POST["addToCart"])):?>
            <p><?=$message?><a href="viewCart.php">Go to cart</a></p>
            <?php endif ?>

            <p><?=$product->getDescription()?></p>
            <input type="hidden" name="itemId" value="<?=$product->getProductId()?>">
            <input type="hidden" name="photoPath" value="<?=$photoPath?>">
            
            <!-- Below will show when user "admin" is logged in  -->
            <?php if (isset($_SESSION["username"]) && $_SESSION["username"]=="admin"):?>
            <div>
                <a href="editItem.php?itemId=<?=$product->getProductId()?>&action=editItem">
                    <button type="button" name="staffEdit">Edit</button>
                </a>
            </div>
            <?php endif ?>
        </form>

</div>