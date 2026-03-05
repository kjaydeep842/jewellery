// Enter Mobile Number Form Handler
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("mobile-form");
    const phoneInput = document.getElementById("phone");
    const fullPhoneInput = document.getElementById("full_phone");
    const continueBtn = document.getElementById("continue-btn");
    const btnText = document.getElementById("btn-text");
    const btnLoader = document.getElementById("btn-loader");
    const errorMessage = document.getElementById("error-message");
    const errorText = document.getElementById("error-text");

    // Initialize intl-tel-input
    const iti = window.intlTelInput(phoneInput, {
        initialCountry: "in",
        separateDialCode: true,
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
    });

    // Format phone number as user types (only allow digits)
    phoneInput.addEventListener("input", function (e) {
        this.value = this.value.replace(/[^0-9]/g, "");
        hideError();
    });

    // Form submission
    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const phone = phoneInput.value.trim();

        // Validate phone number using intl-tel-input
        if (!iti.isValidNumber()) {
            showError("Please enter a valid mobile number.");
            return;
        }

        // Set the full international phone number in the hidden input
        fullPhoneInput.value = iti.getNumber();

        // Show loading state
        setLoading(true);
        hideError();

        try {
            const formData = new FormData(form);
            const response = await fetch("/auth/send-otp", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN":
                        document.querySelector('meta[name="csrf-token"]')
                            ?.content ||
                        document.querySelector('input[name="_token"]').value,
                    Accept: "application/json",
                },
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                // Redirect to OTP verification page
                window.location.href = data.redirect;
            } else {
                showError(
                    data.message || "Failed to send OTP. Please try again.",
                );
            }
        } catch (error) {
            console.error("Error:", error);
            showError("An error occurred. Please try again.");
        } finally {
            setLoading(false);
        }
    });

    function setLoading(loading) {
        continueBtn.disabled = loading;
        if (loading) {
            btnText.classList.add("hidden");
            btnLoader.classList.remove("hidden");
        } else {
            btnText.classList.remove("hidden");
            btnLoader.classList.add("hidden");
        }
    }

    function showError(message) {
        errorText.textContent = message;
        errorMessage.classList.remove("hidden");
    }

    function hideError() {
        errorMessage.classList.add("hidden");
    }
});
