<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-page.css">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <script defer src="login-page.js"></script>
</head>

<body>
<?php
			include('navbar.php')
		?>	

    <div class="container">

        <form class="form" id="login">
            <h1 class="form__title">Login</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" id="loginUsername" autofocus placeholder="Username or email">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" placeholder="Password">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a class="form__link" href="#" id="linkForgotPassword">Forgot your password?</a>
            </p>
            <p class="form__text">
                <a class="form__link" href="#" id="linkCreateAccount">Don't have an account? Create account</a>
            </p>
        </form>

        <form class="form form--hidden" id="createAccount">
            <h1 class="form__title">Create Account</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" id="signupUsername" class="form__input" placeholder="Username">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" placeholder="Email Address">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" placeholder="Password">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" placeholder="Confirm password">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a class="form__link" href="#" id="linkLogin">Already have an account? Sign in</a>
            </p>
        </form>

        <form class="form form--hidden" id="forgotPassword">
            <h1 class="form__title">Forgot Password</h1>
            <button class="form__button form__button--close" type="close">X</button>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" id="resetEmail" placeholder="Email">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit">Continue</button>

        </form>
        
    </div>

	<?php
			include('footer.php')
		?>
		    
</body>

</html>