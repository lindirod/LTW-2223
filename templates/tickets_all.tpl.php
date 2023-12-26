<?php function drawTicketsAll($db, $tickets, $departments) { ?>

    <main class="tab">
                <section class="sidebar">
                    <h3>Filters</h3>
                    <label for="titleFilter">Title:</label>
                    <input type="text" id="titleFilter">
                    <br>
                    <label for="priorityFilter">Priority:</label>
                    <input type="text" id="priorityFilter">
                    <br>
                    <label for="dateFilter">Date:</label>
                    <input type="text" id="dateFilter">
                    <br>
                    <label for="agentFilter">Agent:</label>
                    <input type="text" id="agentFilter">
                    <br>
                    <label for="statusFilter">Status:</label>
                    <input type="text" id="statusFilter">
                    <br>
                    <label for="hashtagFilter">Hashtag:</label>
                    <input type="text" id="hashtagFilter">
                </section>
                
            <section class="table-container">
                <table id="filter">
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Date</th>
                        <th>Agent</th>
                        <th>Status</th>
                        <th>Hashtag</th>
                        <th>Department</th>
                    </tr>
                    <?php
                        foreach($tickets as $ticket)
                            drawTicketAll($db, $ticket, $departments);
                    ?>
                </table>
            </section>    
        </main>


    </body>

</html>    

<?php } ?>

<?php function drawTicketAll($db,$ticket,$departments) { ?>
    <tr>
        <td><a href="../pages/ticket_detail.php?ticket=<?php echo urlencode($ticket->idTicket) ?>"><?php echo $ticket->getTitle() ?></a></td>
        <td><?php echo $ticket->getPriority() ?></td>
        <td><?php echo $ticket->date ?></td>
        <td>
            <?php
                if ($ticket->status == "Opened" ){
                    echo "<i class=\"fa-solid fa-plus\"></i>";
                }
                else{
                    echo $ticket->idAgent;
                }
            ?>
        </td>
        <td><?php echo $ticket->status ?></td>
        <td><?php echo '#' . $ticket->hashtag ?></td>
        <td>
            <form action="../actions/action_updateDepartment.php" method="POST">
            <select name = "department" id="departmentSelect">
            <?php
                foreach ($departments as $department)
                    if ($department == $ticket->department)
                        echo "<option value=\"$department\" selected>$department</option>";
                    else 
                        echo "<option value=\"$department\">$department</option>";
            ?>

            </select>
            <input type="hidden" name="ticket_id" value="<?php echo $ticket->idTicket ?>">
            <button type="submit" class="save-button">
                <i class="fa-sharp fa-regular fa-floppy-disk"></i>
            </button>
            </form>

        </td>
    </tr>

    
<?php } ?>