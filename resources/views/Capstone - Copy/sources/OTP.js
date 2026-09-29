document.addEventListener("DOMContentLoaded", function () {
    const otpInputs = Array.from(document.querySelectorAll(".OTP input"));
    const otpForm = document.getElementById("otpForm");

    if (!otpInputs.length) {
        return;
    }

    otpInputs.forEach((input, index) => {
        input.addEventListener("input", function (event) {
            const value = event.target.value.replace(/\D/g, "").slice(0, 1);
            event.target.value = value;

            if (value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
                otpInputs[index + 1].select();
            }
        });

        input.addEventListener("keydown", function (event) {
            if (event.key === "Backspace" && !input.value && index > 0) {
                otpInputs[index - 1].focus();
                otpInputs[index - 1].value = "";
            }

            if (event.key === "ArrowLeft" && index > 0) {
                otpInputs[index - 1].focus();
                otpInputs[index - 1].select();
            }

            if (event.key === "ArrowRight" && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
                otpInputs[index + 1].select();
            }
        });

        input.addEventListener("paste", function (event) {
            event.preventDefault();

            const pastedValue = (event.clipboardData || window.clipboardData)
                .getData("text")
                .replace(/\D/g, "")
                .slice(0, otpInputs.length);

            if (!pastedValue) {
                return;
            }

            pastedValue.split("").forEach((char, charIndex) => {
                if (otpInputs[charIndex]) {
                    otpInputs[charIndex].value = char;
                }
            });

            const nextIndex = Math.min(pastedValue.length, otpInputs.length - 1);
            otpInputs[nextIndex].focus();
            otpInputs[nextIndex].select();
        });

        input.addEventListener("focus", function () {
            input.select();
        });
    });

    if (otpForm) {
        otpForm.addEventListener("submit", function (event) {
            const otpValue = otpInputs.map((input) => input.value).join("");

            if (otpValue.length !== otpInputs.length) {
                event.preventDefault();
                alert("Please enter all OTP digits.");
                otpInputs[0].focus();
            }
        });
    }
});