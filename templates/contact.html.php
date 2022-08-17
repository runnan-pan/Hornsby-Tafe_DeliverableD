<?php if (isset($_POST["submit"]) and $formValidating -> returnValidation() === true): 
    header("location:thankyou.php");
    endif;
?>

<form action="contact.php" method="POST" id="contact-form">
    <fieldset class="contactFormLayout">
        <legend>Contact Us</legend>

        <?php if ($formValidating->returnValidation() == false):?>
        <p class="formError">Please filled out below information</p>
        <?php endif ?>

        <p class="contactFormPara">
            <label class="shortLabel" for="firstName" <?=$formValidating -> setErrorClass("firstName")?>>First name*: </label>
            <input type="text" id="firstName" name="firstName" value="<?=$formValidating -> setValue("firstName")?>">
            <span class="formError"><?=$fNameMessage?></span>
        </p>
        <p class="contactFormPara">
            <label class="shortLabel" for="lastName" <?=$formValidating -> setErrorClass("lastName")?>>Last name*: </label>
            <input type="text" id="lastName" name="lastName" value="<?=$formValidating -> setValue("lastName")?>">
            <span class="formError"><?=$lNameMessage?></span>
        </p>
        <p class="contactFormPara">
            <label class="shortLabel" for="contactNumber">Contact number: </label>
            <input type="text" id="contactNumber" name="contactNumber" value="<?=$formValidating -> setValue("contactNumber")?>">
            <span class="formError"><?=$phoneMessage?></span>

        </p>
        <p class="contactFormPara">
            <label class="shortLabel" for="email"<?=$formValidating -> setErrorClass("email")?>>Email address*: </label>
            <input type="text" id="email" name="email" value="<?=$formValidating -> setValue("email")?>">
            <span class="formError"><?=$emailMessage?></span>
        </p>
        <p class="contactFormPara">
            <label class="shortLabel" for="question">Question: </label>
            <textarea name="question" id="question" cols="30" rows="10"><?=$formValidating -> setValue("question")?></textarea>
            <span class="formError"><?=$commentsMessasge?></span>
        </p>

        <p class="formSubmit">
            <input type="submit" name="submit" value="Submit">
        </p>

    </fieldset>
</form>

<script defer src="./scripts/contact.html.js"></script>