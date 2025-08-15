# Task Ön Bilgilendirme

Bu task, **PHP 8.2** ve **Laravel 12** sürümleri kullanılarak geliştirilmiştir. Aşağıda proje çalıştırmadan önce bilmeniz gereken temel bilgiler yer almaktadır.

---

## Sistem Gereksinimleri

- PHP: **8.2**
- Veritabanı: MySQL, PostgreSQL
- Laravel: **12**
- Composer: **2.8.3**

---

## Kullanılan Teknolojiler

- **PHP Sürümü:** 8.2
- **Laravel Sürümü:** 12
- **Veritabanı:** MySQL / PostgreSQL (Laravel tarafından desteklenen diğer RDBMS’ler de kullanılabilir)
- **Queue Sistemi:** Laravel Queue (task atama ve bildirimler için)
- **Event & Listener:** Görev atama ve tamamlanma bildirimleri için kullanılmıştır

---

## 📧 Mail Ayarları

Proje içerisinde **mail işlemleri** için [Mailtrap](https://mailtrap.io) servisi kullanılmaktadır.  
Mailtrap, geliştirme ortamında gerçek mail göndermeden test yapmamıza olanak tanır.

**Dikkat:** Bu projede yer alan `.env` dosyasındaki mail ayarları **kendi Mailtrap hesabınızın bilgileri ile** güncellenmelidir.  
Kendi API anahtarınızı ve SMTP bilgilerinizi almak için:
1. [Mailtrap](https://mailtrap.io) hesabı oluşturun.
2. "Email Testing" bölümünde yeni bir Inbox oluşturun.
3. SMTP ayarlarını kopyalayın.

`.env` dosyanızda aşağıdaki şekilde düzenleme yapın:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=YOUR_MAILTRAP_USERNAME
MAIL_PASSWORD=YOUR_MAILTRAP_PASSWORD
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="MyCase Project"
```

---

## Önemli Notlar

1. **API Odaklı Yapı:**
    - Tüm yanıtlar JSON formatında döner.
    - `success`, `message`, `data` alanları kullanılır.

2. **Exception Yönetimi:**
    - Laravel 12’nin `withExceptions()` yapısı kullanılarak tüm hatalar tek bir JSON şablonunda yönetilir.
    - Hata mesajları ve HTTP durum kodları response içerisinde döner.

3. **Policy ve Yetkilendirme:**
    - Takım işlemleri (üye ekleme/çıkarma) sadece takım sahibi (owner) tarafından yapılabilir.
    - Laravel Policy kullanılarak yetkilendirme sağlanmıştır.

4. **Task İşlemleri:**
    - Görev atama ve tamamlanma işlemleri Event/Listener ve Queue sistemi üzerinden yönetilir.
    - Listener nesnelerine ShouldQueue interface imlement edilmiştir ve bundan dolayı otomatik olarak kuyruk ile çalışacaktır.

5. **Environment Ayarları:**
    - `.env` dosyası üzerinden veritabanı, mail ve diğer servis bağlantıları tanımlanmalıdır.
    - 
6. **Authentication (Sanctum):**
    - API endpoint’leri token tabanlı olarak korunmaktadır.
    - Kullanıcı işlemleri için Laravel Sanctum kullanılmıştır.
    - Her istek için geçerli token gereklidir.
---

# Kurulum

## Projeyi klonlayın
```git clone https://github.com/burhancelebi/mycase.git```

```cd <project-folder>```

## Bağımlılıkları yükleyin
```composer install```

## .env dosyasını oluşturun
```cp .env.example .env```

## Uygulama key'ini oluşturun
```php artisan key:generate```

## Veritabanı migrasyonlarını çalıştırın
```php artisan migrate```

## Kuyruk işlerini başlatın
```php artisan queue:work```

## Artisan Serve
```php artisan serve --port=8001```

# POSTMAN DOKÜMAN LİNKİ
https://documenter.getpostman.com/view/13527177/2sB3BHk8ST

Doküman linki açıldıktan sonra üst sağ köşede 
**Run in Postman** seçeneği ile koleksiyon import edilebilir.
