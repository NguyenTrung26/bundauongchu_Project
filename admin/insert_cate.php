<?php
include('../includes/connect.php');

if (isset($_POST['insert_category'])) {
    $cate_title = $_POST['cate_title'];

    // select query to check if the category already exists
    $select_query = "SELECT * FROM categories WHERE cate_title = '$cate_title'";
    $result_select = mysqli_query($con, $select_query);
    if (mysqli_num_rows($result_select) > 0) {
        echo "<script>
        alert('Danh mục đã tồn tại. Vui lòng nhập tên khác.');
        window.location.href = 'index.php?insert_cate';
    </script>";
        return;
    }

    $insert_query = "INSERT INTO categories (cate_title) VALUES ('$cate_title')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<script>alert('Danh mục đã được thêm thành công!')</script>";
        echo "<script>window.open('index.php?insert_cate', '_self')</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm danh mục. Vui lòng thử lại.')</script>";
    }
}
?>
<h2 class="text-center">Insert Category</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cate_title"
            placeholder="Nhập tên danh mục" aria-label="Category Name" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info p-2 my-3 border-0" name="insert_category" value="Insert Category">
    </div>
</form>