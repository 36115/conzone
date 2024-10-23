-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.6.1-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table conzonedb.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.cache: ~0 rows (approximately)

-- Dumping structure for table conzonedb.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.cache_locks: ~0 rows (approximately)

-- Dumping structure for table conzonedb.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table conzonedb.forum_categories
DROP TABLE IF EXISTS `forum_categories`;
CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `accepts_threads` tinyint(1) NOT NULL DEFAULT 0,
  `newest_thread_id` int(10) unsigned DEFAULT NULL,
  `latest_active_thread_id` int(10) unsigned DEFAULT NULL,
  `thread_count` int(11) NOT NULL DEFAULT 0,
  `post_count` int(11) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `_lft` int(10) unsigned NOT NULL DEFAULT 0,
  `_rgt` int(10) unsigned NOT NULL DEFAULT 0,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.forum_categories: ~0 rows (approximately)
REPLACE INTO `forum_categories` (`id`, `title`, `description`, `accepts_threads`, `newest_thread_id`, `latest_active_thread_id`, `thread_count`, `post_count`, `is_private`, `created_at`, `updated_at`, `_lft`, `_rgt`, `parent_id`, `color`) VALUES
	(1, 'Atque non quis minima laudantium non.', 'Est nihil est maxime nam minima voluptate ipsam. Fuga aspernatur fuga voluptates illo dolorem est et sed. Rerum nam unde dolores.', 1, 1, 1, 2, 10, 0, '2024-10-23 20:57:59', '2024-10-23 20:57:59', 1, 4, NULL, NULL),
	(2, 'In repellat velit quia corrupti numquam.', 'Labore sapiente voluptatem voluptates nisi reprehenderit. Esse id voluptatem illum. Voluptates quam molestias nam et nihil dolor iste.', 1, NULL, NULL, 0, 0, 0, '2024-10-23 20:57:59', '2024-10-23 20:57:59', 5, 6, NULL, NULL),
	(3, 'Sed sint iusto odit inventore quaerat debitis.', 'Accusamus tempora quo dolorum porro minus. Architecto ea doloribus quo et et iste. Dolores dolorum rerum ut qui. Eum mollitia officiis velit reiciendis voluptatem ea fuga.', 1, 3, 3, 2, 10, 0, '2024-10-23 20:57:59', '2024-10-23 20:57:59', 2, 3, 1, NULL);

-- Dumping structure for table conzonedb.forum_posts
DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `post_id` int(10) unsigned DEFAULT NULL,
  `sequence` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_posts_thread_id_index` (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.forum_posts: ~0 rows (approximately)
REPLACE INTO `forum_posts` (`id`, `thread_id`, `author_id`, `content`, `post_id`, `sequence`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, 'Illum nobis rerum aliquam quam facere ratione voluptatem possimus. Atque sunt quae et quam. Doloremque assumenda quaerat libero rerum.', NULL, 1, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(2, 1, 2, 'Laboriosam qui et qui. Mollitia nesciunt beatae quia omnis consequatur excepturi natus. Vitae sequi cum dolor eaque minus. Voluptas occaecati quasi nesciunt culpa ut a.', NULL, 2, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(3, 1, 2, 'Enim consequatur dicta provident vero. Mollitia qui laborum voluptatem quia veniam. Et quas tempore non eos dolores suscipit adipisci earum. Sint voluptas aliquam cumque perferendis sunt eius aut.', NULL, 3, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(4, 1, 2, 'Repellendus ea numquam molestias est ipsam non quam. Laboriosam esse optio vero iure. Aliquid commodi nam ipsam dolorem atque eveniet delectus. Mollitia laborum odio adipisci architecto et odio omnis.', NULL, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(5, 1, 2, 'Est molestiae modi assumenda molestias. Tempore voluptas perferendis numquam pariatur iusto temporibus. Labore vero voluptas saepe reiciendis rem quo unde. Rerum vero dolorum voluptatem ut est.', NULL, 5, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(6, 2, 2, 'Sunt saepe voluptates esse dicta suscipit. Pariatur neque autem quo fugiat ut sequi. Dolorem adipisci soluta odio. Voluptatem molestias alias quo non. Quo doloremque veniam autem nam. Esse totam quia non.', NULL, 1, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(7, 2, 2, 'Labore tempore facilis rem ea et quisquam recusandae. Cumque nihil architecto ut earum. Voluptatem iure qui minus et libero.', NULL, 2, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(8, 2, 2, 'Saepe repellendus quia odio enim ad itaque eos. Hic numquam minus qui. Cupiditate distinctio pariatur ut ea aut odio amet. Voluptate sed dolor laboriosam. Maxime eum et perspiciatis doloribus quis aliquid nulla. Commodi vero ipsa iusto molestiae.', NULL, 3, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(9, 2, 2, 'Voluptas exercitationem molestiae ratione expedita est. Aliquid ipsa quod ut alias. Provident recusandae enim sunt quisquam voluptates in alias sed. Qui praesentium ut suscipit non minus aut sed.', NULL, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(10, 2, 2, 'Non consequatur eveniet ad et. Qui consectetur facilis consequuntur sed alias quia velit. Sed fugiat earum sequi molestias dignissimos. Dolor voluptas ex quia non blanditiis provident. Porro et earum dignissimos eligendi consectetur facilis sapiente. Fugit delectus quibusdam quas sint tempora.', NULL, 5, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(11, 3, 2, 'Consequuntur ut praesentium veniam temporibus mollitia ex unde. Quos sit quasi voluptas eaque sed. Illo pariatur eius cum sit consequuntur. Harum nesciunt eaque sint in fugit.', NULL, 1, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(12, 3, 2, 'Nobis nihil unde debitis non. Sed et nesciunt ut id. Ex exercitationem et velit quis. Id qui qui repellendus ut a id. Impedit est qui fuga voluptate nobis et sit quod. Rerum illo in ipsum.', NULL, 2, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(13, 3, 2, 'Nemo autem et minima mollitia eos ab. Dolorum in voluptates quis provident nisi molestias. Reiciendis eos dolor atque quia consequatur vero autem veritatis. Quae dicta voluptatem dolores consequatur quibusdam dolorem. Voluptatibus sit sit repudiandae accusantium.', NULL, 3, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(14, 3, 2, 'Non explicabo tempore esse omnis nam. Quo magnam eius earum magni et. Sed aut placeat non. Magnam qui tempore debitis.', NULL, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(15, 3, 2, 'Ab cum ut dolore distinctio ex aut. Optio ea impedit voluptas et alias maxime. Voluptates rerum et ut quaerat. Ut amet velit aliquid voluptatem quisquam dolorem.', NULL, 5, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(16, 4, 2, 'Dolore quia occaecati eaque rerum consequatur. Ad exercitationem et aut ipsam dolore fugit. Reiciendis ut accusamus maxime delectus. Est eum officiis sit alias optio rerum.', NULL, 1, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(17, 4, 2, 'Nostrum optio ut nostrum voluptatum excepturi amet. Omnis nobis repellendus ea. Esse nesciunt consequatur consequatur quia tenetur est iusto. Quisquam sint sapiente nostrum eaque molestiae iste. Optio consequatur dicta saepe deleniti vel quod a.', NULL, 2, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(18, 4, 2, 'Dolore soluta sint voluptates sint vero est ab. Magni provident quas ratione odio. Architecto omnis temporibus qui id. Iste ipsam laborum quo perspiciatis doloremque modi.', NULL, 3, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(19, 4, 2, 'Laudantium dolores necessitatibus enim aut dolores. Deleniti omnis amet libero corrupti nostrum unde ut. Aliquam et tempore porro et. Dolor nisi necessitatibus et ex est saepe. Culpa officiis et dolore nam sed ratione.', NULL, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(20, 4, 2, 'Laborum et voluptate est sit repellat asperiores. Et illum laudantium et reiciendis. Sed ut autem odit dolore odit aut. Animi qui omnis consequuntur sed praesentium. Sint eaque dolorem culpa voluptas dolores sit est. Deserunt ut amet quia aut eum tempora rerum.', NULL, 5, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL);

-- Dumping structure for table conzonedb.forum_threads
DROP TABLE IF EXISTS `forum_threads`;
CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `pinned` tinyint(1) DEFAULT 0,
  `locked` tinyint(1) DEFAULT 0,
  `first_post_id` int(10) unsigned DEFAULT NULL,
  `last_post_id` int(10) unsigned DEFAULT NULL,
  `reply_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_threads_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.forum_threads: ~0 rows (approximately)
REPLACE INTO `forum_threads` (`id`, `category_id`, `author_id`, `title`, `pinned`, `locked`, `first_post_id`, `last_post_id`, `reply_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, 'Quasi eum quo sit in qui pariatur sit.', 0, 0, 1, 1, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(2, 1, 2, 'Pariatur et consequatur inventore explicabo quam eum minima aut.', 0, 0, 6, 6, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(3, 3, 2, 'Libero provident laudantium illum explicabo voluptatum minus.', 0, 0, 11, 11, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL),
	(4, 3, 2, 'Aperiam nam architecto perspiciatis hic assumenda et.', 0, 0, 16, 16, 4, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL);

-- Dumping structure for table conzonedb.forum_threads_read
DROP TABLE IF EXISTS `forum_threads_read`;
CREATE TABLE IF NOT EXISTS `forum_threads_read` (
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.forum_threads_read: ~0 rows (approximately)

-- Dumping structure for table conzonedb.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.jobs: ~0 rows (approximately)

-- Dumping structure for table conzonedb.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.job_batches: ~0 rows (approximately)

-- Dumping structure for table conzonedb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.migrations: ~21 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(22, '0001_01_01_000000_create_users_table', 1),
	(23, '0001_01_01_000001_create_cache_table', 1),
	(24, '0001_01_01_000002_create_jobs_table', 1),
	(25, '2014_05_19_151759_create_forum_table_categories', 1),
	(26, '2014_05_19_152425_create_forum_table_threads', 1),
	(27, '2014_05_19_152611_create_forum_table_posts', 1),
	(28, '2015_04_14_180344_create_forum_table_threads_read', 1),
	(29, '2015_07_22_181406_update_forum_table_categories', 1),
	(30, '2015_07_22_181409_update_forum_table_threads', 1),
	(31, '2015_07_22_181417_update_forum_table_posts', 1),
	(32, '2016_05_24_114302_add_defaults_to_forum_table_threads_columns', 1),
	(33, '2016_07_09_111441_add_counts_to_categories_table', 1),
	(34, '2016_07_09_122706_add_counts_to_threads_table', 1),
	(35, '2016_07_10_134700_add_sequence_to_posts_table', 1),
	(36, '2018_11_04_211718_update_categories_table', 1),
	(37, '2019_09_07_210904_update_forum_category_booleans', 1),
	(38, '2019_09_07_230148_add_color_to_categories', 1),
	(39, '2020_03_22_050710_add_thread_ids_to_categories', 1),
	(40, '2020_03_22_055827_add_post_id_to_threads', 1),
	(41, '2020_12_02_233754_add_first_post_id_to_threads', 1),
	(42, '2021_07_31_094750_add_fk_indices', 1);

-- Dumping structure for table conzonedb.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table conzonedb.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.sessions: ~0 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('5HOamp9JbH1Q9UZDyVSslByn2D4C6Y3bUCVUQQmP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDQ3OUJmODMxTDdZOWphSU9mTkZGQU8zaW5xOE1EdE1ZZjlRa3BXeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9jb256b25lcmV2YW1wLnRlc3QvcHJvZmlsZS8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1729693313);

-- Dumping structure for table conzonedb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `displayname` varchar(30) DEFAULT NULL,
  `username` char(20) NOT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Member',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `profile_banner` varchar(255) DEFAULT NULL,
  `social_email` int(11) NOT NULL DEFAULT 0,
  `social_website` varchar(255) DEFAULT NULL,
  `social_x` varchar(15) DEFAULT NULL,
  `social_facebook` varchar(50) DEFAULT NULL,
  `social_instagram` varchar(30) DEFAULT NULL,
  `social_youtube` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table conzonedb.users: ~2 rows (approximately)
REPLACE INTO `users` (`id`, `displayname`, `username`, `bio`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_image`, `profile_banner`, `social_email`, `social_website`, `social_x`, `social_facebook`, `social_instagram`, `social_youtube`) VALUES
	(1, 'conzone', 'conzone', 'ConZone Founder', 'con@zo.ne', NULL, 'Member', '$2y$12$ya1L1i7FEgw0fuiiXIebTuKh3ssoe69G4sLjbVKUl6TNk5ASH3NTe', NULL, '2024-10-23 15:58:04', '2024-10-23 21:21:06', 'users/profile-imgs/avatar-1/vcABNoxlCJtP0GpVgzETAyGLZJ0Y8MjR98sEk4AX.png', 'users/profile-banners/avatar-1/e2Hxp2Bvx0oJKhhiOod1uCqb4Hm6l6MOzZjseEWl.png', 0, NULL, NULL, NULL, NULL, NULL),
	(2, 'Adella Ruecker', 'lelia71', 'Aliquam nam cum animi eveniet error aspernatur quisquam maiores enim minima esse nihil odit adipisci culpa aut quos autem itaque similique aperiam voluptatem asperiores ut doloribus odio at et qui aut inventore.', 'balistreri.micaela@yahoo.com', NULL, 'Member', '$2y$12$t7IVO2pD3qTNZ0KAWgEuSulXA9hf.v./ALRi5SbEHgBKQpcfbxMju', NULL, '2024-10-23 20:57:59', '2024-10-23 20:57:59', NULL, NULL, 1, 'http://www.brakus.com/exercitationem-molestiae-alias-explicabo-laborum', 'lelia71', 'lelia71', 'lelia71', 'lelia71');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
