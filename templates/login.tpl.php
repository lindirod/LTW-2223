<?php function drawLogin(){ ?>

<!DOCTYPE html>
    <html lang = "en-Us">

    <head>
        <title>FeupTech</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale=1.0">
        <link href="../css/navLogin_style.css" rel="stylesheet">
        <link href="../css/login_style.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
        <script src="https://kit.fontawesome.com/38229b6c34.js" crossorigin="anonymous"></script>
        <script src="../javascript/toggle.js" defer></script>
    </head>

    <body>
        
        <nav>
            <a href = "../pages"><img src ="../images/logo.png" alt = "logo"></a>
            <ul class = "navigation">
                <li class = "nav_elem"><a href = "../pages/inquiries.php"><i class="fa-solid fa-list-check"></i> Inquiries</a></li>
                <li class = "nav_elem"><a href = "../pages/contacts.php"><i class="fa-solid fa-address-book"></i> Contacts</a></li>
                <li class = "nav_elem"><a href = "../pages/about_us.php"><i class="fas fa-circle-info"></i> About Us</a></li>
                <li class = "nav_elem"><a href = "../pages/faq.php"><i class="fa-solid fa-question"></i> FAQ</a></li>
            </ul>
        </nav>
        <main class="general_container">  
            <section class="column">
                <form action="../actions/action_login.php" method="post">
                        <div class="imgcontainer">
                            <img src='../images/profile.png' alt="Avatar" class="avatar">
                        </div>
                        
                        <div class="container">
                            <label for="email"><b>Email</b></label>
                            <input type="email" class="username" placeholder="Enter Email" name="email" required autofocus>
                            <i class="fas fa-user" style="margin-left: -40px;"></i>
                            
                
                        
                            <label for="psw"><b>Password</b></label>
                            <input name ="password" type="password" placeholder="Enter Password" id="psw" required>
                            <i class="fas fa-eye-slash" id="togglePassword" style="margin-left: -40px; cursor: pointer;"></i>
                                
                            <button type="submit"><a style="text-decoration: none; color: #f1f1f1;" href="../pages/profile.php">Login</a></button>
                            <label>
                            <input type="checkbox" checked="checked" name="remember" style="background-color: #5A4ECE; cursor: pointer;" > Remember me
                            </label>
                            <br>
                            <a href="../pages" >Forgot your password?</a> 
    
                        </div>
    
                        <div class="container1">
                            <button class="cancelbtn"><a style="text-decoration: none; color: aliceblue;" href="../pages">cancel</a></button>
                            <span class="psw">Don't have an account? <a href="../pages/register.php">Sign up</a></span>
                        </div>
                </form>
                <div class="colimgcont">
                    <h2>FeupTech - Sign in</h2>
                    <h2 class="subtitle">Welcome to FeupTech! Use your login credentials.</h2>
                    <img src='../images/login_mock.png' alt="mockup" class="mockup">
                </div>
            </section>
        </main>
    </body>
    
    
</html>
    
<?php } ?>