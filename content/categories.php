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
get_profile_navigation(4);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty(trim($_POST['category_name']))) {
        $errors[] = "Insert category name";
    } else
        $category_name = $_POST['category_name'];

    if (empty($errors)) {
        CategoryModel::insertCategory($category_name);
        $success = true;
    }
}


$categories = CategoryModel::getCategories();

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
            foreach ($categories as $category) {
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<div class="col-md-4"><h3>' . htmlspecialchars($category->nom) . '</h3></div>';
                echo '<div class="col-md-2"><a href="category.php?category=' . htmlspecialchars($category->id) . '" type="button" class="btn btn-warning">Edit</a></div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            ?>
        </div>
    </div>';

<?php


get_footer();
?>