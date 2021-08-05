-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2021 at 10:08 AM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-9+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knest_latest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `login_token` longtext COLLATE utf8mb4_unicode_ci,
  `reset_password_token` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone_number`, `remember_token`, `login_token`, `reset_password_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'adminn@yopmail.com', '$2y$10$u/f3kvYIVLWoqFnZUojoWuqF3pVUB6.OrD.7zoTdTPguos1ysa2O6', '9384234823', 'wQ7kUScbrxJ3YhIVSnlbDufRpBUUt56FA16wS9VMcZ9nIpmq6Yr1wvdIfRok', '5edUEQHv9jMxppBqSfZHjNSCl8EO9FNt', NULL, '2019-10-22 19:53:17', '2021-02-09 05:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_favourite` int(11) DEFAULT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interesteds`
--

CREATE TABLE `interesteds` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `going` int(11) DEFAULT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2020_11_27_103356_create_admins_table', 3),
(52, '2014_10_12_000000_create_users_table', 4),
(55, '2020_11_27_103138_create_notifications_table', 4),
(56, '2020_11_27_103227_create_favourites_table', 4),
(57, '2020_11_27_103336_create_interesteds_table', 4),
(58, '2020_11_27_102946_create_properties_table', 5),
(59, '2020_11_27_103025_create_property_images_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `other_user_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `notify_message` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('029913750b804ea08e037308fe690cef5a4bb780ed6b59552c8e0db26b985a8f3b9c2ab38fced467', 11, 1, 'Knest', '[]', 1, '2021-01-20 00:41:38', '2021-01-20 00:41:38', '2022-01-20 06:11:38'),
('04de7bab823bf655f3dc1153ebdf9cdd0b3950228f780d38cb62a096efd2f344dcb00a49fe5668ca', 22, 1, 'Knest', '[]', 1, '2021-01-18 23:41:49', '2021-01-18 23:41:49', '2022-01-19 05:11:49'),
('0ce8a3ddf6d7f70457aa4b84aa27ca533b284003e822a3e631c52eed2ac01e7bcd1179495b2f478d', 1, 1, 'Knest', '[]', 0, '2021-01-15 02:21:11', '2021-01-15 02:21:11', '2022-01-15 07:51:11'),
('0d031c249f53018aec0c5ab0f2345c54eadf75534d8803025c10eb37b700853613a2c510651ddbcd', 5, 1, 'Knest', '[]', 0, '2021-01-15 02:21:48', '2021-01-15 02:21:48', '2022-01-15 07:51:48'),
('107b52a0fd9b5387b01a61cbc7975c2df49a54e0253b2ac33ba49e51ab422e9026655deb97dad3dc', 28, 1, 'Knest', '[]', 1, '2021-01-19 07:53:16', '2021-01-19 07:53:16', '2022-01-19 13:23:16'),
('10deaefe4c33346ced86b874ba109d660e306dc4ddc562944e880a6e58aebf0beb9947504272696b', 11, 1, 'Knest', '[]', 1, '2021-01-15 04:50:10', '2021-01-15 04:50:10', '2022-01-15 10:20:10'),
('157b0f413b0f1649adcf2ebc853b6a9d0733bf7e6ae11186173e3470b85b5caaeb4170036de9d8d2', 26, 1, 'Knest', '[]', 1, '2021-01-19 06:09:22', '2021-01-19 06:09:22', '2022-01-19 11:39:22'),
('17465a43c93a683c61f2604ea28fc678c5b17a6c02f726677af230641bac9835610ea3ad573ea02d', 1, 1, 'Knest', '[]', 0, '2020-12-01 05:02:10', '2020-12-01 05:02:10', '2021-12-01 10:32:10'),
('1c6aa8329dfc6b2296a099639fdbc2dca2e1bea6cef86a04102e9c6a376a0322a5f96ed05c431dc1', 3, 1, 'Knest', '[]', 0, '2021-01-11 01:47:17', '2021-01-11 01:47:17', '2022-01-11 07:17:17'),
('21c4467ad87216b18562f327b8fb1a0ecc387c17118a03f737540dbcb8dc3a947e3b5a87eaeb76f0', 3, 1, 'Knest', '[]', 0, '2021-01-12 23:37:04', '2021-01-12 23:37:04', '2022-01-13 05:07:04'),
('2404a25fbddad44a19cc0bffec5ca691df5c55661e96a0b45e6e10205d5493e74bbe033ef6a7e48b', 24, 1, 'Knest', '[]', 1, '2021-01-20 00:44:38', '2021-01-20 00:44:38', '2022-01-20 06:14:38'),
('29cf3e862f7e2bfc4866669d655621f4785230862fd930d097c2b7b16b7c3108ccd28798e27c2309', 1, 1, 'Knest', '[]', 0, '2020-12-14 00:03:40', '2020-12-14 00:03:40', '2021-12-14 05:33:40'),
('2b46bd14db86f2e4a3bee698203175df96f95f5340917d5a9bf62c088f93e1bddc304bdc9b47450f', 25, 1, 'Knest', '[]', 1, '2021-01-19 01:19:07', '2021-01-19 01:19:07', '2022-01-19 06:49:07'),
('2dcd62a016d5a7631c724583380aa6a0efa6a53ab9f1b78496189fa30cd7a42c83eac4de6f05cdd1', 19, 1, 'Knest', '[]', 0, '2021-01-18 06:44:27', '2021-01-18 06:44:27', '2022-01-18 12:14:27'),
('2f1a8e01c6b597c2ff9c36d37e05ab26dc2b9880048bf9af8d8e7fa9c300b61694e229d0d3347cf0', 11, 1, 'Knest', '[]', 1, '2021-01-15 08:11:48', '2021-01-15 08:11:48', '2022-01-15 13:41:48'),
('2f9947f059504ec5ecd6b91948e0a70a9ad5f61d5d9212199978b4b4aeda77f3fffae0a7ad531ad1', 11, 1, 'Knest', '[]', 1, '2021-01-18 01:11:12', '2021-01-18 01:11:12', '2022-01-18 06:41:12'),
('30b7630875a3f18f3501b82544f930294e4975b997785dba13b8880e39ef9baef46768c830c59acc', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:11:37', '2021-01-08 01:11:37', '2022-01-08 06:41:37'),
('3deba047eee3ff9d7dae4866f1ae4153d147a5cd919469c57e9d32a9f78c17417b2284f5d4b975ec', 3, 1, 'Knest', '[]', 0, '2021-01-13 00:24:54', '2021-01-13 00:24:54', '2022-01-13 05:54:54'),
('3f18f738f0e385c27b88d32d2ddef3c072f7ea7cffea5a3ab552a0722d76978544d74d8c3258e725', 3, 1, 'Knest', '[]', 0, '2021-01-12 06:07:00', '2021-01-12 06:07:00', '2022-01-12 11:37:00'),
('3fccc8c626a350ea96ace56030557fd389205b92b7019a8192b08be9ddaa5708a0b6231252db9caa', 29, 1, 'Knest', '[]', 0, '2021-01-19 08:42:32', '2021-01-19 08:42:32', '2022-01-19 14:12:32'),
('42235b1bebe853a3749757d872b5915934fdd7d82c7dd23f7f8ea8388df409b7044585fda8af56da', 3, 1, 'Knest', '[]', 0, '2021-01-15 02:18:47', '2021-01-15 02:18:47', '2022-01-15 07:48:47'),
('4276e6bef012cfbba628baa2a42eaa0f32656ae4c4ba855b92d5ab8f8ab33fa4736a37c68e1e2da7', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:05:24', '2021-01-08 01:05:24', '2022-01-08 06:35:24'),
('44b28be7b013bd224f9a3e157d5a985f4ad5404ce832edf1dc43849b7d9a5b0b13932e2aa35c69e4', 25, 1, 'Knest', '[]', 1, '2021-01-19 01:30:25', '2021-01-19 01:30:25', '2022-01-19 07:00:25'),
('45f78219a990ae02cc6db08886f0b6cd0cccb7db72f670564fbba6461450412ecb0c12b4e72a84df', 32, 1, 'Knest', '[]', 0, '2021-01-19 09:28:34', '2021-01-19 09:28:34', '2022-01-19 14:58:34'),
('464488e2e038a6a61113dd7cf94c1d9331fccdd18961716b130907e291edbed18ea8b403b70cf497', 10, 1, 'Knest', '[]', 1, '2021-01-15 02:27:11', '2021-01-15 02:27:11', '2022-01-15 07:57:11'),
('46e05b6dad0f9299db3e45ebd84d7217d5dfb428b31c02d7a883052b5d92b7fd8a20f831c4ed840a', 1, 1, 'Knest', '[]', 0, '2020-12-14 00:33:09', '2020-12-14 00:33:09', '2021-12-14 06:03:09'),
('47289ac00c281c7bb982af79777d62227755d6c70d4588d2a108b3562b2a17c2d602cddecb7d0a1f', 11, 1, 'Knest', '[]', 1, '2021-01-18 03:53:15', '2021-01-18 03:53:15', '2022-01-18 09:23:15'),
('494ac0b7fbe972b0be15b4cba990f5e4081bbd9bf8a5217e9acb7890beef4e6066fbb3afcd8b45f4', 28, 1, 'Knest', '[]', 1, '2021-01-19 08:12:55', '2021-01-19 08:12:55', '2022-01-19 13:42:55'),
('49b6b97336a1fb7d2446b163fb3e0b77a83cf9ecf9ce061b7390009dab51273b5d24d91df4b51c06', 31, 1, 'Knest', '[]', 0, '2021-01-19 09:27:55', '2021-01-19 09:27:55', '2022-01-19 14:57:55'),
('4ce1bc5c1ac64ed42ac10f097f51d83323e65feacb99f6a29bf046cc9057a381b686c7ae470619b4', 6, 1, 'Knest', '[]', 1, '2021-01-15 01:38:39', '2021-01-15 01:38:39', '2022-01-15 07:08:39'),
('4d2bf07671bd1fe735db2f797ffe58d289f4546dc4f76a45f76de192b9b40a0bd1114b75d69caf39', 25, 1, 'Knest', '[]', 1, '2021-01-19 00:27:54', '2021-01-19 00:27:54', '2022-01-19 05:57:54'),
('4d5e997c16a6e78726f5e739d9277a0b058cc2a9325b06eb2d9f8eeb8aa79c136c9bf80d01a82945', 5, 1, 'Knest', '[]', 0, '2021-01-15 01:36:48', '2021-01-15 01:36:48', '2022-01-15 07:06:48'),
('4e1114bcef3a5457c1e10b19614ae649eef887bd20f6daff13d1bf6b57c6e46211733e1912878edf', 22, 1, 'Knest', '[]', 1, '2021-01-19 06:48:18', '2021-01-19 06:48:18', '2022-01-19 12:18:18'),
('4eac6a8f5004daa3d1483bfc3984323dc6602b92ff9daba45569209548a6fe9c3f443863b2030da5', 29, 1, 'Knest', '[]', 0, '2021-01-19 08:40:18', '2021-01-19 08:40:18', '2022-01-19 14:10:18'),
('5091e70dd5199b177ae13207ee46f7ada19f0179624c93bd3468126a3d830c060187ca237d382f07', 3, 1, 'Knest', '[]', 1, '2021-01-08 04:21:21', '2021-01-08 04:21:21', '2022-01-08 09:51:21'),
('52eae5c836f86267497c96a0c74ca44969594f8aecf33c8e9ae957938749eeb2ac3ee0d183079924', 28, 1, 'Knest', '[]', 1, '2021-01-19 07:53:43', '2021-01-19 07:53:43', '2022-01-19 13:23:43'),
('53ee8eba3eceb3daf478222bb56a71ec437b9bfaefa1d2aa029a291c2a6e60d7b748b814f723fc17', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:04:22', '2021-01-08 01:04:22', '2022-01-08 06:34:22'),
('57fa899126bc25f4161c0247601553d9d1d963b6f9f3f251e51a95f1a39ff91822d9e005e5595659', 11, 1, 'Knest', '[]', 1, '2021-01-19 02:03:35', '2021-01-19 02:03:35', '2022-01-19 07:33:35'),
('5a70c1ee97b0478b3d1cf1cdae52c019394bcf3609147d94db66d22ac307179c599190ea46d44883', 7, 1, 'Knest', '[]', 0, '2021-01-15 02:24:46', '2021-01-15 02:24:46', '2022-01-15 07:54:46'),
('5ae960d5516c5e7948ef54971fddf60fe9bb2f53fc75fce18746c9ea04d30ccc5f27022c6bf15b0d', 1, 1, 'Knest', '[]', 0, '2021-01-15 02:19:13', '2021-01-15 02:19:13', '2022-01-15 07:49:13'),
('5b113945d26b5e44a4b99e5302a0e5d6dadb600eab54653ba8e272e81f45bf31e0927eb8c40fcf45', 11, 1, 'Knest', '[]', 1, '2021-01-18 00:38:25', '2021-01-18 00:38:25', '2022-01-18 06:08:25'),
('5cdc3d15b906f6721e2f984f4247dace6f6c96f16e7f587b9e13bf74826e52a5b2008f8d7b5999f9', 21, 1, 'Knest', '[]', 0, '2021-01-18 06:49:02', '2021-01-18 06:49:02', '2022-01-18 12:19:02'),
('5d89698ce3215462fa74d5cafcad57915f1b9d8dd66530ddb24ae8cf75f4274cc070946a1b2b870f', 11, 1, 'Knest', '[]', 1, '2021-01-18 08:23:10', '2021-01-18 08:23:10', '2022-01-18 13:53:10'),
('5f9f61d47248c4b0cc17ca12778c3b844568635c580121f2dfd2e402e6ae991b7c2984656fb88484', 22, 1, 'Knest', '[]', 1, '2021-01-19 01:28:33', '2021-01-19 01:28:33', '2022-01-19 06:58:33'),
('60ff6f40ee89cab3cf9d1d514cd55f54c17da099b8591b40c7cb9690db5172063fb726a567609164', 27, 1, 'Knest', '[]', 1, '2021-01-19 07:09:36', '2021-01-19 07:09:36', '2022-01-19 12:39:36'),
('625fec2207d6cb1b53233ee9df49700a9b871985d5e988e75edfabf1b7bc817fbb1743f0dbae33b3', 22, 1, 'Knest', '[]', 1, '2021-01-19 01:02:09', '2021-01-19 01:02:09', '2022-01-19 06:32:09'),
('6276ea14d84667fe0d70e802a8d2a95075dcc79005585a8d135790e729d67ab7a5a6b4b11bdfe936', 27, 1, 'Knest', '[]', 1, '2021-01-19 07:09:25', '2021-01-19 07:09:25', '2022-01-19 12:39:25'),
('64fa0ac348c0ff8b8cf9ac56430f00c08e5686362de9a3a886b14d8c22bcef63033622be28523155', 27, 1, 'Knest', '[]', 1, '2021-01-19 07:09:10', '2021-01-19 07:09:10', '2022-01-19 12:39:10'),
('6752f34dee7f0bd554a61c91776ad74ce38bf2f97fe94759e5e2930aea35ecfdd5c7dd288529b64b', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:44:43', '2021-01-08 00:44:43', '2022-01-08 06:14:43'),
('68c6d4719a061579e325b6ac6d32663a8ab10b3833120fcbdd70ad6fdf13e21aa6c50055111f110f', 2, 1, 'Knest', '[]', 0, '2020-12-01 05:50:47', '2020-12-01 05:50:47', '2021-12-01 11:20:47'),
('6976809e2f139513249872e66a8f53966e6018d1fa60551acadc7a44a4891984788d1eddeb89d99f', 27, 1, 'Knest', '[]', 1, '2021-01-19 06:55:50', '2021-01-19 06:55:50', '2022-01-19 12:25:50'),
('699cf78a00f284a5795643e85699d9afe9717f38ab078de40c70d56b8dd10f2b95ca206d1c414960', 23, 1, 'Knest', '[]', 0, '2021-01-18 23:41:52', '2021-01-18 23:41:52', '2022-01-19 05:11:52'),
('6ac3ca2ba892c0ef132c857c83d7e9b6ae45bd5bea30776fc317cdb9f43ac2cd50836d508bde7c3f', 2, 1, 'Knest', '[]', 0, '2021-01-15 02:21:11', '2021-01-15 02:21:11', '2022-01-15 07:51:11'),
('6b5c3e760b1b4b12a33a9217b2b20490215f08412c5a2962408397655f41160bc9d319f68a6d47e3', 4, 1, 'Knest', '[]', 0, '2021-01-15 02:18:47', '2021-01-15 02:18:47', '2022-01-15 07:48:47'),
('6c06adac79925291d3d93cdc234e41345139f03c3ce3fb236509ee36e27d837d8d6164d6dd29884d', 2, 1, 'Knest', '[]', 0, '2021-01-15 02:18:27', '2021-01-15 02:18:27', '2022-01-15 07:48:27'),
('6d4247b60f1c7216e6bdfecc255200d211e9a6953b7ac706b0bbbd2a842b51e734a774323682b3e8', 1, 1, 'Knest', '[]', 0, '2021-01-15 02:18:32', '2021-01-15 02:18:32', '2022-01-15 07:48:32'),
('6dbc8c201ff3a12a5cd6fc6157abd994fd5c4945e33091a8f534101b8877d7ec871083d9535d20ea', 30, 1, 'Knest', '[]', 0, '2021-01-19 08:40:26', '2021-01-19 08:40:26', '2022-01-19 14:10:26'),
('6de677ecce12ee88d7b05f8cd6b265a62f5bc8a5ed663798e539d5be80db06e1afb2a4ea9f4253d4', 3, 1, 'Knest', '[]', 0, '2021-01-13 04:20:32', '2021-01-13 04:20:32', '2022-01-13 09:50:32'),
('7167a9c1b52131976fe0a11ec4918194110d481b1e0495fa9cf46eac30d54013eb11d378ac88c542', 3, 1, 'Knest', '[]', 0, '2021-01-12 07:25:25', '2021-01-12 07:25:25', '2022-01-12 12:55:25'),
('74fac9ed603f2cfde13f6bb80fd8a17a827d16ce397bae76ca7798736f85201e10b4eb3f3e9f0c12', 25, 1, 'Knest', '[]', 1, '2021-01-19 00:34:57', '2021-01-19 00:34:57', '2022-01-19 06:04:57'),
('76028d4c5a234807f5c0080672b35e2f68d0eded29682fd4d18275a908b7f34e2848efe9b0859d06', 3, 1, 'Knest', '[]', 0, '2021-01-13 05:30:28', '2021-01-13 05:30:28', '2022-01-13 11:00:28'),
('760d63c47ea8e8d2e5a8951def6fffbbde66b0cc96f66a31eabaceccdf15682cc7058af7d166f121', 11, 1, 'Knest', '[]', 1, '2021-01-15 02:27:20', '2021-01-15 02:27:20', '2022-01-15 07:57:20'),
('764d490ab64b50a1e9365d03ea31edd863b2b424ef754d65580e0118e2cc223108cce9652af7f4a0', 10, 1, 'Knest', '[]', 1, '2021-01-15 02:27:32', '2021-01-15 02:27:32', '2022-01-15 07:57:32'),
('767b860843e37f92a847c5697296244b7bde4488e977bdf697ce6953945aa6552bcec66085d62d79', 3, 1, 'Knest', '[]', 1, '2020-12-04 01:27:37', '2020-12-04 01:27:37', '2021-12-04 06:57:37'),
('77f9b128933ad52d3d40eeb41aac78ab39a8d4cfb309f43a7c927d2a96de81555d65e481c2dc78df', 24, 1, 'Knest', '[]', 1, '2021-01-20 00:55:37', '2021-01-20 00:55:37', '2022-01-20 06:25:37'),
('79f915d98e7ca429cde5ae69690cbeeff9e8a22b166cb45a3e7be9547699f4598aaeabe8a3836f05', 24, 1, 'Knest', '[]', 1, '2021-01-18 23:59:27', '2021-01-18 23:59:27', '2022-01-19 05:29:27'),
('7e1036a91c8d1e82070abb1ba7fc8a73114f5c8906b68d8e0013f902707f4c4f01c57333924bab85', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:02:48', '2021-01-08 01:02:48', '2022-01-08 06:32:48'),
('7f70c0287f7343379d23d4c5e24fcb7ad819c8391b762ed00540905d4b27b1a1f0358c9cd6f7d1b9', 6, 1, 'Knest', '[]', 0, '2021-01-15 02:11:56', '2021-01-15 02:11:56', '2022-01-15 07:41:56'),
('816d643b3cb23da164b423dc9f611d25b7de7d6b9401ba0c8670d8b58d88bb66d8310b00e606ee6c', 16, 1, 'Knest', '[]', 0, '2021-01-18 03:50:19', '2021-01-18 03:50:19', '2022-01-18 09:20:19'),
('8275ead83282aa1a22733a0caa4929745e5f14e97fa3b7ad60f1b8cf07cea457f88e57ac0c4552ef', 9, 1, 'Knest', '[]', 0, '2021-01-15 02:24:48', '2021-01-15 02:24:48', '2022-01-15 07:54:48'),
('84977f718521b430d4d642fa9bca98f9be5128a95d1b7a3f71d8490428f5016fd6c58ec3b0e0ec22', 22, 1, 'Knest', '[]', 1, '2021-01-18 23:43:30', '2021-01-18 23:43:30', '2022-01-19 05:13:30'),
('8539b910542346878a4e63ac1e32136277e5580fe581ad7f15d98dabebd08691d60ac1318b9da079', 11, 1, 'Knest', '[]', 1, '2021-01-15 03:35:46', '2021-01-15 03:35:46', '2022-01-15 09:05:46'),
('8aecb65bd9501e7c3150db095c4daca535a8bf07a73168e5808282acf8bc108d28052f3ab5ba884a', 11, 1, 'Knest', '[]', 1, '2021-01-18 07:11:27', '2021-01-18 07:11:27', '2022-01-18 12:41:27'),
('906a8d70ace8970ecdda26819a8c6e51f209285647c30946abfe89cd953ef1aa260489ae9c314383', 11, 1, 'Knest', '[]', 1, '2021-01-18 06:37:47', '2021-01-18 06:37:47', '2022-01-18 12:07:47'),
('9417913f1658500459fb54fb279720ccb9f3024f0e1bff966e7b3ec8cdf0f1c95bfc6c880453825b', 11, 1, 'Knest', '[]', 1, '2021-01-15 08:11:48', '2021-01-15 08:11:48', '2022-01-15 13:41:48'),
('965b00fea96b2a8d4f61110a71201a45df6fa38175510f279a0b77d969521caf5ea44c16f004aaae', 27, 1, 'Knest', '[]', 1, '2021-01-19 06:55:22', '2021-01-19 06:55:22', '2022-01-19 12:25:22'),
('96f1edafd048eb203472336609a72f4405a3edae565920660bc5438b57ce321d6a571e2578f76b29', 32, 1, 'Knest', '[]', 0, '2021-01-19 09:29:09', '2021-01-19 09:29:09', '2022-01-19 14:59:09'),
('97fe2b58939849ac8cbb065fd299558a1ce06970a3b6a524bf6504be3b53405527300674c017754d', 27, 1, 'Knest', '[]', 1, '2021-01-19 07:09:32', '2021-01-19 07:09:32', '2022-01-19 12:39:32'),
('997f42ec378077d860d4ffe98f47cdbe9bb32998d0898c8c56c0a0a5ee63ac0f0d696920938dda03', 11, 1, 'Knest', '[]', 1, '2021-01-19 08:19:42', '2021-01-19 08:19:42', '2022-01-19 13:49:42'),
('99b920388ecbaf6dcd82175aaae3798c566e0a530147417b33c99af8db74d5cbb7dd7ca2999d9e20', 14, 1, 'Knest', '[]', 0, '2021-01-17 23:51:35', '2021-01-17 23:51:35', '2022-01-18 05:21:35'),
('9d2a6d74f7a502d8ca69daa0bed6bedbb8e3762a46253dfc14da1fdebb49a8238c3c999acbbecb16', 22, 1, 'Knest', '[]', 1, '2021-01-19 00:37:11', '2021-01-19 00:37:11', '2022-01-19 06:07:11'),
('9db6c60108d42d4612eef1b52cde3d21843910ab622f06c18ba8eb09c2b64be934b49cfd7101f42a', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:37:50', '2021-01-08 01:37:50', '2022-01-08 07:07:50'),
('a0abf980a23c42d3c66697154c035275abf5e3407d8b070eaa0a492367c3fc79d75026ff640977a7', 11, 1, 'Knest', '[]', 0, '2021-01-20 01:02:26', '2021-01-20 01:02:26', '2022-01-20 06:32:26'),
('a2c28645a9ed34cd000fedc45b3e036459af1e5013a68ef888df651848706fe34dce6243e6f9ee35', 11, 1, 'Knest', '[]', 1, '2021-01-15 02:31:22', '2021-01-15 02:31:22', '2022-01-15 08:01:22'),
('a325993312ba0657be946412e6b44c069e69d604d4f34c8339bf50852999749880057acd4d48d43b', 22, 1, 'Knest', '[]', 1, '2021-01-19 00:31:51', '2021-01-19 00:31:51', '2022-01-19 06:01:51'),
('a35137b90b3b47c3ea1b1f785700c283e3999f9f35ed51cc847f90ed832e70d5881b6e167462f342', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:40:36', '2021-01-08 00:40:36', '2022-01-08 06:10:36'),
('a36ad1a1ff63e57dd54ed5df4e08d80f7604ca6823c0f2210b6da33c4e743a2a5bab7cc19cb6c1c1', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:45:09', '2021-01-08 00:45:09', '2022-01-08 06:15:09'),
('a4cf7dadce1cc7f42155d3eeb5b99b2fbd0b21306a45f082de6ab7c8026d9e28a5a8b256f9d5082d', 8, 1, 'Knest', '[]', 0, '2021-01-15 02:24:46', '2021-01-15 02:24:46', '2022-01-15 07:54:46'),
('a560aae88511f4a499a5ad79c11ff8af07bac02deade825806a57f8d0463a0ad2a391ee28b77e266', 26, 1, 'Knest', '[]', 1, '2021-01-19 06:51:19', '2021-01-19 06:51:19', '2022-01-19 12:21:19'),
('a73f58284f932ab22e09e1f3094e4acd21924e23d70560f322586a106c202fef7fa13484fa1ac215', 1, 1, 'Knest', '[]', 0, '2021-01-14 02:20:28', '2021-01-14 02:20:28', '2022-01-14 07:50:28'),
('a7a6702090be37b25807c36dd32f57ea31f61cfca5da91ae2ddb59ba785d1be744e2acdbf9abe758', 6, 1, 'Knest', '[]', 1, '2021-01-15 01:37:18', '2021-01-15 01:37:18', '2022-01-15 07:07:18'),
('a983bf85e17f3421d285adf89877822dc6f9c9db5c7c859b6ce4a8409e6e291097a4267a3fc1a90e', 1, 1, 'Knest', '[]', 0, '2020-12-06 22:55:35', '2020-12-06 22:55:35', '2021-12-07 04:25:35'),
('aa942faa3a22458c49a609efdfc01ffb8564b2bdf1fe9dd2e9320836f7bfbcc4796f991df1867fd9', 4, 1, 'Knest', '[]', 0, '2020-12-07 03:28:30', '2020-12-07 03:28:30', '2021-12-07 08:58:30'),
('ac097a92204c68bc5d2e9928bdfac4e644dc25428053ed14f92ae312a0211ef0a78372adc79b2a92', 11, 1, 'Knest', '[]', 1, '2021-01-18 01:39:57', '2021-01-18 01:39:57', '2022-01-18 07:09:57'),
('ad995d67ea3ebc366050724bea340ecbb0a6b02c8ca632d840ba0ffe5882b3fe0b5281d8d503026e', 22, 1, 'Knest', '[]', 1, '2021-01-19 00:36:01', '2021-01-19 00:36:01', '2022-01-19 06:06:01'),
('aea5fe302583610b7f94cbb6bcb97e03da3857cb5f9ea78be9a89bd24e2aae60adc4dd82859dfb3a', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:03:23', '2021-01-08 01:03:23', '2022-01-08 06:33:23'),
('af1f7d51d4e44b2e16f96dc49898fe54587734e2111a354d7dd82cb9283d316d1b97bf5ae804c1e8', 31, 1, 'Knest', '[]', 0, '2021-01-19 09:28:37', '2021-01-19 09:28:37', '2022-01-19 14:58:37'),
('afa58ae4cd982e142831062f1cb433b0e93077bb4486353824055ac31b9a34dee7333841dceaf92b', 11, 1, 'Knest', '[]', 1, '2021-01-20 00:47:13', '2021-01-20 00:47:13', '2022-01-20 06:17:13'),
('afb7226226ac7c5281d80eeefe0872b504fe015ecff558f71a01b77e81756baf722f82e0745a743c', 26, 1, 'Knest', '[]', 1, '2021-01-19 06:47:30', '2021-01-19 06:47:30', '2022-01-19 12:17:30'),
('bacd20acb88bfbd9d46559a94665435914e5bf2a10af02c4b5ae1a7384ae2282b51ab5f69ef53c0d', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:45:28', '2021-01-08 00:45:28', '2022-01-08 06:15:28'),
('bc47e3a81866fb33cc82b0eb9ae63887695362e0a1d9af77e65c2ce57c17bd87803509f07b9ecdcc', 1, 1, 'Knest', '[]', 0, '2020-12-13 23:49:43', '2020-12-13 23:49:43', '2021-12-14 05:19:43'),
('c29d14fb6ee5715d42b353f31665e91b7c9376eb1776283af616db1a609f3462f93e9a7b11e4cc60', 3, 1, 'Knest', '[]', 0, '2021-01-11 00:02:50', '2021-01-11 00:02:50', '2022-01-11 05:32:50'),
('c2fbab6e877db734880644911590712f74f98a5d0be0f1d14bb1a4353e6e7d1c88bfe8aed27de7d4', 4, 1, 'Knest', '[]', 0, '2021-01-15 02:21:13', '2021-01-15 02:21:13', '2022-01-15 07:51:13'),
('c355b054b238522f1c6d4f0cc068854dfcd13f96dd822e7fd0e116ba285af5e7b7885a9f9df04fea', 3, 1, 'Knest', '[]', 0, '2021-01-15 02:21:12', '2021-01-15 02:21:12', '2022-01-15 07:51:12'),
('c61c485f99e3ba1e2eb1cf0cda6fcd5b3f3871bdb8aa08160f72ee0e8bd1c078a634ca60cdb0623e', 13, 1, 'Knest', '[]', 0, '2021-01-15 05:31:58', '2021-01-15 05:31:58', '2022-01-15 11:01:58'),
('c9326a3b927cc73edec069e102893c213970ab512f5100f7f7b237927b0527c060181c7344caa6a1', 2, 1, 'Knest', '[]', 0, '2020-12-01 05:50:08', '2020-12-01 05:50:08', '2021-12-01 11:20:08'),
('cef005ee063e7ca775bdd3eae09e21fc32e9bf8eb4d42eda0dbd697e79feb0d1152b245a6b0738f1', 15, 1, 'Knest', '[]', 0, '2021-01-18 03:49:39', '2021-01-18 03:49:39', '2022-01-18 09:19:39'),
('d216e4a9948541728ce3bde426d95aca69218623118fe3a9d75fba317bb64802a6b6d193896d2e17', 2, 1, 'Knest', '[]', 0, '2020-12-01 05:58:43', '2020-12-01 05:58:43', '2021-12-01 11:28:43'),
('d6253167eb764d78ba902a3d7ad2bed9baa2ec288b8c07fed3e47b2d682789e41f9a7bc825f31f12', 22, 1, 'Knest', '[]', 1, '2021-01-19 06:29:28', '2021-01-19 06:29:28', '2022-01-19 11:59:28'),
('d6729ba27971cdfae3635263c2063d03d06abb94e346ea380aed790f0daec999ddd91c313981d0e3', 3, 1, 'Knest', '[]', 1, '2021-01-08 04:22:36', '2021-01-08 04:22:36', '2022-01-08 09:52:36'),
('d712cec72f2821c882564c770b2b61b70edeb26094fa7256a7f62a28eb6a9357eb85e11010904d5d', 3, 1, 'Knest', '[]', 0, '2021-01-12 07:12:26', '2021-01-12 07:12:26', '2022-01-12 12:42:26'),
('d8e0c0bd54ba4860c06ba7edd85320689cbed845303f283c95c6dee3d3337f12fc0af12a20d40fec', 11, 1, 'Knest', '[]', 1, '2021-01-15 02:28:04', '2021-01-15 02:28:04', '2022-01-15 07:58:04'),
('db27783a77a6a99d48a25fd3f2e0c24257eb6bef2e3bd07693b31909241c9c5f43ff2bfd391e1ec8', 30, 1, 'Knest', '[]', 0, '2021-01-19 08:40:04', '2021-01-19 08:40:04', '2022-01-19 14:10:04'),
('de1f3ea7f312266b5ace12d8953db411a51903968d706aee4fdf52cf748e8469147bd7b44aa99447', 3, 1, 'Knest', '[]', 1, '2021-01-08 01:38:16', '2021-01-08 01:38:16', '2022-01-08 07:08:16'),
('defb4cc0a6c0035a8f921c351b156403f849c5238b09c83ac039a2aeab20105bdfa15e06a5d0f10b', 13, 1, 'Knest', '[]', 0, '2021-01-15 05:32:26', '2021-01-15 05:32:26', '2022-01-15 11:02:26'),
('df0cff57b77528219c7d9600841da99bc5669281d9fa7d9d2707393c58b8dd6fbed9cec61db2b96b', 26, 1, 'Knest', '[]', 0, '2021-01-19 07:16:48', '2021-01-19 07:16:48', '2022-01-19 12:46:48'),
('dfdb65c375d782d0e385ea178dfcd6310324af74f20a46d3a5c14ca51ec19b7934526c8b27e034b4', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:59:17', '2021-01-08 00:59:17', '2022-01-08 06:29:17'),
('e0cf70ba66bef8fd0507276d893dbb35aa540e0886492fdeb527b72b45be841c66da93af3b3c6d6a', 12, 1, 'Knest', '[]', 0, '2021-01-15 02:30:54', '2021-01-15 02:30:54', '2022-01-15 08:00:54'),
('e2272351b0bd5155e52e806c8fb73ee32c94c6e6172f1285d4bb9f86d1ad7b1314490c633601d402', 17, 1, 'Knest', '[]', 0, '2021-01-18 06:28:26', '2021-01-18 06:28:26', '2022-01-18 11:58:26'),
('e511bc79383690a8a61a30a30444033074f0f42e28c652aaceeb66b11ed6ac7966826df24c91e36d', 25, 1, 'Knest', '[]', 1, '2021-01-19 00:28:18', '2021-01-19 00:28:18', '2022-01-19 05:58:18'),
('e71d2b6212cf92c026a569476e5f22ecdd7ab8847a1463876cde79e12a82e964637174aa7ba7e6e0', 28, 1, 'Knest', '[]', 1, '2021-01-19 07:52:40', '2021-01-19 07:52:40', '2022-01-19 13:22:40'),
('ea58b9634417f525d322fc5f2fb861661406cf0c17a553bf502a1941275403adc2a467f5a3a91c94', 18, 1, 'Knest', '[]', 0, '2021-01-18 06:32:29', '2021-01-18 06:32:29', '2022-01-18 12:02:29'),
('ec1b4a95ac18ff37c642f4af087323f857b9ca88974b77293d8345d3b71f523c4c341c675c7e8f4b', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:37:04', '2021-01-08 00:37:04', '2022-01-08 06:07:04'),
('ed8c44ed28bc5fa9306bb88fc85bde85a388a9b700d1f7599e519e875967563324b8126cee3b315f', 11, 1, 'Knest', '[]', 1, '2021-01-18 06:33:26', '2021-01-18 06:33:26', '2022-01-18 12:03:26'),
('ef7f2ceaae18f77c16cddbc0b3b036d2b5e0a780b3bc4ec0787fb1f671eefa0bb44ea6017648ed6a', 1, 1, 'Knest', '[]', 0, '2020-12-07 04:01:31', '2020-12-07 04:01:31', '2021-12-07 09:31:31'),
('f094ce8249883865e184ad9e006ff5be4cb47d0d510552cc6a372799ab9a84cf0d42563040464dbe', 5, 1, 'Knest', '[]', 0, '2021-01-15 02:18:47', '2021-01-15 02:18:47', '2022-01-15 07:48:47'),
('f141ecfb08db331d5af73eb1d2b81e920afb141e76ece0b64416b23b403ee78535afbb4671b8ba3a', 3, 1, 'Knest', '[]', 0, '2021-01-08 09:47:48', '2021-01-08 09:47:48', '2022-01-08 15:17:48'),
('f3a17bf493e9cf0b677af6ccd035b5658e7d44f52c13e748e62f8da164adf28ded58079858b2435f', 25, 1, 'Knest', '[]', 0, '2021-01-19 01:30:51', '2021-01-19 01:30:51', '2022-01-19 07:00:51'),
('f3ea56917b045714b9bb2ba5855cafa353f31f8f17a886c4f0a8df64740187a2e2cc57315597ea60', 20, 1, 'Knest', '[]', 0, '2021-01-18 06:48:17', '2021-01-18 06:48:17', '2022-01-18 12:18:17'),
('f40c1116b6aa4f386b7ef9396c7845ec65c9163e56fb837d2755919d4dc9f37f975a9ad673cd5fce', 25, 1, 'Knest', '[]', 1, '2021-01-19 00:37:35', '2021-01-19 00:37:35', '2022-01-19 06:07:35'),
('f56ae3cc64a0a674a4a4485545e27f061c86104fbfea363c47651b3ce6197e73f8f60598b49a34ac', 29, 1, 'Knest', '[]', 0, '2021-01-19 08:39:00', '2021-01-19 08:39:00', '2022-01-19 14:09:00'),
('f5b439b61cc809605b6a9617173c159660aeca670868688db8a158695cc6d081a9067aee8d04edab', 24, 1, 'Knest', '[]', 1, '2021-01-19 00:00:22', '2021-01-19 00:00:22', '2022-01-19 05:30:22'),
('f5bce5bc69dd36d1d0184c496a275726d1d61ba9fce7b8340859eb84d895fd9ed9897722fcec434e', 5, 1, 'Knest', '[]', 0, '2021-01-15 02:22:20', '2021-01-15 02:22:20', '2022-01-15 07:52:20'),
('fae644b3e4a7473aa9ced7d19d9cd5a907d440b246cac8952a0a03e66760f63c8ea41416fdac7fbe', 3, 1, 'Knest', '[]', 1, '2021-01-08 04:22:14', '2021-01-08 04:22:14', '2022-01-08 09:52:14'),
('fb7ae8285d53f225ba2d33286f6bb106397574ad4bdf664824fa301777ad6443044e4814933b9cae', 22, 1, 'Knest', '[]', 1, '2021-01-19 08:15:46', '2021-01-19 08:15:46', '2022-01-19 13:45:46'),
('fba54f75c415c12c7e81e007dda39f5741b0de5be108c1140f196d38bbdfd98a8520ffc0429d1827', 2, 1, 'Knest', '[]', 0, '2021-01-08 00:59:45', '2021-01-08 00:59:45', '2022-01-08 06:29:45'),
('fc47edc0ed1afd942746cd67a0d79e2f7f093a6030867ecd1a6ea1cd4a8228d433a84fb8ea3982ef', 6, 1, 'Knest', '[]', 0, '2021-01-15 02:24:44', '2021-01-15 02:24:44', '2022-01-15 07:54:44'),
('fe472323422dab1c373ac8d45fc22ebd3ac5b54820d12e8b6244fce29e6607f147d5919d02d1c11d', 26, 1, 'Knest', '[]', 1, '2021-01-19 06:09:39', '2021-01-19 06:09:39', '2022-01-19 11:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'ELBjopHxHVhnonDllC1ZfaVoNtMPdjBnfmFBR8ix', NULL, 'http://localhost', 1, 0, 0, '2020-11-20 01:06:34', '2020-11-20 01:06:34'),
(2, NULL, 'Laravel Password Grant Client', 'YUFYvkMS7Ql5BteuCtEdzNOqcZLryzeG4FgxGWdN', 'users', 'http://localhost', 0, 1, 0, '2020-11-20 01:06:34', '2020-11-20 01:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-11-20 01:06:34', '2020-11-20 01:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `property_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_price` double(10,2) NOT NULL,
  `number_of_bedroom` int(11) DEFAULT NULL,
  `number_of_bathroom` int(11) DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `tax` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plot_size` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_size` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_district` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `property_type`, `property_price`, `number_of_bedroom`, `number_of_bathroom`, `address`, `latitude`, `longitude`, `tax`, `plot_size`, `building_size`, `school_district`, `date`, `start_time`, `end_time`, `description`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, NULL, 'For Sale', 200.00, 2, 3, 'Mohali, Punjab, India', 30.7046486, 76.71787259999999, '23', '34', '432', 'mohali', '2021-02-09', '02:45PM', '09:50PM', 'this is new data', 1, 'admin', '2021-02-09 05:54:38', '2021-02-09 05:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profile` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `user_id`, `profile`, `property_id`, `type`, `created_at`, `updated_at`) VALUES
(1, NULL, '602270f6ca1c0_download5.jpg', 1, 'admin', '2021-02-09 05:54:38', '2021-02-09 05:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` enum('Ios','Android','None') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `device_token` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0',
  `call_enable` int(11) NOT NULL DEFAULT '0',
  `refresh_token` longtext COLLATE utf8mb4_unicode_ci,
  `is_verify` int(11) NOT NULL DEFAULT '0',
  `verify_email_token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_image`, `name`, `country_code`, `phone_number`, `city`, `pin_code`, `device_type`, `device_token`, `email`, `password`, `is_blocked`, `call_enable`, `refresh_token`, `is_verify`, `verify_email_token`, `deleted_at`, `country_name`, `created_at`, `updated_at`) VALUES
(9, '0115202107544160014a41db790.jpeg', 'kamal@yopmaip', '+1284', '6464664964', 'Jana', '42425454', 'Ios', '18787544', 'kamal@yopmail.com', '$2y$10$CxZ2RMTcXsd9WGsJfOeaJuQmSU4EODxiHrCrETYUU.T8cwKR.DmtG', 0, 0, NULL, 0, '1mAWwyoir8xbALYaaMdcCyG2CPsqkFmu', NULL, NULL, '2021-01-15 02:24:46', '2021-01-15 02:24:46'),
(10, '0115202107570760014ad3536ed.jpeg', 'Hanks', '+1284', '676464646461919', 'jsjsj', '87878787', 'Ios', '', 'janak@yopmail.com', '$2y$10$SudPWhynA.19cNg20NLPZOUMB2Ob77gqObu.eGouZ1KBkFzJRHPVW', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-15 02:27:11', '2021-01-18 06:31:34'),
(11, '0115202107571660014adc8b1f6.jpeg', 'sfsf', '+1246', '32423423423', 'we\'re', '132122', 'Ios', '18787544', 'qwerty@yopmail.com', '$2y$10$U7alc4ydyveBQIsvb09dGe/cPWHcix73OeOScBP/JoqgXTl/LDKDS', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-15 02:27:20', '2021-01-20 01:02:26'),
(12, '0115202108004760014bafb83c2.jpeg', 'dsfdsf', '+1246', '423434345534', 'dsfsf', '34423', 'Ios', '18787544', 'se@yopmail.com', '$2y$10$Fc0rpzUJZw6OLgo40Tbmse2Rh4P8F5vkChrO78xRaNdSxCz47h24.', 0, 0, NULL, 0, 'DyillwJCNe412ZJGYTumLMTymk5LREV1', NULL, NULL, '2021-01-15 02:30:54', '2021-01-15 02:30:54'),
(13, '011520211101516001761f986a1.jpeg', 'pooran', '+1242', '321321321321', 'lh', '141001', 'Ios', '18787544', 'pooran@yopmail.com', '$2y$10$dyLN8wusmwcGMY0c6Z2UEOlP.gV/Rnvg5.SX1T25X4MEBx9stvkfW', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-15 05:31:57', '2021-01-15 05:32:25'),
(14, '', 'demo', '+91', '41265554442', 'asdasdsddda', '54123451', 'Ios', 'sndisain', 'demo152@yopmail.com', '$2y$10$wMX0dRQ/9HhM/JN0tZ5greCSu7itR2ZJ6TjR9XeMIDeJo9j8Ugvma', 0, 0, NULL, 0, 'r9nGOYsX1T2Knu95EHgkQbVC6t7wTVoH', NULL, NULL, '2021-01-17 23:51:35', '2021-01-17 23:51:35'),
(15, '01182021091933600552a50cd85.jpeg', 'digging', '+1242', '34534543535', 'panino', '123456', 'Ios', '18787544', 'qq@yopmail.com', '$2y$10$VCK1kr09uDYkS3hBD0VNJ.C9zbckGhYrtwq4aN3Lh8A/IKGL5QJLO', 0, 0, NULL, 0, 'XTtZj0mzjQeXZe4xD4usdETrBiKht2vg', NULL, NULL, '2021-01-18 03:49:39', '2021-01-18 03:49:39'),
(16, '01182021092014600552ce0c103.jpeg', 'dfgdfgdfg', '+1246', '2342343223', 'eggs df', '34234234', 'Ios', '18787544', 'ere@yopmail.com', '$2y$10$6VLG2qwn/3urdd49r8YdoOeqtW/TBthLdkJTaaGDchH4YBDDgtT9G', 0, 0, NULL, 0, '7HXr91fUFxz8EqukIuPGZiDhFmYijFgg', NULL, NULL, '2021-01-18 03:50:19', '2021-01-18 03:50:19'),
(17, '01182021115821600577dd4d832.jpeg', 'retreated', '+1264', '345345354', 'efsfsfs', '123456', 'Ios', '18787544', 'dgd@yopmail.com', '$2y$10$xxdZo5BeQ/3w0ZuplqbJN.Do6KdWANNvBCE6iSsgfDhPMXYPjevqi', 0, 0, NULL, 0, 'qCM83La0dudwzhxN71D2f2ctwni1jluc', NULL, NULL, '2021-01-18 06:28:26', '2021-01-18 06:28:26'),
(18, '01182021120223600578cf4e250.jpeg', 'jdjdjd', '+1284', '1398646465', 'jdjdjd', '464664', 'Ios', '18787544', 'cmfjkd@yopmail.com', '$2y$10$ibs61EmiGTrQXCegmeM.Feq145LixSwupwY8.nxWe3vxUbG32gLBK', 0, 0, NULL, 0, 'je5s2VNYbVWd5EKixGagYZj7c3jTJRAV', NULL, NULL, '2021-01-18 06:32:29', '2021-01-18 06:32:29'),
(19, '0118202112142160057b9da29dc.jpeg', 'jdjdjd', '+1284', '61616566886', 'jdjdjd jd', '4664645', 'Ios', '18787544', 'fjjd@yopmail.com', '$2y$10$eFbIlmswgL5iTN0IOsc8BurdV6a0/ks4KCVko5.HrWSrfX/lT57/C', 0, 0, NULL, 0, 'yWAlgKIk9wHpfF7zq2NKljIx2KExuR4R', NULL, NULL, '2021-01-18 06:44:27', '2021-01-18 06:44:27'),
(20, '0118202112181160057c8357637.jpeg', 'rrbrbrrh', '+1284', '481818626', 'rvrvr bee', '18181818', 'Ios', '18787544', 'qwertyq@yopmail.com', '$2y$10$09aDoa2FMa3qevmlnbBbKuHcEIju7eE1EISwov48/d/c8wxp7/hqe', 0, 0, NULL, 0, 'YvgnG1jgpo08UiGgT0qbYty3VA99WXio', NULL, NULL, '2021-01-18 06:48:17', '2021-01-18 06:48:17'),
(21, '', 'demo', '+91', '41265554434', 'asdasdsddda', '54123451', 'Ios', 'sndisain', 'demo153@yopmail.com', '$2y$10$0iAwlnncBhD3cAXxa5J.n.o8pLh21G5kLdz4K24HfP7ckGENwkr8O', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-18 06:49:02', '2021-01-18 06:49:54'),
(22, '0119202105113560066a07f20f9.jpeg', 'Japan', '+36', '2323232323', 'v', '1', 'Ios', '', 'japan@yopmail.com', '$2y$10$V1fEuCG7eIAnrb51uBaM.OCo3Y6A4RuewtXajZhF.JOkiX9L/Rk6K', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-18 23:41:49', '2021-01-19 08:16:40'),
(23, '0119202105114360066a0f24eca.jpeg', 'Japan', '+36', '2323232323', 'v', '1', 'Ios', '18787544', 'japan@yopmail.com', '$2y$10$rSnoa1oNB0aXsSrTPPT3uOIYt9mnwagumRSZ9Im6zqSChC75mlcfC', 0, 0, NULL, 0, 'q9Z6rOJMYzP94vAdFp4z6owqp4K7IWCA', NULL, NULL, '2021-01-18 23:41:52', '2021-01-18 23:41:52'),
(24, '0119202105292060066e3031df7.jpeg', 'rs', '+1246', '3453453453', 'dfgdfgdfg', '123456', 'Ios', '', 'rs@yopmail.com', '$2y$10$y.3ftUw48ReW5SjjIwzbZu9JKJMZIxvbLcMMFNGgct21.H13byFce', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-18 23:59:27', '2021-01-20 00:56:38'),
(25, '01192021055747600674db0ab0b.jpeg', 'roan', '+1340', '545454554', 'hdhdhd', '455454', 'Ios', '18787544', 'roan@yopmail.com', '$2y$10$26TU9N6zehuKLqs40GzU9O2ApjuTn7Yku5Q6nFWrT.wrvUF6psKjW', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 00:27:54', '2021-01-19 01:30:51'),
(26, '011920211139176006c4e548d60.jpeg', 'Joker', '+1242', '97878784', 'Chandigarh', '123456', 'Ios', '18787544', 'joker@yopmail.com', '$2y$10$/ChTVnJMBr5oCS7qSMdTIuTIDk7XAlx9JJoFceeQ9Cf6lSNzl7B42', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 06:09:22', '2021-01-19 07:16:48'),
(27, '011920211239366006d308d781f.jpeg', 'ra one', '+1340', '87878874', 'chchch', '5252528585', 'Ios', '', 'ram@yopmail.com', '$2y$10$ATYWHV3Pas6nuoOKxhW83ucyB4WCRllnp3Dxmg11LC2HfsUfyaXgm', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 06:55:22', '2021-01-19 07:16:38'),
(28, '011920211342556006e1df16dd5.jpeg', 'ikka', '+1284', '9876543210', 'Ludhiana', '52323', 'Ios', '', 'ikka@yopmail.com', '$2y$10$aj36cGK6LKVrg2FXPcmfBejBvaDMjn7.HkAtGY4QpVzY2MCFCvqUS', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 07:52:40', '2021-01-19 08:15:37'),
(29, '011920211408546006e7f69f06c.jpeg', 'chop ta', '+1340', '56765957769', 'you', '4956', 'Ios', '18787544', 'chopra@yopmail.com', '$2y$10$b0P3h3dlJM9ZM42zb/fICuIbd2A.UgaeVmjeVEEM6pWAAmaXSlSX.', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 08:39:00', '2021-01-19 08:39:42'),
(30, '011920211410006006e8383d977.jpeg', 'pop', '+1268', '848484858', 'Chandigarh', '2323', 'Ios', '18787544', 'pop@yopmail.com', '$2y$10$oeXo0FRgkevcJ.UIXzxO1ujxJk1q.jTWk9tBJC8pcr8qm6ZSs3x9K', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 08:40:04', '2021-01-19 08:40:11'),
(31, '011920211457506006f36ed31a4.jpeg', 'Shan', '+1340', '87848484554', 'Shimla', '23123', 'Ios', '18787544', 'shan@yopmail.com', '$2y$10$TXpYpwQBoyGFkUAeamLYi.QgNzL4vFy.IGrDxADXupJ3EAMXadwNG', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 09:27:55', '2021-01-19 09:28:20'),
(32, '011920211458296006f395967ce.jpeg', 'Gum', '+1473', '8663965800', 'Mohali', '245685', 'Ios', '18787544', 'gum@yopmail.com', '$2y$10$w5yCfrCvOJbAl5jpzGv5wOTqwf1tC1O8iVBQesN7FF4vH0J569IXq', 0, 0, NULL, 1, '', NULL, NULL, '2021-01-19 09:28:34', '2021-01-19 09:29:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_property_id_foreign` (`property_id`);

--
-- Indexes for table `interesteds`
--
ALTER TABLE `interesteds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interesteds_property_id_foreign` (`property_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_foreign` (`user_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_images_property_id_foreign` (`property_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interesteds`
--
ALTER TABLE `interesteds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interesteds`
--
ALTER TABLE `interesteds`
  ADD CONSTRAINT `interesteds_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
