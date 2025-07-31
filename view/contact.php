<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - Bún Đậu Ông Chú</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/style.css">
</head>

<body>

    <!-- Main Container -->
    <div class="container">
        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-grid-page">
                <!-- Contact Information -->
                <div class="contact-info-page">
                    <h2>Thông Tin Liên Hệ</h2>

                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <div class="contact-details">
                            <h3>Địa Chỉ</h3>
                            <p>70 Lê Thiện Trị<br>
                                Phường Hòa Hải, Quận Ngũ Hành Sơn<br>
                                Thành phố Đà Nẵng</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-phone contact-icon"></i>
                        <div class="contact-details">
                            <h3>Điện Thoại</h3>
                            <p><a href="tel:+84905123456">0905 123 456</a><br>
                                <a href="tel:+84236123456">0236 123 456</a>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p><a href="mailto:bundauongchu@gmail.com">bundauongchu@gmail.com</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fab fa-facebook contact-icon"></i>
                        <div class="contact-details">
                            <h3>Facebook</h3>
                            <p><a href="#" target="_blank">Bún Đậu Ông Chú - Đà Nẵng</a></p>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1140.351687846943!2d108.250171864004!3d15.978570072940443!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314211bc6dbaa86f%3A0x120fe99f95830ab9!2zVGnhu4dtIELDum4gxJDhuq11IMOUbmcgQ2jDug!5e0!3m2!1sen!2sus!4v1753964233660!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="map-overlay">
                        <h4><i class="fas fa-location-dot"></i> Vị trí chính xác</h4>
                        <p>70 Lê Thiện Trị, Hòa Hải</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hours Section -->
        <section class="hours-section">
            <h2>Giờ Mở Cửa</h2>
            <div class="hours-grid">
                <div class="hours-item">
                    <h3><i class="fas fa-sun"></i> Thứ 2 - Thứ 6</h3>
                    <p>6:00 - 22:00</p>
                </div>
                <div class="hours-item">
                    <h3><i class="fas fa-calendar-weekend"></i> Thứ 7 - Chủ Nhật</h3>
                    <p>5:30 - 23:00</p>
                </div>
                <div class="hours-item">
                    <h3><i class="fas fa-star"></i> Ngày Lễ</h3>
                    <p>6:00 - 23:30</p>
                </div>
            </div>
        </section>

    </div>


    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.contact-section, .hours-section').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(el);
        });

        // Add click effect for contact items
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'translateX(5px) scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'translateX(5px) scale(1)';
                }, 150);
            });
        });

        // Add phone number click tracking
        document.querySelectorAll('a[href^="tel:"]').forEach(link => {
            link.addEventListener('click', function() {
                console.log('Phone call initiated:', this.getAttribute('href'));
            });
        });

        // Add email click tracking  
        document.querySelectorAll('a[href^="mailto:"]').forEach(link => {
            link.addEventListener('click', function() {
                console.log('Email opened:', this.getAttribute('href'));
            });
        });
    </script>
</body>

</html>