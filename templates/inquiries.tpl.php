<?php function drawInquiries($inquiries, $ticket, $user, $changes){ ?>

    <aside class = "changes">
        <?php
            foreach($changes as $change)
                drawChange($change)
        ?>
    </aside>

    <main class = inquiries>
            <section class="clients">

            <?php
                if($user->id == $ticket->idAgent)
                    echo "<a href = \"../actions/action_closeTicket.php?ticket=" . urlencode($ticket->idTicket) . "\"><button>Close</button></a>";
            ?>
            </section>
            <section class="chat">
                <section class="container">
                    <h2>Client Chat</h2>
                    <div id="message-container">
                        
                        <?php
                            
                            echo "<div class=\"message agent-message\">Ticket n. $ticket->idTicket</div>";

                            foreach ($inquiries as $inquirie)
                                if ($inquirie->idUser === $user->id)
                                    echo "<div class=\"message user-message\">$inquirie->content</div>";
                                else
                                    echo "<div class=\"message agent-message\">$inquirie->content</div>"
                        ?>
                    </div>
                </section>
                <input type="text" id="chat-input" placeholder="Write your message" title="Type in a message" autofocus>
            </section>
        </main>

        <script>
                function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }

            const chatInput = document.getElementById("chat-input");
            const messageContainer = document.getElementById("message-container");

            chatInput.addEventListener("keyup", function (event) {
                if (event.keyCode === 13) {
                    const message = chatInput.value.trim();
                    if (message !== "") {
                        addMessage(message, true);
                        chatInput.value = "";
                    }
                }
            });

            function addMessage(message, isUser) {
            const messageElement = document.createElement("div");
            messageElement.classList.add("message");
            messageElement.textContent = message;

            if (isUser) {
                messageElement.classList.add("user-message");       
            } else {
                messageElement.classList.add("received-message");
            }

            messageContainer.appendChild(messageElement);
            messageContainer.scrollTop = messageContainer.scrollHeight;

            var ticketValue = "<?php echo $ticket->idTicket; ?>";

            window.location.replace('../actions/action_insert_message.php?idTicket=' + ticketValue + '&content=' + message);
            }

        </script>
            
    </body>
</html>


<?php } ?>

<?php function drawChange($change){ ?>

    <section class = "change">
        <h3 class = "change_type">
            <?php
                if ($change instanceof HashTagChange)
                    echo "HashTag Change";
                else if ($change instanceof DepartmentChange)
                    echo "Department Change";
                else if ($change instanceof DescriptionChange)
                    echo "Description Change";
                else 
                    echo "Agent Change"
            ?>
        </h3>
        <p class = "change_info">
        <?php
                if ($change instanceof HashTagChange)
                    echo "Old hashtag: $change->oldHashtag";
                else if ($change instanceof DepartmentChange)
                    echo "Old Department: $change->oldDepartment";
                else if ($change instanceof DescriptionChange)
                    echo "Old Description: $change->oldDescription";
                else 
                    echo "Old Agent: $change->oldAgent"
            ?>
        </p>
        <p class = "change_info">
            <?php
                echo $change->date;
            ?>
        </p>
    </section>

<?php } ?>