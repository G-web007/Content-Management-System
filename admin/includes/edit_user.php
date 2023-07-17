
<!-- UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE -->

<!-- enctype="multipart/form-data meaning attribute specifies how the form-data should be encoded when submitting it to the server." -->

<?php

//this is details from the database
if(isset($_GET['edit_user'])) {
   $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_user_id = mysqli_query($connect, $query);

    //selecting the row of the table structure name from the database
    while($row = mysqli_fetch_assoc($select_user_id)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

    }



?>

<?php

//to EDIT/UPDATE details from users table

if(isset($_POST['edit_user'])) {

    $firstname = escape($_POST['user_firstname']);
    $lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    $post_date = date('d-m-y');

    if(!empty($user_password)) {

        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connect, $query_password);
        confirm($get_user_query);
        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];

        if($db_user_password !== $user_password) {
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    }

        $query = "UPDATE `users` SET `username`= '{$username}', `user_password`= '{$user_password}', `user_firstname`= '{$firstname}', `user_lastname`= '{$lastname}', `user_email`='{$user_email}', `user_role`= '{$user_role}' WHERE `user_id`= {$the_user_id}";
        $update_users_query = mysqli_query($connect, $query);
        confirm($update_users_query); //function
    
        echo "<p class='bg-success'>Users Updated: <a href='./users.php'>View Users</a>";
    
    }

    }

    } else {
        header("Location: index.php");
}

?>

<form action="" method="post" enctype="multipart/form-data"> 

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>" >
    </div>
    
    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role?>"><?php echo $user_role?></option>

            <?php 
            
            if($user_role == 'admin') {

                echo "<option value='subscriber'>subscriber</option>";

            } else {
                echo "<option value='admin'>admin</option>";
            }
            
            
            ?>
            
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username;?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control" value="<?php echo $user_email;?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input autocomplete="off" type="password" name="user_password" class="form-control">
    </div>

    <div>
        <input type="submit" name="edit_user" value="Edit User" class="btn btn-primary">
    </div>
</form>



