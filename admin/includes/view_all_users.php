<div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>         
        </tr>
    </thead>
    <tbody>
        <?php
            deleteUser();
            $users = getAllUsers();
            while($row = mysqli_fetch_assoc($users)) {                
                ?>
                <tr>
                    <?php                        
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td><img class='img-responsive' src='../images/" . $row['user_image'] . "'></td>";                  
                        echo "<td>" . $row['user_username'] . "</td>";
                        echo "<td>" . $row['user_firstname'] . "</td>";
                        echo "<td>" . $row['user_lastname'] . "</td>";
                        echo "<td>" . $row['user_email'] . "</td>";
                        echo "<td>" . $row['user_role'] . "</td>";
                    ?>
                    <td>
                        <a class="btn-sm btn-warning" href="?source=edit&update_user=<?php echo $row['user_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="btn-sm btn-danger" href="?delete_user=<?php echo $row['user_id']; ?>">Delete</a>
                    </td>
                </tr>                                        
                <?php
            }
        ?>
    </tbody>
    </table>
</div>
