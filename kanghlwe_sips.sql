-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Sep 2019 pada 00.01
-- Versi server: 5.7.26-log
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kanghlwe_sips`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `wali_name` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `sub_class` enum('X','XI','XII') NOT NULL,
  `total_students` int(11) NOT NULL,
  `total_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `wali_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `point` int(11) NOT NULL,
  `reported_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `std_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone_number` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe_pelanggaran`
--

CREATE TABLE `tb_tipe_pelanggaran` (
  `id` int(11) NOT NULL,
  `violation_name` text NOT NULL,
  `get_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Guru','Siswa','Wali Murid') NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `remember_me` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `full_name`, `email`, `username`, `password`, `level`, `status`, `remember_me`) VALUES
(2, 'Ahmad Andika', 'ahmadandika471@gmail.com', 'admin', '$2y$10$90hwjCZdFfERsBhY52eT5eKUEVtIvZrYXCFUKp4Hq3Sn40LjKksNO', 'Admin', 1, 'PuRrF2IySPM5nDZ8NGvbwlYHkFB5O98sgJad7UGW0Q3JHVAjf4ymx7x6YsRcpu96'),
(3, 'Burhan', 'burhan@udin.coid', 'NgeCrot', '$2y$10$IX73HM8tB5/hEq5jC/RSbuVf4aruw8EieTi0un183Q6PRgLNbStPK', 'Admin', 1, '2reLcE8acgCYoTZPBtiGsjk1pyJFrn9xsaqXQgQtVA2K0dKwv9lVHTHzxqvGFuWw'),
(4, 'Halim', 'ulfiyaumakhoiriyah@gmail.com', 'Nurkholik22', '$2y$10$HQYQqxGCeCnxuQTvlFWV7O.3lVYJC9Gcjo.Ve9mzQpX51fUmgCqOK', 'Guru', 1, ''),
(5, 'Guru', 'guru@gmail.com', 'guruguru', '$2y$10$n9VJ6dNcM6DBnpYOSewu6OGLX4Yjjz/h9DZtk2Rjihk0xgFvIR09.', 'Guru', 1, 'o3CFBtGHtqYmaO5lVHW8d65gXrRwLjmIPcknT79NeApJ0NMJ3sjQZDfBafUxOuCg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wali`
--

CREATE TABLE `tb_wali` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `phone_number` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_website`
--

CREATE TABLE `tb_website` (
  `id` int(1) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_website`
--

INSERT INTO `tb_website` (`id`, `school_name`, `point`) VALUES
(1, 'FAMOUS SCHOOL', 69);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `wali_id` (`wali_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indeks untuk tabel `tb_tipe_pelanggaran`
--
ALTER TABLE `tb_tipe_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_wali`
--
ALTER TABLE `tb_wali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indeks untuk tabel `tb_website`
--
ALTER TABLE `tb_website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_tipe_pelanggaran`
--
ALTER TABLE `tb_tipe_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_wali`
--
ALTER TABLE `tb_wali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_website`
--
ALTER TABLE `tb_website`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
