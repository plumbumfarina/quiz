function setFormMessage(formElement, type, message) {
    const messageElement = formElement.querySelector(".form__message");

    messageElement.textContent = message;
    messageElement.classList.remove("form__message--success", "form__message--error");
    messageElement.classList.add(`form__message--${type}`);
}

function setInputError(inputElement, message) {
    inputElement.classList.add("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

function clearInputError(inputElement) {
    inputElement.classList.remove("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");
    const forgotPasswordForm = document.querySelector("#forgotPassword");

    document.querySelector("#linkCreateAccount").addEventListener("click", () => {
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hidden");
        forgotPasswordForm.classList.add("form--hidden");
        document.getElementById("signupUsername").focus();
    });

    document.querySelector("#linkLogin").addEventListener("click", () => {
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hidden");
        forgotPasswordForm.classList.add("form--hidden");
        document.getElementById("loginUsername").focus();
    });

    document.querySelector("#linkForgotPassword").addEventListener("click", () => {
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.add("form--hidden");
        forgotPasswordForm.classList.remove("form--hidden");
        document.getElementById("resetEmail").focus();
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();

        

        // Perform your AJAX / Fetch login

        setFormMessage(loginForm, "error", "Invalid username/password combination!");
    });

    createAccountForm.addEventListener("submit", e => {
        e.preventDefault();
        // get data from form
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;

        // write data to db

        // send mail to verify

        setFormMessage(createAccountForm, "error", "Registration not possible!");
    });

    forgotPasswordForm.addEventListener("reset", e => {
        e.preventDefault();

        // verify input email

        // generate password

        // overwrite password in db

        // send mail

        setFormMessage(forgotPasswordForm, "error", "This email does not exist!");
    });

    document.querySelectorAll(".form__input").forEach(inputElement => {
        inputElement.addEventListener("blur", e => {
            if (e.target.id === "signupUsername" && e.target.value.length > 0 && e.target.value.length < 10) {
                setInputError(inputElement, "Username must be at least 10 characters in length.");
            }
        });

        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });
    });
});