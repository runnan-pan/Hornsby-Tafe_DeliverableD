"use strict";

const checkoutForm = document.getElementById("checkout-form");

if (checkoutForm){
    // checkoutForm.setAttribute("novalidate","");
    const firstName = checkoutForm.elements["firstName"];
    const lastName = checkoutForm.elements["lastName"];
    const streetAddress = checkoutForm.elements["streetAddress"];
    const suburb = checkoutForm.elements["suburb"];
    const postcode = checkoutForm.elements["postcode"];
    const email = checkoutForm.elements["email"];
    const contactNumber = checkoutForm.elements["contactNumber"];
    const creditCardNumber = checkoutForm.elements["creditCardNumber"];
    const expiryDate = checkoutForm.elements["expiryDate"];
    const nameOnCard = checkoutForm.elements["nameOnCard"];

    checkoutForm.addEventListener("submit",(ev)=>{
        hideAllError(checkoutForm)

        const regexName = (/^[ a-zA-Z\-\']+$/);
        const regexPostcode = (/^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$/);
        const regexEmail = (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

        const regexExpiryDate = (/^\d\d\/\d\d$/);
        

        if (firstName.value.trim().length===0){
            showError(firstName,ev,"Please provide first name");
        }else if (!regexName.test(firstName.value)){
            showError(firstName,ev,"Only letters, apostrophe,hyphens and white space allowed");
        }

        if (lastName.value.trim().length===0){
            showError(lastName,ev,"Please provide last name");
        }else if (!regexName.test(lastName.value)){
            showError(lastName,ev,"Only letters, apostrophe,hyphens and white space allowed");
        }

        if (streetAddress.value.trim().length===0){
            showError(streetAddress,ev,"Please provide address");
        }

        if (suburb.value.trim().length===0){
            showError(suburb,ev,"Please provide suburb");
        }else if (!regexName.test(suburb.value)){
            showError(suburb,ev,"Only letters, apostrophe,hyphens and white space allowed");
        }

        if (postcode.value.trim().length===0){
            showError(postcode,ev,"Please provide postcode");
        }else if (!regexPostcode.test(postcode.value)){
            showError(postcode,ev,"Postcode should be 4 digits only");
        }

        if (contactNumber.value.trim().length===0){
            showError(contactNumber,ev,"Please provide phone number");
        }

        if (email.value.trim().length===0){
            showError(email,ev,"Please provide email");
        }else if (!regexEmail.test(email.value)){
            showError(email,ev,"Email format not valid");
        }

        if (creditCardNumber.value.trim().length===0){
            showError(creditCardNumber,ev,"Please provide credit card number");
        }

        if (expiryDate.value.trim().length===0){
            showError(expiryDate,ev,"Please provide date");
        }else if (!regexExpiryDate.test(expiryDate.value)){
            showError(expiryDate,ev,'Please enter date in "MM/YY" format');
        }

        if (nameOnCard.value.trim().length===0){
            showError(nameOnCard,ev,"Please provide name");
        }else if (!regexName.test(nameOnCard.value)){
            showError(nameOnCard,ev,"Only letters, apostrophe,hyphens and white space allowed");
        }

})
}


/**
 * Hide existing error
 * @param {Element} form The form to hide errors within 
 */
function hideAllError(form){
    const errors = form.querySelectorAll(".error-message");
    for (const error of errors) {
        error.innerHTML = "";
    }
}


/**
 * 
 * @param {HTMLFormElement} field The form field to be validated
 * @param {Event} event 
 */
function showError(field,event,errorMessage){
    event.preventDefault();
    field.parentElement.querySelector(".error-message").innerHTML = errorMessage;
}