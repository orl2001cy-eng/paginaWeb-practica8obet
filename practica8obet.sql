-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla practica8obet.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.cache: ~0 rows (aproximadamente)
DELETE FROM `cache`;

-- Volcando estructura para tabla practica8obet.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.cache_locks: ~0 rows (aproximadamente)
DELETE FROM `cache_locks`;

-- Volcando estructura para tabla practica8obet.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.companies: ~0 rows (aproximadamente)
DELETE FROM `companies`;

-- Volcando estructura para tabla practica8obet.failed_jobs
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

-- Volcando datos para la tabla practica8obet.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;

-- Volcando estructura para tabla practica8obet.jobs
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

-- Volcando datos para la tabla practica8obet.jobs: ~0 rows (aproximadamente)
DELETE FROM `jobs`;

-- Volcando estructura para tabla practica8obet.job_batches
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

-- Volcando datos para la tabla practica8obet.job_batches: ~0 rows (aproximadamente)
DELETE FROM `job_batches`;

-- Volcando estructura para tabla practica8obet.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.migrations: ~12 rows (aproximadamente)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_10_27_030522_create_products_table', 1),
	(5, '2025_11_06_050147_add_image_to_products_table', 1),
	(6, '2025_11_09_203141_create_personal_access_tokens_table', 1),
	(7, '2025_12_05_014127_create_companies_table', 1),
	(8, '2025_12_05_041731_add_avatar_to_users_table', 1),
	(9, '2026_01_28_003655_cleanup_manual_role_column', 1),
	(10, '2026_01_28_004236_create_permission_tables', 1),
	(11, '2026_02_25_000001_create_orders_table', 2),
	(12, '2026_02_25_000002_create_order_items_table', 2);

-- Volcando estructura para tabla practica8obet.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.model_has_permissions: ~0 rows (aproximadamente)
DELETE FROM `model_has_permissions`;

-- Volcando estructura para tabla practica8obet.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.model_has_roles: ~0 rows (aproximadamente)
DELETE FROM `model_has_roles`;

-- Volcando estructura para tabla practica8obet.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('stripe','paypal','bank_transfer') NOT NULL DEFAULT 'stripe',
  `payment_status` enum('pending','completed','failed','cancelled') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `order_status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `bank_reference` varchar(255) DEFAULT NULL COMMENT 'Bank transfer reference number',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_transaction_id_unique` (`transaction_id`),
  KEY `orders_user_id_index` (`user_id`),
  KEY `orders_payment_status_index` (`payment_status`),
  KEY `orders_order_status_index` (`order_status`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.orders: ~16 rows (aproximadamente)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `payment_method`, `payment_status`, `transaction_id`, `order_status`, `bank_reference`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 2, 1.00, 'paypal', 'completed', '0FG57397JL265384F', 'pending', NULL, NULL, '2026-02-27 00:38:02', '2026-02-27 00:38:02'),
	(2, 2, 1.00, 'paypal', 'completed', '8PE28739S23477337', 'pending', NULL, NULL, '2026-02-27 00:43:20', '2026-02-27 00:43:20'),
	(3, 2, 1.00, 'stripe', 'completed', 'pi_3T9X9lRDVhpMENLC1RdjM8E4', 'pending', NULL, NULL, '2026-03-11 02:45:53', '2026-03-11 02:45:53'),
	(4, 2, 1.00, 'stripe', 'completed', 'pi_3T9XBORDVhpMENLC07ksJ6je', 'pending', NULL, NULL, '2026-03-11 02:47:17', '2026-03-11 02:47:17'),
	(5, 2, 1.00, 'stripe', 'completed', 'pi_3T9tOiRDVhpMENLC1imPtLfX', 'pending', NULL, NULL, '2026-03-12 02:30:45', '2026-03-12 02:30:45'),
	(6, 2, 1.00, 'stripe', 'completed', 'pi_3TAaOiRDVhpMENLC1tA8xeeO', 'pending', NULL, NULL, '2026-03-14 00:25:37', '2026-03-14 00:25:38'),
	(7, 2, 1.00, 'stripe', 'completed', 'pi_3TAafURDVhpMENLC1lHeohmh', 'pending', NULL, NULL, '2026-03-14 00:42:41', '2026-03-14 00:42:41'),
	(8, 2, 1.00, 'stripe', 'completed', 'pi_3TAbpERDVhpMENLC07SnCOpF', 'pending', NULL, NULL, '2026-03-14 01:56:49', '2026-03-14 01:56:49'),
	(9, 2, 1.00, 'stripe', 'completed', 'pi_3TAbvQRDVhpMENLC1jIMMC5n', 'pending', NULL, NULL, '2026-03-14 02:03:12', '2026-03-14 02:03:12'),
	(10, 2, 1.00, 'stripe', 'completed', 'pi_3TCl9dRDVhpMENLC0Pe2CzMU', 'pending', NULL, NULL, '2026-03-20 00:19:04', '2026-03-20 00:19:04'),
	(11, 2, 1.00, 'stripe', 'completed', 'pi_3TClcCRDVhpMENLC1zaCeo1D', 'pending', NULL, NULL, '2026-03-20 00:48:18', '2026-03-20 00:48:18'),
	(12, 2, 1.00, 'stripe', 'completed', 'pi_3TCllhRDVhpMENLC07Dw5SYM', 'pending', NULL, NULL, '2026-03-20 00:58:06', '2026-03-20 00:58:07'),
	(13, 1, 14970.00, 'bank_transfer', 'pending', NULL, 'pending', 'ORD1774291108744', 'Pending bank transfer confirmation', '2026-03-24 00:38:37', '2026-03-24 00:38:37'),
	(14, 1, 1.00, 'stripe', 'completed', 'pi_3TEDdURDVhpMENLC0RSE6GNn', 'pending', NULL, NULL, '2026-03-24 00:55:51', '2026-03-24 00:55:51'),
	(15, 2, 115.00, 'bank_transfer', 'pending', NULL, 'pending', 'ORD1777103092831', 'Pending bank transfer confirmation', '2026-04-25 13:45:03', '2026-04-25 13:45:03'),
	(16, 2, 115.00, 'stripe', 'completed', 'pi_3TQ30bRDVhpMENLC18zHopmV', 'pending', NULL, NULL, '2026-04-25 16:00:31', '2026-04-25 16:00:31');

-- Volcando estructura para tabla practica8obet.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL COMMENT 'Price per unit at time of purchase',
  `total` decimal(10,2) NOT NULL COMMENT 'Subtotal for this item',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_index` (`order_id`),
  KEY `order_items_product_id_index` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.order_items: ~6 rows (aproximadamente)
DELETE FROM `order_items`;
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
	(14, 13, 5, 1, 1.00, 1.00, '2026-03-24 00:38:37', '2026-03-24 00:38:37'),
	(15, 13, 16, 1, 900.00, 900.00, '2026-03-24 00:38:37', '2026-03-24 00:38:37'),
	(16, 13, 14, 1, 1500.00, 1500.00, '2026-03-24 00:38:37', '2026-03-24 00:38:37'),
	(18, 13, 17, 1, 660.00, 660.00, '2026-03-24 00:38:37', '2026-03-24 00:38:37'),
	(21, 15, 4, 1, 115.00, 115.00, '2026-04-25 13:45:03', '2026-04-25 13:45:03'),
	(22, 16, 4, 1, 115.00, 115.00, '2026-04-25 16:00:31', '2026-04-25 16:00:31');

-- Volcando estructura para tabla practica8obet.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.password_reset_tokens: ~0 rows (aproximadamente)
DELETE FROM `password_reset_tokens`;

-- Volcando estructura para tabla practica8obet.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.permissions: ~0 rows (aproximadamente)
DELETE FROM `permissions`;

-- Volcando estructura para tabla practica8obet.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.personal_access_tokens: ~0 rows (aproximadamente)
DELETE FROM `personal_access_tokens`;

-- Volcando estructura para tabla practica8obet.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.products: ~26 rows (aproximadamente)
DELETE FROM `products`;
INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `created_at`, `updated_at`) VALUES
	(4, 'Miel & Cera', 'Bálsamo protector elaborado con cera de abeja pura que crea una barrera natural contra el frío y el', 'products/b328068b-00e1-4a8a-8a0d-66301848d8d8.png', 115.00, '2026-02-14 01:17:25', '2026-04-25 13:23:42'),
	(5, 'Zen Floral', 'Mezcla de aceites esenciales deshidratados y plantas medicinales que actúa como un rescate para piel', 'products/8518e2dc-d709-4d51-a1b8-061e6becac01.png', 340.00, '2026-02-14 01:17:25', '2026-04-25 13:24:52'),
	(6, 'Cacao Skin', 'Tratamiento intensivo en polvo con cacao puro avena coloidal, rico en antioxidantes para combatir lo', 'products/2c480584-161a-48f4-84d8-eb046b050ab5.png', 230.00, '2026-02-14 01:17:28', '2026-04-25 13:25:50'),
	(7, 'ALOE REFRESCANTE', 'Crema corporal de aloe vera puro diseñada para hidratar profundamente después del baño o la exposici', 'products/5d5f2e4a-c31c-4027-aa6c-621fb0063394.png', 210.00, '2026-02-14 01:17:28', '2026-04-25 13:26:43'),
	(10, 'Aloe Hidratante', 'Crema facial ligera de aloe vera diseñada para calmar y refrescar el rostro al instante. Su fórmula', 'products/22b5a6f4-fae3-46e7-b785-772752cc1070.png', 245.00, '2026-02-14 01:17:28', '2026-04-25 13:27:50'),
	(14, 'mascarilla aloe vera', 'Mascarilla aclarante con ingredientes naturales que unifican el tono de la piel y suavizan manchas.', 'products/d2785a13-0746-44b2-925a-0d9d8b9ef943.png', 240.00, '2026-02-18 02:36:36', '2026-04-25 13:19:04'),
	(16, 'Cítricos Vitales', 'Mantequilla corporal de cacao con alto poder nutritivo, ideal para zonas extra secas como codos y ro', 'products/b9f47650-873f-4021-b73b-4c762fc99c07.png', 350.00, '2026-02-18 02:43:14', '2026-04-25 13:22:27'),
	(17, 'hidratante facial', 'Mezcla de aceites esenciales deshidratados y plantas medicinales que actúa como un rescate para piel', 'products/dbf75b95-12dc-41e3-a944-d1a64afcd604.png', 240.00, '2026-02-18 02:47:54', '2026-04-25 13:21:30'),
	(26, 'Beso de Cacao', 'Tratamiento labial con manteca de cacao orgánica que nutre profundamente las capas de la piel. Graci', 'products/268f3f74-b6e8-462c-9daa-d5cbb3c7ca1e.png', 120.00, '2026-04-25 14:14:34', '2026-04-25 14:14:34'),
	(27, 'Crema Hidratante Natural', '.', 'products/7348a2ca-497f-49bc-a15f-b4646cfa7899.png', 120.00, '2026-04-25 15:13:44', '2026-04-25 15:13:46'),
	(28, 'Aceite de Rosa Mosqueta', 'Aceite puro prensado en frío para regenerar y nutrir la piel.', NULL, 15.50, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(29, 'Crema Hidratante de Aloe', 'Crema ligera y refrescante con extracto puro de aloe vera.', NULL, 22.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(30, 'Sérum de Vitamina C Botánico', 'Sérum antioxidante con extractos de frutas para iluminar el rostro.', NULL, 35.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(31, 'Exfoliante de Café y Coco', 'Exfoliante natural corporal que remueve células muertas y activa la circulación.', NULL, 18.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(32, 'Mascarilla de Arcilla Verde', 'Purifica y equilibra las pieles grasas o mixtas.', NULL, 12.50, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(33, 'Bálsamo Labial de Manteca', 'Hidratación profunda para labios resecos con karité.', NULL, 6.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(34, 'Jabón Artesanal de Lavanda', 'Relajante jabón corporal hecho con aceites esenciales.', NULL, 8.50, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(35, 'Tónico Facial de Rosas', 'Tónico refrescante sin alcohol para equilibrar el pH.', NULL, 14.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(36, 'Aceite de Árbol de Té', 'Propiedades antibacterianas naturales para imperfecciones.', NULL, 11.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(37, 'Champú Sólido de Romero', 'Fortalece el cuero cabelludo y estimula el crecimiento.', NULL, 16.50, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(38, 'Acondicionador de Aguacate', 'Nutre intensamente el cabello seco o dañado.', NULL, 19.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(39, 'Loción Corporal de Almendras', 'Suaviza y protege la piel con aceite de almendras dulces.', NULL, 24.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(40, 'Desodorante Piedra Alumbre', 'Protección duradera sin aluminio sintético.', NULL, 9.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(41, 'Contorno de Ojos Hialurónico', 'Reduce bolsas y líneas de expresión con ácido hialurónico vegetal.', NULL, 28.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(42, 'Manteca Corporal de Cacao', 'Hidratación extrema para zonas secas del cuerpo.', NULL, 21.50, '2026-04-25 15:18:17', '2026-04-25 15:18:17'),
	(43, 'Agua Micelar de Manzanilla', 'Desmaquillante suave que respeta las pieles más sensibles.', NULL, 13.00, '2026-04-25 15:18:17', '2026-04-25 15:18:17');

-- Volcando estructura para tabla practica8obet.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.roles: ~0 rows (aproximadamente)
DELETE FROM `roles`;

-- Volcando estructura para tabla practica8obet.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.role_has_permissions: ~0 rows (aproximadamente)
DELETE FROM `role_has_permissions`;

-- Volcando estructura para tabla practica8obet.sessions
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

-- Volcando datos para la tabla practica8obet.sessions: ~7 rows (aproximadamente)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('aynGSCnxF08yr68qp4WOiyyTaVhwbkn92L9ogyPw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMjoiaHR0cDovL3ByYWN0aWNhOG9iZXQudGVzdC9sb2dvdXQiO3M6NToicm91dGUiO3M6NjoibG9nb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777104705),
	('GJ0EBZKoSMcvKyFYpApOjBUwcu1nXRJZQW91hgaC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMjoiaHR0cDovL3ByYWN0aWNhOG9iZXQudGVzdC9sb2dvdXQiO3M6NToicm91dGUiO3M6NjoibG9nb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777112335),
	('hY4nfUtSmMoPTAWLbWcB8AK058mESXEKsHZcJN9q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienJiNG1MUEp1WDJLeDJTVGJqZEtqV1g2MWdKTmRCZWVPaWNNVEFnNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9wcmFjdGljYThvYmV0LnRlc3QiO3M6NToicm91dGUiO3M6Nzoid2VsY29tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777119309),
	('j6WW2OoaOMR59UU6NynusPQbrkLrBYhqRhRDLAAo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMjoiaHR0cDovL3ByYWN0aWNhOG9iZXQudGVzdC9sb2dvdXQiO3M6NToicm91dGUiO3M6NjoibG9nb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777109411),
	('Ja06t6ZFL7l47Noqkw9jkjDe6RhUTxc1iyajb4Qc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMjoiaHR0cDovL3ByYWN0aWNhOG9iZXQudGVzdC9sb2dvdXQiO3M6NToicm91dGUiO3M6NjoibG9nb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777106195),
	('rU8OOIPEiI9uljL3lSFKEL44bPp0nTiKgjmlHWQF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMjoiaHR0cDovL3ByYWN0aWNhOG9iZXQudGVzdC9sb2dvdXQiO3M6NToicm91dGUiO3M6NjoibG9nb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777104753),
	('WJ1C675eozIAwtTGhAmUuMWWbo85RoYZTA57fZiM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.22.3 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDg3NzRQT3RPZXhSUzU0ZERZZlhEYmxZZWFyNERsSzFFVmFUbEN0cCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9wcmFjdGljYThvYmV0LnRlc3QvP2hlcmQ9cHJldmlldyI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777119251);

-- Volcando estructura para tabla practica8obet.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla practica8obet.users: ~4 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'obet', 'orl2001cy@gmail.com', NULL, NULL, '$2y$12$3RALol5OF5P26bUXTBkE/OEpc3cVfehE/18SlkNxeqwYShYeRB77e', NULL, '2026-02-12 02:39:38', '2026-02-12 02:39:38'),
	(2, 'jhon cena', 'jhoncena@gmail.com', NULL, NULL, '$2y$12$Ro0HmcaZNtqQuMtKWdcRTe6K64zh0SI5GeeCLT.wyLxa2Ek0/m1om', 'jTOG0LnzY7OddL0zwf9eiXoc8NRTT9S9cEj40OQkB7dVC42NZ9CfLp5uAfS5', '2026-02-12 02:58:02', '2026-02-12 02:58:02'),
	(3, 'orlando', 'orlando@gmail.com', NULL, NULL, '$2y$12$ws6XTMn.19C4p/SZrHb6beOt.AUpkTd/ZYqesL8Ol65fk0HBkPmuS', NULL, '2026-02-12 03:02:49', '2026-02-12 03:02:49'),
	(4, 'orlando', 'orli@gmail.com', NULL, NULL, '$2y$12$ewxk.KN580XbC.Ea.CueIeMzPyIgqT/4Nf/4oatp9Bw1chSi3oRHe', NULL, '2026-02-12 03:05:34', '2026-02-12 03:05:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
