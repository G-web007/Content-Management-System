<?php include "include/db.php"; ?>  
    <?php include "include/header.php"; ?>  


    <!-- Navigation -->
    
    <?php include "include/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

                if(isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];
                
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = '{$the_post_id}' ";
                $send_query = mysqli_query($connect, $view_query);
                if(!$send_query) {
                    die('QUERY FAILED');
                }

                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
                $selectallPosts = mysqli_query($connect, $query);

                while($row = mysqli_fetch_assoc($selectallPosts)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

            ?>


                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title;?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author;?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="Images">
                    <hr>
                    <p><?php echo $post_content;?></p> 

                    <hr>
                
                <?php }
            
            } else {
                header("Location: index.php");
            }
            
            
            
            ?>

                 <!-- Blog Comments -->


                <?php
                
                //to create or insert some details from the table comments and it is connected to the database
                if(isset($_POST['create_comments'])) {
                    $the_post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) { 

                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_Date) VALUES ({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}','Unapproved', now())";
                            $create_comments_query = mysqli_query($connect, $query);

                                if (!$create_comments_query) { 
                                    die('QUERY FAILED' . mysqli_error($connect));
                                }

                                echo "<p class='text-center bg-success'>Comment Added!</p>";

                            // this area is for the post_comment_count in order to make it dynamic
                            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            // $query .= "WHERE post_id = $the_post_id ";
                            // $update_comment_count = mysqli_query($connect, $query);

                        } else {
                            echo "<script>alert('Fields cannot be empty')</script>";
                        }
                }
                
                
                ?>



                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comments">Your Comments</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comments" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC";
                $select_comment_query = mysqli_query($connect, $query);
                if(!$select_comment_query) {
                    die('QUERY FAILED' . mysqli_error($connect));
                }

                while($row = mysqli_fetch_assoc($select_comment_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];

                ?>

                 <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <?php } ?>
 
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "include/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "include/footer.php"; ?>


