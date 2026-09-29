document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("forgotPasswordForm");

    if (!form) return;

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const email = form.querySelector("input[type='email']");

        if (!email || !email.value.trim()) {
            alert("Please enter your email.");
            return;
        }

        alert("OTP has been sent to your email.");
        window.location.href = "/OTP";
    });
});
