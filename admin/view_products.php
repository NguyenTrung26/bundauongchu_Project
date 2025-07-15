<?php
include('../includes/connect.php');
// Câu truy vấn đúng theo bảng của bạn
$query = "SELECT * FROM products ";
$result = mysqli_query($con, $query);
?>

<div class="container">
    <h2 class="text-center my-4">📦 Danh sách sản phẩm</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Ngày thêm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['status_product'] == 'true'
                        ? "<span class='badge bg-success'>Hiển thị</span>"
                        : "<span class='badge bg-secondary'>Ẩn</span>";

                    echo "<tr>";
                    echo "<td>{$row['product_id']}</td>";
                    echo "<td>{$row['product_title']}</td>";
                    echo "<td>{$row['product_desc']}</td>";
                    echo "<td>" . number_format($row['product_price']) . "đ</td>";
                    echo "<td><img src='../images/{$row['product_image']}' width='80'></td>";

                    echo "<td>" . ($row['cate_title'] ?? 'Không rõ') . "</td>";
                    echo "<td>$status</td>";
                    echo "<td>{$row['date_product']}</td>";
                    echo "<td>
                        <a href='index.php?edit_product={$row['product_id']}' class='btn btn-sm btn-warning'>Sửa</a>
                        <a href='index.php?delete_product={$row['product_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Bạn có chắc muốn xóa?')\">Xóa</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
