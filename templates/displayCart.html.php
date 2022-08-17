<?php
$cartHasItem = true;
$cart="";

if (!isset($_SESSION["cart"])){
    echo "<p>There is no product in your cart.</p>";
    $cartHasItem = false;
}else{
    $cart = $_SESSION["cart"];
    if ($cart->count()<1){
        echo "<p>There is no product in your cart.</p>";
        $cartHasItem = false;
    }
}
?>

<?php if ($cartHasItem==true):?>
<h2>Below is your shopping cart</h2>

<div class="cart-wrap">
    <?php
        $cartItems = $_SESSION["cart"]->getItems();
    ?>

    <table class="cart-table">
        <tr class="cart-row">
            <th class="cart__first-column"></th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th></th>
        </tr>

        <?php foreach($cartItems as $item):?>
        <tr class="cart-row">
            <td class="cart__img"><a href="itemDetails.php?itemId=<?=$item->getItemId()?>"><img class="cart__item-photo" src="<?=$item->getPhotoPath()?>" alt=""></a></td>
            <td class="cart__name"><a href="itemDetails.php?itemId=<?=$item->getItemId()?>"><?=$item->getItemName()?></a></td>
            <td class="cart__price">$<?=$item->getPrice()?></td>
            <td class="cart__action">
                <?php if (isset($_GET["editItemId"]) and $_GET["editItemId"]==$item->getItemId()): ?>
                <form action="viewCart.php" method="POST">
                    <input class="cart__updatePrice" type="number" name="qty" value="<?=$item->getQuantity()?>">
                    <input type="submit" name="update" value="update">
                    <input type="submit" name="cancel" value="cancel">
                    <input type="hidden" name="itemId" value="<?=$item->getItemId()?>">
                </form>

                <?php else:?>
                <?=$item->getQuantity()?>

                <?php endif ?>
            </td>
            <td>
                <form action="viewCart.php" method="POST">
                    <?php
                    $editing = false;
                    if (isset($_GET["editItemId"]) and $_GET["editItemId"]==$item->getItemId()){
                        $editing = true;
                    }                    
                    ?>

                    <?php if ($editing == false):?>                        
                    <a href="viewCart.php?editItemId=<?=$item->getItemId()?>"><button type="button" name="edit"><i class="fa-solid fa-pen-to-square"></i></button></a>
                    <?php endif ?>
                    <button type="submit" name="remove" class="remove"><i class="fa-solid fa-trash-can"></i></button>
                    <input type="hidden" name="itemId" value="<?=$item->getItemId()?>">
                </form>
            </td>
        </tr>
        <?php endforeach ?>
        
    </table>

    <div>
        <p class="cart__total-price boldtext">Total: $<?=$_SESSION["cart"]->calculateTotal()?></p>
    </div>
    
    <div class="cart-actions">
        <form action="viewCart.php" method="POST">
            <button type="submit" name="clearCart" id="clear-cart">Clear cart</button>
        </form>
        <a href="checkout.php"><button>Go to checkout</button></a>
    </div>

</div>

<?php endif ?>