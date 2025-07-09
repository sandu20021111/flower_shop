-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 05:13 PM
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
(10, 'Vijay Thapa', '1234', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(12, 'Administrator', 'admin', 'admin'),
(13, 'Sashika Dilmina Karunanayake', 'admin', '21232f297a57a5a743894a0e4a801fc3');

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
  `added_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `flower_id`, `flower_name`, `price`, `qty`, `user_session`, `added_date`) VALUES
(2, 29, 'Cheese Burger', 980.00, 2, 'mcgc1ck985h7e4f3d6bchq3n1t', '2025-07-04 20:40:31'),
(3, 28, 'Hamburger ', 1100.00, 1, 'mcgc1ck985h7e4f3d6bchq3n1t', '2025-07-04 20:41:50');

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
(16, 'Pizza', 'Food_Category_959.jpg', 'Yes', 'Yes', '2024-08-18 00:00:00'),
(17, 'Burgur', 'Food_Category_506.jpg', 'Yes', 'Yes', '2024-08-18 00:00:00'),
(18, 'Momo', 'Food_Category_230.jpg', 'Yes', 'Yes', '2024-08-18 00:00:00'),
(19, 'Tacos', 'Food_Category_288.jpg', 'Yes', 'Yes', '2024-08-18 00:00:00'),
(20, 'Submarine', 'Food_Category_250.jpg', 'Yes', 'Yes', '2024-08-18 00:00:00'),
(21, 'mojito', 'Food_Category_49.jpg', 'Yes', 'Yes', '2024-08-18 00:00:00');

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
(10, 'Chicken Tacos', 'Grilled Chicken,Olive oil,Paprica,Chili Powder,Salt,Pepper,Homemade taco seasoning', 800.00, 'Food-Name-1874.jpg', 19, 'Yes', 'Yes'),
(11, 'Pork Tacos', 'Grilled pork,Cabbage, Avocado, Sour cream, Pickled onions,Homemade taco seasoning', 900.00, 'Food-Name-1704.jpg', 19, 'No', 'Yes'),
(12, 'Beef Tacos', 'Grilled,Beef,Lettuce,Cheese,\r\nTomatoes,Avacado,sour cream', 800.00, 'Food-Name-831.jpg', 19, 'Yes', 'Yes'),
(13, 'Prawn Tacos', 'Prawns,Cheese,sour cream,Olive oil,Green cabbage', 700.00, 'Food-Name-9175.jpg', 19, 'No', 'Yes'),
(14, 'Fish Taco', 'Grilled Fish,Cheese,sour cream,Olive oil,Tomatoes,Mayonnaise,Capsicum', 500.00, 'Food-Name-272.jpg', 19, 'No', 'Yes'),
(15, 'Vegan Tacos', 'Mushrooms,Olives,Tomatoes,\r\nCabbage, Lettuce,Cheese,onions', 400.00, 'Food-Name-5094.jpg', 19, 'No', 'Yes'),
(16, 'Pineapple Mojito', 'Fresh mint leaves,Fresh pineapple,Pineapple juice,Rum,Club soda', 450.00, 'Food-Name-8786.jpg', 21, 'No', 'Yes'),
(17, 'Watermelon Mojito', 'Fresh mint leaves,Fresh lime juice,Simple syrup,Light rum,Watermelon puree,Club soda', 350.00, 'Food-Name-8556.jpg', 21, 'No', 'No'),
(18, 'Blackberry Mojito', 'Blueberries,Superfine sugar,Lime juice,Fresh mint,Light rum ', 500.00, 'Food-Name-7932.jpg', 21, 'No', 'Yes'),
(19, 'Mint & Lemon Mojito', 'Fresh mint leaves,Lemon juice,Rum, Lime juice, Simple syrup,', 400.00, 'Food-Name-8006.jpg', 21, 'No', 'Yes'),
(20, 'Strawberry mojito', 'Fresh strawberries, Mint, Lime juice, Club soda, Sugar,', 550.00, 'Food-Name-1347.jpg', 21, 'Yes', 'Yes'),
(21, 'Blue Lagoon Mojito', 'Fresh mint leaves,Blue Lagoon syrup\r\n,Sugar syrup,Soda water,lemon', 550.00, 'Food-Name-3365.jpg', 21, 'No', 'Yes'),
(22, 'BBQ Chicken Sub', 'BBQ,Chicken,Onions,Cheese,\r\nLettuceTomatoes', 500.00, 'Food-Name-7011.jpg', 20, 'No', 'Yes'),
(23, 'Crispy Chicken Sub', 'Crispy Chicken,\r\nMayonnaise,Onion,Lettuce,\r\n ', 550.00, 'Food-Name-9720.jpg', 20, 'Yes', 'Yes'),
(24, 'Mac & Cheese Sub', 'Ham,Macaroni and Cheese,Bread and butter pickle,Mayonnaise\r\nClove garlic', 650.00, 'Food-Name-8708.jpg', 20, 'No', 'Yes'),
(25, 'Beef Sub', 'Mushrooms,Onions,Beef,\r\nMozzarella cheese,Lettuce', 800.00, 'Food-Name-7627.jpg', 20, 'No', 'Yes'),
(26, 'Tuna Sub', 'Tuna,Mayonnaise,Green chilli,Lettuce,Tomatoes', 450.00, 'Food-Name-4029.jpg', 20, 'No', 'Yes'),
(27, 'Vegan Sub', 'Mushrooms,Tomatoes,Olives\r\nLettuce,Pickles,Cucumbers,Avacado\r\n', 400.00, 'Food-Name-4109.jpg', 20, 'No', 'Yes'),
(28, 'Hamburger ', 'A classic beef patty with lettuce, tomato, and our special sauce\r\n', 1100.00, 'Food-Name-5585.jpg', 17, 'No', 'Yes'),
(29, 'Cheese Burger', 'A juicy beef patty topped with melted cheese, lettuce, and tomato.\r\n', 980.00, 'Food-Name-7359.jpg', 17, 'No', 'Yes'),
(30, 'Bacon Cheese Burger', 'A beef patty with crispy bacon, melted cheese, and fresh toppings.\r\n', 1650.00, 'Food-Name-9424.jpg', 17, 'Yes', 'Yes'),
(31, 'Double Chicken Burger', 'Two tender chicken patties with lettuce, tomato, and a creamy sauce\r\n', 1450.00, 'Food-Name-9554.jpg', 17, 'No', 'Yes'),
(32, 'Bacon double Cheese Burger', 'Two beef patties, crispy bacon, and double the cheese, with fresh toppings.\r\n', 1850.00, 'Food-Name-9059.jpg', 17, 'No', 'Yes'),
(33, 'Delight Chilli Chicken Pizza', 'A delightful combination of Spicy Chicken, green chilies, onions and Cheese\r\n', 1650.00, 'Food-Name-2167.jpeg', 16, 'No', 'Yes'),
(34, 'Signature Sea-Food Treat Pizza', ' Creamy Cuttlefish & Devilled Prawns, green chilies & onion, topped with delicious mozzarella\r\n', 2100.00, 'Food-Name-2722.jpeg', 16, 'No', 'Yes'),
(35, 'Classic Black Chicken Pizza', 'Black chicken and crunchy onion with a double layer of cheese.\r\n', 1400.00, 'Food-Name-6037.jpeg', 16, 'No', 'Yes'),
(36, 'Classic Hot & Spicy Chicken Pizza', 'Spicy chicken, capsicums, onions and cheese\r\n', 1700.00, 'Food-Name-9322.jpeg', 16, 'Yes', 'Yes'),
(37, 'Classic Tandoori Chicken', 'Tandoori chicken, onions and cheese\r\n', 1680.00, 'Food-Name-8093.jpeg', 16, 'No', 'Yes'),
(38, 'Shallow Fried Prawn Momos', 'Delicious prawn-filled dumplings, lightly fried to a crispy perfection\r\n', 980.00, 'Food-Name-2651.jpg', 18, 'No', 'Yes'),
(39, 'Steamed Veg Momos', 'Healthy and flavorful vegetable dumplings, steamed to perfection.\r\n', 720.00, 'Food-Name-5657.jpg', 18, 'No', 'Yes'),
(40, 'Shallow Fried Beef Momo', 'Savory beef dumplings, shallow fried for a tasty, crisp texture\r\n', 950.00, 'Food-Name-4246.jpg', 18, 'No', 'Yes'),
(41, 'Cheese Veg Momo', 'A delightful mix of cheese and vegetables, wrapped in a soft dumpling\r\n', 780.00, 'Food-Name-3620.jpg', 18, 'Yes', 'Yes'),
(42, 'Wok Fried Chicken Momo', 'Juicy chicken dumplings, wok-fried for a rich and flavorful taste.\r\n', 850.00, 'Food-Name-2348.jpg', 18, 'No', 'Yes');

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
(1, 'Sadeko Momo', 6.00, 3, 18.00, '2020-11-30 03:49:48', 'Cancelled', 'Bradley Farrell', '+1 (576) 504-4657', 'zuhafiq@mailinator.com', 'Duis aliqua Qui lor'),
(2, 'Best Burger', 4.00, 4, 16.00, '2020-11-30 03:52:43', 'Delivered', 'Kelly Dillard', '+1 (908) 914-3106', 'fexekihor@mailinator.com', 'Incidunt ipsum ad d'),
(3, 'Mixed Pizza', 10.00, 2, 20.00, '2020-11-30 04:07:17', 'Delivered', 'Jana Bush', '+1 (562) 101-2028', 'tydujy@mailinator.com', 'Minima iure ducimus'),
(4, 'Smoky BBQ Pizza', 6.00, 5, 30.00, '2024-07-28 11:53:08', 'Delivered', 'Sashika Dilmina Karunanayake', '55515', 'M20010209009@student.cinec', 'Badulla'),
(5, 'Dumplings Specials', 5.00, 1, 5.00, '2024-07-29 05:32:00', 'Ordered', 'Sashika Dilmina Karunanayake', '55515', 'M20010209009@student.cinec', 'malabe'),
(6, 'Dumplings Specials', 5.00, 1, 5.00, '2024-07-29 05:32:00', 'Cancelled', 'Sashika Dilmina Karunanayake', '55515', 'M20010209009@student.cinec', 'malabe'),
(7, 'Smoky BBQ Pizza', 6.00, 1, 6.00, '2024-07-29 12:17:57', 'Delivered', 'Sashika Dilmina Karunanayake', '55515', 'M20010209009@student.cinec', 'badulla'),
(8, 'Smoky BBQ Pizza', 6.00, 1, 6.00, '2024-07-29 12:23:59', 'On Delivery', 'abcd', '11111', '123@com', 'asdfg'),
(9, 'Blackberry Mojito', 500.00, 1, 500.00, '2024-07-30 09:02:04', 'Delivered', 'Sashika Dilmina Karunanayake', '8907', 'M20010209009@student.cinec', 'badulla'),
(10, 'Smoky BBQ Pizza', 6.00, 1, 6.00, '2024-07-31 08:31:58', 'On Delivery', 'rashmi', '6666', 'sashikadilmina01exed@gmail.com', 'malabe'),
(11, 'Strawberry mojito', 550.00, 2, 1100.00, '2024-08-01 11:35:36', 'Cancelled', 'Sonali Manjula', '119', 'sonumanju@gmail.vom', 'Kiribathgoda'),
(12, 'Shallow Fried Prawn Momos', 980.00, 5, 4900.00, '2024-08-18 03:53:20', 'Delivered', 'Pramod Chinthaka Ekanayaka', '0700000000', 'pramod@gmail.com', 'Diyathalawa');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
