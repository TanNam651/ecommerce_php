# Ecommerce website (php thuần)

## Tính năng chính

### User
- Đăng ký, đăng nhập, xác thực qua email (JWT/Sanctum).
- Xem danh sách sản phẩm, tìm kiếm sản phẩm, xem thông tin chi tiết của sản phẩm.
- Thêm sản phẩm vào giỏ hàng, cập nhật số lượng.
- Đặt hàng, hỗ trợ thanh toán qua vnpay và xem trạng thái đơn hàng.
- Đánh giá sản phẩm

### Admin
- Quản lý sản phẩm.
- Quản lý danh mục, thương hiệu.
- Quản lý đơn hàng, người dùng. 
- Quản lý lịch sử thanh toán.
- Quản lý đánh giá sản phẩm.
- Dashboard thống kê.


##  Yêu cầu môi trường

Để chạy dự án, bạn cần có:

| Phần mềm | Phiên bản khuyến nghị |
|-----------|------------------------|
| PHP | >= 8.0 |
| MySQL | >= 5.7 |
| Composer *(tùy chọn)* | Dùng để quản lý package |
| Apache / Nginx | Để phục vụ web |
| XAMPP / Laragon / MAMP | Gợi ý dùng cho môi trường local |

Kiểm tra PHP:
```bash
php -v
```

## Cài đặt dự án
git clone https://github.com/TanNam651/ecommerce_php.git

- Cấu hình database trong file config
- Tạo database

## Cấu trúc thư mục

project/
├── config/
│   └── config.php          # Cấu hình database
│   └── vnpay-config.php    # Cấu hình vnpay
├── index.php/              # File chính (điểm vào)
├── route.php/              # File lưu trữ các đường dẫn url
├── controllers/            # Controller xử lý logic và điều hướng trang web
├── actions/                # Controller xử lý logic
├── layout/                 # Layout của trang web
├── scripts/                # Xử lý logic liên quan đến javascript
├── views/                  # Hiển thị các page
└── README.md

## Cách chạy dự án
```bash
php -S localhost:8000 -t public
```