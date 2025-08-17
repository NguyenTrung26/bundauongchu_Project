<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Bún Đậu Ông Chú</title>
    <style>
        :root {
            --primary-color: #d2691e;
            --secondary-color: #8b4513;
            --accent-color: #cd853f;
            --light-bg: #fffaf3;
            --white: #ffffff;
            --text-dark: #4a2e1c;
            --text-medium: #666;
            --shadow-light: 0 4px 15px rgba(210, 105, 30, 0.1);
            --shadow-medium: 0 8px 25px rgba(210, 105, 30, 0.15);
            --shadow-heavy: 0 15px 40px rgba(210, 105, 30, 0.25);
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            --gradient-bg: linear-gradient(135deg, var(--white) 0%, var(--light-bg) 100%);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Helvetica, Arial, sans-serif;
        }

        body {
            line-height: 1.6;
            background: var(--gradient-bg);
            min-height: 100vh;
            color: var(--text-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 60px;
            padding: 60px 20px;
            background: var(--gradient-primary);
            border-radius: 0 0 30px 30px;
            box-shadow: var(--shadow-heavy);
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: slideInDown 1s ease-out;
        }

        .header p {
            font-size: 1.3rem;
            color: rgba(255,255,255,0.95);
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        /* Search Bar */
        .search-container {
            max-width: 600px;
            margin: 0 auto 40px auto;
            position: relative;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .search-input {
            width: 100%;
            padding: 20px 60px 20px 25px;
            font-size: 1.1rem;
            border: 2px solid var(--accent-color);
            border-radius: 50px;
            background: var(--white);
            box-shadow: var(--shadow-medium);
            outline: none;
            transition: var(--transition);
        }

        .search-input:focus {
            transform: translateY(-2px);
            box-shadow: var(--shadow-heavy);
            border-color: var(--primary-color);
        }

        .search-icon {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        /* FAQ Container */
        .faq-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        /* Categories */
        .category-tabs {
            display: flex;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            overflow-x: auto;
            padding: 0;
        }

        .category-tab {
            padding: 20px 30px;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .category-tab:hover {
            background: rgba(255,255,255,0.1);
        }

        .category-tab.active {
            background: rgba(255,255,255,0.2);
        }

        .category-tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: white;
        }

        /* FAQ Items */
        .faq-category {
            display: none;
            padding: 40px;
        }

        .faq-category.active {
            display: block;
        }

        .faq-item {
            margin-bottom: 20px;
            border: 2px solid #f0f0f0;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.6s ease-out forwards;
        }

        .faq-item:nth-child(2) { animation-delay: 0.1s; }
        .faq-item:nth-child(3) { animation-delay: 0.2s; }
        .faq-item:nth-child(4) { animation-delay: 0.3s; }
        .faq-item:nth-child(5) { animation-delay: 0.4s; }

        .faq-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .faq-question {
            padding: 25px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .faq-question::after {
            content: '+';
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            font-weight: 300;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-question::after {
            transform: translateY(-50%) rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, padding 0.3s ease;
            background: #f8f9ff;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 30px;
        }

        .faq-answer p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 15px;
        }

        .faq-answer ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        .faq-answer li {
            margin-bottom: 8px;
            color: #666;
        }

        /* Contact CTA */
        .contact-cta {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            margin-top: 40px;
            border-radius: 20px;
            animation: fadeInUp 1s ease-out 1.2s both;
        }

        .contact-cta h3 {
            font-size: 2rem;
            color: white;
            margin-bottom: 15px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .contact-cta p {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .contact-btn {
            padding: 15px 35px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .contact-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        /* Back to Home Button */
        .back-home {
            position: fixed;
            top: 30px;
            left: 30px;
            background: rgba(255,255,255,0.9);
            color: #667eea;
            padding: 15px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .back-home:hover {
            background: white;
            transform: translateX(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        /* Animations */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-100px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .category-tabs {
                flex-direction: column;
            }

            .category-tab {
                text-align: center;
            }

            .faq-category {
                padding: 20px;
            }

            .faq-question {
                padding: 20px;
                font-size: 1.1rem;
            }

            .contact-buttons {
                flex-direction: column;
                align-items: center;
            }

            .back-home {
                position: relative;
                margin: 20px auto;
                display: inline-block;
            }
        }

        .highlight {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            border-left: 4px solid #ff6b6b;
        }
    </style>
</head>
<body>
    <a href="#" class="back-home">← Trang chủ</a>
    
    <div class="container">
        <div class="header">
            <h1>Câu hỏi thường gặp</h1>
            <p>Tìm hiểu thêm về Bún Đậu Ông Chú - Từ thực đơn đến dịch vụ</p>
        </div>

        <div class="search-container">
            <input type="text" class="search-input" placeholder="Tìm kiếm câu hỏi..." id="searchInput">
            <span class="search-icon">🔍</span>
        </div>

        <div class="faq-container">
            <div class="category-tabs">
                <button class="category-tab active" data-category="general">Thông tin chung</button>
                <button class="category-tab" data-category="menu">Thực đơn</button>
                <button class="category-tab" data-category="order">Đặt hàng</button>
                <button class="category-tab" data-category="service">Dịch vụ</button>
                <button class="category-tab" data-category="location">Địa điểm</button>
            </div>

            <!-- Thông tin chung -->
            <div class="faq-category active" id="general">
                <div class="faq-item">
                    <div class="faq-question">Bún Đậu Ông Chú hoạt động từ khi nào?</div>
                    <div class="faq-answer">
                        <p>Bún Đậu Ông Chú đã phục vụ khách hàng hơn 20 năm qua, bắt đầu từ một quầy nhỏ và phát triển thành nhà hàng có tiếng như hiện tại. Chúng tôi tự hào là một trong những địa chỉ uy tín nhất về món bún đậu truyền thống tại khu vực.</p>
                        <p>Với kinh nghiệm lâu năm và công thức gia truyền, chúng tôi cam kết mang đến cho khách hàng những bát bún đậu chất lượng nhất.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Điều gì làm nên sự đặc biệt của Bún Đậu Ông Chú?</div>
                    <div class="faq-answer">
                        <p>Sự đặc biệt của chúng tôi nằm ở:</p>
                        <ul>
                            <li>Công thức nước mắm pha chế độc quyền, truyền từ đời này sang đời khác</li>
                            <li>Đậu phụ được làm tươi hàng ngày, chiên vàng ươm với lớp vỏ giòn tan</li>
                            <li>Bún tươi dai ngon, không sử dụng chất bảo quản</li>
                            <li>Rau thơm được chọn lọc kỹ càng, rửa sạch và bảo quản tươi ngon</li>
                            <li>Đội ngũ đầu bếp giàu kinh nghiệm, tâm huyết với nghề</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Quán có đảm bảo vệ sinh an toàn thực phẩm không?</div>
                    <div class="faq-answer">
                        <p>Vệ sinh an toàn thực phẩm luôn là ưu tiên hàng đầu của chúng tôi:</p>
                        <ul>
                            <li>Giấy phép kinh doanh và chứng nhận vệ sinh an toàn thực phẩm đầy đủ</li>
                            <li>Nhân viên được đào tạo đều đặn về vệ sinh thực phẩm</li>
                            <li>Nguyên liệu được kiểm tra chất lượng hàng ngày</li>
                            <li>Khu vực chế biến được vệ sinh định kỳ</li>
                            <li>Chén bát được rửa sạch và khử trùng bằng nước sôi</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Quán có phù hợp cho trẻ em và người ăn chay không?</div>
                    <div class="faq-answer">
                        <p>Quán rất thân thiện với mọi lứa tuổi và khẩu vị:</p>
                        <p><strong>Cho trẻ em:</strong> Chúng tôi có thể điều chỉnh độ cay, mắm tôm riêng và có ghế ngồi phù hợp cho trẻ nhỏ.</p>
                        <p><strong>Cho người ăn chay:</strong> Chúng tôi có phiên bản chay của bún đậu với đậu phụ chiên, rau thơm và nước chấm chay đặc biệt không có mắm tôm.</p>
                    </div>
                </div>
            </div>

            <!-- Thực đơn -->
            <div class="faq-category" id="menu">
                <div class="faq-item">
                    <div class="faq-question">Thực đơn của quán có những món gì?</div>
                    <div class="faq-answer">
                        <p>Thực đơn chính của chúng tôi bao gồm:</p>
                        <ul>
                            <li><strong>Bún Đậu Mắm Tôm Cổ Điển:</strong> Món truyền thống với đầy đủ thành phần cơ bản</li>
                            <li><strong>Bún Đậu Thịt Nướng:</strong> Thêm thịt ba chỉ nướng thơm lừng</li>
                            <li><strong>Bún Đậu Chả Cá:</strong> Kết hợp với chả cá Hà Nội đặc trưng</li>
                            <li><strong>Bún Đậu Nem Nướng:</strong> Phiên bản với nem nướng Ninh Hòa</li>
                            <li><strong>Combo Gia Đình:</strong> Phần ăn lớn cho 4-6 người</li>
                            <li><strong>Bún Đậu Chay:</strong> Dành cho người ăn chay</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Giá cả như thế nào?</div>
                    <div class="faq-answer">
                        <p>Bảng giá chi tiết:</p>
                        <ul>
                            <li>Bún Đậu Cổ Điển: 35.000 - 45.000 VNĐ</li>
                            <li>Bún Đậu Thịt Nướng: 50.000 - 60.000 VNĐ</li>
                            <li>Bún Đậu Chả Cá: 55.000 - 65.000 VNĐ</li>
                            <li>Combo Gia Đình: 180.000 - 250.000 VNĐ</li>
                            <li>Đồ uống: 10.000 - 25.000 VNĐ</li>
                        </ul>
                        <p>Giá có thể thay đổi theo thời điểm và có các chương trình khuyến mãi định kỳ.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Có thể tùy chỉnh món ăn theo khẩu vị không?</div>
                    <div class="faq-answer">
                        <p>Chúng tôi hoàn toàn có thể tùy chỉnh món ăn theo yêu cầu:</p>
                        <ul>
                            <li>Điều chỉnh độ cay của nước mắm</li>
                            <li>Tăng giảm lượng mắm tôm</li>
                            <li>Thêm hoặc bớt rau thơm theo sở thích</li>
                            <li>Thay đổi loại thịt hoặc chả</li>
                            <li>Phục vụ riêng cho người có dị ứng thực phẩm</li>
                        </ul>
                        <p>Hãy thông báo cho nhân viên khi đặt món để chúng tôi phục vụ tốt nhất!</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Quán có đồ uống gì?</div>
                    <div class="faq-answer">
                        <p>Danh sách đồ uống phong phú:</p>
                        <ul>
                            <li>Trà đá miễn phí</li>
                            <li>Nước ngọt các loại</li>
                            <li>Bia tươi, bia lon</li>
                            <li>Nước chanh tươi</li>
                            <li>Sinh tố trái cây theo mùa</li>
                            <li>Chè đậu xanh, chè thái</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Đặt hàng -->
            <div class="faq-category" id="order">
                <div class="faq-item">
                    <div class="faq-question">Làm thế nào để đặt bàn trước?</div>
                    <div class="faq-answer">
                        <p>Bạn có thể đặt bàn qua nhiều cách:</p>
                        <ul>
                            <li><strong>Điện thoại:</strong> Gọi trực tiếp số hotline để đặt bàn</li>
                            <li><strong>Mạng xã hội:</strong> Nhắn tin qua Facebook hoặc Zalo</li>
                            <li><strong>Trực tiếp:</strong> Đến quán để đặt bàn cho lần sau</li>
                        </ul>
                        <p>Khuyến nghị đặt bàn trước 2-3 tiếng, đặc biệt vào cuối tuần và giờ cao điểm.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Có dịch vụ giao hàng không?</div>
                    <div class="faq-answer">
                        <p>Có! Chúng tôi cung cấp dịch vụ giao hàng với những thông tin sau:</p>
                        <ul>
                            <li>Phạm vi giao hàng: Bán kính 5km từ quán</li>
                            <li>Thời gian giao hàng: 30-45 phút</li>
                            <li>Phí giao hàng: 15.000 - 25.000 VNĐ tùy khoảng cách</li>
                            <li>Đơn hàng tối thiểu: 100.000 VNĐ</li>
                            <li>Miễn phí ship cho đơn hàng từ 300.000 VNĐ</li>
                        </ul>
                        <p>Đặt hàng qua điện thoại hoặc ứng dụng giao hàng.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Có thể hủy đơn hàng không?</div>
                    <div class="faq-answer">
                        <p>Chính sách hủy đơn hàng:</p>
                        <ul>
                            <li><strong>Đặt bàn:</strong> Có thể hủy trước 1 tiếng mà không mất phí</li>
                            <li><strong>Giao hàng:</strong> Có thể hủy trong vòng 10 phút sau khi đặt</li>
                            <li><strong>Sau khi chế biến:</strong> Không thể hủy, nhưng có thể đổi sang giao hàng</li>
                        </ul>
                        <p>Vui lòng gọi điện ngay khi muốn hủy để tránh phát sinh chi phí không cần thiết.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Có nhận đặt tiệc không?</div>
                    <div class="faq-answer">
                        <p>Chúng tôi có nhận đặt tiệc cho các sự kiện:</p>
                        <ul>
                            <li>Tiệc sinh nhật, kỷ niệm</li>
                            <li>Họp mặt gia đình, bạn bè</li>
                            <li>Sự kiện công ty nhỏ (10-30 người)</li>
                        </ul>
                        <p>Với đơn đặt tiệc, bạn sẽ được:</p>
                        <ul>
                            <li>Tư vấn thực đơn phù hợp</li>
                            <li>Giá ưu đãi cho số lượng lớn</li>
                            <li>Phục vụ riêng biệt</li>
                            <li>Trang trí cơ bản miễn phí</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Dịch vụ -->
            <div class="faq-category" id="service">
                <div class="faq-item">
                    <div class="faq-question">Giờ hoạt động của quán?</div>
                    <div class="faq-answer">
                        <p>Thời gian phục vụ:</p>
                        <ul>
                            <li><strong>Thứ 2 - Chủ nhật:</strong> 10:00 - 22:00</li>
                            <li><strong>Giờ cao điểm:</strong> 11:30 - 13:30 và 18:00 - 20:00</li>
                            <li><strong>Nghỉ lễ:</strong> Theo lịch chung, thông báo trước trên fanpage</li>
                        </ul>
                        <p>Khuyến nghị đến vào giờ tránh cao điểm để được phục vụ nhanh chóng hơn.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Quán có WiFi miễn phí không?</div>
                    <div class="faq-answer">
                        <p>Có! Chúng tôi cung cấp WiFi miễn phí cho khách hàng:</p>
                        <ul>
                            <li>Tên mạng: BunDauOngChu_Free</li>
                            <li>Mật khẩu: bundan2024</li>
                            <li>Tốc độ ổn định, phù hợp để check-in và chia sẻ</li>
                        </ul>
                        <p>Ngoài ra còn có điều hòa, quạt mát và không gian thoáng đãng.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Có chỗ để xe không?</div>
                    <div class="faq-answer">
                        <p>Chúng tôi có khu vực để xe tiện lợi:</p>
                        <ul>
                            <li>Bãi xe máy rộng rãi, có mái che</li>
                            <li>Khu vực để xe đạp điện</li>
                            <li>Một số chỗ để xe hơi (cần đặt trước)</li>
                            <li>Có bảo vệ trông xe</li>
                            <li>Miễn phí trông xe cho khách ăn tại quán</li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Thanh toán như thế nào?</div>
                    <div class="faq-answer">
                        <p>Chúng tôi chấp nhận nhiều hình thức thanh toán:</p>
                        <ul>
                            <li>Tiền mặt</li>
                            <li>Chuyển khoản ngân hàng</li>
                            <li>Ví điện tử: MoMo, ZaloPay, ViettelPay</li>
                            <li>Quét mã QR</li>
                            <li>Thẻ ATM (từ đơn hàng 200.000 VNĐ)</li>
                        </ul>
                        <p>Hóa đơn VAT được xuất theo yêu cầu.</p>
                    </div>
                </div>
            </div>

            <!-- Địa điểm -->
            <div class="faq-category" id="location">
                <div class="faq-item">
                    <div class="faq-question">Địa chỉ cụ thể của quán ở đâu?</div>
                    <div class="faq-answer">
                        <p>Bún Đậu Ông Chú có địa chỉ:</p>
                        <p><strong>123 Đường Trần Hưng Đạo, Phường Hòa Thuận Tây, Quận Hải Châu, Đà Nẵng</strong></p>
                        <p>Các mốc tham khảo gần quán:</p>
                        <ul>
                            <li>Cách chợ Hàn 500m</li>
                            <li>Đối diện trường THPT Phan Châu Trinh</li>
                            <li>Gần ngã tư Trần Hưng Đạo - Lê Duẩn</li>
                            <li>Cách cầu sông Hàn 1km</li>
                        </ul>
                        <p>Quán có bảng hiệu to, dễ nhận biết với logo đặc trưng.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Làm thế nào để đến quán bằng phương tiện công cộng?</div>
                    <div class="faq-answer">
                        <p>Bạn có thể đến quán bằng:</p>
                        <p><strong>Xe buýt:</strong></p>
                        <ul>
                            <li>Tuyến 01: Xuống trạm Trần Hưng Đạo, đi bộ 100m</li>
                            <li>Tuyến 03: Xuống trạm chợ Hàn, đi bộ 500m</li>
                        </ul>
                        <p><strong>Taxi/Grab:</strong> Báo địa chỉ "Bún Đậu Ông Chú, 123 Trần Hưng Đạo"</p>
                        <p><strong>Xe máy cá nhân:</strong> Đường rộng, dễ đi, có bãi xe riêng</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Quán có chi nhánh nào khác không?</div>
                    <div class="faq-answer">
                        <p>Hiện tại chúng tôi chỉ có một cơ sở duy nhất tại Đà Nẵng để đảm bảo chất lượng phục vụ tốt nhất.</p>
                        <p>Chúng tôi đang có kế hoạch mở rộng trong tương lai, nhưng hiện tại tập trung hoàn thiện dịch vụ tại địa chỉ chính.</p>
                        <p><strong>Lưu ý:</strong> Nếu thấy tên "Bún Đậu Ông Chú" ở nơi khác, vui lòng kiểm tra kỹ vì có thể là hàng giả mạo.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Xung quanh quán có gì thú vị?</div>
                    <div class="faq-answer">
                        <p>Vị trí quán rất thuận tiện để khám phá Đà Nẵng:</p>
                        <ul>
                            <li><strong>Chợ Hàn:</strong> 500m - Mua sắm đặc sản, quà lưu niệm</li>
                            <li><strong>Cầu Rồng:</strong> 1,5km - Xem rồng phun lửa vào cuối tuần</li>
                            <li><strong>Bảo tàng Đà Nẵng:</strong> 800m - Tìm hiểu lịch sử địa phương</li>
                            <li><strong>Nhà thờ Con Gà:</strong> 1km - Kiến trúc Gothic độc đáo</li>
                            <li><strong>Sông Hàn:</strong> 1km - Tản bộ, ngắm cảnh về đêm</li>
                        </ul>
                        <p>Lý tưởng để kết hợp ăn uống với tham quan thành phố!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-cta">
            <h3>Không tìm thấy câu trả lời?</h3>
            <p>Đừng ngại liên hệ trực tiếp với chúng tôi!</p>
            <div class="contact-buttons">
                <a href="tel:0236123456" class="contact-btn">📞 Gọi ngay</a>
                <a href="#" class="contact-btn">💬 Chat Zalo</a>
                <a href="#" class="contact-btn">📧 Email</a>
                <a href="#" class="contact-btn">📍 Chỉ đường</a>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and categories
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.faq-category').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding category
                this.classList.add('active');
                document.getElementById(this.dataset.category).classList.add('active');
            });
        });

        // FAQ accordion functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const isActive = faqItem.classList.contains('active');
                
                // Close all other FAQ items in the same category
                const currentCategory = faqItem.closest('.faq-category');
                currentCategory.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const allFaqItems = document.querySelectorAll('.faq-item');
            let hasResults = false;

            allFaqItems.forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    if (searchTerm.length > 0) {
                        item.classList.add('highlight');
                    } else {
                        item.classList.remove('highlight');
                    }
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                    item.classList.remove('highlight');
                }
            });

            // Show/hide categories based on search results
            if (searchTerm.length > 0) {
                document.querySelectorAll('.faq-category').forEach(category => {
                    const hasVisibleItems = category.querySelector('.faq-item[style="display: block;"], .faq-item:not([style*="display: none"])');
                    if (hasVisibleItems) {
                        category.style.display = 'block';
                    } else {
                        category.style.display = 'none';
                    }
                });
            } else {
                // Reset to show only active category
                document.querySelectorAll('.faq-category').forEach(category => {
                    if (category.classList.contains('active')) {
                        category.style.display = 'block';
                    } else {
                        category.style.display = 'none';
                    }
                });
            }
        });

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add floating animation to contact buttons
        document.querySelectorAll('.contact-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.animation = 'float 1s ease-in-out infinite';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.animation = 'none';
            });
        });

        // Add floating keyframes
        const floatStyle = document.createElement('style');
        floatStyle.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(-3px) scale(1.05); }
                50% { transform: translateY(-8px) scale(1.05); }
            }
        `;
        document.head.appendChild(floatStyle);

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Reset all FAQ items to closed state
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
        });
    </script>
</body>
</html>