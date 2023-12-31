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
                //get request

                $per_page = 5;

                if(isset($_GET['page'])) {
                    $page = $_GET['page'];

                } else {
                    $page = "";
                }

                if($page == "" || $page == 1) {
                    $page_1 = 0;

                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }



                //Pagination
                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connect, $post_query_count); 
                $count = mysqli_num_rows($find_count);

                $count = ceil($count / $per_page);

            
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page"; 
                $selectallPosts = mysqli_query($connect, $query);

                while($row = mysqli_fetch_assoc($selectallPosts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,100); //minimize the text in the post area
                    $post_status = $row['post_status'];

                    if($post_status == 'published') { //it will check the status if it's draft  or published, check the TABLE POST (published -> display it )

                    ?>
                    
                    <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                    </h1> -->

                    <!-- First Blog Post -->
            
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>"><?php echo $post_user;?></</a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></</p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id;?>">
                    <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="Images">
                    </a>
                    <hr>
                    <p><?php echo $post_content;?></</p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                
                <?php } } ?>
         
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "include/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>
        <!-- pagination -->
        <ul class="pager">
            <?php
            
            for($i = 1; $i <= $count; $i++) {

                if($i == $page) {

                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>"; //get request

                } else {

                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>"; //get request

                }

                
            }
            
            
            ?>
        </ul>


<?php include "include/footer.php";?>


