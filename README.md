# Website Rental Mobil menggunakan laravel

NOTE
* abaikan konfigurasi reverb di env , karena saya berusaha implementasi realtime tetapi error terus di konfigurasi vitenya
SETUP PROJECT
* composer install
* npm install
* copy file .env.example
* php artisan key:generate
* php artisan storage:link (agar asset gambar dapat di akses)
* php artisan migrate --seed (jika ingin menggunakan akun user yang sudah tersedia)
* atau anda dapat meregister akun di hyperlink register di halaman login
* php artisan serve
* rental mobil ini terdapat 2 role akun user , yaitu sebagai administrator dari mobil dan sebagai tenant / penyewa
* akun sebagai administrator mobil = username=haha , password=12345678
* akun sebagai tenant / penyewa = username=german, password=55556666
* di dalam sistem ini terdapat sistem regional , yaitu user menyewa mobil yang berada di jangkauan regionalnya
* jika ingin menggunakan akun tenant yang sudah tersedia , silahkan create data mobil di akun admin dengan regional pekalongan(karena akun username=german memiliki regional pekalongan)
* di dalam aplikasi ini terdapat integrasi ke sistem payment gateway midrans , mohon untuk konfigurasi di env
* flow alur perentalan = user order mobil - menunggu pembayaraan dari user - jika pembayaran terkonfirmasi maka akan menunggu konfirmasi dari admin mobil tersebut - admin mengkonfirmasi - pesanan terkonfirmasi , jika mobil di pakai user , maka admin harus update bahwa mobil telah dirental - user ingin mengembalikan , dan menunggu konfirmasi dari admin apakah benar sudah dikembalikan - rental mobil selesai
