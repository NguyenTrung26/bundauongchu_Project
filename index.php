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
        case 'faq':
            include 'view/faq.php';
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
<!-- CSS -->
<style>
/* Nút bong bóng tròn ở góc */
#chat-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #d16c07ff, #ffcf11ff);
    color: white;
    font-size: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    z-index: 999;
    transition: all 0.3s ease;
}

/* Hiệu ứng hover */
#chat-toggle:hover {
    transform: scale(1.1) rotate(8deg);
    background: linear-gradient(135deg, #ffcf11ff, #d16c07ff);
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
}

/* Icon SVG bên trong */
#chat-toggle svg {
    width: 28px;
    height: 28px;
    fill: white;
}

/* Khung chat */
#chat-container {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 380px;
    height: 500px;
    border: 1px solid #ddd;
    border-radius: 15px;
    display: none;
    flex-direction: column;
    font-family: Arial, sans-serif;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    background: #fff;
    z-index: 998;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.4s ease;
}
#chat-container.show {
    display: flex;
    opacity: 1;
    transform: translateY(0);
}

#chat-header {
    background: #db8307ff;
    color: white;
    padding: 12px;
    font-weight: bold;
    text-align: center;
    position: relative;
}
#chat-header button {
    position: absolute;
    right: 10px;
    top: 5px;
    border: none;
    background: transparent;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

#chat-box {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background: #f9f9f9;
}

.msg {
    margin: 8px 0;
    display: inline-block;
    padding: 8px 12px;
    border-radius: 15px;
    max-width: 75%;
    line-height: 1.4em;
    word-wrap: break-word;
}
.user {
    background: #ae6512ff;
    color: white;
    border-bottom-right-radius: 0;
    float: right;
    clear: both;
}
.bot {
    background: #e5e5ea;
    color: black;
    border-bottom-left-radius: 0;
    float: left;
    clear: both;
}

#chat-input {
    display: flex;
    border-top: 1px solid #ddd;
    background: #fff;
}
#message {
    flex: 1;
    padding: 10px;
    border: none;
    outline: none;
    font-size: 14px;
}
#send-btn {
    padding: 0 20px;
    border: none;
    background: #fca817ff;
    color: white;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s ease;
}
#send-btn:hover {
    background: #b35a00ff;
}
</style>

<!-- HTML -->
<div id="chat-toggle">
    <!-- Icon Chat SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M20 2H4C2.897 2 2 2.897 2 4V22L6 18H20C21.103 18 22 17.103 22 16V4C22 2.897 21.103 2 20 2z"/>
    </svg>
</div>

<div id="chat-container">
    <div id="chat-header">
        💬 Trợ lý AI - Quán Bún Đậu
        <button onclick="toggleChat()">✖</button>
    </div>
    <div id="chat-box"></div>
    <div id="chat-input">
        <input type="text" id="message" placeholder="Nhập tin nhắn..." onkeypress="checkEnter(event)">
        <button id="send-btn" onclick="sendMessage()">Gửi</button>
    </div>
</div>

<!-- JS -->
<script>
function toggleChat() {
    let chat = document.getElementById("chat-container");
    if (chat.classList.contains("show")) {
        chat.classList.remove("show");
        setTimeout(()=>{ chat.style.display="none"; }, 400);
    } else {
        chat.style.display = "flex";
        setTimeout(()=>{ chat.classList.add("show"); }, 10);
    }
}
document.getElementById("chat-toggle").addEventListener("click", toggleChat);

function sendMessage() {
    let msg = document.getElementById("message").value.trim();
    if(msg==="") return;

    let chatBox = document.getElementById("chat-box");

    // Hiển thị tin nhắn user
    let userMsg = document.createElement("div");
    userMsg.className = "msg user";
    userMsg.innerHTML = msg;
    chatBox.appendChild(userMsg);

    // Gửi lên server
    fetch("chat.php", {
        method:"POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "message=" + encodeURIComponent(msg)
    })
    .then(res=>res.text())
    .then(reply=>{
        let botMsg = document.createElement("div");
        botMsg.className = "msg bot";
        botMsg.innerHTML = reply;
        chatBox.appendChild(botMsg);
        chatBox.scrollTop = chatBox.scrollHeight;
    });

    document.getElementById("message").value = "";
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Enter để gửi
function checkEnter(event) {
    if(event.key === "Enter") {
        sendMessage();
    }
}
</script>
