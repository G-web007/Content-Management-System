<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>

 <?php
 
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($password)) {

        $username = mysqli_real_escape_string($connect, $username);
        $email = mysqli_real_escape_string($connect, $email);
        $password = mysqli_real_escape_string($connect, $password);

        $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12) );



        // $query = "SELECT randsalt FROM users";
        // $select_randsalt_query = mysqli_query($connect, $query);
        // if(!$select_randsalt_query) {
        //     die('QUERY FAILED' . mysqli_error($connect));
        // }

        // $row = mysqli_fetch_assoc($select_randsalt_query); 
        // $salt = $row['randsalt'];
        

        $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
        $register_user_query = mysqli_query($connect, $query);
        if(!$register_user_query) {
            die('QUERY FAILED' . mysqli_error($connect) .' '. mysqli_errno($connect));
        }

        $message =  "Your Registration is Submitted!";

        } else {

            $message = "Fields cannot be empty!";

        }   

 } else {
     $message = "";
 }


 ?>


    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    

<!-- log in form -->
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <!-- to display the message to the form  -->
                        <h5 class="text-center bg-success"><?php echo $message;?></h5> 
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
