-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2020 at 05:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booklife`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `favorite_id` int(11) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `price` varchar(128) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `link` varchar(128) NOT NULL,
  `category` varchar(128) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`favorite_id`, `title`, `price`, `image`, `link`, `category`, `user_id`) VALUES
(25, '裏側から視るAＩ', '2420', 'http://books.google.com/books/content?id=_h2vDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'https://play.google.com/store/books/details?id=_h2vDwAAQBAJ&source=gbs_api', '未分類', 1),
(28, 'おもしろまじめなAIスピーカーアプリをつくろう -Google Home（アシスタント）&Amazon Echo（Alexa）音声アシスタント開発', '2772', 'http://books.google.com/books/content?id=TuSoDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'https://play.google.com/store/books/details?id=TuSoDwAAQBAJ&source=gbs_api', '未分類', 1),
(30, 'ゲーム開発者のためのAI入門', '不明', 'http://books.google.com/books/content?id=86GetY0qpd4C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'http://books.google.co.jp/books?id=86GetY0qpd4C&dq=AI&hl=&source=gbs_api', '未分類', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `mail`, `password`) VALUES
(1, 'sada', 'sadanokosei0114@gmail.com', 'kosei0114'),
(2, 'jiro', 'jiro@next', '1234'),
(3, 'テスト', 'test@gmail.com', '123456'),
(4, 'バグテスト', 'test2@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favorite_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
