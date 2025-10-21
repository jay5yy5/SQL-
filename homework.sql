-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-07 04:09:50
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `homework`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `account` varchar(20) NOT NULL,
  `ad_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `員工`
--

CREATE TABLE `員工` (
  `employeeId` varchar(20) NOT NULL,
  `employeeGender` varchar(10) NOT NULL,
  `employeeName` varchar(50) NOT NULL,
  `projectId` int(20) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `學生`
--

CREATE TABLE `學生` (
  `studentId` varchar(20) NOT NULL,
  `studentGender` varchar(10) NOT NULL,
  `studentName` varchar(50) NOT NULL,
  `studentPhone` varchar(20) NOT NULL,
  `studentBirthday` varchar(20) NOT NULL,
  `studentAddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `聯絡人`
--

CREATE TABLE `聯絡人` (
  `studentId` varchar(20) NOT NULL,
  `contactAddress` varchar(100) NOT NULL,
  `contactPhone` varchar(20) NOT NULL,
  `contactName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `負責項目`
--

CREATE TABLE `負責項目` (
  `projectId` int(20) NOT NULL,
  `projectName` varchar(100) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `部門`
--

CREATE TABLE `部門` (
  `departmentId` int(11) NOT NULL,
  `departmentName` varchar(20) NOT NULL,
  `departmentPhone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`account`);

--
-- 資料表索引 `員工`
--
ALTER TABLE `員工`
  ADD PRIMARY KEY (`employeeId`),
  ADD KEY `departmentId` (`departmentId`),
  ADD KEY `projectId` (`projectId`);

--
-- 資料表索引 `學生`
--
ALTER TABLE `學生`
  ADD PRIMARY KEY (`studentId`);

--
-- 資料表索引 `聯絡人`
--
ALTER TABLE `聯絡人`
  ADD PRIMARY KEY (`studentId`);

--
-- 資料表索引 `負責項目`
--
ALTER TABLE `負責項目`
  ADD PRIMARY KEY (`projectId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- 資料表索引 `部門`
--
ALTER TABLE `部門`
  ADD PRIMARY KEY (`departmentId`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `員工`
--
ALTER TABLE `員工`
  ADD CONSTRAINT `員工_ibfk_1` FOREIGN KEY (`departmentId`) REFERENCES `部門` (`departmentId`),
  ADD CONSTRAINT `員工_ibfk_2` FOREIGN KEY (`projectId`) REFERENCES `負責項目` (`projectId`);

--
-- 資料表的限制式 `聯絡人`
--
ALTER TABLE `聯絡人`
  ADD CONSTRAINT `聯絡人_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `學生` (`studentId`);

--
-- 資料表的限制式 `負責項目`
--
ALTER TABLE `負責項目`
  ADD CONSTRAINT `負責項目_ibfk_1` FOREIGN KEY (`departmentId`) REFERENCES `部門` (`departmentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
