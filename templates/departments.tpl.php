<?php function drawBegin(Session $session, User $agent) { ?>
    <section>
                <h2>Welcome to your departments!</h2>
    </section>
        </nav>
        <main class="mainprofile">

            <div id="info">
                <img src = "../images/profile.png" alt = "profile" width = "100">
                <?php
                    if ($agent instanceof Admin) 
                        echo "<a href = \"../pages/users_all.php\"><button id=\"editProfileButton\" type=\"button\">All Users</button></a>";
                ?>
                <br>
            </div>
            <div id="section">
                    <section class="profile-section" style="display: none;">
                        <button>Create new Department</button>
                    </section>
    
<?php } ?>

<?php function drawEnd($user) { ?>
    <div class="form-container">
    <?php
    if ($user instanceof Admin){
        echo "<form class=\"addDepartment\" action=\"../actions/action_addDepartment.php\" method=\"post\">";
        echo "<label for=\"name\" id=\"namelabel\"><b>Name</b></label>";
        echo "<input type=\"text\" id=\"name\" name=\"name\">";

        echo "<label for=\"description\" id=\"descriptionlabel\"><b>Description</b></label>";
        echo "<input type=\"text\" id=\"description\" name=\"description\">";

        echo "<button id=\"newDepartment\">Create new Department</button>";
        echo "</form>";
    }
    ?>
    </div>

        </main>
</html>
    <?php } ?>

<?php function drawDepartment($department, $user, $db) { ?>
    <section class="profile-section">

    <a href="../pages/tickets_all.php?department=<?php echo urlencode($department) ?>"><?php echo $department ?></a>
            <div id ="text">
                <p style = "font-weight: 600;">Tickets Assigned to You</p>
            </div>

            <div id="number">
                <p class="number"><?php echo $user->getNumberTicketsByDepartment($db, $department)?></p>
            </div>
                    
            <span id="dots"></span>
            <span id="more"></span>
    </section>

<?php } ?>