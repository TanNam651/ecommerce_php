# Ecommerce website (php thuần)

## 🧩 1. Yêu cầu môi trường

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

- Cấu hình database trong file configa
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

