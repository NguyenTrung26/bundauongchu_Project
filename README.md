<div align="center">

# 🍲 Bún Đậu Ông Chú  

![PHP](https://img.shields.io/badge/PHP-8.2.12-blue?logo=php)  
![MySQL](https://img.shields.io/badge/MySQL-5.7-orange?logo=mysql)  
![HTML](https://img.shields.io/badge/HTML-5-red?logo=html5)  
![CSS](https://img.shields.io/badge/CSS-3-blue?logo=css3)  
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow?logo=javascript)  
![License](https://img.shields.io/badge/license-MIT-green)  

> Website bán hàng & quản lý quán **Bún Đậu Ông Chú** – hỗ trợ đặt món online, giỏ hàng, quản lý đơn hàng và chatbot hỗ trợ khách hàng.  

<img src="https://raw.githubusercontent.com/NguyenTrung26/bundauongchu_Project/main/ongchu.jpg" width="300" alt="Logo Bún Đậu Ông Chú"/>

</div>

---

## ✨ Tính năng nổi bật
- 🍜 Menu món ăn + giỏ hàng + thanh toán  
- 🔑 Hệ thống **đăng ký / đăng nhập** (khách hàng & admin)  
- 📦 Quản lý sản phẩm (**CRUD cho admin**)  
- 🤖 Chatbot đơn giản + lưu lịch sử chat  
- 📊 Trang admin quản lý đơn hàng  

---

## 🛠 Công nghệ sử dụng
| Thành phần   | Công nghệ |
|--------------|-----------|
| **Back-end** | PHP (MySQLi / PDO) |
| **Front-end**| HTML, CSS, JavaScript |
| **Database** | MySQL |
| **Package**  | npm (các dependency front-end, chatbot) |

---
## 📂 Cấu trúc thư mục
bundauongchu_Project/
├── admin/            # Quản lý (CRUD sản phẩm, đơn hàng)
├── model/            # Xử lý dữ liệu (DB, business logic)
├── view/             # Giao diện (HTML, CSS, JS)
├── index.php         # Trang chủ
├── chatbot.php       # Xử lý chatbot
├── chat_history.php  # Lưu & hiển thị lịch sử chat
├── package.json      # Quản lý dependency front-end
└── ongchu.jpg        # Logo / hình ảnh

## ⚙️ Cài đặt & chạy dự án
1. Clone repo
git clone https://github.com/NguyenTrung26/bundauongchu_Project.git
cd bundauongchu_Project

2. Cấu hình môi trường

Cài đặt PHP 7.4+ và MySQL

Import database từ file db.sql (nếu có trong repo)

Tạo file kết nối DB:

// includes/connect.php
$con = mysqli_connect("localhost","root","","bundau_ongchu");
if (!$con) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

3. Chạy server local
php -S localhost:8000


Truy cập 👉 http://localhost:8000

## 🔒 Bảo mật

✔️ Dùng Prepared Statements để chống SQL Injection

✔️ Escape dữ liệu đầu ra tránh XSS

✔️ Thêm CSRF token cho form

✔️ Lưu biến môi trường vào .env (không commit)

## 📸 Demo giao diện

(Thêm ảnh screenshot hoặc GIF demo ở đây để repo trực quan hơn)

## 👨‍💻 Tác giả

Nguyễn Trung – Fullstack Developer
