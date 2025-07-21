// Thêm hiệu ứng hover cho các nút
        document.querySelectorAll('.btn-update, .btn-remove, .btn-continue, .btn-checkout').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });