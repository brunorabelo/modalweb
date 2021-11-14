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


if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['category'])) {
    $id = $_GET['category'];
    $category = CategoryModel::getCategory($id);
}


if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['category'])) {
    $id = $_GET['category'];
    $category = CategoryModel::getCategory($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['category_id']);
    if ($_POST['send'] == 'delete') {
        CategoryModel::deleteCategory($id);
        header("location: categories.php");
    }
    if (empty(trim($_POST['category_name']))) {
        $errors[] = "Insert category name";
    } else
        $category_name = $_POST['category_name'];

    if (empty($errors)) {
        CategoryModel::updateCategory($id, $category_name);
        $success = true;
        header("location: categories.php");
    }

}
get_head();
get_header();
get_profile_navigation(4);

?>

<div class="section">
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <h3>Edit category "<?php echo $category->nom ?>"</h3>
                <input type="hidden" name="category_id" id="category_id" value="<?php echo $category->id ?>">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <input type="text" name="category_name" id="category_name"
                               placeholder="New category name" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="submit" name="send" value="update" class="btn btn-primary">Edit category</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" name="send" value="delete" class="btn btn-danger" onclick="return confirm('All the annonces related to te category will be deleted. Are you sure you want to continue?');">Delete category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

