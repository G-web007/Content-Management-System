

<?php

//get from the URL
if(isset($_GET['p_id'])) {
    $the_post_id = escape($_GET['p_id']);
}

// selecting the table posts from the database
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

//detect the form when it submitted, check the name of update post(submit button)
if(isset($_POST['submit'])) {

    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']); //temporary action on the side of choose file that no file chosen, image location)
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);

    move_uploaded_file($post_image_temp, "../images/$post_image"); //moving the temporay location to a permanent location(copying the image to another folder)
    
    //this is to for the insert some image
    if(empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

        $select_image = mysqli_query($connect, $query); //to send the query asign it to the variables

        while($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }


    //query for updating the posts tables
    $query = "UPDATE `posts` SET `post_category_id`={$post_category_id},`post_title`='{$post_title}',`post_user`='{$post_user}',`post_date`=now() ,`post_image`='{$post_image}',`post_content`='{$post_content}',`post_tags`='{$post_tags}',`post_status`='{$post_status}' WHERE `post_id`={$the_post_id} ";

    $update_post = mysqli_query($connect, $query);

    confirm($update_post);

    echo "<p class='bg-success'>Post Updated: <a href='../post.php?p_id= {$the_post_id}'>View Post</a> or <a href='./posts.php'>Edit More Post</a></p>";
    
}



?>


<!-- HTML FORM FOR EDITING THE POSTS table -->

<form action="" method="post" enctype="multipart/form-data"> 

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title;?>">
    </div>
    <div class="form-group">
        <label for="categories">Categories</label>
        <select name="post_category_id" id="">


            <?php


                //this is for selecting the categories table
                $query = "SELECT * FROM categories";
                $select_categories_id = mysqli_query($connect, $query);

                confirm($select_categories_id);

                while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";

                
                }
            
            ?>

        
        
        </select>

    </div>
    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">

        <?php echo "<option value='{$post_user}'>{$post_user}</option>";?>

            <?php


                //this is for selecting the categories table
                $query = "SELECT * FROM users";
                $edit_users = mysqli_query($connect, $query);
                confirm($edit_users);

                while($row = mysqli_fetch_assoc($edit_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value='{$username}'>{$username}</option>";

                
                }
            
            ?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_author">Post Author </label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author;?>">
    </div> -->
    <div class="form-group">
        <select name="post_status" id="">
          
            <option value="<?php echo $post_status?>"><?php echo $post_status?></option>

            <?php
            
            if($post_status == 'published') {
                echo "<option value='draft'>Draft</option>"; 
            } else {
                echo "<option value='published'>Published</option>"; 
            }
            
       
            ?>
        
        </select>
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image;?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags;?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="editp" class="form-control" name="post_content" cols="30" rows="10" ><?php echo $post_content;?></textarea>
    </div>

    <div>
        <input type="submit" name="submit" value="Update Post" class="btn btn-primary">
    </div>
</form>
