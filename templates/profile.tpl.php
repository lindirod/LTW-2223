<?php function drawProfile(User $user, Session $session, $open, $assigned, $closed, $departments, $foreign = false) { ?>
    <section>
                <h2>Welcome to your profile!</h2>
                <h3>Here you'll be able to keep track of your tickets and their status</h3>
                
                <?php
                if (!$foreign)

                 echo "<button type = \"button\" class = \"button\" id=\"button\"> 
                    <i class=\"fa-solid fa-plus fa-bounce\"></i> 
                    Create new Ticket
                </button>";
                



                ?>

            </section>
        </nav>
        <main class="mainprofile">
                <div id="info">
                    <img src = "../images/profile.png" alt = "profile" width = "100">
                    <?php
                    if (!$foreign)
                        echo "<button id=\"editProfileButton\" type=\"button\">Edit Profile</button>";
                    else
                        echo "<a href=../actions/action_upgradeUser.php?user=$user->id>
                        <button type=\"button\" class=\"button\">
                            Upgrade User
                        </button>
                        </a>"
                    ?>

                    <?php echo "<h3>$user->name</h3>" ?>
                    <br>
                    <?php echo "<p>@$user->username</p>" ?>
                </div>

            <div id="sections">
                <section class="profile-section" style="display: none;">
                <h2 style="color: white; font-size: xx-large; text-align:center;">Edit Profile</h2>


                <form id="editProfileForm" style="display: none;" action="../actions/action_editProfile.php" method = "post">
                    <label for="name">Name</label>
                    <input class="name" type="text" id="name" name="name" value="<?php echo $user->name; ?>"><br>
                    <br>
                    <label for="username">Username</label>
                    <input class="username" type="text" id="username" name="username" value="<?php echo $user->username; ?>"><br>
                    <br>
                    <label for="password">Old Password</label>
                    <input class="password" name="password" type="password" id="psw" required autofocus>
                    <i class="fas fa-eye-slash" id="togglePasswordOld" style="margin-left: -40px; cursor: pointer; color: black;"></i>
                    <label for="password">New Password</label>
                    <input class="password" name="new_password" type="password" id="new_psw">
                    <i class="fas fa-eye-slash" id="togglePasswordNew" style="margin-left: -40px; cursor: pointer; color: black;"></i>
                    <br>
                    <label for="email">Email</label>
                    <input class="email" type="email" id="email" name="email" value="<?php echo $user->email; ?>"><br>

                    <button type="submit">Save</button>
                </form>

                </section>
                <section class="ticket-section">
                    <?php
                    if ($user instanceof Admin){
                        echo "<img src=\"../images/admin_badge.png\" alt =\"Badge of admin\">";
                    }
                    elseif($user instanceof Agent){
                        echo "<img src=\"../images/agent_badge.png\" alt =\"Badge of agent\">";
                    }
                    else{
                        echo "<img src=\"../images/client_badge.png\" alt =\"Badge of client\">";
                    }
                    ?>

                    <a href="../pages/tickets.php">Status</a>
                    <div id ="text">
                        <p style = "font-weight: 600;">Open</p>
                        <p style = "font-weight: 600;">Assigned</p>
                        <p style = "font-weight: 600;">Closed</p>
                    </div>

                    <div id="number">
                        <p class="number"><?php echo $open?></p>
                        <p class="number"><?php echo $assigned?></p>
                        <p class="number"><?php echo $closed?></p>   
                    </div>
                    
                    <span id="dots"></span>
                    <span id="more">
                        
                    <?php    
                        if($user instanceof Admin || $user instanceof Agent){
                            echo "<h2>Tickets assigned <span class=\"assigned\">$assigned</span></h2>";
                        } 

                    ?>
                    </span>
                    <?php
                        if($user instanceof Agent || $user instanceof Admin){
                            echo '<a href="../pages/departments.php"><button onclick="moreInfo()" id="btnInfo" type="button">More info</button></a>';
                        }
                        if ($foreign){
                            if ($user instanceof Agent){
                            
                            echo "<form action=\"../actions/action_assignDepartment.php\" method = \"post\">";
                            echo "<input type=\"hidden\" name=\"id\" value=\"$user->id\">";
                            echo "<select class = \"departmentsassign\" name = \"departmentsassign\">\n";
                                foreach ($departments as $department)
                                    echo "<option value =\"$department\">$department</option>\n";
                            echo "</select>\n";
                            echo "<button type = \"submit\">Assign Department</button>"; 
                            }
                        }
                    ?>
                    </form>
                </section>
                    
            </div>
        </main>
                <div class ="popup" id ="popup">
                    <form action="../actions/action_addTicket.php" method = "post" class="popup-content ">
                        <input class="email" placeholder="email" name="email" type = "hidden" value="<?php echo $user->getEmail(); ?>">

                        <img src="../images/close.png" alt ="Close" class="close">
                            <p class="write">Write your ticket here</p><br>

                            <label for="Title"><b>Title</b></label>
                            <input type="text" id="title" name="title">

                            <p>Department</p>
                            <select name = "department">
                                <?php
                                foreach ($departments as $department)
                                    echo "<option value =\"$department\">$department</option>";
                                ?>
                            </select>
                            <p>Priority</p>
                            <div class="two-column" class = "priority">
                                <div>
                                <input type="radio" id="high" name="priority" value="High">
                                <label for="high"> High</label>
                                </div>
                                <div>
                                <input type="radio" id="medium" name="priority" value="Medium">
                                <label for="medium">Medium</label>
                                </div>
                                <div>
                                <input type="radio" id="low" name="priority" value="Low" checked>
                                <label for="low">Low</label>
                                </div>
                            </div>     
                            <label for="hashtag"><b>Hashtag</b></label>
                            <input type="text" id="hashtag" name="hashtag">
                            <label for="New Ticket"><b>Description</b></label>
                            <textarea class = "description" id = "description" name = "description" name = "description" required autofocus></textarea>
                        <button type="submit" class = "button_sub"><i class="far fa-paper-plane-top"></i> Submit ticket!</button>
                    </form>
                </div>

    </body>

</html>

<?php } ?>