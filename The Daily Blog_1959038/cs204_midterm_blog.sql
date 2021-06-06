-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 10:08 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs204_midterm_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `message`) VALUES
(1, 3, 1, 'Comment '),
(2, 3, 1, 'where the dream beginswhere the dream begins');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`, `contents`) VALUES
(1, 'where the dream begins', 'where the dream begins', 'zing-news-phan-mem-quan-ly-ban-hang-pos365.png', '<p>where the dream begins</p>\r\n\r\n<p>where the dream beginswhere the dream beginswhere the dream beginswhere the dream begins</p>\r\n\r\n<p>where the dream beginswhere the dream begins</p>\r\n'),
(2, 'api get campaign and register campaign dfgfdgdfgdfgdfgdfgdf', 'api get campaign and register campaigndfgdfgdfgdfgdf dfgdfg', '20210526_30afd6230515eeffc7a14adf3a4b3313_1622014077.jpg', '<p>api get campaign and register campaign</p>\r\n\r\n<p>api get campaign and register campaign</p>\r\n\r\n<p>api get campaign and register campaign</p>\r\n\r\n<p>api get campaign and register campaign</p>\r\n'),
(6, 'add email to companys', 'Nơi chia sẻ những khóa học miễn phí hót nhất', 'doanh-thu-la-gi-6-1610936126.jpg', '<h2>What Is BakeryToken (BAKE)?</h2>\r\n\r\n<p>Launched in September 2020, BakeryToken (BAKE) is a part of the BakerySwap ecosystem. Liquidity providers are rewarded with BAKE tokens which can be used to earn a share of BakerySwap&rsquo;s trading fees and to participate in voting as part of BakerySwap&rsquo;s governance process.</p>\r\n\r\n<p>BakerySwap is a decentralized automated market-making (<a href=\"https://coinmarketcap.com/alexandria/glossary/automated-market-maker-amm\">AMM</a>) protocol that is based on the Binance Smart Chain (<a href=\"https://coinmarketcap.com/bsc/\">BSC</a>). The BAKE token is a native BEP-20 governance token on the platform.</p>\r\n\r\n<p>Users have the ability to earn BAKE tokens by providing liquidity on BakerySwap, and BAKE holders can use their tokens for governance voting and to receive transaction fee dividends. The BAKE rewards are offered in several liquidity pools, initially including&nbsp;<a href=\"https://coinmarketcap.com/currencies/bitcoin/\">BTC</a>,&nbsp;<a href=\"https://coinmarketcap.com/currencies/ethereum/\">ETH</a>,&nbsp;<a href=\"https://coinmarketcap.com/currencies/polkadot-new/\">DOT</a>,&nbsp;<a href=\"https://coinmarketcap.com/currencies/chainlink/\">LINK</a>,&nbsp;<a href=\"https://coinmarketcap.com/currencies/binance-usd/\">BUSD</a>&nbsp;and BAKE versus&nbsp;<a href=\"https://coinmarketcap.com/currencies/binance-coin/\">BNB</a>.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `user_role`) VALUES
(1, 'Admin', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 1),
(3, 'A', 'duocnvoit@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
