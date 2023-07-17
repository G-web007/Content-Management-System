<?php include "includes/admin_header.php";?>

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
                            <!-- to change the name in the admin welcome section -->
                            <small><?php echo $_SESSION['username'];?></small> 
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
    
    
    
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comments</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Action</th>
            </tr>
        </thead>    
        <tbody>
        
            <?php 
            
                $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connect, $_GET['id']) . "";
                $select_comments = mysqli_query($connect, $query);

                while($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = escape($row['comment_id']);
                $comment_post_id = escape($row['comment_post_id']);
                $comment_author = escape($row['comment_author']);
                $comment_content = escape($row['comment_content']);
                $comment_email = escape($row['comment_email']);
                $comment_status = escape($row['comment_status']);
                $comment_date = escape($row['comment_date']);
        

                echo "<tr>";
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";


                    echo "<td>{$comment_email}</td>";
                    echo "<td>{$comment_status}</td>";

                    //code for "in response to"
                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $select_post_id_query = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_assoc($select_post_id_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];   

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                }


                    echo "<td>{$comment_date}</td>";
                    echo "<td><a href='post_comment.php?approved=$comment_id&id=" . $_GET['id'] . "'>Approved</a></td>";
                    echo "<td><a href='post_comment.php?unapproved=$comment_id&id=" . $_GET['id'] . "'>Unapproved</a></td>";
                    echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?');\" href='post_comment.php?delete=$comment_id&id=". $_GET['id'] ."'>Delete</a></td>";
                    echo "</tr>"; //with javascript asking for confirmation if you want to delete a file
            }
            
            ?>

            <?php

                //this area is for the status (comments table status)
                if(isset($_GET['unapproved'])) {
                $the_comment_id= $_GET['unapproved'];
                $query = "UPDATE comments SET comment_status =  'unapproved' WHERE comment_id='$the_comment_id'";
                $unapprove_query = mysqli_query($connect, $query);
                header("Location: post_comment.php?id=" . $_GET['id'] . "");
    
                }

                if(isset($_GET['approved'])) {
                    $the_comment_id= $_GET['approved'];
                    $query = "UPDATE comments SET comment_status =  'approved' WHERE comment_id='$the_comment_id'";
                    $approve_query = mysqli_query($connect, $query);
                    header("Location: post_comment.php?id=" . $_GET['id'] . "");
        
                    }


                //this is the delete function
                if(isset($_GET['delete'])) {
                $the_comment_id= $_GET['delete'];
                $query = "DELETE FROM `comments` WHERE comment_id =  {$the_comment_id}";
                $delete_query = mysqli_query($connect, $query);
                header("Location: post_comment.php?id=" . $_GET['id'] . "");
                
            }

            
            ?>


        </tbody>
    </table>

    </div>
                    <!-- /.container-fluid -->


                </div>
                <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php";?>
