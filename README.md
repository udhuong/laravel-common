## **📺 Laravel Package - YourPackage**

🚀 Package giúp mở rộng tính năng Laravel với các class và file dùng chung, giúp tăng tính tái sử dụng và giảm lặp code.

## **📌 Tính năng chính**

✅ Cung cấp các class tiện ích dùng chung trong Laravel.
✅ Hỗ trợ tự động đăng ký Service Provider.
✅ Dễ dàng tích hợp vào các dự án Laravel.

## **👥 Cài đặt**
Cài đặt package qua Composer:
```bash
composer require udhuong/laravel-common
```

Nếu package chưa tự động đăng ký, bạn có thể thêm vào config/app.php:
```php
'providers' => [  
    Udhuong\LaravelCommon\LaravelCommonServiceProvider::class,  
],  
```