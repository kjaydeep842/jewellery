// Verify OTP Form Handler
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('otp-form');
    const otpInputs = document.querySelectorAll('.otp-input');
    const verifyBtn = document.getElementById('verify-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoader = document.getElementById('btn-loader');
    const resendBtn = document.getElementById('resend-btn');
    const resendText = document.getElementById('resend-text');
    const resendTimer = document.getElementById('resend-timer');
    const timerCount = document.getElementById('timer-count');
    const errorMessage = document.getElementById('error-message');
    const errorText = document.getElementById('error-text');
    const successMessage = document.getElementById('success-message');
    const successText = document.getElementById('success-text');

    let resendCountdown = null;

    // Auto-focus first input
    otpInputs[0].focus();

    // Handle OTP input
    otpInputs.forEach((input, index) => {
        // Only allow digits
        input.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');

            if (this.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            // Auto-submit when all fields are filled
            if (index === otpInputs.length - 1 && this.value.length === 1) {
                if (isOtpComplete()) {
                    form.dispatchEvent(new Event('submit'));
                }
            }

            hideError();
        });

        // Handle backspace
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && this.value === '' && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        // Handle paste
        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');

            if (pastedData.length === 6) {
                otpInputs.forEach((input, i) => {
                    input.value = pastedData[i] || '';
                });
                otpInputs[5].focus();

                // Auto-submit after paste
                setTimeout(() => {
                    form.dispatchEvent(new Event('submit'));
                }, 100);
            }
        });
    });

    // Form submission
    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const otp = getOtpValue();

        if (otp.length !== 6) {
            showError('Please enter the complete 6-digit OTP.');
            return;
        }

        setLoading(true);
        hideError();

        try {
            const formData = new FormData();
            formData.append('otp', otp);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            const response = await fetch('/auth/verify-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                        document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showSuccess(data.message || 'Login successful!');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            } else {
                showError(data.message || 'Invalid OTP. Please try again.');
                clearOtpInputs();
                otpInputs[0].focus();
            }
        } catch (error) {
            console.error('Error:', error);
            showError('An error occurred. Please try again.');
            clearOtpInputs();
            otpInputs[0].focus();
        } finally {
            setLoading(false);
        }
    });

    // Resend OTP
    resendBtn.addEventListener('click', async function (e) {
        e.preventDefault();

        if (resendBtn.disabled) return;

        try {
            const response = await fetch('/auth/resend-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                        document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            });

            const data = await response.json();

            if (data.success) {
                showSuccess(data.message || 'OTP resent successfully!');
                startResendTimer();
                clearOtpInputs();
                otpInputs[0].focus();
            } else {
                showError(data.message || 'Failed to resend OTP. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError('An error occurred. Please try again.');
        }
    });

    function getOtpValue() {
        return Array.from(otpInputs).map(input => input.value).join('');
    }

    function isOtpComplete() {
        return Array.from(otpInputs).every(input => input.value.length === 1);
    }

    function clearOtpInputs() {
        otpInputs.forEach(input => input.value = '');
    }

    function setLoading(loading) {
        verifyBtn.disabled = loading;
        if (loading) {
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
        } else {
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
        }
    }

    function showError(message) {
        errorText.textContent = message;
        errorMessage.classList.remove('hidden');
        successMessage.classList.add('hidden');
    }

    function showSuccess(message) {
        successText.textContent = message;
        successMessage.classList.remove('hidden');
        errorMessage.classList.add('hidden');
    }

    function hideError() {
        errorMessage.classList.add('hidden');
        successMessage.classList.add('hidden');
    }

    function startResendTimer() {
        let seconds = 60;
        resendBtn.disabled = true;
        resendText.classList.add('hidden');
        resendTimer.classList.remove('hidden');
        timerCount.textContent = seconds;

        if (resendCountdown) {
            clearInterval(resendCountdown);
        }

        resendCountdown = setInterval(() => {
            seconds--;
            timerCount.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(resendCountdown);
                resendBtn.disabled = false;
                resendText.classList.remove('hidden');
                resendTimer.classList.add('hidden');
            }
        }, 1000);
    }

    // Start timer on page load
    startResendTimer();
});
