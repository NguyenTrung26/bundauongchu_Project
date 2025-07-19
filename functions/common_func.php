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

//hien thi tat ca san pham
function getAllProducts(){
    global $con;
    $query = "SELECT * FROM products ORDER BY RAND()";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        displayProductCard($row);
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
    $product_id = htmlspecialchars($product['product_id']);
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
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-primary'>Thêm vào giỏ hàng</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-sm btn-outline-secondary'>Thông tin</a>
                </div>
            </div>
        </div>
    </div>
    ";
}

//add to cart function
function addToCart() {
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $product_id = $_GET['add_to_cart'];

        // Lấy thông tin sản phẩm từ bảng products
        $query = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = mysqli_real_escape_string($con, $row['product_title']);
            $price = $row['product_price'];
            $image = mysqli_real_escape_string($con, $row['product_image']);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $check_query = "SELECT * FROM cart WHERE product_id = '$product_id'";
            $check_result = mysqli_query($con, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Nếu đã có -> tăng số lượng
                $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = '$product_id'";
                mysqli_query($con, $update_query);
            } else {
                // Nếu chưa có -> thêm mới với số lượng = 1
                $insert_query = "INSERT INTO cart (product_id, product_title, product_price, product_image, quantity) 
                                 VALUES ('$product_id', '$title', '$price', '$image', 1)";
                mysqli_query($con, $insert_query);
            }

            echo "<script>alert('Đã thêm $title vào giỏ hàng!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Sản phẩm không tồn tại!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }
}

?>


