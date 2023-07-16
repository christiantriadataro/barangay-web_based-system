</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    const emailInput = document.getElementById('authen_email');
    const currentPasswordInput = document.getElementById('authen_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const submitButton = document.getElementById('next');

    currentPasswordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);

    function validatePasswords() {
        const currentPassword = currentPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (currentPassword === confirmPassword) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    function transferValue() {
        const emailResultInput = document.getElementById('authen_email_read');
        const passwordResultInput = document.getElementById('authen_password_read');

        const email = emailInput.value;
        const password = currentPasswordInput.value;

        emailResultInput.value = email;
        passwordResultInput.value = password;
    }


</script>
</body>
</html>
