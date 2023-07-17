    <div class="col-md-4">

        
        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>

            <!-- form -->
            <form action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="submit">
                            <span class="glyphicon glyphicon-search"></span>
                    </button>
                    </span>
                </div>
                <!-- /.input-group -->
            </form> 
            <!-- end search form -->
            
        </div>

        <!-- LOGIN -->
        <div class="well">
            <h4>Login</h4>

            <!-- form for log in -->
            <form action="include/login.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </span>
                </div>
          
                <!-- /.input-group -->
            </form>
            
        </div>

        <!-- Blog Categories Well -->
        <div class="well">

            <?php 
            
                $query = "SELECT * FROM categories";
                $selectcatBlog = mysqli_query($connect, $query);
            
            ?>


            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">

                        <?php 
                        
                            while($row = mysqli_fetch_assoc($selectcatBlog)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
            
                            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                            }
                        ?>

                    </ul>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <?php include "widget.php";?>

    </div> 