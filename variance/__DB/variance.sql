-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 12:42 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `variance`
--

-- --------------------------------------------------------

--
-- Table structure for table `gigapay_raw_logs`
--

CREATE TABLE `gigapay_raw_logs` (
  `id` longtext DEFAULT NULL,
  `status` longtext DEFAULT NULL,
  `transaction_digest` longtext DEFAULT NULL,
  `number` longtext DEFAULT NULL,
  `main_number` longtext DEFAULT NULL,
  `brand` longtext DEFAULT NULL,
  `transaction_date` longtext DEFAULT NULL,
  `transaction_type` longtext DEFAULT NULL,
  `payment_method` longtext DEFAULT NULL,
  `currency` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `keyword` longtext DEFAULT NULL,
  `action` longtext DEFAULT NULL,
  `payment_reference_number` longtext DEFAULT NULL,
  `app_transaction_number` longtext DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `is_payment_status_updated` longtext DEFAULT NULL,
  `authentication_status_origin` longtext DEFAULT NULL,
  `wallet_amount` longtext DEFAULT NULL,
  `wallet_fees` longtext DEFAULT NULL,
  `wallet_status` longtext DEFAULT NULL,
  `wallet_request_reference_no` longtext DEFAULT NULL,
  `wallet_merchant_value` longtext DEFAULT NULL,
  `wallet_payment_token_id` longtext DEFAULT NULL,
  `paymaya_checkout_id` longtext DEFAULT NULL,
  `paymaya_void_id` longtext DEFAULT NULL,
  `paymaya_void_reason` longtext DEFAULT NULL,
  `last_four` longtext DEFAULT NULL,
  `first_six` longtext DEFAULT NULL,
  `card_type` longtext DEFAULT NULL,
  `elp_transaction_number` longtext DEFAULT NULL,
  `elp_corporation_id` longtext DEFAULT NULL,
  `elp_branch_id` longtext DEFAULT NULL,
  `elp_request_reference_number` longtext DEFAULT NULL,
  `elp_plan_code` longtext DEFAULT NULL,
  `elp_amount` longtext DEFAULT NULL,
  `elp_retailer_deduct` longtext DEFAULT NULL,
  `elp_retailer_new_balance` longtext DEFAULT NULL,
  `elp_response_code` longtext DEFAULT NULL,
  `elp_response_description` longtext DEFAULT NULL,
  `elp_transaction_timestamp` longtext DEFAULT NULL,
  `created_at` longtext DEFAULT NULL,
  `updated_at` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `raw_elp_logs`
--

CREATE TABLE `raw_elp_logs` (
  `id` longtext DEFAULT NULL,
  `type` longtext DEFAULT NULL,
  `number` longtext DEFAULT NULL,
  `corporate_id` longtext DEFAULT NULL,
  `branch_id` longtext DEFAULT NULL,
  `request_reference_number` longtext DEFAULT NULL,
  `plan_code` longtext DEFAULT NULL,
  `amount` longtext DEFAULT NULL,
  `retailer_deduct` longtext DEFAULT NULL,
  `retailer_new_balance` longtext DEFAULT NULL,
  `response_code` longtext DEFAULT NULL,
  `response_description` longtext DEFAULT NULL,
  `transaction_request_reference_number` longtext DEFAULT NULL,
  `transaction_timestamp` longtext DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `created_at` longtext DEFAULT NULL,
  `updated_at` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `splunk`
--

CREATE TABLE `splunk` (
  `_time` longtext DEFAULT NULL,
  `id` longtext DEFAULT NULL,
  `processor_ref_no` longtext DEFAULT NULL,
  `app_transaction_number` longtext DEFAULT NULL,
  `state` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
