<?php function drawUsersAll($users) { ?>

<main class="tab">
            <section class="sidebar">
                <h3>Filters</h3>
                <label for="idUserFilter">idUser:</label>
                <input type="text" id="idUserFilter">
                <br>
                <label for="emailFilter">E-mail:</label>
                <input type="text" id="emailFilter">
                <br>
                <label for="nameFilter">Name:</label>
                <input type="text" id="nameFilter">
                <br>
                <label for="usernameFilter">Username:</label>
                <input type="text" id="usernameFilter">
            </section>
            
        <section class="table-container">
            <table id="filter">
                    <th>idUser</th>
                    <th>E-mail</th>
                    <th>Name</th>
                    <th>Username</th>
                </tr>
                <?php
                    foreach($users as $user)
                        drawUserAll($user);
                ?>
                <!-- Add more rows as needed -->
            </table>
        </section>    
    </main>
                    


</body>
</html>    

<?php } ?>

<?php function drawUserAll($user) { ?>
<tr>
    <td>
        <a href="../pages/profile_foreign.php?user=<?php echo urlencode($user->id) ?>">
            <?php echo $user->id ?> </a>
    </td>
    <td><?php echo $user->email ?></td>
    <td><?php echo $user->name ?></td>
    <td><?php echo $user->username ?></td>
</tr>
<?php } ?>