"use strick"

const contactForm = document.getElementById("contact-form")

if (contactForm){
    const firstName = contactForm.elements["firstName"]
    const lastName = contactForm.elements["lastName"]
    const email = contactForm.elements["email"]
    const question = contactForm.elements['question']
    const contactNumber = contactForm.elements["contactNumber"]

    contactForm.addEventListener("submit",(ev)=>{
        hideAllErrors(contactForm)

        const nameRegex = /^[a-zA-z \-']*$/

        if (firstName.value.trim().length<2){
            showError(firstName,ev,"First name must be at least 2 characters long")
        }else if(!nameRegex.test(firstName.value.trim())){
            showError(firstName,ev,"Only letters, apostrophe,hyphens and white space allowed")
        }
    
        if (lastName.value.trim().length<2){
            showError(lastName,ev,"Last name must be at least 2 characters long")
        }else if(!nameRegex.test(lastName.value.trim())){
            showError(lastName,ev,"Only letters, apostrophe,hyphens and white space allowed")
        }

        const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        
        if (email.value.trim().length===0){
            showError(email,ev,"Email is required")
        }else if (!emailRegex.test(email.value)){
            showError(email,ev,'Email is not in a valid format, e.g.user@domain.com')
        }

        const phoneRegex = /^((000|112|106)|((13|18)([- ]?\d){4})|((1300|1800|190\d)([- ]?\d){6})|(((\+61[- ]?\(?)|(\(?0[- ]?))[23478]\)?([- ]?\d){8}))$/
        if (!phoneRegex.test(contactNumber.value)){
            showError(contactNumber,ev,"Please provide a valid phone number")
        }

        if (question.value.trim().length<30){
            showError(question,ev,"Please enter at least 30 characters")
        }
    })

}



function hideAllErrors(form){
    const errors = form.querySelectorAll(".formError")
    for (const error of errors) {
        error.innerHTML = ""
    }
}

function showError(field,event,errorMessage = null){
    event.preventDefault()
    field.parentElement.querySelector(".formError").innerHTML = errorMessage
}