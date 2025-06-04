

CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `browser_agent` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `fa_status` tinyint(4) NOT NULL DEFAULT 0,
  `googlefa_secret` varchar(255) DEFAULT NULL,
  `fa_expiring` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO admins VALUES("1","Super Admin","1","admin@mail.com","+918950291871","2025012819154544065.jpg","$2y$12$cYy06fAYMX1s8Y2dO9Fo6.c7DOWgK/pjob89GapMBa5cuxTzVcM8e","","1","0","","","","2025-01-25 17:08:31","2025-01-28 20:25:36");
INSERT INTO admins VALUES("3","Admin","2","admin@mail.com1","23456765432","202501281745026225.jpg","$2y$12$8ezX2Y4d8aZukPQp20p7LuzXvl9AF0V0L7v1Dor8X0.2BSZZ8Jzou","","1","0","","","2025-01-28 19:11:00","2025-01-28 17:45:04","2025-01-28 19:11:00");
INSERT INTO admins VALUES("4","Demo","2","demo@gmail.com","8960989671","2025012817473311386.jpg","$2y$12$vPeV4RtV.zP9AoiQyScVQui53YfwsQdpJmaYtD1eMWgcIPEVfl3Wq","","1","0","","","2025-01-28 19:10:51","2025-01-28 17:47:34","2025-01-28 19:10:51");
INSERT INTO admins VALUES("5","Admin","2","admin@mail.com2","74993894982","2025012819062684627.jpg","$2y$12$paIT9QyPjjYS6fJQxuAEfuhzyq96TpaeHttBWTPuovvFiYkJdl7iu","","1","0","","","","2025-01-28 18:50:18","2025-01-28 19:26:44");





CREATE TABLE IF NOT EXISTS `backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `backups_created_by_foreign` (`created_by`),
  CONSTRAINT `backups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blog_categories VALUES("1","Categories","categories","1","2025-01-30 10:41:57","2025-01-30 10:41:32","2025-01-30 10:41:57");
INSERT INTO blog_categories VALUES("2","Categories1","categories-1","1","","2025-01-30 10:42:21","2025-01-30 11:57:37");





CREATE TABLE IF NOT EXISTS `blog_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_tags_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blog_tags VALUES("1","Tag","tag","1","2025-01-30 11:01:56","2025-01-30 11:01:48","2025-01-30 11:01:56");
INSERT INTO blog_tags VALUES("2","Tag1","tag-1","1","","2025-01-30 11:02:05","2025-01-30 11:58:05");





CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `credit` varchar(255) DEFAULT NULL,
  `credit_url` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `orderby` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blogs VALUES("1","Blogs","blogs","Blogs","<p>Blogs</p>","2","2","1","2025013011372310901.jpg","1","Blogs","Blogs","1","1","2025-01-30 11:39:34","2025-01-30 11:37:23","2025-01-30 11:39:34");
INSERT INTO blogs VALUES("2","Blogs1","blogs-1","Blogs","<h4 class=\"form-section\">Blogs</h4>","2","2","1","2025013011404639267.jpg","1","Blogs1","Blogs","1","2","","2025-01-30 11:40:46","2025-01-30 11:59:45");





CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `blog_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `comment` text NOT NULL,
  `like` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_blog_id_foreign` (`blog_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_short_name_unique` (`short_name`),
  UNIQUE KEY `iso3` (`iso3`)
) ENGINE=InnoDB AUTO_INCREMENT=899 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO countries VALUES("4","AF","Afghanistan","AFG","4","93","AFN","https://s3.amazonaws.com/rld-flags/af.svg","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("8","AL","Albania","ALB","8","355","ALL","https://s3.amazonaws.com/rld-flags/al.svg","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("10","AQ","Antarctica","ATA","10","0","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("12","DZ","Algeria","DZA","12","213","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("16","AS","American Samoa","ASM","16","1684","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("20","AD","Andorra","AND","20","376","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("24","AO","Angola","AGO","24","244","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("28","AG","Antigua and Barbuda","ATG","28","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("31","AZ","Azerbaijan","AZE","31","994","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("32","AR","Argentina","ARG","32","54","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("36","AU","Australia","AUS","36","61","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("40","AT","Austria","AUT","40","43","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("44","BS","Bahamas","BHS","44","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("48","BH","Bahrain","BHR","48","973","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("50","BD","Bangladesh","BGD","50","880","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("51","AM","Armenia","ARM","51","374","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("52","BB","Barbados","BRB","52","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("56","BE","Belgium","BEL","56","32","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("60","BM","Bermuda","BMU","60","1441","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("64","BT","Bhutan","BTN","64","975","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("68","BO","Bolivia","BOL","68","591","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("70","BA","Bosnia and Herzegovina","BIH","70","387","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("72","BW","Botswana","BWA","72","267","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("74","BV","Bouvet Island","BVT","74","0","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("76","BR","Brazil","BRA","76","55","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("84","BZ","Belize","BLZ","84","501","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("86","IO","British Indian Ocean Territory","IOT","86","246","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("90","SB","Solomon Islands","SLB","90","677","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("92","VG","Virgin Islands, British","VGB","92","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("96","BN","Brunei Darussalam","BRN","96","673","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("100","BG","Bulgaria","BGR","100","359","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("104","MM","Myanmar","MMR","104","95","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("108","BI","Burundi","BDI","108","257","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("112","BY","Belarus","BLR","112","375","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("116","KH","Cambodia","KHM","116","855","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("120","CM","Cameroon","CMR","120","237","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("124","CA","Canada","CAN","124","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("132","CV","Cape Verde","CPV","132","238","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("136","KY","Cayman Islands","CYM","136","1345","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("140","CF","Central African Republic","CAF","140","236","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("144","LK","Sri Lanka","LKA","144","94","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("148","TD","Chad","TCD","148","235","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("152","CL","Chile","CHL","152","56","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("156","CN","China","CHN","156","86","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("158","TW","Taiwan, Province of China","TWN","158","886","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("162","CX","Christmas Island","CXR","162","61","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("166","CC","Cocos (Keeling) Islands","CCK","166","672","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("170","CO","Colombia","COL","170","57","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("174","KM","Comoros","COM","174","269","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("178","CG","Congo","COG","178","242","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("180","CD","Congo, the Democratic Republic of the","COD","180","242","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("184","CK","Cook Islands","COK","184","682","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("188","CR","Costa Rica","CRI","188","506","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("191","HR","Croatia","HRV","191","385","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("192","CU","Cuba","CUB","192","53","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("196","CY","Cyprus","CYP","196","357","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("203","CZ","Czech Republic","CZE","203","420","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("204","BJ","Benin","BEN","204","229","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("208","DK","Denmark","DNK","208","45","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("212","DM","Dominica","DMA","212","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("214","DO","Dominican Republic","DOM","214","1","DOP","https://s3.amazonaws.com/rld-flags/do.svg","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("218","EC","Ecuador","ECU","218","593","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("222","SV","El Salvador","SLV","222","503","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("226","GQ","Equatorial Guinea","GNQ","226","240","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("231","ET","Ethiopia","ETH","231","251","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("232","ER","Eritrea","ERI","232","291","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("233","EE","Estonia","EST","233","372","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("234","FO","Faroe Islands","FRO","234","298","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("238","FK","Falkland Islands (Malvinas)","FLK","238","500","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("239","GS","South Georgia and the South Sandwich Islands","SGS","239","0","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("242","FJ","Fiji","FJI","242","679","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("246","FI","Finland","FIN","246","358","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("250","FR","France","FRA","250","33","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("254","GF","French Guiana","GUF","254","594","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("258","PF","French Polynesia","PYF","258","689","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("260","TF","French Southern Territories","ATF","260","0","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("262","DJ","Djibouti","DJI","262","253","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("266","GA","Gabon","GAB","266","241","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("268","GE","Georgia","GEO","268","995","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("270","GM","Gambia","GMB","270","220","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("275","PS","Palestinian Territory, Occupied","PSE","275","970","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("276","DE","Germany","DEU","276","49","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("288","GH","Ghana","GHA","288","233","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("292","GI","Gibraltar","GIB","292","350","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("296","KI","Kiribati","KIR","296","686","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("300","GR","Greece","GRC","300","30","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("304","GL","Greenland","GRL","304","299","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("308","GD","Grenada","GRD","308","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("312","GP","Guadeloupe","GLP","312","590","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("316","GU","Guam","GUM","316","1671","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("320","GT","Guatemala","GTM","320","502","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("324","GN","Guinea","GIN","324","224","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("328","GY","Guyana","GUY","328","592","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("332","HT","Haiti","HTI","332","509","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("334","HM","Heard Island and Mcdonald Islands","HMD","334","0","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("336","VA","Holy See (Vatican City State)","VAT","336","39","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("340","HN","Honduras","HND","340","504","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("344","HK","Hong Kong","HKG","344","852","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("348","HU","Hungary","HUN","348","36","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("352","IS","Iceland","ISL","352","354","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("356","IN","India","IND","356","91","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("360","ID","Indonesia","IDN","360","62","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("364","IR","Iran, Islamic Republic of","IRN","364","98","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("368","IQ","Iraq","IRQ","368","964","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("372","IE","Ireland","IRL","372","353","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("376","IL","Israel","ISR","376","972","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("380","IT","Italy","ITA","380","39","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("384","CI","Cote D\'Ivoire","CIV","384","225","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("388","JM","Jamaica","JAM","388","1876","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("392","JP","Japan","JPN","392","81","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("398","KZ","Kazakhstan","KAZ","398","7","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("400","JO","Jordan","JOR","400","962","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("404","KE","Kenya","KEN","404","254","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("408","KP","Korea, Democratic People\'s Republic of","PRK","408","850","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("410","KR","Korea, Republic of","KOR","410","82","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("414","KW","Kuwait","KWT","414","965","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("417","KG","Kyrgyzstan","KGZ","417","996","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("418","LA","Lao People\'s Democratic Republic","LAO","418","856","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("422","LB","Lebanon","LBN","422","961","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("426","LS","Lesotho","LSO","426","266","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("428","LV","Latvia","LVA","428","371","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("430","LR","Liberia","LBR","430","231","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("434","LY","Libyan Arab Jamahiriya","LBY","434","218","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("438","LI","Liechtenstein","LIE","438","423","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("440","LT","Lithuania","LTU","440","370","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("442","LU","Luxembourg","LUX","442","352","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("446","MO","Macao","MAC","446","853","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("450","MG","Madagascar","MDG","450","261","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("454","MW","Malawi","MWI","454","265","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("458","MY","Malaysia","MYS","458","60","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("462","MV","Maldives","MDV","462","960","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("466","ML","Mali","MLI","466","223","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("470","MT","Malta","MLT","470","356","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("474","MQ","Martinique","MTQ","474","596","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("478","MR","Mauritania","MRT","478","222","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("480","MU","Mauritius","MUS","480","230","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("482","YT","Mayotte","MYT","482","269","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("484","MX","Mexico","MEX","484","52","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("492","MC","Monaco","MCO","492","377","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("496","MN","Mongolia","MNG","496","976","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("498","MD","Moldova, Republic of","MDA","498","373","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("500","MS","Montserrat","MSR","500","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("504","MA","Morocco","MAR","504","212","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("508","MZ","Mozambique","MOZ","508","258","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("512","OM","Oman","OMN","512","968","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("516","NA","Namibia","NAM","516","264","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("520","NR","Nauru","NRU","520","674","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("524","NP","Nepal","NPL","524","977","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("528","NL","Netherlands","NLD","528","31","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("530","AN","Netherlands Antilles","ANT","530","599","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("533","AW","Aruba","ABW","533","297","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("540","NC","New Caledonia","NCL","540","687","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("548","VU","Vanuatu","VUT","548","678","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("554","NZ","New Zealand","NZL","554","64","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("558","NI","Nicaragua","NIC","558","505","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("562","NE","Niger","NER","562","227","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("566","NG","Nigeria","NGA","566","234","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("570","NU","Niue","NIU","570","683","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("574","NF","Norfolk Island","NFK","574","672","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("578","NO","Norway","NOR","578","47","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("580","MP","Northern Mariana Islands","MNP","580","1670","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("581","UM","United States Minor Outlying Islands","UMI","581","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("583","FM","Micronesia, Federated States of","FSM","583","691","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("584","MH","Marshall Islands","MHL","584","692","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("585","PW","Palau","PLW","585","680","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("586","PK","Pakistan","PAK","586","92","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("591","PA","Panama","PAN","591","507","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("598","PG","Papua New Guinea","PNG","598","675","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("600","PY","Paraguay","PRY","600","595","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("604","PE","Peru","PER","604","51","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("608","PH","Philippines","PHL","608","63","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("612","PN","Pitcairn","PCN","612","0","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("616","PL","Poland","POL","616","48","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("620","PT","Portugal","PRT","620","351","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("624","GW","Guinea-Bissau","GNB","624","245","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("626","TL","Timor-Leste","TLS","626","670","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("630","PR","Puerto Rico","PRI","630","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("634","QA","Qatar","QAT","634","974","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("638","RE","Reunion","REU","638","262","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("642","RO","Romania","ROM","642","40","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("643","RU","Russian Federation","RUS","643","70","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("646","RW","Rwanda","RWA","646","250","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("654","SH","Saint Helena","SHN","654","290","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("659","KN","Saint Kitts and Nevis","KNA","659","1","XCD","https://s3.amazonaws.com/rld-flags/kn.svg\"","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("660","AI","Anguilla","AIA","660","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("662","LC","Saint Lucia","LCA","662","1","XCD","https://s3.amazonaws.com/rld-flags/lc.svg","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("666","PM","Saint Pierre and Miquelon","SPM","666","508","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("670","VC","Saint Vincent and the Grenadines","VCT","670","1","XCD","https://s3.amazonaws.com/rld-flags/vc.svg","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("674","SM","San Marino","SMR","674","378","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("678","ST","Sao Tome and Principe","STP","678","239","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("682","SA","Saudi Arabia","SAU","682","966","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("686","SN","Senegal","SEN","686","221","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("688","CS","Serbia and Montenegro","SRB","688","381","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("690","SC","Seychelles","SYC","690","248","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("694","SL","Sierra Leone","SLE","694","232","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("702","SG","Singapore","SGP","702","65","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("703","SK","Slovakia","SVK","703","421","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("704","VN","Viet Nam","VNM","704","84","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("705","SI","Slovenia","SVN","705","386","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("706","SO","Somalia","SOM","706","252","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("710","ZA","South Africa","ZAF","710","27","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("716","ZW","Zimbabwe","ZWE","716","263","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("724","ES","Spain","ESP","724","34","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("732","EH","Western Sahara","ESH","732","212","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("736","SD","Sudan","SDN","736","249","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("740","SR","Suriname","SUR","740","597","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("744","SJ","Svalbard and Jan Mayen","SJM","744","47","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("748","SZ","Swaziland","SWZ","748","268","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("752","SE","Sweden","SWE","752","46","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("756","CH","Switzerland","CHE","756","41","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("760","SY","Syrian Arab Republic","SYR","760","963","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("762","TJ","Tajikistan","TJK","762","992","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("764","TH","Thailand","THA","764","66","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("768","TG","Togo","TGO","768","228","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("772","TK","Tokelau","TKL","772","690","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("776","TO","Tonga","TON","776","676","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("780","TT","Trinidad and Tobago","TTO","780","1868","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("784","AE","United Arab Emirates","ARE","784","971","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("788","TN","Tunisia","TUN","788","216","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("792","TR","Turkey","TUR","792","90","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("795","TM","Turkmenistan","TKM","795","7370","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("796","TC","Turks and Caicos Islands","TCA","796","1649","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("798","TV","Tuvalu","TUV","798","688","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("800","UG","Uganda","UGA","800","256","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("804","UA","Ukraine","UKR","804","380","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("807","MK","Macedonia, the Former Yugoslav Republic of","MKD","807","389","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("818","EG","Egypt","EGY","818","20","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("826","GB","United Kingdom","GBR","826","44","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("834","TZ","Tanzania, United Republic of","TZA","834","255","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("840","US","United States","USA","840","1","USD","https://s3.amazonaws.com/rld-flags/so.svg","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("850","VI","Virgin Islands, U.s.","VIR","850","1","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("854","BF","Burkina Faso","BFA","854","226","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("858","UY","Uruguay","URY","858","598","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("860","UZ","Uzbekistan","UZB","860","998","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("862","VE","Venezuela","VEN","862","58","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("876","WF","Wallis and Futuna","WLF","876","681","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("882","WS","Samoa","WSM","882","684","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("887","YE","Yemen","YEM","887","967","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("894","ZM","Zambia","ZMB","894","260","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("895","CW","Curaçao","CUW","531","599","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("896","BQ","Bonaire","BES","535","599","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("897","SX","Sint Maarten","SXM","534","721","","","1","","2025-01-31 12:14:30","2025-01-31 12:15:05");
INSERT INTO countries VALUES("898","Country","Country","Country","Country","Country","Country","","0","2025-01-31 07:27:11","2025-01-31 07:25:03","2025-01-31 07:27:11");





CREATE TABLE IF NOT EXISTS `email_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email_protocol` varchar(255) NOT NULL DEFAULT 'smtp',
  `email_encryption` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(11) NOT NULL DEFAULT 587,
  `smtp_email` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `from_address` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `notification_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO email_configs VALUES("1","smtp","smtp","smtp","587","smtp","smtp","smtp","smtp","smtp","0","smtp","2025-01-31 01:38:58","2025-01-30 20:30:41");





CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `temp_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_temp_id_unique` (`temp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO email_templates VALUES("1","1","new user","new user body 12","email","1","","2025-01-31 02:14:21","2025-01-30 21:37:44");
INSERT INTO email_templates VALUES("2","2","Verification Link 2","Verification Link 2","email","1","","2025-01-31 03:06:03","2025-01-30 21:37:30");





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






CREATE TABLE IF NOT EXISTS `home_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content1` text DEFAULT NULL,
  `content2` text DEFAULT NULL,
  `content3` text DEFAULT NULL,
  `content4` text DEFAULT NULL,
  `content5` text DEFAULT NULL,
  `content6` text DEFAULT NULL,
  `content7` text DEFAULT NULL,
  `content8` text DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `attachment1` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO home_pages VALUES("1","I am Bhawesh Bhaskar, a Full Stack Sr. Software Developer. I am a good learner and always eager to learn new technologies. I can develop both client and server software. In addition to mastering HTML and CSS, I also know how to: Program a browser (like using JavaScript, jQuery) Program a server (like using Laravel, Code Ignitor or Core PHP)","<span style=\"color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">I quickly came to understand that code is a superpower every young man should be able to access. Understanding that code is the underlying (and invisible) framework of tech means that we do not have to be passive bystanders in our ever-changing digital world. I came in with near zero programming knowledge and halfway in, I’m quite confident of what I can achieve.</span>","<p style=\"margin-bottom: 0px; color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(245, 248, 253);\">I am good in Backend processing using Laravel, Core PHP and MySql.</p><p style=\"margin-bottom: 0px; color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(245, 248, 253);\">I am also good in Frontend Design and have a good experience in it.I am good in HTML 5, CSS 3, Bootstrap 4.0, Java Script, J Query and Photoshop.</p><p style=\"margin-bottom: 0px; color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(245, 248, 253);\">I have also good hands on CMS\'s (WordPress, OpenCart, Shopify).</p><p style=\"margin-bottom: 0px; color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(245, 248, 253);\">I have also good hands on Api\'s.</p>","<p><span style=\"color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">The challenge of life, I have found, is to build a resume that doesn\'t simply tell a story about what you want to be, but it\'s a story about who you want to be. I have a fairly hefty resume because I\'m pretty aggressive about doing things that I think I need to do.</span><br></p>","<p><span style=\"color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(245, 248, 253);\">Some of the major Projects done for the companies, SMD Webtech Limited, Pratham Vision, CTD World &amp; Annexorien Technologies Pvt. Ltd. It was good a experience while working on such good projects. Every project was a new challenge and learn many things while working on it.</span><br></p>","<p><span style=\"color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">I have been working in tech for more than 4 years now, and always had a feeling that I am missing the foundation of software development &amp; computer science. If you know that feeling, this is the perfect course for you! You are not a full-stack software developer after the course, but you have built the foundation to become one, or continue on a management path in tech, but with a huge confidence &amp; knowledge boost.</span><br></p>","<p><span style=\"color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(245, 248, 253);\">Don’t try to plan everything out to the very last detail. I’m a big believer in just getting it out there: create a minimal viable product or website, launch it, and get feedback. If you can’t explain it simply, you don’t understand it well enough.</span><br></p>","<p><span style=\"color: rgb(39, 40, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">We all have a thirst for wonder. It\'s a deeply human quality. Science and religion are both bound up with it. What I\'m saying is, you don\'t have to make stories up, you don\'t have to exaggerate. There\'s wonder and awe enough in the real world. Nature\'s a lot better at inventing wonders than we are.</span><br></p>","2025013017214731560.jpg","2025013017214778511.jpg","2025013017214760785.jpg","2025013017214783141.pdf","","2025-01-25 23:30:29","2025-01-30 17:21:47");





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






CREATE TABLE IF NOT EXISTS `maintenance_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `maintenance_settings_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO maintenance_settings VALUES("1","Maintenance","maintenance","2025-01-26","06:20:00","07:21:00","Maintenance","1","2025-01-30 19:45:32","2025-01-30 19:45:15","2025-01-30 19:45:32");
INSERT INTO maintenance_settings VALUES("2","Maintenance1","maintenance-1","2025-01-25","08:21:00","20:18:00","Maintenance","1","","2025-01-30 19:46:00","2025-01-30 19:49:30");





CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","0001_01_01_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","0001_01_01_000001_create_cache_table","1");
INSERT INTO migrations VALUES("3","0001_01_01_000002_create_jobs_table","1");
INSERT INTO migrations VALUES("4","2025_01_25_102607_add_columns_to_users_table","2");
INSERT INTO migrations VALUES("5","2025_01_25_105619_create_admins_table","3");
INSERT INTO migrations VALUES("6","2025_01_25_112035_create_blogs_table","4");
INSERT INTO migrations VALUES("7","2025_01_25_112353_create_blog_categories_table","5");
INSERT INTO migrations VALUES("8","2025_01_25_112732_create_blog_tags_table","6");
INSERT INTO migrations VALUES("9","2025_01_25_113131_create_comments_table","7");
INSERT INTO migrations VALUES("10","2025_01_25_113437_create_contacts_table","8");
INSERT INTO migrations VALUES("11","2025_01_25_113842_create_home_pages_table","9");
INSERT INTO migrations VALUES("12","2025_01_25_114354_create_pages_table","10");
INSERT INTO migrations VALUES("13","2025_01_25_114743_create_personals_table","11");
INSERT INTO migrations VALUES("14","2025_01_25_115059_create_projects_table","12");
INSERT INTO migrations VALUES("15","2025_01_25_115452_create_seo_details_table","12");
INSERT INTO migrations VALUES("16","2025_01_25_120102_create_socials_table","13");
INSERT INTO migrations VALUES("17","2025_01_25_120547_create_technologies_table","14");
INSERT INTO migrations VALUES("18","2025_01_25_121010_create_activity_logs_table","15");
INSERT INTO migrations VALUES("19","2025_01_25_121753_create_email_configs_table","16");
INSERT INTO migrations VALUES("20","2025_01_25_122136_create_email_templates_table","17");
INSERT INTO migrations VALUES("21","2025_01_25_122523_create_countries_table","18");
INSERT INTO migrations VALUES("22","2025_01_25_123318_create_notifications_table","19");
INSERT INTO migrations VALUES("23","2025_01_25_123716_create_permissions_table","20");
INSERT INTO migrations VALUES("24","2025_01_25_124016_create_permission_roles_table","21");
INSERT INTO migrations VALUES("25","2025_01_25_124808_create_tickets_table","22");
INSERT INTO migrations VALUES("26","2025_01_25_125325_create_ticket_replies_table","23");
INSERT INTO migrations VALUES("27","2025_01_25_130956_create_oauth_auth_codes_table","24");
INSERT INTO migrations VALUES("28","2025_01_25_130957_create_oauth_access_tokens_table","24");
INSERT INTO migrations VALUES("29","2025_01_25_130958_create_oauth_refresh_tokens_table","24");
INSERT INTO migrations VALUES("30","2025_01_25_130959_create_oauth_clients_table","24");
INSERT INTO migrations VALUES("31","2025_01_25_131000_create_oauth_personal_access_clients_table","24");
INSERT INTO migrations VALUES("32","2025_01_25_131956_create_maintenance_settings_table","25");
INSERT INTO migrations VALUES("33","2025_01_26_080630_create_roles_table","26");
INSERT INTO migrations VALUES("34","2025_01_26_092345_create_pages_table","27");
INSERT INTO migrations VALUES("35","2025_01_30_183033_create_socials_table","28");
INSERT INTO migrations VALUES("36","2025_01_30_185105_create_socials_table","29");
INSERT INTO migrations VALUES("37","2025_01_30_190458_create_socials_table","30");
INSERT INTO migrations VALUES("38","2025_01_30_192451_create_maintenance_settings_table","31");
INSERT INTO migrations VALUES("39","2025_01_31_075345_create_settings_table","32");
INSERT INTO migrations VALUES("40","2025_01_31_091621_create_backups_table","33");





CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url_to_go` varchar(255) DEFAULT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO oauth_clients VALUES("1","","oauth_personal_access_clients","EY3KnuarGO426ka7vUd44DENSE1BLg3b4PGccxd9","","http://localhost","1","0","0","2025-01-25 13:11:34","2025-01-25 13:11:34");
INSERT INTO oauth_clients VALUES("2","","oauth_personal_grant_clients","ecaphZGnzj6rUYc2n2tDDiJN42IAuoald4EMAYO5","users","http://localhost","0","1","0","2025-01-25 13:12:39","2025-01-25 13:12:39");





CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO oauth_personal_access_clients VALUES("1","1","2025-01-25 13:11:34","2025-01-25 13:11:34");





CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO pages VALUES("1","Page","page","<h4 class=\"form-section\">Page</h4>","1","2025-01-30 17:40:32","2025-01-30 17:40:28","2025-01-30 17:40:32");
INSERT INTO pages VALUES("2","Page1","page-1","<h4 class=\"form-section\">Page</h4>","1","","2025-01-30 17:40:44","2025-01-30 18:21:38");





CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `permission_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `personals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `map` text DEFAULT NULL,
  `freelance` tinyint(1) NOT NULL DEFAULT 0,
  `experience` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO personals VALUES("1","Bhawesh Bhaskar","bhawesh9696@gmail.com","info@i-am-bhaskar.com","+91 8950291871","+91 8178343709","+918950291871","1996-06-09","https://i-am-bhaskar.com/","28","Graduation (B.Tech)","Noida, Uttar Pradesh, India","<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224369.03562454425!2d77.2580443994236!3d28.516681710933348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5a43173357b%3A0x37ffce30c87cc03f!2sNoida%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1588878770945!5m2!1sen!2sin\" frameborder=\"0\" style=\"border:0; width: 100%; height: 290px;\" allowfullscreen></iframe>","1","6+","","2025-01-26 14:58:00","2025-01-30 18:10:40");





CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `orderby` int(11) NOT NULL DEFAULT 0,
  `company` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO projects VALUES("1","Project","project","Project","2025012919250418692.jpg","1","12","Project","2025-01-30 06:47:49","2025-01-29 19:20:21","2025-01-30 06:47:49");
INSERT INTO projects VALUES("2","Project1","project-1","Project","2025013006563020727.jpg","1","1","Project","","2025-01-30 06:48:08","2025-01-30 06:56:30");





CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES("1","Super Admin","Super Admin","Super Admin","Super Admin","1","","2025-01-28 16:20:42","2025-01-28 16:25:26");
INSERT INTO roles VALUES("2","Admin","Admin","Admin","Admin","1","","2025-01-28 16:25:02","2025-01-28 16:25:02");





CREATE TABLE IF NOT EXISTS `seo_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `canonical` varchar(255) DEFAULT NULL,
  `blog_seo_title` varchar(255) DEFAULT NULL,
  `blog_seo_description` text DEFAULT NULL,
  `blog_seo_keywords` varchar(255) DEFAULT NULL,
  `blog_canonical` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO seo_details VALUES("1","I am Bhawesh Bhaskar","I am Bhawesh Bhaskar, a Full Stack Sr. Software Developer. I am a good learner and always eager to learn new technologies. I can develop both client and server software. In addition to mastering HTML and CSS, I also know how to: Program a browser (like using JavaScript, jQuery) Program a server (like using Laravel, Code Ignitor or Core PHP)","Bhawesh Bhaskar, Web Developer, Full Stack Developer, Website Developer, Website Developer Noida, Website Developer Muzaffarpur, Website Developer Ahiyapur, Website Developer Delhi","https://www.i-am-bhaskar.com/","Bhaskar\'s Blogs","Welcome to my blog, where I will share posts related to technical languages that I learned while working. Remember to share your comments and thoughts with me; I love hearing from you","Bhawesh Bhaskar, Web Developer, Full Stack Developer, Website Developer, Website Developer Noida, Website Developer Muzaffarpur, Website Developer Ahiyapur, Website Developer Delhi, Blogs, Bhaskar\'s Blogs","https://www.i-am-bhaskar.com/blog","1","","2025-01-26 15:06:56","2025-01-30 18:13:09");





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

INSERT INTO sessions VALUES("d60s2Odv11XG27PZMEbhTPA95lzwgcpQsNKe1Wmj","1","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36","YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWGQ4dk9QTmVyaVJaZkd0Q3doZzdsaUowVHZNdktPWnhsVEpSZkZ6YiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluaXN0cmF0b3IvdGVtcGxhdGVzLzEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluaXN0cmF0b3IvYmFja3VwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=","1738317436");





CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `google_recaptcha_key` varchar(255) DEFAULT NULL,
  `google_recaptcha_secret` varchar(255) DEFAULT NULL,
  `google_analytics_code` varchar(255) DEFAULT NULL,
  `google_firebase_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES("1","qwertyu","2025013108334439659.jpg","2025013108334419991.jpg","qwertyu","qwertyu","qwertyu","qwertyu","2025-01-31 13:43:13","2025-01-31 08:33:44");





CREATE TABLE IF NOT EXISTS `socials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `orderby` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `socials_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO socials VALUES("1","Social","social","Social","fa-user","2025013019070613446.jpg","1","1","2025-01-30 19:07:15","2025-01-30 19:07:06","2025-01-30 19:07:15");
INSERT INTO socials VALUES("2","Social1","social-1","Social","fa-facebook","2025013019073347441.jpg","1","1","","2025-01-30 19:07:33","2025-01-30 19:08:41");





CREATE TABLE IF NOT EXISTS `technologies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `orderby` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `technologies_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO technologies VALUES("1","Technology","technology","Technology","Technology","1","1","2025-01-30 07:12:42","2025-01-30 07:12:32","2025-01-30 07:12:42");
INSERT INTO technologies VALUES("2","Technology1","technology-1","fa-user","Technology","1","2","","2025-01-30 07:12:50","2025-01-30 07:52:45");





CREATE TABLE IF NOT EXISTS `ticket_replies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `ticket_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_replies_user_id_foreign` (`user_id`),
  KEY `ticket_replies_ticket_id_foreign` (`ticket_id`),
  CONSTRAINT `ticket_replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ticket_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `ticket_status_id` bigint(20) unsigned NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT 1,
  `type` varchar(255) NOT NULL,
  `last_reply` timestamp NULL DEFAULT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;






CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `email_verification` tinyint(4) NOT NULL DEFAULT 0,
  `phone_verification` tinyint(4) NOT NULL DEFAULT 0,
  `facebook_id` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `linkedin_id` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","User1","user@gmail.com","","$2y$12$A0AfaZCv3SbLK9w6gCTUK.b0BCLvhTHbA0YgDdwuyBJAAMMyMNWXu","","2025-01-28 20:57:19","2025-01-28 21:13:01","BB2K251","345654323434","","2025012821100116257.jpg","0","0","0","","","","2025-01-28 21:13:01");
INSERT INTO users VALUES("2","Varsha Rani","iamvarsharani@gmail.com","","$2y$12$/yztlfvDBD2CBe3DFaVnaOCopSv9mDnRMSHBOAW0Km.gZ2XEKV3Ii","","2025-01-28 21:11:44","2025-01-28 21:11:44","BB2K252","09304525133","","2025012821114376666.jpeg","1","0","0","","","","");



