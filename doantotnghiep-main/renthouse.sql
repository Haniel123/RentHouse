-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 14, 2023 lúc 04:29 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `renthouse`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_04_14_141018_create_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_baiviet`
--

CREATE TABLE `table_baiviet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `name` longtext NOT NULL,
  `photo` longtext DEFAULT NULL,
  `desc` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `type` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_chi`
--

CREATE TABLE `table_chi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `id_admin` bigint(20) UNSIGNED DEFAULT NULL,
  `name` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_dichvu`
--

CREATE TABLE `table_dichvu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `name` longtext NOT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_dieukhoan`
--

CREATE TABLE `table_dieukhoan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `name` longtext NOT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_hopdong`
--

CREATE TABLE `table_hopdong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `name` longtext NOT NULL,
  `content` longtext DEFAULT NULL,
  `deposit` longtext DEFAULT NULL,
  `id_thue` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_hopdong_dieukhoan`
--

CREATE TABLE `table_hopdong_dieukhoan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_hopdong` bigint(20) UNSIGNED DEFAULT NULL,
  `id_dieukhoan` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_khachhang`
--

CREATE TABLE `table_khachhang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `name` longtext NOT NULL,
  `email` longtext DEFAULT NULL,
  `phone` longtext DEFAULT NULL,
  `birthday` longtext DEFAULT NULL,
  `avatar` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `status` longtext DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_phanhoi`
--

CREATE TABLE `table_phanhoi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `id_phong` bigint(20) UNSIGNED DEFAULT NULL,
  `id_khachhang` bigint(20) UNSIGNED DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` longtext DEFAULT NULL,
  `type` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_phong`
--

CREATE TABLE `table_phong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `name` longtext NOT NULL,
  `desc` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `price` double DEFAULT NULL,
  `deposittime` longtext DEFAULT NULL,
  `electricity_price` double DEFAULT NULL,
  `water_price` double DEFAULT NULL,
  `area` longtext DEFAULT NULL,
  `payday` longtext DEFAULT NULL,
  `floor` longtext DEFAULT NULL,
  `status` longtext DEFAULT NULL,
  `picture` longtext DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_phong_dichvu`
--

CREATE TABLE `table_phong_dichvu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_phong` bigint(20) UNSIGNED DEFAULT NULL,
  `id_dichvu` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_phong_hopdong`
--

CREATE TABLE `table_phong_hopdong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_hopdong` bigint(20) UNSIGNED DEFAULT NULL,
  `id_khachhang` bigint(20) UNSIGNED DEFAULT NULL,
  `id_quantri` bigint(20) UNSIGNED DEFAULT NULL,
  `id_phong` bigint(20) UNSIGNED DEFAULT NULL,
  `rental_start_date` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_phong_thue`
--

CREATE TABLE `table_phong_thue` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_khachhang` bigint(20) UNSIGNED DEFAULT NULL,
  `id_phong` bigint(20) UNSIGNED DEFAULT NULL,
  `rental_start_date` longtext DEFAULT NULL,
  `rental_end_date` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `status` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_quantri`
--

CREATE TABLE `table_quantri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `name` longtext NOT NULL,
  `email` longtext DEFAULT NULL,
  `phone` longtext DEFAULT NULL,
  `birthday` longtext DEFAULT NULL,
  `avatar` longtext DEFAULT NULL,
  `permission` longtext NOT NULL,
  `address` longtext DEFAULT NULL,
  `status` longtext DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_quantri`
--

INSERT INTO `table_quantri` (`id`, `ordinal`, `username`, `password`, `name`, `email`, `phone`, `birthday`, `avatar`, `permission`, `address`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0', 'Admin', '$2y$10$d8Xo4nv6MWf/OHI/Bj31R.vWLKI0/OBrczILG4r4tLoCGUxnnIpT2', 'Admin', NULL, NULL, NULL, NULL, '0', NULL, '-1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_thongtin`
--

CREATE TABLE `table_thongtin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext NOT NULL,
  `hotline` longtext DEFAULT NULL,
  `fanpage` longtext DEFAULT NULL,
  `facebook` longtext DEFAULT NULL,
  `video` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `map` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_thu`
--

CREATE TABLE `table_thu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordinal` longtext NOT NULL,
  `id_phong` bigint(20) UNSIGNED DEFAULT NULL,
  `id_khachhang` bigint(20) UNSIGNED DEFAULT NULL,
  `id_quantri` bigint(20) UNSIGNED DEFAULT NULL,
  `name` longtext DEFAULT NULL,
  `namebook` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `price` double DEFAULT NULL,
  `phone` longtext DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `code` longtext DEFAULT NULL,
  `status` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `table_baiviet`
--
ALTER TABLE `table_baiviet`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_chi`
--
ALTER TABLE `table_chi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_chi_id_admin_foreign` (`id_admin`);

--
-- Chỉ mục cho bảng `table_dichvu`
--
ALTER TABLE `table_dichvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_dieukhoan`
--
ALTER TABLE `table_dieukhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_hopdong`
--
ALTER TABLE `table_hopdong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_hopdong_dieukhoan`
--
ALTER TABLE `table_hopdong_dieukhoan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_hopdong_dieukhoan_id_hopdong_foreign` (`id_hopdong`),
  ADD KEY `table_hopdong_dieukhoan_id_dieukhoan_foreign` (`id_dieukhoan`);

--
-- Chỉ mục cho bảng `table_khachhang`
--
ALTER TABLE `table_khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_phanhoi`
--
ALTER TABLE `table_phanhoi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_phong`
--
ALTER TABLE `table_phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_phong_dichvu`
--
ALTER TABLE `table_phong_dichvu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_phong_dichvu_id_phong_foreign` (`id_phong`),
  ADD KEY `table_phong_dichvu_id_dichvu_foreign` (`id_dichvu`);

--
-- Chỉ mục cho bảng `table_phong_hopdong`
--
ALTER TABLE `table_phong_hopdong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_phong_hopdong_id_hopdong_foreign` (`id_hopdong`),
  ADD KEY `table_phong_hopdong_id_khachhang_foreign` (`id_khachhang`),
  ADD KEY `table_phong_hopdong_id_quantri_foreign` (`id_quantri`),
  ADD KEY `table_phong_hopdong_id_phong_foreign` (`id_phong`);

--
-- Chỉ mục cho bảng `table_phong_thue`
--
ALTER TABLE `table_phong_thue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_phong_thue_id_khachhang_foreign` (`id_khachhang`),
  ADD KEY `table_phong_thue_id_phong_foreign` (`id_phong`);

--
-- Chỉ mục cho bảng `table_quantri`
--
ALTER TABLE `table_quantri`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_thongtin`
--
ALTER TABLE `table_thongtin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_thu`
--
ALTER TABLE `table_thu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_baiviet`
--
ALTER TABLE `table_baiviet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_chi`
--
ALTER TABLE `table_chi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_dichvu`
--
ALTER TABLE `table_dichvu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_dieukhoan`
--
ALTER TABLE `table_dieukhoan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_hopdong`
--
ALTER TABLE `table_hopdong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_hopdong_dieukhoan`
--
ALTER TABLE `table_hopdong_dieukhoan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_khachhang`
--
ALTER TABLE `table_khachhang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_phanhoi`
--
ALTER TABLE `table_phanhoi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_phong`
--
ALTER TABLE `table_phong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_phong_dichvu`
--
ALTER TABLE `table_phong_dichvu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_phong_hopdong`
--
ALTER TABLE `table_phong_hopdong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_phong_thue`
--
ALTER TABLE `table_phong_thue`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_quantri`
--
ALTER TABLE `table_quantri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_thongtin`
--
ALTER TABLE `table_thongtin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_thu`
--
ALTER TABLE `table_thu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `table_chi`
--
ALTER TABLE `table_chi`
  ADD CONSTRAINT `table_chi_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `table_quantri` (`id`);

--
-- Các ràng buộc cho bảng `table_hopdong_dieukhoan`
--
ALTER TABLE `table_hopdong_dieukhoan`
  ADD CONSTRAINT `table_hopdong_dieukhoan_id_dieukhoan_foreign` FOREIGN KEY (`id_dieukhoan`) REFERENCES `table_dieukhoan` (`id`),
  ADD CONSTRAINT `table_hopdong_dieukhoan_id_hopdong_foreign` FOREIGN KEY (`id_hopdong`) REFERENCES `table_hopdong` (`id`);

--
-- Các ràng buộc cho bảng `table_phong_dichvu`
--
ALTER TABLE `table_phong_dichvu`
  ADD CONSTRAINT `table_phong_dichvu_id_dichvu_foreign` FOREIGN KEY (`id_dichvu`) REFERENCES `table_dichvu` (`id`),
  ADD CONSTRAINT `table_phong_dichvu_id_phong_foreign` FOREIGN KEY (`id_phong`) REFERENCES `table_phong` (`id`);

--
-- Các ràng buộc cho bảng `table_phong_hopdong`
--
ALTER TABLE `table_phong_hopdong`
  ADD CONSTRAINT `table_phong_hopdong_id_hopdong_foreign` FOREIGN KEY (`id_hopdong`) REFERENCES `table_hopdong` (`id`),
  ADD CONSTRAINT `table_phong_hopdong_id_khachhang_foreign` FOREIGN KEY (`id_khachhang`) REFERENCES `table_khachhang` (`id`),
  ADD CONSTRAINT `table_phong_hopdong_id_phong_foreign` FOREIGN KEY (`id_phong`) REFERENCES `table_phong` (`id`),
  ADD CONSTRAINT `table_phong_hopdong_id_quantri_foreign` FOREIGN KEY (`id_quantri`) REFERENCES `table_quantri` (`id`);

--
-- Các ràng buộc cho bảng `table_phong_thue`
--
ALTER TABLE `table_phong_thue`
  ADD CONSTRAINT `table_phong_thue_id_khachhang_foreign` FOREIGN KEY (`id_khachhang`) REFERENCES `table_khachhang` (`id`),
  ADD CONSTRAINT `table_phong_thue_id_phong_foreign` FOREIGN KEY (`id_phong`) REFERENCES `table_phong` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
