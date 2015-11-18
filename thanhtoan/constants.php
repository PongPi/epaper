<?php
//CẤU HÌNH TÀI KHOẢN (Configure account)
define('EMAIL_BUSINESS','nguyenduc1222@gmail.com');//Email Bảo kim
define('MERCHANT_ID','19984');                // Mã website tích hợp
define('SECURE_PASS','52b4cf302631f93d');   // Mật khẩu

// Cấu hình tài khoản tích hợp
define('API_USER','epapercom');  //API USER
define('API_PWD','CBv7gKTrxhAdEzVxZJFy');       //API PASSWORD
define('PRIVATE_KEY_BAOKIM','-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAtPXLOOVgQhjZQN8K3aVTHphofH5iI0xm97CDCNHjewdfFNgd
uA6O1TIWglCm8sVQ+FLbESdx+KuWYxOEX7d6d8NKzV11Qpvc+TSQ60PUea/0hXf8
IMGZuX+vi7/WADOTIKqvI9OSDSug0NKFSJl7AwxrvKugQ1I3B57emhcmSInU4RHZ
h1ZiS6XrytgkhOLzYn0L+KGSMTQJ4Aol/wbdv7uquWGGWsFC1uuYXcEw60CKbyfg
kdWkMQZ8wsWe39QhnH0JLFJYVXMgzzKtTSAKNBcEGsYKPXdwBDeh/oh05/mpvt9I
U1Zz9qWZsikYnyuj+/bC7Jo4gFHibGlhVd95IQIDAQABAoIBAQCqj73DW9d1lUw4
a8InFWuZu9dH+Ctxz9KBhTqMdqAt1s3UrLqeQAJ6iiJTI8enrTlbRWU77uzqkHhH
3B55xUtGVKlNldgvNw95SAWL6jv7klAr+OKI0VGeWO5SDzeaqwHy2U4Iu6K+jS+f
g72ipx8dyXhGtZFxwq0hnql7nXQ1CzVC/xjg2TniQtlpXJyZabzz4bbZEnBKHEGP
FviJRO1Yscql/c0Uxd9AXHJUw4pSpO4eXtvKlHLHsny4B4scoZqpleLl/NjpRkTK
Ch3t+FLWBLR+bFLoT8qw9CgsgI7G63QHgEiqCKJbfPPEjSSsoEomusjBfPDgsrZ/
ERb5NtsRAoGBAOwgOH/YnaSmxjUH7Om7iM4oCoA8bmQulV9SN9/vHZdO22TF4iGe
H4FHHHYPViHHsRJBDAjf3s0fmwDGtxULjcIBIMsk0dV8N+Owjh+RIMlvT4jdnfLO
TTD7UsJ4XWFj4Db88jF2AQ0zr4HWnxgzi8BGFibX97VOrHoy9hDzYUudAoGBAMQw
7EP+0rCKsOi6lJJYCURiBNvVbOJOtSWAr47fgOBvCADsh3VFN5DKSohyZD/nkv9N
CK6/TclvzDyA7FjVhxT7rTh/RCQVZe739sxWoS+CneL97VtJcLqfyCLBRqSqVpkk
gIkzkmmqjuK5nSbV0subXcZn1nwxBaNMepQwY3ZVAoGAUi/I2p7wB+5QkQbILHas
4GzJcucV2WLpdPsuHZCh8Rduf73svpzGBH5W5rTh2vIhrOPdJ32clDMLBZMlCHs0
BTHVUz/mlXMeFO9QGKawDczjlxTkNC4gagsgPDYe8pYL5bfXKOYU6Z5y2TN1vru6
SdtbPHvxaTcQC5yPT0kXNXUCgYEAh14GNyhE8UDQrdPHHW6W/lLvbUtGdKPAA19W
QqtePfz+Nbz9/eFDZKjfYmQjXaCH4ZWibwhaQKnd7sU5zlWOfeDldT0CpC8LhSYc
aINBdgmWrP9t3XW/zVTf/3MCLi3F0KbJ9WDbHgNr0W4my5vvdUL/Ih2VdV1RuYnU
bhkxF30CgYEAmecmTbZvBDoeZ/wA8M1hcCVkjttC7v8Kq/XhDW8PfkYwrU24TnRd
5ATOfOrOWhq2jkswu5W4iGu2JRVui07APd5CQrZk2VfpvMnHvw02rheoZGhR4AGM
f2ixf/s3gM38d7fdfx3tqpGpPzMiAJhWcgZcYSzA7XpW8HnfGWeQLLg=
-----END RSA PRIVATE KEY-----');

define('BAOKIM_API_SELLER_INFO','/payment/rest/payment_pro_api/get_seller_info');
define('BAOKIM_API_PAY_BY_CARD','/payment/rest/payment_pro_api/pay_by_card');
define('BAOKIM_API_PAYMENT','/payment/order/version11');

define('BAOKIM_URL','https://www.baokim.vn');
//define('BAOKIM_URL','http://kiemthu.baokim.vn');

//Phương thức thanh toán bằng thẻ nội địa
define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
//Phương thức thanh toán bằng thẻ tín dụng quốc tế
define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
//Dịch vụ chuyển khoản online của các ngân hàng
define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
//Dịch vụ chuyển khoản ATM
define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);

?>