<?php

require_once "../models/UserModel.php";
require_once 'utils/utils.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isLoggedIn() || !isAdmin()) {
    header("location: index.php");
    exit;
}
$success = false;
$category_name = '';

get_head();
get_header();
get_profile_navigation(3);




$users = UserModel::getAllUsers();

?>
    <div class="section">
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <input type="text" name="category_name" id="category_name"
                                   placeholder="Category name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">';
            <?php
            foreach ($users as $user) {
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<div class="col-md-4"><h3>' . $user->email . '</h3></div>';
                echo '<div class="col-md-2"><a href="admin.php?user=' . $user->email . '" type="button" class="btn btn-warning">Edit</a></div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>';

<?php


get_footer();
?>