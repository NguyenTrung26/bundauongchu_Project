<?php
include('./includes/connect.php');
include('./functions/common_func.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($con, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        die("<div class='container mt-5'><h2 class='text-center text-danger'>Không tìm thấy sản phẩm</h2></div>");
    }

    $product = mysqli_fetch_assoc($result);
    $title = htmlspecialchars($product['product_title']);
    $desc = htmlspecialchars($product['product_desc']);
    $price = number_format($product['product_price']);
    $image = $product['product_image'];
    $cate_id = $product['cate_id'];
} else {
    die("<div class='container mt-5'><h2 class='text-center text-danger'>Không có sản phẩm nào được chọn</h2></div>");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?> - Chi tiết sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary color-navbar navbar-fixed">
        <div class="container-fluid container-fluid_nav">
            <img class="logo-navbar" src="./images/logo.png" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_allproducts.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đặt món</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>

                </ul>
                <form class="d-flex" role="search" action="search_product.php" method="get">
                    <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    <input type="submit" name="search_data_product" class="btn btn-outline-success" value="Search">
                </form>
            </div>
        </div>
    </nav>
    <?php
    // cart function
    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];
        addToCart($product_id);
    }
    ?>
    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Wekcome Guest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-secondary p-3">
                <h5 class="text-light text-center mb-3">🍽 MENU</h5>
                <ul class="navbar-nav">
                    <?php 
                    getCategories(); ?>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🍜 Bún đậu thập cẩm</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🥩 Chả cốm, chả cua</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🧈 Đậu rán</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🐷 Lòng heo</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🍖 Thịt luộc</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🥤 Nước uống</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light">🍢 Ăn vặt khác</a></li>
                </ul>
            </div>

            <!-- Main Product Details -->
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="./images/<?php echo $image; ?>" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="<?php echo $title; ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <h2 class="card-title text-primary mb-3"><?php echo $title; ?></h2>
                                <p class="card-text mb-4"><?php echo $desc; ?></p>
                                <h4 class="text-danger mb-4">Giá: <?php echo $price; ?> VNĐ</h4>
                                <a href="index.php?add_to_cart=<?php echo $product_id; ?>" class="btn btn-primary me-2">
                                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                                </a>
                                <a href="index.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Go Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optional: Suggest related products here -->

            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>