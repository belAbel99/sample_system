-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2022 at 06:31 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sample_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_archive`
--

CREATE TABLE `tbl_archive` (
  `id` int(100) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Reg_DateTime` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `Gender` varchar(100) NOT NULL,
  `ContactNo` char(100) NOT NULL,
  `DoB` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Updation_Date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(100) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Reg_DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Gender` varchar(100) NOT NULL,
  `DoB` varchar(100) NOT NULL,
  `ContactNo` char(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Updation_Date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `Firstname`, `Lastname`, `Email`, `Password`, `Reg_DateTime`, `Gender`, `DoB`, `ContactNo`, `Address`, `Updation_Date`) VALUES
(2, 'gracesss', 'poohta', 'olrak@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2022-09-16 16:23:07', 'Female', '2022-09-13', '09123456789', 'wwwww', '2022-09-17 04:23:07'),
(3, 'Anna', 'KSKSKS', 'olrak222@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2021-01-25 01:22:15', 'Male', '2021-01-21', '12345678911', 'AAAKK', '2021-01-26 00:10:38'),
(4, 'Kobe', 'Bryant', 'kobe@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2021-01-26 00:07:01', 'Male', '2021-01-07', '12345678911', 'Im the legend', '2021-01-26 00:09:41'),
(5, 'qq', 'kasinillo', 'olra11k@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2021-01-26 03:17:05', '', '', '', '', NULL),
(8, '77', '77', 'olrak@gmail.com66', 'e4da3b7fbbce2345d7772b0674a318d5', '2021-01-26 03:19:24', '', '', '', '', NULL);

CREATE TABLE uploaded_files (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES tbl_users(id),
    profile_name TEXT NOT NULL,
    group_name TEXT NOT NULL,
    file_path TEXT NOT NULL,
    description TEXT,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE uploaded_files 
ADD COLUMN form_a BOOLEAN DEFAULT FALSE,
ADD COLUMN form_b BOOLEAN DEFAULT FALSE,
ADD COLUMN form_c BOOLEAN DEFAULT FALSE,
ADD COLUMN form_d BOOLEAN DEFAULT FALSE;



-- table for delete trigger
CREATE TABLE delete_log (
    log_id SERIAL PRIMARY KEY,
    user_id INTEGER,
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    action_type VARCHAR(10),
    profile_name VARCHAR(255),
    group_name VARCHAR(255),
    file_path VARCHAR(255),
    description VARCHAR(255),
    form_a BOOLEAN,
    form_b BOOLEAN,
    form_c BOOLEAN,
    form_d BOOLEAN
);


ALTER TABLE delete_log
DROP COLUMN contactno;
DROP COLUMN user_id,
DROP COLUMN action_type,
DROP COLUMN profile_name,
DROP COLUMN group_name,
DROP COLUMN file_path,
DROP COLUMN description,
DROP COLUMN form_a,
DROP COLUMN form_b,
DROP COLUMN form_c,
DROP COLUMN form_d;

ALTER TABLE delete_log
ADD COLUMN contactno VARCHAR(100);
ADD COLUMN user_id INTEGER(20),
ADD COLUMN firstname VARCHAR(100),
ADD COLUMN lastname VARCHAR(255),
ADD COLUMN email VARCHAR(255),
ADD COLUMN gender VARCHAR(255),

ADD COLUMN dob VARCHAR(255),
ADD COLUMN address VARCHAR(255)
ADD COLUMN action_type VARCHAR(10);

--table for update trigger
CREATE TABLE changes_log (
    log_id SERIAL PRIMARY KEY,
    user_id INTEGER,
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    action_type VARCHAR(10),
    profile_name VARCHAR(255),
    group_name VARCHAR(255),
    file_path VARCHAR(255),
    description VARCHAR(255),
    form_a BOOLEAN,
    form_b BOOLEAN,
    form_c BOOLEAN,
    form_d BOOLEAN
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_archive`
--
ALTER TABLE `tbl_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_archive`
--
ALTER TABLE `tbl_archive`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
