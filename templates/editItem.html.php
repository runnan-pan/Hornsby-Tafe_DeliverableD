<?php $photoPath = "images/productImages/photo-unavailable.png";

    // if photo exists, change the $photoPath to the correct photo
    if (file_exists("images/productImages/".$product->getPhotoPath()) and strlen($product->getPhotoPath())>0){
        $photoPath="images/productImages/".$product->getPhotoPath();
    }
?> 
 
<div class="item-wrapper">
 
    <!-- if staff clicked "edit" -->
    <?php if (isset($_GET["action"]) && $_GET["action"]==="editItem"): ?>

    <div class="itemDetailImage">
        <img src="<?=$photoPath?>" width="300px" alt="<?=$product->getProductName();?>">
        <div>
            <label for="">Photo:</label>
            <div><?="images/productImages/".$product->getPhotoPath()?></div>
        </div>
        <?php if(file_exists("images/productImages/".$product->getPhotoPath()) and strlen($product->getPhotoPath())>0):?>
        <form action="editItem.php?itemId=<?=$product->getProductId()?>&action=editItem" method="POST" id="deletePhoto">
            <button name="deletePhoto">Delete photo</button>
            <input type="hidden" name="oldPhoto" value="<?=$product->getPhotoPath()?>">
            <input type="hidden" name="itemId" value="<?=$_GET["itemId"]?>">
        </form>
        <?php endif ?>    
    </div>



    <form action="editItem.php?itemId=<?=$product->getProductId()?>&action=editItem" method="POST">

    <p class="staff-edit__p-tag">
        <label for="productName">Product name:</label>
        <input class="wide-input productName" type="text" id="productName" name="productName" value="<?php if (isset($_POST["update"])){echo $formValidation->setValue("productName");}else{echo $product->getProductName();}?>" placeholder="<?=$itemNameMsg?>">
    </p>
    <p class="staff-edit__p-tag">
        <label for="itemCategory">Category:</label>
        <select name="itemCategory" id="itemCategory">
            <?php foreach($categoryRows as $row):?>
                <option value="<?=$row["categoryId"]?>" <?php if (isset($_POST["update"])){$formValidation->returnSelected("itemCategory",$row["categoryId"]);}else if($product->getCategoryId()==$row["categoryId"]){echo "selected";}?>><?=$row["categoryName"]?></option>
            <?php endforeach ?>    
        </select>
    </p>
    <p class="staff-edit__p-tag">
        <label for="originalPrice">Original price:</label>
        <input type="number" step="0.01" id="originalPrice" name="originalPrice" value="<?php if (isset($_POST["update"])){echo $formValidation->setValue("originalPrice");}else{echo $product->getPrice();}?>">
        <span class="error-message"><?=$priceMsg?></span>
    </p>
    <p class="staff-edit__p-tag">
        <label for="salesPrice">Sales price:</label>
        <input type="number" step="0.01" id="salesPrice" name="salesPrice" value="<?php if (isset($_POST["update"])){echo $formValidation->setValue("salesPrice");}else{echo $product->getSalePrice();}?>">
        <span class="error-message"><?=$salePriceMsg?></span>
    </p>
    <p class="staff-edit__p-tag">
        <label for="itemDescription">Description:</label>
        <textarea class="wide-input" name="itemDescription" id="itemDescription" cols="30" rows="10"><?php if (isset($_POST["update"])){echo $formValidation->setValue("itemDescription");}else{echo $product->getDescription();}?></textarea>
    </p>
    <p>
        <label for="newPhoto">Upload new photo:</label>
        <input type="file" id="newPhoto" name="newPhoto">
        <div class="error-message"><?=$photoMsg?></div>
    </p>
    <p>
        <label>
            Featured:
            <select name="featured">
                <option value="0" <?php if (isset($_POST["update"])){$formValidation->returnSelected("featured","0");}else if($product->getFeatured()==="0"){echo "selected";}?>>No</option>
                <option value="1" <?php if (isset($_POST["update"])){$formValidation->returnSelected("featured","1");}else if($product->getFeatured()==="1"){echo "selected";}?>>Yes</option>
            </select>
        </label>
    </p>

    <p>
        <button type="submit" name="update" formenctype="multipart/form-data">Update</button>
        <a href="itemDetails.php?itemId=<?=$product->getProductId()?>"><button type="button" name="cancel">Cancel</button></a>
    </p>
    <input type="hidden" name="itemId" value="<?=$_GET["itemId"]?>">
    <input type="hidden" name="oldPhoto" value="<?=$product->getPhotoPath()?>">
    </form>

    <?php endif ?>

</div>

<script defer>
    document.getElementById("deletePhoto").addEventListener("submit",(ev)=>{
        if (!confirm("Do you want to delete the photo? Please note that this action can not be undone")){
            ev.preventDefault();
        }
    })
</script>