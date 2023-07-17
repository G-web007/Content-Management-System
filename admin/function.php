<?php

//to be safe from mysqli injection(escape all the database/form)
function escape($string){
    global $connect;

return mysqli_real_escape_string($connect, trim($string));

}



function users_online() {
    

    if(isset($_GET['onlineusers'])) {

    global $connect;

    if(!$connect) {
        session_start();
        include ("../include/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 5;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connect, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL) {
            mysqli_query($connect, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
        } else {
            mysqli_query($connect, "UDPATE users_online SET time = '$time' WHERE session = '$session' ");

        }
            $users_online_query = mysqli_query($connect, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_query);

    }

    

    } //get request isset()
         
}

users_online();




function confirm($result) {
    global $connect;

    if(!$result) {
        die('QUERY FAILED' . mysqli_error($connect)); 
    }
}


function insert_categories() {
    global $connect;

    if(isset($_POST['submit'])) {
        $cat_title  = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo 'This fields should not be empty!';
        } else {

            $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}') ";

            $createCategory = mysqli_query($connect, $query);

            if(!$createCategory) {
                die('QUERY FAILED' . mysqli_error($connect));
            }

        }
    }
}

function  findAllCategories() {
    global $connect;

    $query = "SELECT * FROM categories";
    $selectCategories = mysqli_query($connect, $query);
    
    while($row = mysqli_fetch_assoc($selectCategories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}


function deleteCategories() {
    global $connect;

    if(isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$deleteId}";
        $deleteQuery = mysqli_query($connect, $query);
        header("Location: categories.php");

    }
}


?>