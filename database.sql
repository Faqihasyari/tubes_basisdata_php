-- Buat database
CREATE DATABASE IF NOT EXISTS peminjaman_buku;
USE peminjaman_buku;

-- Tabel Admin
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Tabel User
CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    status ENUM('aktif', 'tidak aktif') DEFAULT 'aktif'
);

-- Tabel Buku
CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    pengarang VARCHAR(100),
    tahun_terbit YEAR,
    status ENUM('tersedia', 'dipinjam') DEFAULT 'tersedia'
);

-- Tabel Peminjaman
CREATE TABLE peminjaman (
    id_pinjam INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_buku INT,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    status_pinjam ENUM('dipinjam', 'kembali') DEFAULT 'dipinjam',
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
);

-- Data Dummy Admin
INSERT INTO admin (username, password) VALUES ('admin123', 'adminpass');

-- Data Dummy User
INSERT INTO user (nama, email, password) VALUES
('Faqih Asyari', 'faqih@email.com', '12345'),
('Rina Lestari', 'rina@email.com', '12345');

-- Data Dummy Buku
INSERT INTO buku (judul, pengarang, tahun_terbit, status) VALUES
('Algoritma dan Struktur Data', 'Anwar', 2021, 'tersedia'),
('Database Relasional', 'Budi', 2020, 'tersedia'),
('Pemrograman Web Dasar', 'Citra', 2022, 'tersedia');
