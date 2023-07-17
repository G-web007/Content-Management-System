<?php include "includes/admin_header.php";?>

<?php

    if(isset($_SESSION['username'])) {
    $username  = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_profile_query = mysqli_query($connect, $query);

    while($row = mysqli_fetch_array($select_profile_query)) {
        $user_id = escape($row['user_id']);
        $username = escape($row['username']);
        $user_password = escape($row['user_password']);
        $user_firstname = escape($row['user_firstname']);
        $user_lastname = escape($row['user_lastname']);
        $user_email = escape($row['user_email']);
        $user_image = escape($row['user_image']);
        $user_role = escape($row['user_role']);

    }
}

?>

<?php

    //validate the form
    if(isset($_POST['edit_user'])) {

    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name']; //temporary action on the side of choose file that no file chosen, image location)

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');
  

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    //to update or edit the inputed info from the table 
    $query = "UPDATE `users` SET `username`= '{$username}', `user_password`= '{$user_password}', `user_firstname`= '{$firstname}', `user_lastname`= '{$lastname}', `user_email`='{$user_email}' WHERE `username`= '{$username}'";


    $update_users_query = mysqli_query($connect, $query);//to execute the database and query 

    confirm($update_users_query); //function


}   



?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

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
                            <input type="submit" name="edit_user" value="Update Profile" class="btn btn-primary">
                        </div>
                    </form>
                 
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
