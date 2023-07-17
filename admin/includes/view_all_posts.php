

<?php

include("delete_modal.php");

if(isset($_POST['checkBoxArray'])) {

    foreach($_POST['checkBoxArray'] as $postValueId) {
     $bulk_options = $_POST['bulk_options'];

        switch($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connect, $query);
                confirm($update_to_published_status);
            break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft_status = mysqli_query($connect, $query);
                confirm($update_to_draft_status);
            break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_to_delete_status = mysqli_query($connect, $query);
                confirm($update_to_delete_status);
            break;
            case 'clone':
                //select all the query from the database
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connect, $query);

                while($row = mysqli_fetch_array($select_post_query)) {
                    $post_author = escape($row['post_author']);
                    $post_title = escape($row['post_title']);
                    $post_category_id = escape($row['post_category_id']);
                    $post_status = escape($row['post_status']);
                    $post_image = escape($row['post_image']);
                    $post_tags = escape($row['post_tags']);
                    $post_content = escape($row['post_content']);
                    $post_date = escape($row['post_date']);
                }

                //add
                $query = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

                $copy_query = mysqli_query($connect, $query);

                if(!$copy_query) {
                    die('QUERY FAILED' . mysqli_error($connect));
                }
            break;
            
                
        }
    }
}


?>


<form action="" method="post">

    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
            <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href='posts.php?source=add_post'>Add New</a>
        </div>


        <thead>
            <tr>
                <th><input id="selectallboxes" type="checkbox"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Posts</th>
                <th colspan="2" class="text-center">Action</th>
                <th>Views</th>
            </tr>
        </thead>    
        <tbody>
        
            <?php 
            
                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                $select_posts = mysqli_query($connect, $query);

                while($row = mysqli_fetch_assoc($select_posts)) {
                $posts_id = escape($row['post_id']);
                $posts_author = escape($row['post_author']);
                $posts_user = escape($row['post_user']);
                $posts_title = escape($row['post_title']);
                $posts_category_id = escape($row['post_category_id']);
                $posts_status = escape($row['post_status']);
                $posts_image = escape($row['post_image']);
                $posts_tags = escape($row['post_tags']);
                $posts_comment_count = escape($row['post_comment_count']);
                $posts_date = escape($row['post_date']);
                $post_views_count = escape($row['post_views_count']);

                echo "<tr>";

                ?>
                
                <td><input class='checkboxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $posts_id;?>"></td>

                <?php
                    echo "<td>{$posts_id}</td>";

                    if(!empty($posts_author)) {
                        echo "<td>{$posts_author}</td>";
                    } elseif (!empty($posts_user)) {
                        echo "<td>{$posts_user}</td>";
                    }
                    
                    echo "<td>{$posts_title}</td>";

                    $query = "SELECT * FROM categories WHERE cat_id = $posts_category_id";
                    $select_categories_id = mysqli_query($connect, $query);

                    while($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = escape($row['cat_id']);
                    $cat_title = escape($row['cat_title']);

                    echo "<td>{$cat_title}</td>";

                    }



                    echo "<td>{$posts_status}</td>";
                    echo "<td><img width='100' class='img-responsive' src='../images/$posts_image' alt='image'></td>";
                    echo "<td>{$posts_tags}</td>";

                    //comments count
                    $query = "SELECT * FROM comments WHERE comment_post_id = $posts_id";
                    $send_comment_query = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($send_comment_query);
                    $count_comments = mysqli_num_rows($send_comment_query);

                    echo "<td><a href='post_comment.php?id=$posts_id'>{$count_comments}</a></td>";
                    echo "<td>{$posts_date}</td>";
                    echo "<td><a href='../post.php?p_id={$posts_id}'>View Post</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$posts_id}'>Edit</a></td>";
                    echo "<td><a rel='$posts_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                    // echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$posts_id}'>Delete</a></td>"; //with javascript asking for confirmation if you want to delete a file
                    echo "<td><a href='posts.php?reset={$posts_id}'>{$post_views_count}</a></td>";
                echo "</tr>"; 
            }
            
            ?>
            
            <?php
            
                if(isset($_GET['delete'])) {
                $the_post_id = $_GET['delete'];
                $query = "DELETE FROM `posts` WHERE post_id =  {$the_post_id}";
                $delete_query = mysqli_query($connect, $query);
                header("Location: posts.php");
                
            }

                if(isset($_GET['reset'])) {
                $the_post_id = escape($_GET['reset']);
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connect, $_GET['reset']) ." ";
                $reset_query = mysqli_query($connect, $query);
                header("Location: posts.php");
                
            }

            
            ?>


            <script>
            
                $(document).ready(function() {

                    $(".delete_link").on('click', function(){

                        var id = $(this).attr("rel"); //this use to select the specific link

                        var delete_url = "posts.php?delete="+ id +" ";

                        $(".modal_delete_link").attr("href", delete_url);

                        $("#myModal").modal('show');

                    });

                });
            
            </script>


        </tbody>
    </table>
    </form>