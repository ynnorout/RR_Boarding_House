-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 10:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inet_boarding_house_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivitylog`
--

CREATE TABLE `tblactivitylog` (
  `log_record_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_type` enum('add','update','delete') DEFAULT NULL,
  `details` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblactivitylog`
--

INSERT INTO `tblactivitylog` (`log_record_id`, `user_id`, `log_type`, `details`, `date_time`) VALUES
(1, 1, 'add', 'Add new tenant: John Peter', '2024-04-05 14:05:45'),
(2, 1, 'add', 'Added new room: room 1', '2024-04-05 14:06:19'),
(3, 1, 'add', 'Added new room: room 2', '2024-04-05 14:07:34'),
(4, 1, 'add', 'Added new bed: Bed Number=bed 1', '2024-04-05 14:07:48'),
(5, 1, 'add', 'Added new bed: Bed Number=bed 2', '2024-04-05 14:07:57'),
(6, 1, 'add', 'Added new bed: Bed Number=bed 3', '2024-04-05 14:08:15'),
(7, 1, 'add', 'Added new bed assignment for tenant in bed 1', '2024-04-05 14:08:40'),
(8, 1, 'update', 'Updated invoice ID 1', '2024-04-05 14:09:25'),
(9, 1, '', 'Payment made for Invoice #2024-1-1-May by John Peter amounting to PHP:4500', '2024-04-05 14:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblbackup`
--

CREATE TABLE `tblbackup` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbackup`
--

INSERT INTO `tblbackup` (`id`, `user_id`, `backup_file`, `backup_date`) VALUES
(1, 1, 'backup/database_backup_2024-04-05_08-10-27.sql', '2024-04-05 06:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblbarangay`
--

CREATE TABLE `tblbarangay` (
  `location_id` int(11) NOT NULL,
  `barangay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbed`
--

CREATE TABLE `tblbed` (
  `bed_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `bed_number` varchar(20) DEFAULT NULL,
  `monthly_rent` decimal(10,2) DEFAULT NULL,
  `status` enum('available','occupied') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbed`
--

INSERT INTO `tblbed` (`bed_id`, `room_id`, `bed_number`, `monthly_rent`, `status`) VALUES
(1, 1, 'bed 1', '5000.00', 'occupied'),
(2, 1, 'bed 2', '5000.00', 'available'),
(3, 2, 'bed 3', '5000.00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `tblbedassignment`
--

CREATE TABLE `tblbedassignment` (
  `assignment_id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `due_date` int(2) NOT NULL,
  `months_to_stay` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbedassignment`
--

INSERT INTO `tblbedassignment` (`assignment_id`, `tenant_id`, `room_id`, `bed_id`, `due_date`, `months_to_stay`) VALUES
(1, 9, 1, 3, 25, 5),
(2, 1, 1, 5, 25, 7),
(3, 1, 1, 1, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `comment_id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reply_from_management` text DEFAULT NULL,
  `status` enum('pending','solved','on-going') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `company_id` int(11) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_contact` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`company_id`, `company_logo`, `company_name`, `company_address`, `company_contact`, `company_website`) VALUES
(1, 'user8-128x128.jpg', 'company name', 'address', '123456', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `tenant_id` int(11) NOT NULL,
  `due_date_iterate` varchar(255) NOT NULL,
  `bed_rate` double NOT NULL,
  `penalty_amount` double NOT NULL DEFAULT 0,
  `discount_amount` double NOT NULL DEFAULT 0,
  `total_due` double NOT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `remarks` varchar(255) NOT NULL,
  `assignment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`invoice_id`, `invoice_number`, `tenant_id`, `due_date_iterate`, `bed_rate`, `penalty_amount`, `discount_amount`, `total_due`, `status`, `remarks`, `assignment_id`) VALUES
(1, '2024-1-1-May', 1, 'May 5, 2024', 5000, 500, 1000, 4500, 'paid', 'test remarks', 3),
(2, '2024-1-1-June', 1, 'June 5, 2024', 5000, 0, 0, 5000, 'unpaid', '', 3),
(3, '2024-1-1-July', 1, 'July 5, 2024', 5000, 0, 0, 5000, 'unpaid', '', 3),
(4, '2024-1-1-August', 1, 'August 5, 2024', 5000, 0, 0, 5000, 'unpaid', '', 3),
(5, '2024-1-1-September', 1, 'September 5, 2024', 5000, 0, 0, 5000, 'unpaid', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `payment_id` int(11) NOT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `tenant_name` varchar(255) NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`payment_id`, `invoice_number`, `tenant_name`, `amount_paid`, `payment_date`, `payment_mode`) VALUES
(1, '2024-1-1-May', 'John Peter', '4500.00', '2024-04-05', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

CREATE TABLE `tblroom` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) DEFAULT NULL,
  `room_description` text DEFAULT NULL,
  `room_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`room_id`, `room_name`, `room_description`, `room_image`) VALUES
(1, 'room 1', 'test description', 'room 1.jpg'),
(2, 'room 2', 'room 2 description', 'room 2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbltenant`
--

CREATE TABLE `tbltenant` (
  `tenant_id` int(11) NOT NULL,
  `complete_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `proof_of_identity` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltenant`
--

INSERT INTO `tbltenant` (`tenant_id`, `complete_name`, `address`, `email_address`, `contact`, `gender`, `profile_picture`, `proof_of_identity`, `status`, `username`, `password`) VALUES
(1, 'John Peter', 'Wall Street USA', 'test@email.com', '13498732135', 'Male', 'John Peter.png', 'John Peter.png', 'active', 'john', '$2y$10$XcbvO6lMGU9IxFn/Xi1tnOZJAljk3Y.BWGutVoEzuG4EC.3vP9FMu');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `complete_name` varchar(255) DEFAULT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `username`, `password`, `complete_name`, `user_type`) VALUES
(1, 'admin', '$2y$10$hgauy44BNQ.S36u0uVhS2OplCumIv3B66.7QLeJ411y4TEPsqKuze', 'administrator', 'admin'),
(2, 'usera', '$2y$10$PXHGrsIRzH8Ok0rIpD4VLunlB/2iLChqVllZhD3b5tlb2Z1T2jVm2', 'user/encoder', 'user'),
(5, 'a', '$2y$10$J1aNliB6rZ9a/0XRkJTd5.nxCyJNL3YEa/dhbLaOgi.3TxP/KtKQO', 'a', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblactivitylog`
--
ALTER TABLE `tblactivitylog`
  ADD PRIMARY KEY (`log_record_id`);

--
-- Indexes for table `tblbackup`
--
ALTER TABLE `tblbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbarangay`
--
ALTER TABLE `tblbarangay`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tblbed`
--
ALTER TABLE `tblbed`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `tblbedassignment`
--
ALTER TABLE `tblbedassignment`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbltenant`
--
ALTER TABLE `tbltenant`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblactivitylog`
--
ALTER TABLE `tblactivitylog`
  MODIFY `log_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblbackup`
--
ALTER TABLE `tblbackup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbarangay`
--
ALTER TABLE `tblbarangay`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblbed`
--
ALTER TABLE `tblbed`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblbedassignment`
--
ALTER TABLE `tblbedassignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbltenant`
--
ALTER TABLE `tbltenant`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
