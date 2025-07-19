<?php
// Include file connect.php
$connectPath = __DIR__ . '/../includes/connect.php';
if (file_exists($connectPath)) {
    include($connectPath);
} else {
    die("Không tìm thấy file kết nối CSDL.");
}

// function hiển thị sản phẩm mới nhất/random
function getProducts()
{
    global $con;
    if (!isset($_GET['category'])) {
        $query = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            displayProductCard($row);
        }
    }
}

// hiển thị sản phẩm theo danh mục
function get_uni_categories()
{
    global $con;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $query = "SELECT * FROM products WHERE cate_id='$category_id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 0) {
            echo "<div style='padding:20px'><h2 class='text-center text-danger'>Không có sản phẩm nào</h2></div>";
        }
        while ($row = mysqli_fetch_array($result)) {
            displayProductCard($row);
        }
    }
}

// danh sách tất cả danh mục
function getCategories()
{
    global $con;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $cate_title = htmlspecialchars($row['cate_title']);
        $cate_id = $row['cate_id'];
        echo "<li class='nav-item'>
                <a href='index.php?category=$cate_id' class='nav-link text-light'>$cate_title</a>
              </li>";
    }
}

// tìm kiếm sản phẩm
function searchProducts()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_value = trim($_GET['search_data']);
        if (empty($search_value)) {
            echo "<div style='padding:20px'><h2 class='text-center text-danger'>Vui lòng nhập từ khóa tìm kiếm</h2></div>";
            return;
        }
        $search_value = mysqli_real_escape_string($con, $search_value);
        $query = "SELECT * FROM products WHERE product_title LIKE '%$search_value%'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 0) {
            echo "<div style='padding:20px'><h2 class='text-center text-danger'>Không tìm thấy sản phẩm phù hợp</h2></div>";
        }
        while ($row = mysqli_fetch_array($result)) {
            displayProductCard($row);
        }
    }
}

// hàm dùng chung để hiển thị thẻ sản phẩm
function displayProductCard($product)
{
    $title = htmlspecialchars($product['product_title']);
    $desc = htmlspecialchars($product['product_desc']);
    $price = number_format($product['product_price']);
    $image = $product['product_image'];
    $cate_id = $product['cate_id'];

    echo "
    <div class='col-md-4 mb-4'>
        <div class='card h-100 shadow-sm'>
            <img src='./images/$image' class='card-img-top' alt='$title'>
            <div class='card-body d-flex flex-column'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text small text-muted'>$desc</p>
                <p class='fw-bold text-danger'>Giá: $price VNĐ</p>
                <div class='mt-auto'>
                    <a href='#' class='btn btn-sm btn-primary'>Thêm vào giỏ hàng</a>
                    <a href='index.php?category=$cate_id' class='btn btn-sm btn-outline-secondary'>Thông tin</a>
                </div>
            </div>
        </div>
    </div>
    ";
}
?>
