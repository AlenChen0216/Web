-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-05-23 18:34:14
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `user0`
--
CREATE DATABASE IF NOT EXISTS `user0` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `user0`;

-- --------------------------------------------------------

--
-- 資料表結構 `商品`
--

CREATE TABLE `商品` (
  `UID` varchar(20) NOT NULL,
  `品名` varchar(20) NOT NULL,
  `庫存量` int(11) NOT NULL,
  `評價` int(11) NOT NULL,
  `簡短敘述` varchar(50) NOT NULL,
  `完整敘述` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `用戶`
--

CREATE TABLE `用戶` (
  `ID` varchar(20) NOT NULL,
  `帳號` varchar(20) NOT NULL,
  `密碼` varchar(20) NOT NULL,
  `生日` date NOT NULL,
  `電話` varchar(20) NOT NULL,
  `地址` varchar(20) NOT NULL,
  `權限` int(11) NOT NULL,
  `姓名` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `用戶評論`
--

CREATE TABLE `用戶評論` (
  `UID` varchar(20) NOT NULL,
  `ID` varchar(20) NOT NULL,
  `評論` varchar(20) NOT NULL,
  `評價` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `訂單`
--

CREATE TABLE `訂單` (
  `UUID` varchar(20) NOT NULL,
  `ID` varchar(20) NOT NULL,
  `UID` varchar(20) NOT NULL,
  `數量` int(11) NOT NULL,
  `地址` varchar(20) NOT NULL,
  `電話` varchar(20) NOT NULL,
  `姓名` varchar(20) NOT NULL,
  `運送狀態` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `商品`
--
ALTER TABLE `商品`
  ADD PRIMARY KEY (`UID`);

--
-- 資料表索引 `用戶`
--
ALTER TABLE `用戶`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `訂單`
--
ALTER TABLE `訂單`
  ADD PRIMARY KEY (`UUID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
