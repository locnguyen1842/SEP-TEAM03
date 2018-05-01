# SEP-TEAM03


Yêu cầu cài đặt :
- <a href="https://getcomposer.org/Composer-Setup.exe">Composer</a> phiên bản mới nhất 
- Xampp v3.2.x ( đã bao gồm PHP v 7.2.x )
- Cài đặt <a href="https://o7planning.org/vi/10221/huong-dan-cai-dat-va-cau-hinh-mysql-community">MySQL Cummunity</a> <b>nếu</b> muốn chỉnh sửa database 


Hướng dẫn cài đặt :

- Clone project về và để trong thư mục xampp/htdocs/
- mở command prompt và cd đến thư mục vừa clone về
- gõ : <pre>composer install</pre> ( để tiến hành tạo thư mục vendor )
- tiếp theo tiến hành copy file .env ( trong cửa sổ cmd vừa mở gõ : <pre>copy .env.example .env</pre> )
- sau khi đã copy file .env tại cửa sổ đó tiếp tục gõ : <pre>php artisan key:generate</pre>
- Sau đó tiến hành kết nối database 
  - vào thư mục đã clone lúc đầu mở file .env và chỉnh giống như dòng dưới
      <pre>
      DB_HOST=den1.mysql5.gear.host
      DB_PORT=3306
      DB_DATABASE=dbcloudmarket
      DB_USERNAME=dbcloudmarket
      DB_PASSWORD= liên hệ trưởng nhóm để biết pass
      </pre>
  
- Mở xampp và start 2 Module : Apache và MySQL 
- Tiến hành kiểm tra kết nối bằng cách gõ localhost trên trình duyệt (localhost:[port]/[tên thư mục vừa clone]/public/index )
