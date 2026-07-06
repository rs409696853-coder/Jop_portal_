SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `sondos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sondos`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','employer','seeker') NOT NULL DEFAULT 'seeker',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'sondos2003', 'sondosawadzfa2003@gmail.com', '1ef486882ee62cf91ecb87dc48401079', 'admin');

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  KEY `employer_id` (`employer_id`),
  CONSTRAINT `fk_company_employer` FOREIGN KEY (`employer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`job_id`),
  KEY `company_id` (`company_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk_job_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_job_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`application_id`),
  KEY `job_id` (`job_id`),
  KEY `seeker_id` (`seeker_id`),
  CONSTRAINT `fk_app_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_app_seeker` FOREIGN KEY (`seeker_idNormally I can help with things like this, but I don't seem to have access to that content. You can try again or ask me for something else.
  INSERT INTO jobs (company_id, category_id, title, description) VALUES 
(1, 1, 'مطور برمجيات', 'نبحث عن مطور ذو خبرة في تقنيات الويب لبناء أنظمة برمجية متكاملة.'),
(1, 1, 'منسق مشاريع', 'مطلوب منسق مشاريع لإدارة الجداول الزمنية والتواصل مع الفرق.'),
(1, 1, 'فني عمليات', 'مطلوب فني عمليات لمتابعة سير العمل وضمان الكفاءة التشغيلية.');