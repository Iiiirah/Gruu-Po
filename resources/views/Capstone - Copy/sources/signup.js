const form = document.getElementById("signupForm");
const signupCard = document.getElementById("signupCard");
const successCard = document.getElementById("successCard");

if (form && signupCard && successCard) {
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        signupCard.style.display = "none";
        successCard.style.display = "flex";

        setTimeout(function() {
            window.location.href = form.action;
        }, 3000);
    });
}