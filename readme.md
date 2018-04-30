# SEP-TEAM03


Yêu cầu cài đặt :
- Composer phiên bản mới nhất (https://getcomposer.org/Composer-Setup.exe)
- Xampp v3.2.x ( đã bao gồm PHP v 7.2.x )

Hướng dẫn cài đặt :

- Clone project về và để trong thư mục xampp/htdocs/
- mở command prompt và cd đến thư mục vừa clone về
- gõ : composer install ( để tiến hành tạo thư mục vendor )
- tiếp theo tiến hành copy file .env ( trong cửa sổ cmd vừa mở gõ : copy .env.example .env )
- sau khi đã copy file .env tại cửa sổ đó tiếp tục gõ : php artisan key:generate
- Mở xampp và start 2 Module : Apache và MySQL 
- Tiến hành kiểm tra kết nối bằng cách gõ localhost trên trình duyệt ( localhost:[port]/[tên thư mục vừa clone]/public/index )
