<?php
include('../includes/connect.php');

if (isset($_POST['insert_category'])) {
    $category_title = $_POST['category_title'];
    
        $insert_query = "INSERT INTO categories (cate_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Danh mục đã được thêm thành công!')</script>";
            echo "<script>window.open('index.php?insert_cate', '_self')</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm danh mục. Vui lòng thử lại.')</script>";
        }
}
?>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="category_title" 
        placeholder="Nhập tên danh mục" aria-label="Category Name" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info p-2 my-3 border-0" name="insert_category" value="Insert Category">
    </div>
</form>