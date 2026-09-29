document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");

    if (!form) return;

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const email = form.querySelector("#email");
        const name = form.querySelector("#name");
        const password = form.querySelector("#password");

        if (!email.value.trim() || !name.value.trim() || !password.value.trim()) {
            alert("Please fill in all login fields.");
            return;
        }

        window.location.href = "/OTP";
    });
});
