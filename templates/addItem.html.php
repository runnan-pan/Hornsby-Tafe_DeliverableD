<?php $photoPath = "images/productImages/photo-unavailable.png";

    if (file_exists("images/productImages/".$product->getPhotoPath()) and strlen($product->getPhotoPath())>0){
        $photoPath="images/productImages/".$product->getPhotoPath();
    }
?>

<div class="item-wrapper">
            <div>
                <img src="<?=$photoPath?>" width="300px" alt="">
                <div>
                    <label for="">Photo:</label>
                    <div><?=$photoPath?></div>
                </div>
            </div>
            <form action="addProducts.php" method="POST" novalidate>

            <!-- image -->


            <p class="staff-edit__p-tag">
                <label for="productName">Product name:</label>
                <input class="wide-input productName" type="text" id="productName" name="productName" value="<?=$formValidation->setValue("productName")?>" placeholder="<?=$itemNameMsg?>" required>
            </p>
            <p class="staff-edit__p-tag">
                <label for="itemCategory">Category:</label>
                <select name="itemCategory" id="itemCategory" required>
                    <option value="">---Please select a category---</option>
                    <?php foreach($categoryRows as $row):?>
                        <option value="<?=$row["categoryId"]?>" <?=$formValidation->returnSelected("itemCategory",$row["categoryId"])?>><?=$row["categoryName"]?></option>
                    <?php endforeach ?>    
                </select>
                <span class="error-message"><?=$cateMsg?></span>
            </p>
            <p class="staff-edit__p-tag">
                <label for="originalPrice">Original price:</label>
                <input type="number" id="originalPrice" name="originalPrice" value="<?=$formValidation->setValue("originalPrice")?>" required>
                <span class="error-message"><?=$priceMsg?></span>
            </p>
            <p class="staff-edit__p-tag">
                <label for="salesPrice">Sales price:</label>
                <input type="number" id="salesPrice" name="salesPrice" value="<?=$formValidation->setValue("salesPrice")?>" min="0.01">
                <span class="error-message"><?=$salePriceMsg?></span>
            </p>
            <p class="staff-edit__p-tag">
                <label for="itemDescription">Description:</label>
                <textarea class="wide-input" name="itemDescription" id="itemDescription" cols="30" rows="10"><?=$formValidation->setValue("itemDescription")?></textarea>
            </p>
            <p>
                <label for="newPhoto">Upload new photo:</label>
                <input type="file" id="newPhoto" name="newPhoto">
            </p>
            <p>
                <label>
                    Featured:
                    <select name="featured">
                        <option value="0" <?=$formValidation->returnSelected("featured","0")?>>No</option>
                        <option value="1" <?=$formValidation->returnSelected("featured","1")?>>Yes</option>
                    </select>
                </label>
            </p>
            <p>
                <button type="submit" name="add-item">Add item</button>
                <a href="maintainItem.php"><button type="button">Cancel</button></a>
            </p>
            <input type="hidden" name="itemId" value="">
   
            </form>

</div>