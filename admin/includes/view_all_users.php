
   <!-- READ READ READ READ READ -->
   
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th colspan="4" class="text-center">Action</th>
            </tr>
        </thead>    
        <tbody>
        
            <?php 
            
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connect, $query);
                while($row = mysqli_fetch_assoc($select_users)) {
                $user_id = escape($row['user_id']);
                $username = escape($row['username']);
                $user_password = escape($row['user_password']);
                $user_firstname = escape($row['user_firstname']);
                $user_lastname = escape($row['user_lastname']);
                $user_email = escape($row['user_email']);
                $user_image = escape($row['user_image']);
                $user_role = escape($row['user_role']);
        

                echo "<tr>";
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$user_firstname}</td>";


                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";
                    echo "<td>{$user_role}</td>";

                    //code for "in response to"
                    // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    // $select_post_id_query = mysqli_query($connect, $query);
                    // while($row = mysqli_fetch_assoc($select_post_id_query)) {
                    // $post_id = $row['post_id'];
                    // $post_title = $row['post_title'];   

                    // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                


                   
                    echo "<td><a href='users.php?change_to_admin={$user_id}'>admin</a></td>";
                    echo "<td><a href='users.php?change_to_sub={$user_id}'>subscriber</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                    echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?');\"href='users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>"; //with javascript asking for confirmation if you want to delete a file
                }
            
            ?>

            <?php

        
                if(isset($_GET['change_to_admin'])) {
                $the_users_id= $_GET['change_to_admin'];
                $query = "UPDATE users SET user_role =  'admin' WHERE `user_id`='$the_users_id'";
                $admin_query = mysqli_query($connect, $query);
                header("Location: users.php");
    
                }

                if(isset($_GET['change_to_sub'])) {
                    $the_users_id= $_GET['change_to_sub'];
                    $query = "UPDATE users SET user_role =  'subscriber' WHERE `user_id`='$the_users_id'";
                    $sub_query = mysqli_query($connect, $query);
                    header("Location: users.php");
        
                    }


                //this is the delete function
                if(isset($_GET['delete'])) {
                    if(isset($_SESSION['user_role'])) {
                        if($_SESSION['user_role'] == 'admin') {
 
                        $the_users_id= mysqli_real_escape_string($connect, $_GET['delete']);
                        $query = "DELETE FROM `users` WHERE `user_id` =  {$the_users_id}";
                        $delete_query = mysqli_query($connect, $query);
                        header("Location: users.php");
                
                    }
                }
            }

            
            ?>


        </tbody>
    </table>