# Proje Adı

Bu proje, slim freamwork servislerini kullanmak için yazılmıştır.

## Başlangıç

Projeyi yerel makinenizde çalıştırmak için aşağıdaki adımları izleyin.


### Kurulum

1. Bu depoyu yerel makinenize klonlayın.
2. Terminali açın ve projenin klonlandığı dizine gidin.
3. Bağımlılıkları yüklemek için `composer install` komutunu çalıştırın.
4. `php artisan.php setup:database` komutu ile veritabanını oluşturun.
5. `php -S localhost:8888 -t public` public/index.php  komutu ile projeyi başlatın.

### Kullanım ve url yapısı

1. http://localhost:8888/posts/{post_id}/comments Örneğin: http://localhost:8888/posts/1/comments 
2. http://localhost:8888/posts/
3. http://localhost:8888/comments/
