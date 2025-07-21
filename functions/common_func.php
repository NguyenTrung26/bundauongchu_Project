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
function getAllProducts()
{
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
function addToCart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress();
        $product_id = $_GET['add_to_cart'];

        // Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
        $check_product = "SELECT * FROM `cart` WHERE ip_address='$ip' AND product_id='$product_id'";
        $result_check = mysqli_query($con, $check_product);

        if (mysqli_num_rows($result_check) > 0) {
            // Nếu đã tồn tại → cập nhật tăng quantity lên 1
            $update_query = "UPDATE `cart` SET quantity = quantity + 1 WHERE ip_address='$ip' AND product_id='$product_id'";
            mysqli_query($con, $update_query);
            echo "<script>alert('Đã cập nhật số lượng sản phẩm trong giỏ hàng')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            // Nếu chưa có → thêm mới với quantity = 1
            $insert_query = "INSERT INTO `cart` (product_id, ip_address, quantity) VALUES ('$product_id', '$ip', 1)";
            mysqli_query($con, $insert_query);
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}


// get IP address
function getIPAddress()
{
    // whether IP is from the shared internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // whether IP is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // whether IP is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// $ip = getIPAddress();  
// echo 'User Real IP Address - ' . $ip;  

// displaying number of items in cart 
function display_cart_item()
{
    global $con;
    $ip = getIPAddress();
    $count_items = "SELECT * FROM `cart` WHERE ip_address='$ip'";
    $result_count = mysqli_query($con, $count_items);
    $count = mysqli_num_rows($result_count);
    echo $count;
}

// Getting Total price 
function get_total_price()
{
    global $con;
    $ip = getIPAddress();
    $total = 0;

    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
    $result = mysqli_query($con, $cart_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        $select_product = "SELECT product_price FROM `products` WHERE product_id='$product_id'";
        $result_product = mysqli_query($con, $select_product);

        if ($row_product = mysqli_fetch_assoc($result_product)) {
            $price = $row_product['product_price'];
            $subtotal = $price * $quantity; // ✅ nhân số lượng
            $total += $subtotal;
        }
    }

    echo number_format($total); // định dạng đẹp 12,000,...
}
// function get_total_price()
// {
//     global $con;
//     $ip = getIPAddress();
//     $total = 0;
//     $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
//     $result = mysqli_query($con, $cart_query);
//     while ($row = mysqli_fetch_assoc($result)) {
//         $product_id = $row['product_id'];
//         $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
//         $result_products = mysqli_query($con, $select_products);
//         while ($row_product_price = mysqli_fetch_array($result_products)) {
//             $product_price = array($row_product_price['product_price']);
//             $price_table = $row_product_price['product_price'];
//             $product_values = array_sum($product_price);
//             $total += $product_values;
//         }
//     }
//     echo $total;
// }
?>
