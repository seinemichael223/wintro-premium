<?php
// require_once 'signup-inc.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome</title>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="stylesheet" rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container" id="container">
        <div class="sign-up">
            <form action="../includes/signup-inc.php" method="post" name="signupForm" id="signupForm" autocomplete="on" onsubmit="return(validate('signupForm'));">
                <h2>Let's get started.</h2>
                <div>
                    <!--FullName-->
                    <label for="signup-fn">Full Name<span class="star"> *</span></label>
                    <input
                        type="text"
                        name="fullname"
                        id="signup-fn"
                        placeholder="Enter Full Name"
                        required
                        aria-required="true"
                        pattern="[a-zA-Z\s]+"
                        title="Full name should only contain letters and spaces.">

                    <!--Username-->
                    <label for="signup-un">Username<span class="star"> *</span></label>
                    <input
                        type="text"
                        name="username"
                        id="signup-un"
                        placeholder="Enter Username"
                        required
                        aria-required="true"
                        pattern="[a-zA-Z\s]+">

                    <!--Phone Number-->
                    <label for="signup-phoneno">Phone Number<span class="star"> *</span></label>
                    <input
                        type="tel"
                        name="phoneno"
                        id="signup-phoneno"
                        placeholder="011-234-5678"
                        required
                        aria-required="true"
                        pattern="^\d{3}-\d{3}-\d{4}$"
                        title="Phone number must be in the format 011-234-5678.">

                    <!--Email-->
                    <label for="signup-email">Email<span class="star"> *</span></label>
                    <input
                        type="email"
                        name="email"
                        id="signup-email"
                        placeholder="Enter Email"
                        required
                        aria-required="true">

                    <!--Password-->
                    <label for="signup-password">Password<span class="star"> *</span></label>
                    <input
                        type="password"
                        name="pwd"
                        id="signup-pwd"
                        placeholder="Enter Password"
                        required
                        aria-required="true"
                        pattern="(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,8}"
                        title="Password must be 6-8 characters long, include an uppercase letter, a number, and a special character.">
                </div>
                <div class="eye1">
                    <i class="fa-solid fa-eye" id="show-signup-pwd"></i>
                </div>
                <span class="tips">Password must be 6-8 characters, include an uppercase letter, a number, and a special character.</span>


                <button type="submit" id="signupBtn">Sign Up</button>
            </form>
        </div>

        <div class="sign-in">
            <form action="../includes/login-inc.php" method="post" name="signinForm" id="signinForm" autocomplete="on" onsubmit="return(validate('signinForm'));">

                <h2>Sign In</h2>

                <div>
                    <label for="signin-email">Email<span class="star"> *</span></label>
                    <input type="text" name="email" id="signin-email" placeholder="Enter email" required>
                    <label for="signin-password">Password<span class="star"> *</span></label>
                    <input type="password" name="pwd" id="signin-pwd" placeholder="Enter Password" required>
                </div>
                <div class="eye2">
                    <i class="fa-solid fa-eye" id="show-signin-pwd"></i>
                </div>

                <a href="forgotPwd.html">Forgot Password?</a>

                <button type="submit">Log In</button>
            </form>
        </div>

        <div class="toogle-container">
            <div class="toogle">
                <div class="toogle-panel toogle-left">
                    <img src="image/wp_Logo1.png" alt="Logo">
                    <h2>Welcome to Wintro Premium</h2>
                    <p>Have an account?</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toogle-panel toogle-right">
                    <img src="image/wp_Logo1.png" alt="Logo">
                    <h2>Welcome Back!</h2>
                    <p>Don't have an account?</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>

        <div class="overlay" id="overlay">
            <i class="fa-solid fa-x" id="close"></i>
            <img src="image/tick-square.png" alt="tick">
            <h3>Congratulations!</h3>
            <p>You have successfullty registered as a Wintro Premium member.</p>
        </div>

    </div>
    <script type="text/javascript" src="login.js"></script>
</body>

</html>