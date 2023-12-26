<?php function drawMainHeader(Session $session) { ?>

<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <title>FEUPTech</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale=1.0">
        <link href="css/index_style.css" rel="stylesheet">
        <link href="css/footer_style.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="images/favicon.ico">
        <script src="https://kit.fontawesome.com/38229b6c34.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <h1>FEUPTech</h1>
            <h3>FEUPTech: Your One-Stop Solution for Streamlined Ticket Management</h3>
            <div id="signup">
                <?php
                if (!$session->isLoggedIn()){
                echo "<a href=\"../pages/register.php\">Register</a>";
                echo "<a href=\"../pages/login.php\">Login</a>";
                }
                else{
                    echo "<a href =\"../pages/profile.php\"><i class=\"fa-solid fa-user\"></i> Profile</a>";
                    echo "<form action=\"../actions/action_logout.php\" method=\"post\" class=\"logout\">
                    <a href = \"../pages\" onclick=\"this.parentNode.submit(); return false;\">Logout</a>
                  </form>
                  ";
                }
                ?>
            </div>
        </header>
        <nav id="menu">
                <h2>
                    <img src="images/FAQ.png" alt="Frequently Asked Questions image">
                    <a href="../pages/faq.php"><i class="fa-solid fa-arrow-right"></i></a>
                </h2>
                <h2>
                    <img src="images/About.png" alt="About Us Image">
                    <a href="../pages/about_us.php"><i class="fa-solid fa-arrow-right"></i></a>
                </h2>
                <h2>
                    <img src="images/Contacts.png" alt="Contacts Image">
                    <a href="../pages/contacts.php"><i class="fa-solid fa-arrow-right"></i></a>
                </h2>
        </nav> 
<?php } ?>

