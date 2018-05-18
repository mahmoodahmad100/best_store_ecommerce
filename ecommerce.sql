-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~trusty.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2018 at 10:45 PM
-- Server version: 5.5.60-0ubuntu0.14.04.1
-- PHP Version: 7.0.30-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`) VALUES
(1, 'HP'),
(2, 'Apple'),
(3, 'Dell'),
(4, 'BRAfdasf');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `ip_address`, `quantity`) VALUES
(12, '127.0.0.1', 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Laptops'),
(2, 'Mobiles'),
(4, 'Cameras'),
(5, 'LapTopsssssssss');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_id`, `user_id`, `status`, `date`) VALUES
(1, 'inv-1503859469', 2, 'in progress', '2017-08-27 19:00:41'),
(2, 'inv-1503859724', 2, 'in progress', '2017-08-27 19:00:45'),
(3, 'inv-1503861663', 8, 'in progress', '2017-08-27 19:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `trx_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `trx_id`, `user_id`, `amount`, `currency`, `date`) VALUES
(1, 'EC-05V31062W4455770A', 2, 699, 'USD', '2017-08-27 18:46:54'),
(2, 'EC-6U660665SK389970N', 2, 355, 'USD', '2017-08-27 18:48:45'),
(3, 'EC-9V820228MM6799006', 8, 436, 'USD', '2017-08-27 19:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `brand_id`, `title`, `description`, `price`, `image`, `keywords`) VALUES
(9, 2, 2, 'afdsafsad', '<p>fsadfsdafsdafsadfasdfsadfasdfasdfsdafasfsdf</p>\r\n<p>asdfsadfsadff<strong>asdfadsfasdasdsdfs</strong></p>\r\n<p>fasdfsadfasd<em>fsdafsadfsadfdsafsadfsadfasdfasdfasdfasdfsad</em></p>', 456, '1497515014.jpg', 'fsda af-sdf sadf- dsafa-sdf -asdf-asd-f sadfasd'),
(10, 4, 2, 'aaaaaaaaa', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaa</p>', 20, '1503503830.png', 'fsdafsda - fsadf sdf- asdf- sadf-sda-f da-sfadsfasd'),
(11, 2, 1, 'fsadfsda', '<p>fsdafasdfsadfdsafsdafasd</p>', 165, '1497515076.png', 'fsdafsadfsdafsad'),
(12, 2, 1, 'fsdafsd', '<p>fsdafsdafsadfsadf</p>', 65, '1497515102.png', 'fsdafsadfsdfsad -sdf- sad-f -sad-f -dsafasdf'),
(13, 1, 1, 'fsdafsda', '<p>fasdfsdafsadfasdfasdfasdfasdfasd</p>', 1231, '1497515136.png', 'fdsafsdafsad'),
(15, 2, 1, 'aaaaaaaaaaaaaaaaa', '<p>dddddddddddddddddddd</p>', 23, '1497515208.png', 'fsdafsadf'),
(17, 5, 1, 'fadsfsad', '<p>fsdafsdafadsfasdfasdfasdf</p>', 26, '1503503856.jpg', 'fasdfasdfsad'),
(18, 4, 2, 'aaaaaaaaa', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaa</p>', 20, '1503502824.jpg', 'fsdafsda - fsadf sdf- asdf- sadf-sda-f da-sfadsfasd'),
(19, 4, 2, 'aaaaaaaaa', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaa</p>', 20, '1503502858.png', 'fsdafsda - fsadf sdf- asdf- sadf-sda-f da-sfadsfasd'),
(20, 4, 2, 'aaaaaaaaa', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaa</p>', 20, '1503503087.jpg', 'fsdafsda - fsadf sdf- asdf- sadf-sda-f da-sfadsfasd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(250) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `name`, `email`, `password`) VALUES
(1, '127.0.0.1', 'fdsaf', 'hi@hi.com', 'hi@hi.com'),
(2, '127.0.0.1', 'Hello', 'hello@hello.com', 'd36eef32625367a43da63a9909ba716e'),
(3, '127.0.0.1', 'dsfasadf', 'welcome@aaa.com', '79aaa90e8681aa87f68f921e3a7fb696'),
(5, '127.0.0.1', 'Test', 'test@test.com', 'b642b4217b34b1e8d3bd915fc65c4452'),
(6, '127.0.0.1', 'hello ', 'ajfsdljfl@asj2Fsdjla.com', 'd72de0762024fe1071f2030af81ee88e'),
(7, '127.0.0.1', 'fsadfsad', 'fsdafasd@fdsa.cj', '5bc8576c76add3246d2e7d04fde094af'),
(8, '127.0.0.1', 'mahmod ahmad', 'option364@gmail.com', '175c45365a2d6b366d2db00b882de06d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
