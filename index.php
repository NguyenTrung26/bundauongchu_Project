<?php
session_start();
include 'model/pdo.php';
include 'model/sanpham.php';
include 'model/danhmuc.php';
include 'model/taikhoan.php';
include 'model/cart.php';
include 'view/header.php';
// include 'view/introduce.php';

if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = [];
}

$spnew = sanpham_loadall_home();
$dmsp = danhmuc_loadall();
$dstop10 = sanpham_loadall_top10();
if ((isset($_GET['act'])) && ($_GET['act'] != '')) {
    $act = $_GET['act'];
    switch ($act) {
        case 'sanpham':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }
            $dssp = sanpham_loadall($kyw, $iddm);
            $tendm = load_ten_danhmuc($iddm);
            include 'view/sanpham.php';
            break;
        case 'sanphamct':
            if (isset($_GET['idsp']) && ($_GET['idsp'] > 0)) {
                $id = $_GET['idsp'];
                $onesp = sanpham_loadone($id);
                extract($onesp);
                $spcungloai = sanpham_load_cungloai($id, $iddm);

                include 'view/sanphamct.php';
            } else {
                include 'view/home.php';
            }
            break;
        case 'dangky':
            if (isset($_POST['dangky']) && ($_POST['dangky'])) {
                $email = $_POST['email'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                taikhoan_insert($email, $user, $pass);
                $thongbao = "Đăng ký thành công";
            }
            include 'view/taikhoan/dangky.php';
            break;
        case 'dangnhap':
            if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $tk = checkuser($user, $pass);
                if (is_array($tk)) {
                    $_SESSION['user'] = $tk;
                    // $thongbao = "Đăng nhập thành công";
                    header('location:index.php');
                } else {
                    $thongbao = "Đăng nhập thất bại";
                }
            }
            include 'view/taikhoan/dangnhap.php';
            break;
        case 'edit_taikhoan':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $addr = $_POST['addr'];
                $phone = $_POST['phone'];
                $id = $_POST['id'];
                taikhoan_update($id, $user, $pass, $email, $addr, $phone);
                $_SESSION['user'] = checkuser($user, $pass);
                // $thongbao = "Cập nhật thành công";
                header('location:index.php?act=edit_taikhoan');
            }
            include 'view/taikhoan/edit_taikhoan.php';
            break;
        case 'quenmk':
            if (isset($_POST['guiemail']) && ($_POST['guiemail'])) {
                $email = $_POST['email'];
                $checkemail = quenmk($email);
                if (is_array($checkemail)) {
                    $thongbao = "Mật khẩu của bạn là: " . $checkemail['pass'];
                } else {
                    $thongbao = "Email không tồn tại";
                }
                // $thongbao = "Cập nhật thành công";
            }
            include 'view/taikhoan/quenmk.php';
            break;
        case 'addtocart':
            if (isset($_POST['addtocart']) && ($_POST['addtocart'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $qty = 1;
                $thanhtien = $price * $qty;
                $spadd = [$id, $name, $img, $price, $qty, $thanhtien];
                array_push($_SESSION['mycart'], $spadd);
                // if (isset($_SESSION['cart'][$id])) {
                //     $_SESSION['cart'][$id]['qty'] += 1;
                // } else {
                //     $_SESSION['cart'][$id] = array('id' => $id, 'name' => $name, 'img' => $img, 'price' => $price, 'qty' => $qty);
                // }
            }
            include 'view/cart/viewcart.php';
            break;
        case 'delcart':
            if (isset($_GET['idcart'])) {
                $idcart = $_GET['idcart'];
                unset($_SESSION['mycart'][$idcart]);
                $_SESSION['mycart'] = array_values($_SESSION['mycart']); // Reindex the array
            } else {
                unset($_SESSION['mycart']);
            }

            header('location:index.php?act=viewcart');
            break;
        case 'viewcart':
            include 'view/cart/viewcart.php';
            break;
        case 'bill':
            if (isset($_POST['apply_discount'])) {
                $code = trim($_POST['discount_code']);
                include "model/discount.php";

                $discount = checkDiscountCode($code);

                if ($discount) {
                    $_SESSION['discount_percent'] = $discount['discount_percent'];
                    $_SESSION['discount_code'] = $discount['code'];
                    $msg = "<p style='color:green'>Áp dụng mã giảm giá thành công: -{$discount['discount_percent']}%</p>";
                } else {
                    unset($_SESSION['discount_percent'], $_SESSION['discount_code']);
                    $msg = "<p style='color:red'>Mã giảm giá không hợp lệ hoặc đã hết hạn!</p>";
                }
            }
            include "view/cart/bill.php";
            break;

        case 'billconfirm':
            if (isset($_POST['dongydathang']) && ($_POST['dongydathang'])) {
                if (isset($_SESSION['user'])) $iduser = $_SESSION['user']['id'];
                else $iduser = 0;

                $name = $_POST['user'];
                $addr = $_POST['addr'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $pttt = $_POST['pttt'];
                $ngaydathang = date('Y-m-d H:i:s');
                $tongdonhang = tongdonhang();

                // Lấy thông tin giảm giá từ session
                $discount_percent = $_SESSION['discount_percent'] ?? 0;
                $discount_code = $_SESSION['discount_code'] ?? '';
                $giamgia = ($tongdonhang * $discount_percent) / 100;
                $total_final = $tongdonhang - $giamgia;

                // Lưu vào bill
                $idbill = insert_bill(
                    $iduser,
                    $name,
                    $addr,
                    $phone,
                    $email,
                    $pttt,
                    $ngaydathang,
                    $tongdonhang,
                    $discount_code,
                    $discount_percent,
                    $total_final
                );

                // insert giỏ hàng
                foreach ($_SESSION['mycart'] as $cart) {
                    insert_cart(
                        $_SESSION['user']['id'] ?? 0,
                        $cart[0],
                        $cart[2],
                        $cart[1],
                        $cart[3],
                        $cart[4],
                        $cart[5],
                        $idbill
                    );
                }

                // clear session cart + discount
                $_SESSION['mycart'] = [];
                unset($_SESSION['discount_percent'], $_SESSION['discount_code']);
            }

            $bill = loadone_bill($idbill);
            $billct = loadall_cart($idbill);
            include "view/cart/billconfirm.php";
            break;

        case 'mybill':
            $listbill = loadall_bill($_SESSION['user']['id']);
            include 'view/cart/mybill.php';
            break;
        case 'thoat':
            unset($_SESSION['user']);
            header('location:index.php');
            break;
        case 'introduce':
            include './view/introduce.php';
            break;
        case 'contact':
            include 'view/contact.php';
            break;
        case 'binhluan':
            include 'view/binhluan.php';
            break;
        case 'hoidap':
            include 'view/hoidap.php';
            break;
        default:
            include 'view/home.php';
            break;
    }
} else {
    include 'view/home.php';
}

include 'view/footer.php';
?>
<!-- Nút bong bóng -->
<div id="chat-toggle" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #007bff;
    color: #fff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 1000;
">💬</div>
<!-- Khung chat -->
<div id="chatbox" style="
    position: fixed;
    bottom: 90px;
    right: 20px;
    border: 1px solid #ccc;
    width: 300px;
    background: #fff;
    padding: 10px;
    display: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    border-radius: 10px;
    z-index: 999;
">
    <div id="messages" style="height:250px; overflow-y:auto; margin-bottom:10px;"></div>
    <div id="chat-input" style="display:flex; gap:5px;">
        <input type="text" id="userInput" placeholder="Nhập tin nhắn..." style="flex:1; padding:5px;">
        <button onclick="sendMessage()">Gửi</button>
    </div>
</div>

<!-- Nút bật/tắt chat -->
<div id="chat-toggle" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #007bff;
    color: #fff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 24px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
">
💬
</div>

<script>
    let chatbox = document.getElementById("chatbox");
    let toggleBtn = document.getElementById("chat-toggle");

    // Ẩn chatbox ban đầu
    chatbox.style.transform = "translateY(20px)";
    chatbox.style.opacity = "0";
    chatbox.style.transition = "all 0.3s ease";
    chatbox.style.display = "none";

    // Toggle mở/đóng
    toggleBtn.addEventListener("click", function() {
        if (chatbox.style.display === "none" || chatbox.style.opacity === "0") {
            chatbox.style.display = "block";
            setTimeout(() => {
                chatbox.style.transform = "translateY(0)";
                chatbox.style.opacity = "1";
            }, 10);
            loadHistory(); // 👉 load lịch sử khi mở
        } else {
            chatbox.style.transform = "translateY(20px)";
            chatbox.style.opacity = "0";
            setTimeout(() => {
                chatbox.style.display = "none";
            }, 300);
        }
    });

    // Hàm gửi tin nhắn
    function sendMessage() {
        let msg = document.getElementById("userInput").value;
        if (!msg.trim()) return;

        fetch("chatbot.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "message=" + encodeURIComponent(msg)
            })
            .then(res => res.json())
            .then(data => {
                let messages = document.getElementById("messages");
                messages.innerHTML += `<div class="message user"><b>Bạn:</b> ${msg}</div>`;
                messages.innerHTML += `<div class="message bot"><b>Bot:</b> ${data.reply}</div>`;
                messages.scrollTop = messages.scrollHeight;
                document.getElementById("userInput").value = "";
            });
    }

    // Ấn Enter để gửi tin nhắn
    document.getElementById("userInput").addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            sendMessage();
        }
    });

    // 👉 Hàm load lịch sử chat
    function loadHistory() {
        fetch("chat_history.php")
            .then(res => res.json())
            .then(data => {
                let messages = document.getElementById("messages");
                messages.innerHTML = "";
                data.forEach(row => {
                    messages.innerHTML += `<div class="message ${row.role}">
                        <b>${row.role === "user" ? "Bạn" : "Bot"}:</b> ${row.message}
                    </div>`;
                });
                messages.scrollTop = messages.scrollHeight;
            });
    }
</script>
