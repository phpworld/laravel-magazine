-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 11:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-magzine`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `description`, `image_path`, `button_text`, `button_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'E Library Online Books', 'E Library Online Books', 'E Library Online Books', 'banners/F9iegjYRLgQPlL1o6eu5iQI3CqmTX0NNyahu46ak.png', NULL, NULL, 1, 1, '2025-09-21 03:23:35', '2025-09-21 03:23:35'),
(4, 'General Knowledge Books', 'General Knowledge Books', 'General Knowledge Books', 'banners/yAdK1M9hfSLme1Xfy0ggQIUHaUUzSeCNxNQis2h3.png', NULL, NULL, 2, 1, '2025-09-21 03:35:11', '2025-09-21 03:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-option_banner_subtitle', 's:36:\"Discover Amazing Content Every Month\";', 1758534551),
('laravel-cache-option_banner_title', 's:27:\"Welcome to Laravel Magazine\";', 1758534551),
('laravel-cache-option_contact_address', 's:38:\"123 Magazine Street\\nCity, State 12345\";', 1758533708),
('laravel-cache-option_contact_email', 's:27:\"contact@laravelmagazine.com\";', 1758533708),
('laravel-cache-option_contact_phone', 's:17:\"+1 (555) 123-4567\";', 1758533708),
('laravel-cache-option_favicon', 's:58:\"options/media/gKOPR3Y5JuqC8ggUXIkwq8xDS5eE232bBwZaTJPx.png\";', 1758534551),
('laravel-cache-option_hero_banner', 's:0:\"\";', 1758534551),
('laravel-cache-option_logo', 's:58:\"options/media/SeiqOj33DnD1fgo2CkjqsKr6A8x3llfjALRYueN7.png\";', 1758534551),
('laravel-cache-option_site_description', 's:33:\"Premium Digital Magazine Platform\";', 1758534551),
('laravel-cache-option_site_name', 's:16:\"Laravel Magazine\";', 1758534551),
('laravel-cache-option_social_facebook', 's:0:\"\";', 1758534551),
('laravel-cache-option_social_instagram', 's:0:\"\";', 1758534551),
('laravel-cache-option_social_linkedin', 's:0:\"\";', 1758534551),
('laravel-cache-option_social_twitter', 's:0:\"\";', 1758534551);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'UPSC Exams', 'UPSC Exams', 'upsc-exams', 1, '2025-09-20 03:45:18', '2025-09-21 05:58:29'),
(2, 'BPSE Exams', 'BPSE Exams Weekly Kit', 'bpse-exams', 1, '2025-09-20 03:45:18', '2025-09-21 04:05:15'),
(3, 'SSC Exams', 'SSC Exams Kit', 'ssc-exams', 1, '2025-09-20 03:45:18', '2025-09-21 04:09:12'),
(4, 'NEET Exams', 'NEET Exams', 'neet-exams', 1, '2025-09-20 03:45:18', '2025-09-21 04:29:29'),
(5, 'Police Exams', 'Sports news and updates', 'police-exams', 1, '2025-09-20 03:45:18', '2025-09-21 04:29:59'),
(7, 'Banking Exams', 'Banking Exams', 'banking-exams', 1, '2025-09-21 04:51:34', '2025-09-21 04:51:34'),
(8, 'Railway Exam', 'Railway Exam', 'railway-exam', 1, '2025-09-21 06:42:20', '2025-09-21 06:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `publication_date` date NOT NULL,
  `week_number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`id`, `title`, `description`, `slug`, `category_id`, `cover_image`, `pdf_file`, `price`, `publication_date`, `week_number`, `year`, `is_active`, `is_featured`, `download_count`, `created_at`, `updated_at`) VALUES
(1, 'BUSINESS INVESTMENT', 'BUSINESS INVESTMENT', 'business-investment', 2, 'magazines/covers/Evn16NcnbZbc93nnMLnmvad8RH2vBytwI19HP4dN.png', 'magazines/pdfs/rpO6Rrc76IYUU6NnwQ0vZrIaU54DQGne7A2fEBvA.pdf', 19.00, '2025-09-20', 1, 2025, 1, 1, 0, '2025-09-20 05:32:18', '2025-09-21 04:23:48'),
(2, 'UPSC Prepration Weekly Kit', 'UPSC Prepration Weekly Kit', 'upsc-prepration-weekly-kit', 1, 'magazines/covers/tob9n64irnzsAjk51YgYPMeTfBbx41MICv6iU2Jc.png', 'magazines/pdfs/4uzHGABjbO5rRPpID4uw9g4uCDLgHwM44I11zTB8.pdf', 10.00, '2025-09-21', 4, 2025, 1, 0, 1, '2025-09-21 03:41:38', '2025-09-21 05:55:24'),
(3, 'BPSE Exams Weekly KIT', 'BPSE Exams Weekly Kit', 'bpse-exams-weekly-kit', 2, 'magazines/covers/gWYMu6FRwuEcOPAdzAGNYXCYoc1zxcWxqGbkSdcS.png', 'magazines/pdfs/KbAcETP3KtXEWpeeP6B5ynrAXfckMbwndUHNCSxA.pdf', 10.00, '2025-09-21', 3, 2025, 1, 1, 2, '2025-09-21 04:05:53', '2025-09-21 05:55:12'),
(4, 'SSC Exams Kit', 'SSC Exams Kit', 'ssc-exams-kit', 3, 'magazines/covers/5sJYCBBqfCpQkZQg9KvBHF7gbs9dvVZJYYPXFcAB.png', 'magazines/pdfs/wfEK5HI3Mdtg1sRoXxfOQ6l0R6c03xq9sBL07ak2.pdf', 10.00, '2025-09-21', 2, 2025, 1, 1, 2, '2025-09-21 04:10:00', '2025-09-21 05:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_20_085902_create_categories_table', 1),
(5, '2025_09_20_085907_create_magazines_table', 1),
(6, '2025_09_20_085912_create_purchases_table', 1),
(7, '2025_09_20_085918_add_role_to_users_table', 1),
(8, '2025_09_21_071120_create_options_table', 2),
(9, '2025_09_21_072225_create_banners_table', 3),
(10, '2025_09_21_072321_create_banners_table', 3),
(11, '2025_09_21_073353_fix_banners_table_structure', 4),
(12, '2025_09_21_094956_add_featured_to_magazines_table', 5),
(13, '2025_09_21_110811_update_magazine_slugs', 6),
(14, '2025_09_21_115154_create_pages_table', 7),
(15, '2025_09_22_041445_add_google_id_to_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Laravel Magazine', NULL, '2025-09-21 01:48:18', '2025-09-21 01:48:18'),
(2, 'site_description', 'Premium Digital Magazine Platform', NULL, '2025-09-21 01:48:18', '2025-09-21 01:48:18'),
(3, 'contact_email', 'contact@laravelmagazine.com', NULL, '2025-09-21 01:48:18', '2025-09-21 01:48:18'),
(4, 'contact_phone', '+1 (555) 123-4567', NULL, '2025-09-21 01:48:18', '2025-09-21 01:48:18'),
(5, 'contact_address', '123 Magazine Street\\nCity, State 12345', NULL, '2025-09-21 01:48:18', '2025-09-21 01:48:18'),
(6, 'banner_title', 'Welcome to Laravel Magazine', NULL, '2025-09-21 01:48:18', '2025-09-21 01:48:18'),
(7, 'banner_subtitle', 'Discover Amazing Content Every Month', NULL, '2025-09-21 01:48:19', '2025-09-21 01:48:19'),
(8, 'social_facebook', '', NULL, '2025-09-21 01:48:25', '2025-09-21 01:48:25'),
(9, 'social_twitter', '', NULL, '2025-09-21 01:48:25', '2025-09-21 01:48:25'),
(10, 'social_instagram', '', NULL, '2025-09-21 01:48:25', '2025-09-21 01:48:25'),
(11, 'social_linkedin', '', NULL, '2025-09-21 01:48:25', '2025-09-21 01:48:25'),
(12, 'logo', 'options/media/SeiqOj33DnD1fgo2CkjqsKr6A8x3llfjALRYueN7.png', NULL, '2025-09-21 01:48:25', '2025-09-21 02:52:26'),
(13, 'favicon', 'options/media/gKOPR3Y5JuqC8ggUXIkwq8xDS5eE232bBwZaTJPx.png', NULL, '2025-09-21 01:48:25', '2025-09-21 02:52:34'),
(14, 'hero_banner', '', NULL, '2025-09-21 01:48:25', '2025-09-21 01:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', 'Welcome to our Magazine Store - your premier destination for quality educational and professional magazines.\n\nFounded with a passion for knowledge and learning, we have been serving students, professionals, and educational institutions with carefully curated magazines and publications.\n\nOur Mission:\nTo make quality educational content accessible to everyone by providing a comprehensive collection of magazines covering various subjects including competitive exams, professional development, current affairs, and educational resources.\n\nWhat We Offer:\n• Comprehensive magazine collection for various competitive exams\n• Digital and print format options\n• Regular updates with latest content\n• User-friendly platform for easy browsing and purchasing\n• Secure payment processing\n• Instant digital downloads\n\nOur Commitment:\nWe are committed to providing our customers with:\n- High-quality content from trusted publishers\n- Affordable pricing for students and professionals\n- Excellent customer service and support\n- Regular updates and new additions to our catalog\n- Secure and reliable platform for all transactions\n\nWhether you\'re preparing for competitive exams, staying updated with current affairs, or looking for professional development resources, we have something for everyone.\n\nThank you for choosing us as your trusted source for educational magazines and publications.', 'About Us - Magazine Store', 'Learn about our mission to provide quality educational magazines and publications for students and professionals.', 1, 1, '2025-09-21 06:30:18', '2025-09-21 06:30:18'),
(2, 'Contact Us', 'contact-us', 'Get in touch with us - we\'re here to help!\n\nWe value your feedback and are always ready to assist you with any questions or concerns about our services.\n\nContact Information:\n\nEmail Support:\n• General Inquiries: info@magazinestore.com\n• Customer Support: support@magazinestore.com\n• Technical Issues: tech@magazinestore.com\n• Business Partnerships: business@magazinestore.com\n\nPhone Support:\n• Customer Service: +91-XXXX-XXXX-XX\n• Technical Support: +91-XXXX-XXXX-XX\nAvailable: Monday to Friday, 9:00 AM to 6:00 PM IST\n\nOffice Address:\nMagazine Store Pvt. Ltd.\n123 Education Street\nKnowledge City, State - 123456\nIndia\n\nBusiness Hours:\nMonday to Friday: 9:00 AM - 6:00 PM\nSaturday: 10:00 AM - 4:00 PM\nSunday: Closed\n\nFor quick assistance, you can also use the contact form below. We aim to respond to all inquiries within 24 hours.\n\nFrequently Asked Questions:\nBefore contacting us, you might find answers to common questions in our FAQ section. This can help you get immediate assistance for common issues.\n\nFollow Us:\nStay connected with us on social media for updates, new releases, and educational content:\n• Facebook: @MagazineStore\n• Twitter: @MagazineStore\n• LinkedIn: Magazine Store\n• Instagram: @magazine_store\n\nWe appreciate your interest in our services and look forward to hearing from you!', 'Contact Us - Magazine Store', 'Contact Magazine Store for customer support, technical assistance, or general inquiries. We are here to help!', 1, 2, '2025-09-21 06:30:18', '2025-09-21 06:30:18'),
(3, 'Privacy Policy', 'privacy-policy', 'Privacy Policy\n\nLast updated: September 21, 2025\n\nAt Magazine Store, we take your privacy seriously. This Privacy Policy explains how we collect, use, and protect your personal information when you use our website and services.\n\n1. Information We Collect\n\nPersonal Information:\n• Name and contact information\n• Email address and phone number\n• Billing and shipping addresses\n• Payment information (processed securely)\n• Account credentials\n\nUsage Information:\n• Pages visited and time spent on our website\n• Download history and preferences\n• Device information and IP address\n• Browser type and operating system\n\n2. How We Use Your Information\n\nWe use your information to:\n• Process orders and payments\n• Deliver digital and physical products\n• Provide customer support\n• Send order confirmations and updates\n• Improve our website and services\n• Comply with legal obligations\n\n3. Information Sharing\n\nWe do not sell or rent your personal information to third parties. We may share information with:\n• Payment processors for transaction processing\n• Shipping partners for order delivery\n• Legal authorities when required by law\n• Service providers who assist in our operations\n\n4. Data Security\n\nWe implement appropriate security measures to protect your information:\n• Encryption of sensitive data\n• Secure payment processing\n• Regular security audits\n• Access controls and authentication\n• Data backup and recovery procedures\n\n5. Your Rights\n\nYou have the right to:\n• Access your personal information\n• Update or correct your data\n• Delete your account and data\n• Opt-out of marketing communications\n• Request data portability\n\n6. Cookies and Tracking\n\nWe use cookies to:\n• Remember your preferences\n• Analyze website usage\n• Provide personalized content\n• Improve user experience\n\nYou can control cookie settings through your browser preferences.\n\n7. Data Retention\n\nWe retain your information for as long as necessary to:\n• Provide our services\n• Comply with legal obligations\n• Resolve disputes\n• Enforce our agreements\n\n8. Children\'s Privacy\n\nOur services are not intended for children under 13. We do not knowingly collect personal information from children under 13.\n\n9. Changes to This Policy\n\nWe may update this Privacy Policy periodically. We will notify you of significant changes via email or website notice.\n\n10. Contact Us\n\nIf you have questions about this Privacy Policy, please contact us at:\nEmail: privacy@magazinestore.com\nAddress: 123 Education Street, Knowledge City, State - 123456\n\nBy using our services, you agree to the collection and use of information in accordance with this Privacy Policy.', 'Privacy Policy - Magazine Store', 'Read our Privacy Policy to understand how we collect, use, and protect your personal information.', 1, 3, '2025-09-21 06:30:18', '2025-09-21 06:30:18'),
(4, 'Terms and Conditions', 'terms-and-conditions', 'Terms and Conditions\n\nLast updated: September 21, 2025\n\nWelcome to Magazine Store. These Terms and Conditions govern your use of our website and services.\n\n1. Acceptance of Terms\n\nBy accessing and using our website, you accept and agree to be bound by the terms and provision of this agreement.\n\n2. Use License\n\nPermission is granted to temporarily download materials on Magazine Store\'s website for personal, non-commercial transitory viewing only.\n\nUnder this license you may not:\n• Modify or copy the materials\n• Use the materials for commercial purposes\n• Attempt to reverse engineer any software\n• Remove copyright or proprietary notations\n\n3. Account Terms\n\nYou are responsible for:\n• Maintaining account security\n• All activities under your account\n• Providing accurate information\n• Notifying us of unauthorized use\n\n4. Products and Services\n\nDigital Products:\n• Digital magazines are delivered electronically\n• Downloads are available immediately after payment\n• Multiple download attempts may be limited\n• Products are for personal use only\n\nPhysical Products:\n• Shipping times vary by location\n• We are not responsible for shipping delays\n• Products must be in original condition for returns\n\n5. Payment Terms\n\n• All prices are in Indian Rupees (INR)\n• Payment is due immediately upon order\n• We accept major credit cards and digital payments\n• All sales are final unless otherwise specified\n\n6. Intellectual Property\n\nAll content, trademarks, and data on this website are the property of Magazine Store or content suppliers. You may not use our intellectual property without written permission.\n\n7. User Conduct\n\nYou agree not to:\n• Violate any applicable laws or regulations\n• Share account credentials with others\n• Upload malicious code or content\n• Interfere with website operations\n• Engage in fraudulent activities\n\n8. Disclaimers\n\n• Services are provided \'as is\' and \'as available\'\n• We do not guarantee uninterrupted service\n• We are not liable for third-party content\n• Educational content is for informational purposes\n\n9. Limitation of Liability\n\nMagazine Store shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.\n\n10. Refund Policy\n\nDigital Products:\n• Refunds may be provided within 7 days of purchase\n• Must be due to technical issues preventing access\n• Proof of technical problem may be required\n\nPhysical Products:\n• Returns accepted within 15 days of delivery\n• Products must be in original condition\n• Customer responsible for return shipping\n\n11. Privacy\n\nYour privacy is important to us. Please review our Privacy Policy, which also governs your use of our services.\n\n12. Termination\n\nWe may terminate or suspend your account immediately, without prior notice, for conduct that we believe violates these Terms.\n\n13. Governing Law\n\nThese Terms shall be governed and construed in accordance with the laws of India, without regard to its conflict of law provisions.\n\n14. Changes to Terms\n\nWe reserve the right to modify these terms at any time. We will notify users of significant changes.\n\n15. Contact Information\n\nIf you have any questions about these Terms and Conditions, please contact us at:\nEmail: legal@magazinestore.com\nAddress: 123 Education Street, Knowledge City, State - 123456\n\nBy using our services, you signify your acceptance of these Terms and Conditions.', 'Terms and Conditions - Magazine Store', 'Read our Terms and Conditions to understand the rules and regulations for using our services.', 1, 4, '2025-09-21 06:30:18', '2025-09-21 06:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `magazine_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `razorpay_payment_id` varchar(255) DEFAULT NULL,
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `purchased_at` timestamp NULL DEFAULT NULL,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `last_downloaded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `magazine_id`, `transaction_id`, `razorpay_payment_id`, `razorpay_order_id`, `amount`, `payment_status`, `purchased_at`, `download_count`, `last_downloaded_at`, `created_at`, `updated_at`) VALUES
(4, 5, 3, 'txn_local_1758453440_6906', 'pay_local_1758453439262', 'order_local_1758453439_2616', 10.00, 'completed', NULL, 0, NULL, '2025-09-21 05:47:20', '2025-09-21 05:47:20'),
(5, 5, 4, 'txn_1758453620_7199', 'pay_RKEV4IGhAmA4D2', 'order_RKEUs7kR9PyMg5', 10.00, 'completed', NULL, 0, NULL, '2025-09-21 05:50:20', '2025-09-21 05:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1ARDXuT3izxl6jaL4tuXPykFnJ56PXygdCuzV0o6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNWxNNnlkWjRDanhpVFZydHAzWndibFhKeVVKdUxmSG5JSlV0ZnNuWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYxMDUwNjEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYxMDUwNjEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758456105),
('3QOntytgI07n3w9s73X1cAQ4NeeJWommUE1XH3ZN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUwyRGRFRVg5bllqM1laTGNXdzRHVm5DNGJyelVETGxRSjNMMEt0MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvYWJvdXQtdXM/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2MjEwMzQwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456210),
('45cBlVcwPNzksyCdh9n6h0iVDvYKhrkGW7dwm1TC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWxqQkExS0R4Y1JQSmx2QWFpRno4Mk5wV2tQaFprNWtwNlhWU1hsZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU3MTM1Nzk3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758457136),
('4NBYGrmYi8jtQwTq7FoQxP2t6VbaehgmxzLG2QvJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3JRZWhPVFpUNVg3WWZVa1FBQjA3ZTBhekc5em1yNEFnZjg0czdlRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758456587),
('4vZR0OY8pJZ8hGA3HHA8tBtwd4s2QG07YYay0gKP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0NFdWU2WTRZdWZMZFZFZjlSamp2aXozeEtLWUFMM05DVmV4RkdFViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NTM2MDA4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456536),
('4XODxVenolP9hN3VPfVeaGyPXJ2hYNzkY3l0qZcX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid1ZmYjdwTkR0N3R1Z0ZJcm5YbUM3em1DWXB4TlhPbGtDMU96UnBZUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYwNTM0NzkiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYwNTM0NzkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758456053),
('6SbL6bB5oRnx2Ua3qGeRJFOTnZBeyN3lLhkpOLsF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVU41eFRZZXdDRXZobVltRHltOUdmaGlmcnBacTdRTXN1UkI3NHpTRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1758457513),
('Di3SxBY2q3LuuSf0MLicuyYOp4w8hmkmJrUd9XAV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHNSZnJjRTlON3FDZmNIU0kyUWlNNDhUZXFsWko3S3FycElWcXdMMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758456197),
('DKGNc4rS1EH0DSY1drnDHm2EmV8TWyhKHuhBPgip', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1RBRU9CSzlaUkZwYjV2SmhveFAxaG4xcFZhZ3dOQUNqc2tINnBBZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTExOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvY29udGFjdC11cz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTY0NTMyNDciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758456453),
('E01uVxZLxRSaCjv8q5yc7d0mJEPjFzzA0Iy9s0RG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTXBWOGR6RVdvbXBKUW1OUTBLZ2dmM1h0TmEyUU9XaVZWTVc2aHRlaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456137),
('EkfztaF5YAnomqpCDpcxDDWuP35ifRhyKEshshee', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjNhVVgwNVlZclZSbzdQRzNmMnRYdkwwV05IRjFITTZES3IySG5tTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NjcxMzM2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456671),
('fhX9x64QdAjI8sK3xMQqC9vZcBu8A7bTxrfZDdUP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidGtiOE5ka0syeGtlc2tiUXBVM1pNSTZXQXJCMHVsVmJQNzhlNUFzNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYWdhemluZXMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1ODUzMDk0MDt9fQ==', 1758530988),
('FttFWYgjYdYotptmuLG9nS7g25u2sfLFfQEPYlMQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTW5wQjJDamNFMTNIRklmYmk5RlRITWdjMW9rcnlYZTdaUnM0OWNvZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758456054),
('gem3KyM8JgAe8fIyauUFQjx8IlOQUgtyUjdreKlI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYUdBM2FwMnBGYnlkOHR4bHByeWtSd2ZVaEJtT1RyYkswM25oWlBOUCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcHRpb25zP2lkPWI5MDgxNzhkLTc4YWUtNDMxMi1hZTBiLTM1ZjhhOWFkMWE2NiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1ODQ1NzQzMTQwNSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjEwODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL29wdGlvbnM/aWQ9YjkwODE3OGQtNzhhZS00MzEyLWFlMGItMzVmOGE5YWQxYTY2JnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU3NDMxNDA1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758457431),
('hsEA7AgWBvIAsziL4hpsASHzE0UwU9EQ77bS9Hx8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU29pWHphTmJxR040TU9rV1lSSWlCQ1pzV045dFljdjhqNUtaSGgzSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9YWZkYTM5Y2EtM2Y5OC00MmVhLThkOWYtMWNhNWYwZmJkMTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU3NDg4NDgwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758457488),
('hUTf2mDtc6tl0bJOi0hUnZiSoLQ2dNhZMWjpfIML', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3lrVWRSS1pKeU1sa2NWeVV3SWxLWUxLOTcxU2VmNkpIMGx5cGFaRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTExOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvY29udGFjdC11cz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYyMjAxNzkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758456220),
('IbHgjZXN0bYInIp96uHaH8n0qPIoNnOYkezcywKc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNG9QRVY3bmhYbDI4ZmM3SnNhdHNRVHNnMkVKUGJjc3RxbHZRc3VhNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758453751),
('kbqvMs07RkAVBnBZFYkMX1g5m5AeiCne3gFph0d1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTdraE9CdW1ab1QxeXRRTXpDT0Y1THcwbUZrQzlBYmFtYmZ3Y3pTZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9YjkwODE3OGQtNzhhZS00MzEyLWFlMGItMzVmOGE5YWQxYTY2JnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU3MzM2NjI2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758457336),
('KeuAzWtURU76QFPJ3Cn9Vmr3EscjUcb2EdwWsuG9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekE2QUhaWkJtaFlaSEZjN2dzbkJreXpTR2xyaEVSZVdjUjV4R0FHSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NDk3NDMxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456497),
('lClSOn37yt1as5LmnJhoOQ4UglvjCd8vORJmiHo0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmtkVnp5bWxubE1PU2N4aVZyQ0FCbkF1YlEwMDl5a2U5VDVWZUtzVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvYWJvdXQtdXM/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NTQxODE2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456542),
('nnI3R9b7VHTKwljZh5Fmj51HWmEdfo1I6zZHpbFi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXZCUDN4M0xDMjBPWVlEaWVIRTVaZ1RWMEhoc1VXUkxOUUo0MkFZeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758456105),
('NwbXpJVEoMWKEoM3eXEhsMbvvK4UtkGgYBZ72zWo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFhCYk4yRVlBWDA0Z2xSVTVxRGhmNGFHYU5UejZGUnhwR1N4T0dIYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvYWJvdXQtdXM/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NDQ4NTU4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456448),
('PCMYON6GkkyfI2K6L8WkzBWkcM7GdFhbgGDbCoHK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFdldWNOd2FWQlhUYmxaWW1TZGg3SzU3bEJIRlYxajZFbzdSVm1LdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758456984),
('Q34ogQSjm2P7mSoPytDglym6vIQThLk2phBfrzaS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQk82ZE45bkxVWWlPR2k3czRYWkRjc0NsRWdsSmJHSU93YmRMS29rSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVnaXN0ZXI/aWQ9N2FjODMzNDItM2JmNC00ZDJlLWE2ZjAtNWFkZTUxZDgyZGJhJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NTI3MjM2NzMxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758527237),
('t2NMPKzJTZOBCtEAOzRmqmBtGDalQXYd5LwjDLEt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWlVkRzBHRXc5UzRVczN2TGN4OEVpUmVNVFZzMGcyNDhhclQzSU9lUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2dvb2dsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IkdITVJoclhGRWRHYTlWV2t6bk9XUXpIaVFNNE9tSmVaVXBTdHNHWTciO30=', 1758529881),
('t42lZk4pWbYxZyDgDsW7sgNgEQn4gXGrsEEpMnRU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ2RacjJQWVNLREFieERYU3I2dnZTTFd1NjRIMlh0dHgyZnlqNlRtcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXRlZ29yaWVzP2lkPWRmN2VhMTc4LWRjNDctNDIxMC04MGFlLTA2YjViZDc4ZTkwYiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1ODQ1Njk4NDMxMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjExMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NhdGVnb3JpZXM/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2OTg0MzExIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456984),
('TJb34qlf6S3fW9lzhFUfYRj7YrP185XyBmh7fevu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTI2U3hiYm55bG5jR0NMVWRGNHZKQkpMU1VycU0yd1g3Y3l6RmNDTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU3MjIwNjE2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758457221),
('vwbHhKuOfftqMCYSuy1UmS6EjoMbEoX408AftKBD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUVE0cHZNZEhuVHlWcllrTlJubDRteG04alVDUkdIdWlZRVFqRUc3QSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYxOTY2OTAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYxOTY2OTAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758456196),
('VwCDW9mYK6W1nLW8GrB4C0wGsmSQAgdh75jpg2Uz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUZNM09HZmdyNUJRbjdBano2Z0dzcnZHTnV0cGlCb2dNbkF4YUQ5VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2OTc2OTk4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456977),
('wZ85ep30xZDl2V8WQYsBCqYzzXmyzwZfXJaI5Nqe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1NyNk5rYlV1S3JBWkdROHkyUlpKWm01QWxXYVJwSGlJNEdvMHRGYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758456126),
('XXNhoVCoBdADEpMoxfJYQdFGvqe7j73JJf6NEF0w', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFI4YXBkSlBTWDVnTXU4SVpQWmRWOTVpVmtCV2JiYURRUXFydnEyNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758457431),
('ydsbj1KnJCsY6rEXDgP9UyGGVNQDHUPPkCeJWW1i', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVWw4YXZHOGt5d2kxNXNzU1U2SWFXYWFtU3dZNWRwbEE5eWVYZVg0aCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3B1cmNoYXNlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTM3NTEyMDYiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxMDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3B1cmNoYXNlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTM3NTEyMDYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758453751),
('YvGpbbEfqyoDBVNEijahGB6xt2WrqP3znWdCckhx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHprejc5bDZDNUZmcjJEakRrcEZWaUNibDJsSUFUU2hidzhuVFg1bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvdGVybXMtYW5kLWNvbmRpdGlvbnM/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NDY3MjYwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456467),
('Zrtr0zymWB3ZrfZWNLKy0nwfGkqlxQe5uvMcFPWg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienFrN0lBVjlHT0praVVpNFJNZG1JRmNhenlDcWZidWF3VXA4emt2YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFnZXMvcHJpdmFjeS1wb2xpY3k/aWQ9ZGY3ZWExNzgtZGM0Ny00MjEwLTgwYWUtMDZiNWJkNzhlOTBiJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU4NDU2NDYwODY1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1758456461),
('ZwQhliJUOWDqphOtWVjS3cQw1Hl35qYYcEsZk98P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.104.1 Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXZEOWs2dDRqdUtuY0UyQUN0VG9iU3ZMWnVZZGFlMVV0ZkZpQlZTMyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYxMjYyMjAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxMDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcz9pZD1kZjdlYTE3OC1kYzQ3LTQyMTAtODBhZS0wNmI1YmQ3OGU5MGImdnNjb2RlQnJvd3NlclJlcUlkPTE3NTg0NTYxMjYyMjAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758456126);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `avatar`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin User', 'admin@example.com', NULL, 'admin', '2025-09-20 03:45:18', '$2y$12$Bk8gu5x3eDC01gTgvrg0g.N3wjcuJbdqq2VgPy/9HqlR1.Fr80JM6', NULL, '2025-09-20 03:45:18', '2025-09-20 03:45:18'),
(5, NULL, 'Vinay Singh', 'vinaysingh43@gmail.com', NULL, 'user', NULL, '$2y$12$SVe0qQmnRGjuHj29xXQ9J.dwM.V.j5eN14C.9dVWobGHbyhwsYqSO', NULL, '2025-09-21 01:26:45', '2025-09-21 01:26:45'),
(6, '117023220236076707435', 'Digital Creative International', 'wordpress2help@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocJLMWqaG7ztvHDYv8lNzUTlY1ltX-XhN_F9qnrGguzY_ho-XnM=s96-c', 'user', NULL, '$2y$12$pGTWvsT05nfYAaenzV1p/OrOfzMWDqM4LFCvlMG27hlpV3YFRBpuy', NULL, '2025-09-22 03:05:07', '2025-09-22 03:05:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `magazines_slug_unique` (`slug`),
  ADD KEY `magazines_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `options_key_unique` (`key`),
  ADD KEY `options_key_index` (`key`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_transaction_id_unique` (`transaction_id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`),
  ADD KEY `purchases_magazine_id_foreign` (`magazine_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `magazines`
--
ALTER TABLE `magazines`
  ADD CONSTRAINT `magazines_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_magazine_id_foreign` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
