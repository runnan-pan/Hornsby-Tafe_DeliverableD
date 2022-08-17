<?php if ($cartItemQty==0):?>
<p>Your cart is empty, please add items in your cart then check out.</p>
<?php else:?>

<h2>Checkout</h2>
<div class="checkout-wrap">
    <form action="checkout.php" method="POST" id="checkout-form" novalidate>
        <fieldset>
            <legend>Delivery details</legend>
            <p class="checkout-p">
                <label for="firstName" class="checkout-short-label">First name:</label>
                <input type="text" id="firstName" name="firstName" value="<?=$form->setValue("firstName")?>" required>
                <span class="error-message"><?=$fNameMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="lastName" class="checkout-short-label">Last name:</label>
                <input type="text" id="lastName" name="lastName" value="<?=$form->setValue("lastName")?>" required>
               <span class="error-message"><?=$lNameMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="streetAddress" class="checkout-short-label">Street address:</label>
                <input type="text" id="streetAddress" name="streetAddress" value="<?=$form->setValue("streetAddress")?>" required>
                <span class="error-message"><?=$streetAddressMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="suburb" class="checkout-short-label">Suburb:</label>
                <input type="text" id="suburb" name="suburb" value="<?=$form->setValue("suburb")?>" placeholder="" required>
                <span class="error-message"><?=$suburbMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="state" class="checkout-short-label">State:</label>
                <select name="state" id="state" required>
                    <option value="">--Please select state--</option>
                    <option value="NSW" <?php $form->returnSelected("state","NSW")?>>New South Wales</option>
                    <option value="QLD" <?php $form->returnSelected("state","QLD")?>>Queensland</option>
                    <option value="VIC" <?php $form->returnSelected("state","VIC")?>>Victoria</option>
                    <option value="SA" <?php $form->returnSelected("state","SA")?>>South Australia</option>
                    <option value="NT" <?php $form->returnSelected("state","NT")?>>North Territory</option>
                    <option value="TAS" <?php $form->returnSelected("state","TAS")?>>Tasmania</option>
                </select>
                <span class="error-message"><?=$stateMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="postcode" class="checkout-short-label">Postcode:</label>
                <input type="text" id="postcode" value="<?=$form->setValue("postcode")?>" name="postcode" placeholder="2000" maxlength="4" title="Postcode contains 4 digits only" pattern="\d\d\d\d" required>
                <span class="error-message"><?=$postcodeMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="contactNumber" class="checkout-short-label">Contact number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" value="<?=$form->setValue("contactNumber")?>" placeholder="0400 000 000" required>
                <span class="error-message"><?=$contactNumberMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="email" class="checkout-short-label">Email address:</label>
                <input type="email" id="email" name="email" value="<?=$form->setValue("email")?>" required>
                <span class="error-message"><?=$emailMsg?></span>
            </p>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Payment details</legend>
            <p class="checkout-p">
                <label for="creditCardNumber" class="checkout-short-label">Credit card number:</label>
                <input type="text" id="creditCardNumber" name="creditCardNumber" value="<?=$form->setValue("creditCardNumber")?>" pattern="[0-9]+" required>
                <span class="error-message"><?=$creditCardNoMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="expiryDate" class="checkout-short-label">Expiry date:</label>
                <input type="text" id="expiryDate" name="expiryDate" value="<?=$form->setValue("expiryDate")?>" placeholder="MM/YY" pattern="\d\d/\d\d" title="Format: MM/YY" maxlength="5" required>
                <span class="error-message"><?=$creditCardDateMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="CSV" class="checkout-short-label">CSV:</label>
                <input type="text" id="CSV" name="CSV" value="<?=$form->setValue("CSV")?>" pattern="[0-9]+" required>
                <span class="error-message"><?=$creditCardCSVMsg?></span>
            </p>
            <p class="checkout-p">
                <label for="nameOnCard" class="checkout-short-label">Name on credit card:</label>
                <input type="text" id="nameOnCard" name="nameOnCard" value="<?=$form->setValue("nameOnCard")?>" required>
                <span class="error-message"><?=$creditCardNameMsg?></span>
            </p>
        </fieldset>
        <p>Total amount of <mark>$<?=$_SESSION["cart"]->calculateTotal()?></mark> will be deducted from your account.</p>
        <button type="submit" name="submit">Submit Order</button>
    </form>
</div>

<script defer src="./scripts/checkOutValidation.js"></script>

<?php endif ?>