<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Batas Ukuran Upload File
    |--------------------------------------------------------------------------
    |
    | Berlaku untuk upload Materi (Guru) dan Jawaban Tugas (Siswa).
    | Satuan dalam KILOBYTE (sesuai format yang dipakai validasi Laravel).
    | Ubah nilainya lewat MAX_UPLOAD_SIZE_KB di file .env, TIDAK perlu ubah
    | kode di Form Request manapun.
    |
    | CATATAN PENTING: nilai ini tetap dibatasi oleh pengaturan server
    | (upload_max_filesize & post_max_size di php.ini). Kalau server cuma
    | mengizinkan 8 MB, mengubah angka ini jadi 20 MB tidak akan berpengaruh
    | selama pengaturan php.ini di server belum ikut dinaikkan juga.
    |
    */

    'max_upload_size_kb' => env('MAX_UPLOAD_SIZE_KB', 10240), // default: 10 MB

];
