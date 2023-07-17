<!-- ADD ADD ADD ADD ADD ADD -->

<!-- enctype="multipart/form-data meaning attribute specifies how the form-data should be encoded when submitting it to the server." -->

<?php

//to add details from post 

if(isset($_POST['create_user'])) {

    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $user_role = escape($_POST['user_role']);

    $username = escape($_POST['username']);
    $user_email = escape($_POST['email']);
    $user_password = escape($_POST['password']);

    $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10) );

    $query = "INSERT INTO `users`(`user_firstname`, `user_lastname`, `user_role`, `username`,`user_email`, `user_password` ) VALUES ('{$firstname}','{$lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";

    $create_users_query = mysqli_query($connect, $query);

    confirm($create_users_query);


    echo "<p class='bg-success'>User has been Created: " . "" . "<a href='users.php'>View Users</a>";
    


}


?>



<form action="" method="post" enctype="multipart/form-data"> 

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="">
            <option value="">Select Options</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>
    
    
    <!-- <div class="form-group">
        <label for="post_image"></label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div>
        <input type="submit" name="create_user" value="Add User" class="btn btn-primary">
    </div>
</form>