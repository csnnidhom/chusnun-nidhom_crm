# 🚀 Laravel CRM Project
Proyek ini adalah aplikasi CRM (Customer Relationship Management) sederhana berbasis Laravel untuk mengelola **Customers,Products,Leads**
Mendukung **CRUD, Dashboard Statistik, dan Approval Workflow** untuk sales.

## 📌 Fitur Utama
- Role ada 2 : Sales dan Manager
- Dashboard : menampilkan jumlah Leads, Customers, Waiting Approval, Approved, Rejected. itu semua sesuai user input, terkecuali role manager bisa menampilkan jumlah keseluruhan dari masing-masing jumlah.
- Manajemen Customer : CRUD Customer
- Manajemen Produk : CRUD produk, menu ini hanya untuk user yang mempunyai role manager.
- Deal(Transaksi) : Membuat transaksi dengan memilih customer yang diinput sesuai yang dibuat oleh setiap user, kemudian menambahkan beberapa produk dan harga jual. ketika dalam satu transaksi ada salah satu produk yang harga dealnya di bawah harga jual yang telah ditetapkan maka transaksi tersebut statusnya menjadi waiting approval, menunggu user role manager untuk approve/rejected, namun ketika harga deal diatas harga jual yang telah ditetapkan makan transaksi tersebut langsung otomatis menjadi approved dan juga mengubah status customer dari lead menjadi customer.
- Export ke excel : di menu Deal ada fungsi untuk export ke excel, namun sebelum di export bisa di filter terlebih dahulu kemudian di export

## 🛠️ Requirement
Pastikan sudah menginstall:

- PHP **>= 8.1**
- Composer **v2+**
- MySQL
- Git
- Laravel **^12.x**

## 📥 Cara Install (Local Development)
1. **Clone repository**
    - git clone https://github.com/csnnidhom/chusnun-nidhom_crm.git

2. **Install dependency**
    - composer install

3. **Copy & konfigurasi environment**
    - cp .env.example .env
    - edit file .env :
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=crm
        DB_USERNAME=root
        DB_PASSWORD=

4. **Generate App Key**
    - php artisan key:generate

5. **Migrasi Database & Seed Data**
    - php artisan migrate --seed

6. **Jalankan server Laravel**
    - php artisan serve

7. **Akses aplikasi**
    - http://127.0.0.1

8. **User Login**
    1.  email  : manager@gmail.com
        password' : manager123

    2.  email  : sales@gmail.com
        password' : sales123

    3.  email  : sales2@gmail.com
        password' : sales123

