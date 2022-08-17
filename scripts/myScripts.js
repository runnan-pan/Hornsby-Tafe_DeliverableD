document.getElementById("mobile-menu-menu").addEventListener("click",mobileMenuDisplayBlock);
document.getElementById("mobile-menu-hamburger").addEventListener("click",mobileMenuDisplayBlock);
document.getElementById("clear-cart").addEventListener("click",confirmClearCart);

function mobileMenuDisplayBlock(){
    var element = document.getElementById("mobile-expanded-menu");
    element.classList.toggle("display-block");
}


const deleteLinks = document.querySelectorAll(".remove");

for (let i=0;i<deleteLinks.length;i++){
    deleteLinks[i].addEventListener("click",confirmDelete);
}

function confirmDelete(event){
    if (!confirm("Do you want to remove")){
        event.preventDefault();
    }
    return false;
}

function confirmClearCart(event){
    if (!confirm("You are going to REMOVE All ITEMS from your cart")){
        event.preventDefault();
    }
    return false;
}