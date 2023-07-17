<!-- enctype="multipart/form-data meaning attribute specifies how the form-data should be encoded when submitting it to the server." -->

<?php

//to add details from post 

if(isset($_POST['submit'])) {
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']); //temporary action on the side of choose file that no file chosen, image location)

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
  

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    $create_post_query = mysqli_query($connect, $query);

    confirm($create_post_query);

    $the_post_id = mysqli_insert_id($connect);

    echo "<p class='bg-success'>Post Added! <a href='../post.php?p_id= {$the_post_id}'>View Post</a> or <a href='./posts.php'>Edit More Post</a></p>";
   

}


?>


<form action="" method="post" enctype="multipart/form-data"> 

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="category">Category</label>
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
            <?php


                //this is for selecting the categories table
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connect, $query);
                confirm($select_users);

                while($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value='{$username}'>{$username}</option>";

                
                }
            
            ?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_author">Post Author </label>
        <input type="text" class="form-control" name="post_author">
    </div> -->
    <div class="form-group">
        <select name="post_status" id="">
            <option value="">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
        <!-- <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status"> -->
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="body" class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>

    <div>
        <input type="submit" name="submit" value="submit" class="btn btn-primary">
    </div>
</form>