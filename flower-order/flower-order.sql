-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 08:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flower-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', 'admin'),
(13, 'sanduni', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `flower_id` int(10) UNSIGNED NOT NULL,
  `flower_name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `user_session` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `flower_id`, `flower_name`, `price`, `qty`, `user_session`, `added_date`, `image_name`) VALUES
(32, 15, 'Red Rose', 700.00, 1, 'kbp79cb9fpukpldkgrqblg9c9s', '2025-07-14 23:14:52', NULL),
(39, 13, 'Lily', 850.00, 2, '2neun3le3r6fp3dg4bp8877fhu', '2025-07-15 19:43:45', NULL),
(40, 4, 'Orchid', 5000.00, 2, '2neun3le3r6fp3dg4bp8877fhu', '2025-07-16 00:14:46', NULL),
(41, 9, 'Daisies', 6500.00, 1, '4g6q865u00n5qne33l9q497o11', '2025-07-16 11:20:07', NULL),
(42, 4, 'Orchid', 5000.00, 1, 'r5qo572nvqhhlab5mdo1sego90', '2025-07-17 14:10:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`, `date_modified`) VALUES
(22, 'Anniversary Bouquet', 'Flower_Category_482.jpg', 'Yes', 'Yes', '2025-07-13 18:42:54'),
(23, 'Wedding Bouquet', 'Flower_Category_984.jpg', 'Yes', 'Yes', '2025-07-13 18:44:49'),
(24, 'Graduation Bouquet', 'Flower_Category_862.jpg', 'Yes', 'Yes', '2025-07-13 18:45:17'),
(25, 'Birthday Bouquet', 'Flower_Category_949.jpg', 'Yes', 'Yes', '2025-07-13 18:45:40'),
(26, 'Valentine Bouquet', 'Flower_Category_651.jpg', 'No', 'Yes', '2025-07-13 18:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_messages`
--

CREATE TABLE `tbl_contact_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact_messages`
--

INSERT INTO `tbl_contact_messages` (`id`, `full_name`, `email`, `message`, `submission_date`) VALUES
(1, 'sanduni', 'sandu@gmail.com', 'hi', '2025-07-17 23:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stars` float NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `name`, `stars`, `text`, `created_at`, `image`) VALUES
(5, 'Buwanika Anthony', 4, 'Absolutely beautiful bouquet! The flowers were fresh and the arrangement was stunning. Great for any special occasion.', '2025-07-15 18:32:22', '1752604342_buwanika_anthoney.jpg'),
(6, 'Pubudu Chathuranga', 4, 'The roses were vibrant and fragrant. Delivered on time and exactly as shown on the website.', '2025-07-15 18:32:59', '1752604379_pubudu_chathuranga.jfif'),
(7, 'Anusha Damayanthi', 5, 'Perfect flowers for my anniversary. The colors were lovely and the packaging was elegant.', '2025-07-15 18:34:50', '1752604490_anusha_damayanthi.jpg'),
(8, 'Akila Dhanuddara', 3, 'The sympathy flowers were elegant and respectful. Could use more fragrance though.', '2025-07-15 18:35:32', '1752604532_akila_danuddara.jfif'),
(9, 'Shanudri Priyasad', 5, 'Impressed by the exotic flower arrangement. The orchids were fresh and lasted long.', '2025-07-15 18:36:19', '1752604579_shanudri_priyasad.jpg'),
(10, 'nethmi rosel', 5, 'dhcbgsdy byscb8aysbcau', '2025-07-17 05:59:01', '1752731941_nethmi_roshel.jpg'),
(11, 'saranga', 3, 'nice', '2025-07-17 06:10:13', '1752732613_saranaga_dissasekara.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flower`
--

CREATE TABLE `tbl_flower` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_flower`
--

INSERT INTO `tbl_flower` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(3, 'Lily', 'Elegant and fragrant, lilies represent purity and renewal. They come in many colors, each with its own meaning.', 20000.00, 'Flower-Name-9961.jpg', 22, 'Yes', 'Yes'),
(4, 'Orchid', 'Exotic and delicate, orchids symbolize beauty, strength, and luxury. They’re often used in elegant floral arrangements.', 5000.00, 'Flower-Name-1934.jpg', 22, 'Yes', 'Yes'),
(5, 'Peonies', 'Full and lush, peonies stand for romance, prosperity, and good fortune. They bloom beautifully in spring.', 3000.00, 'Flower-Name-787.jpg', 22, 'Yes', 'Yes'),
(6, 'Carnation', 'Known for their ruffled petals and sweet fragrance, carnations symbolize love and admiration.', 8000.00, 'Flower-Name-4532.png', 25, 'Yes', 'Yes'),
(7, 'Gerberas', 'Bright and cheerful flowers that come in many colors, gerberas represent happiness and innocence.', 13500.00, 'Flower-Name-8121.jpg', 25, 'Yes', 'Yes'),
(8, 'Sunflower', 'With large yellow petals and a bold center, sunflowers symbolize warmth, positivity, and loyalty.', 5000.00, 'Flower-Name-549.jpg', 25, 'Yes', 'Yes'),
(9, 'Daisies', 'Simple and cheerful flowers with white petals and a yellow center, symbolizing purity and innocence.', 6500.00, 'Flower-Name-3070.jpg', 24, 'Yes', 'Yes'),
(10, 'Sunflower', 'Large yellow flowers that follow the sun, symbolizing warmth, positivity, and loyalty.', 7500.00, 'Flower-Name-182.jpg', 24, 'Yes', 'Yes'),
(11, 'Gerberas', 'Bright and bold daisy-like flowers, known for their large blooms and variety of colors, symbolizing happiness.', 19500.00, 'Flower-Name-2362.jpg', 24, 'Yes', 'Yes'),
(12, 'Heart Shape Mix Bouquet', 'A romantic arrangement of various colorful flowers shaped like a heart, symbolizing love and affection.', 15000.00, 'Flower-Name-586.jpg', 26, '', 'Yes'),
(13, 'Lily', 'Elegant, trumpet-shaped flowers that symbolize purity and renewal, available in white, pink, and orange shades.', 8050.00, 'Flower-Name-1136.jpg', 26, '', 'Yes'),
(14, 'Tulip', 'Bright, cup-shaped flowers that come in many colors, symbolizing perfect love and springtime joy.', 7000.00, 'Flower-Name-9745.jpg', 26, '', 'Yes'),
(15, 'Red Rose', 'Classic symbol of deep love and passion, often given on romantic occasions.', 25000.00, 'Flower-Name-5505.jpg', 26, '', 'Yes'),
(16, 'Calla Lily', 'Elegant, trumpet-shaped flowers known for their smooth curves and classic beauty.', 29500.00, 'Flower-Name-3081.jpg', 23, '', 'Yes'),
(17, 'Daisies', 'Simple and cheerful flowers with white petals and a yellow center, symbolizing innocence.', 8500.00, 'Flower-Name-7135.jpg', 23, '', 'Yes'),
(18, 'Gypsophila', 'Also known as baby’s breath, these tiny white blooms are delicate and airy, often used as filler.', 7500.00, 'Flower-Name-6028.jpg', 23, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `flower` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `flower`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(28, 'Carnation', 100.00, 1, 100.00, '2025-07-13 15:49:17', 'Delivered', 'sanduni', '0714586217', 'sandu@gmail.com', 'malabe'),
(29, 'Orchid', 200.00, 3, 600.00, '2025-07-15 09:45:20', 'Ordered', 'sanduni', '0714586217', 'vihara@gmail.com', '214'),
(30, 'Carnation', 200.00, 2, 400.00, '2025-07-15 09:45:20', 'Ordered', 'sanduni', '0714586217', 'vihara@gmail.com', '214'),
(31, 'Lily', 150.00, 1, 150.00, '2025-07-15 09:45:20', 'Ordered', 'sanduni', '0714586217', 'vihara@gmail.com', '214'),
(32, 'Peonies', 300.00, 1, 300.00, '2025-07-15 09:45:20', 'Ordered', 'sanduni', '0714586217', 'vihara@gmail.com', '214'),
(33, 'Sunflower', 700.00, 1, 700.00, '2025-07-15 09:45:20', 'Ordered', 'sanduni', '0714586217', 'vihara@gmail.com', '214');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_messages`
--
ALTER TABLE `tbl_contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_flower`
--
ALTER TABLE `tbl_flower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_contact_messages`
--
ALTER TABLE `tbl_contact_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_flower`
--
ALTER TABLE `tbl_flower`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
