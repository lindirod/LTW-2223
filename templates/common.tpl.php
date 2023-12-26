<?php function drawHeader(Session $session) { ?>
    <!DOCTYPE html>
<html lang = "en-Us">

    <head>
        <title>FEUPTech</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale=1.0">
        <link href="../css/nav_style.css" rel="stylesheet">
        <link href="../css/contacts_style.css" rel="stylesheet">
        <link href="../css/profile_style.css" rel="stylesheet">
        <link href="../css/newTicket.css" rel="stylesheet">
        <link href="../css/about_style.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
        <script src="https://kit.fontawesome.com/38229b6c34.js" crossorigin="anonymous"></script>
        <script src="../javascript/profile.js" defer></script>
    </head>

    <body>
        
        <nav>
        <div class = "navbar">
            <a href = "../pages"><img src ="../images/logo.png" alt = "logo"></a>
            <ul class = "navigation">
                <li class = "nav-elem"><a href = "../pages"></a></li>
                <li class = "nav_elem"><a href = "../pages/contacts.php"><i class="fa-solid fa-address-book"></i> Contacts</a></li>
                <li class = "nav_elem"><a href = "../pages/about_us.php"><i class="fas fa-circle-info"></i> About Us</a></li>
                <li class = "nav_elem"><a href = "../pages/faq.php"><i class="fa-solid fa-question"></i> FAQ</a></li>
                <?php
                if (!$session->isLoggedIn()){
                        echo "<li class = \"nav-elem\"><a href=\"../pages/register.php\">Register</a></li>";
                        echo "<li class = \"nav-elem\"><a href=\"../pages/login.php\">Login</a></li>";
                    }
                    else{
                        echo "<li class = \"nav-elem\"><a href =\"../pages/profile.php\"><i class=\"fa-solid fa-user\"></i> Profile</a></li>";
                        echo "<form action=\"../actions/action_logout.php\" method=\"post\" class=\"logout\"><a href = \"#\" type=\"submit\" onclick=\"this.parentNode.submit(); return false;\">Logout</a></form>";
                    }
                ?>
            </ul>
        </div>

<?php } ?>



<?php function drawFooter() { ?>
        <footer class="footer">
            <h4 class="sm-header">Follow us on</h4>
            <div class="line"></div>
            <ul class="footer-list">
                <li class="footer-item">
                <a href="#" class="footer-link"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="footer-item">
                <a href="#" class="footer-link"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="footer-item">
                <a href="#" class="footer-link"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="footer-item">
                <a href="#" class="footer-link"><i class="fab fa-linkedin-in"></i></a>
                </li>
            </ul>
        </footer>
    </body>
</html>
<?php } ?>

