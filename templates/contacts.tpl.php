<?php function drawContacts() { ?>
    <section>
            <h2>Contact us!</h2>
            <h3>We're happy to answer any questions you have or provide you an estimate. 
            <br>Just send us a message in the form below with any questions you may have. </h3> 
        </section>
    </nav>

    <h3 style="padding: 85px 85px; font-weight: 500;">Please provide the following informations so we can receive your message!</h3> 
        <main class="row"> 
            <form class = "forms">
                    <label for="user_name">Name:</label><br>
                    <input type="text" id="user_name" name="fname" required autofocus><br>
                    <br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required><br><br>
                    <br>
                    <label for="message">Enter your message:</label><br><br>
                    <textarea id = "message" name = "message" required></textarea>
                    <br>
                    <br>
                    <input type="submit" value="Submit">
                </form>
        
            <div class="informations">  
                <h3> <i class="fa-regular fa-at"></i>  Email</h3>
                <p>info@FEUPTech.com</p>
                <br>
                <h3> <i class="fas fa-phone"></i> Phone number</h3>
                <p>+315 180 180 360</p>
            </div>
        </main>
</body>
</html>


<?php } ?>