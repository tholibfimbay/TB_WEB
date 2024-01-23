## Tentang SIHER

SIHER adalah Aplikasi berbasi web yang di berguna untuk melakukan heregistrasi mahasiswa secara online dan saat ini SIHER mengikuti konsep Heregistrasi kampus [STMIK Pelita Nusantara](http://siakad.penusa.ac.id/) dengan beberapa fitur yang dimiliki

- Multilevel Login [Admin, Operator, Mahasiswa]
- Penambahan Operator melalui Admin
- Penambahan Mahasiswa melalui Admin dan Operator
- Upload document KHS, KRS, Cicilan Uang Kuliah
- Cetak Kartu Hasil
- Simpan Document KHS, KRS, dan UK

Dan akan dikembangkan lebih lagi

## Komponen SIHER

- Laravel 7
- Bootstrap 5

Silahkan baca buku manual seputar Laravel maupun Bootstrap untuk info lebih lanjut

## Screenshots

**Auth Page**
![Screenshot (87)](https://user-images.githubusercontent.com/46182403/97806035-35e2fe80-1c8c-11eb-8d97-31e3db12924c.png)

![Screenshot (88)](https://user-images.githubusercontent.com/46182403/97806052-472c0b00-1c8c-11eb-880c-0183e6e92f61.png)

**Admin Page**
![Screenshot (77)](https://user-images.githubusercontent.com/46182403/97806065-557a2700-1c8c-11eb-87a9-f9af129054c6.png)

![Screenshot (78)](https://user-images.githubusercontent.com/46182403/97806100-7773a980-1c8c-11eb-8ea3-ba31609b93b3.png)

**Operator Page**
![Screenshot (73)](https://user-images.githubusercontent.com/46182403/97806188-fd8ff000-1c8c-11eb-88f2-32575bb63519.png)

![Screenshot (79)](https://user-images.githubusercontent.com/46182403/97806148-c6214380-1c8c-11eb-806c-9c371f73c236.png)

**Mahasiswa Page**
![Screenshot (80)](https://user-images.githubusercontent.com/46182403/97806214-1d271880-1c8d-11eb-8cdf-1545ba3e6a21.png)

![Screenshot (81)](https://user-images.githubusercontent.com/46182403/97806223-26b08080-1c8d-11eb-876a-6f7d318a21a0.png)

![Screenshot (82)](https://user-images.githubusercontent.com/46182403/97806228-2dd78e80-1c8d-11eb-8175-d502ab85158d.png)

![Screenshot (84)](https://user-images.githubusercontent.com/46182403/97806241-3760f680-1c8d-11eb-8c58-587bbddf12d6.png)

![Screenshot (83)](https://user-images.githubusercontent.com/46182403/97806246-421b8b80-1c8d-11eb-9345-c9458fa9aa66.png)

## Langkah Instalasi

Sebelumnya pastikan kamu sudah memasang [composer](https://getcomposer.org/) dan [git](https://git-scm.com/) pada komputer kamu

1. Download File
`git clone https://github.com/rickyginting/siher.git`

2. Update Composer
`composer update`

3. Ubah env menjadi .env
4. Buat database db_siher
5. Jalankan migrate
`php artisan migrate`

6. Factory untuk membuat akun admin
`php artisan tinker
factory('App\User',1)->create()`

7. Jalankan local server
`php artisan serve`
