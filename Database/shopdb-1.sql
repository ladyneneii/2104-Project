-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 05:27 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `admin_id` int(11) NOT NULL,
  `admin_firstname` varchar(50) NOT NULL,
  `user_category_id` int(11) NOT NULL,
  `admin_lastname` varchar(50) NOT NULL,
  `admin_gender_id` int(11) DEFAULT NULL,
  `admin_contact` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_id`, `admin_firstname`, `user_category_id`, `admin_lastname`, `admin_gender_id`, `admin_contact`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 2, 'admin', 0, 111111, 'admin', '202cb962ac59075b964b07152d234b70'),
(2, '', 2, '', 0, 0, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(5, 'admin1', 2, 'admin1', 0, 12345, 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `user_category_id` int(11) NOT NULL,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_middlename` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_contact_no` int(11) NOT NULL,
  `customer_age` int(11) NOT NULL,
  `customer_gender_id` int(11) NOT NULL,
  `customer_complete_address` varchar(100) NOT NULL,
  `customer_city` varchar(50) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `customer_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `user_category_id`, `customer_firstname`, `customer_middlename`, `customer_lastname`, `customer_contact_no`, `customer_age`, `customer_gender_id`, `customer_complete_address`, `customer_city`, `customer_username`, `customer_password`) VALUES
(10, 1, 'Juan', 'Antonio', 'Cruz', 912345, 23, 1, '123 Main Street', 'Cebu', 'juan', '827ccb0eea8a706c4c34a16891f84e7b'),
(12, 1, 'sadfsa', 'fsdfsd', 'fsdfsda', 12312, 213, 2, '123c qwer', '2 4', 'test', '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 1, 'Carlos', 'Antonio', 'Cruz', 123456, 32, 1, '123 asdfasf', 'cebu', 'carlos', '310dcbbf4cce62f762a2aaa148d556bd'),
(16, 2, 'test', 'test', 'test', 123, 12, 1, '123 Main St', 'Cebu', 'test123', 'test123'),
(19, 1, 'Ariana', 'Maryland', 'Grande', 1234567890, 28, 2, '482 Wall St. Yakima, WA 98908', 'Evergreen City', 'agrande@gmail.com', 'agrande'),
(20, 1, 'Taylor', 'Batumbakal', 'Swift', 123456789, 32, 2, '8 Walnutwood Drive Fresh Meadows, NY 11365', 'Pennsylvania City', 'tswift@gmail.com', 'tswift'),
(21, 1, 'Ross', 'Smith', 'Lynch', 432168958, 25, 1, '26 Fieldstone Ave. Capitol Heights, MD 20743', 'Leicester City', 'rlynch@gmail.com', 'rlynch'),
(22, 1, 'Lana', 'Del', 'Ray', 9984728, 31, 2, '512 Manchester Avenue Londonderry, NH 03053', 'Greenwhich City', 'lray@gmail.com', 'lray');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_number` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_number`, `payment_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `date_order_placed` date NOT NULL,
  `order_status_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`order_id`, `customer_id`, `total_amount`, `date_order_placed`, `order_status_code`) VALUES
(14, 12, 5297, '2022-12-18', 3),
(15, 21, 2000, '2022-12-14', 3),
(16, 20, 2949, '2022-12-28', 3),
(17, 19, 1995, '2022-12-04', 3),
(18, 22, 2298, '2022-12-17', 3),
(19, 15, 900, '2022-12-17', 3),
(20, 16, 2499, '2022-12-13', 3),
(21, 20, 300, '2022-12-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`product_id`, `order_id`, `quantity`) VALUES
(2, 16, 3),
(2, 19, 6),
(2, 21, 2),
(3, 14, 1),
(3, 15, 4),
(3, 18, 3),
(4, 14, 1),
(4, 17, 5),
(4, 18, 2),
(5, 14, 2),
(5, 16, 1),
(5, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method_code` int(11) NOT NULL,
  `payment_status_code` int(11) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `order_id`, `payment_method_code`, `payment_status_code`, `payment_date`) VALUES
(1, 14, 1, 2, '2022-12-31'),
(2, 15, 2, 2, '2022-12-30'),
(3, 16, 2, 1, '2022-12-30'),
(4, 17, 1, 2, '2022-12-28'),
(5, 18, 2, 1, '2022-12-31'),
(6, 19, 1, 2, '2022-12-30'),
(7, 20, 1, 2, '2022-12-31'),
(8, 21, 2, 1, '2022-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type_code` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_size` enum('XS','S','M','L','XL') NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_stocks` enum('In Stock','Out of Stock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type_code`, `product_name`, `product_price`, `product_size`, `product_description`, `product_quantity`, `product_stocks`) VALUES
(2, 1, 'Levis Jeans', 150, 'L', 'Levis straightcut', 50, 'In Stock'),
(3, 3, 'Yellow Dress', 500, 'L', ' A dress color yellow', 2, 'In Stock'),
(4, 2, 'Crop Top', 399, 'S', 'Pink crop top', 28, 'In Stock'),
(5, 3, 'Ball Gown', 2499, 'L', 'Long, flowy blue dress for proms and formal events', 6, 'In Stock');

-- --------------------------------------------------------

--
-- Table structure for table `ref_delivery_status`
--

CREATE TABLE `ref_delivery_status` (
  `delivery_status_code` int(11) NOT NULL,
  `delivery_status_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_delivery_status`
--

INSERT INTO `ref_delivery_status` (`delivery_status_code`, `delivery_status_desc`) VALUES
(1, 'Delivered'),
(2, 'In_transit');

-- --------------------------------------------------------

--
-- Table structure for table `ref_gender_code`
--

CREATE TABLE `ref_gender_code` (
  `gender_id` int(11) NOT NULL,
  `gender_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_gender_code`
--

INSERT INTO `ref_gender_code` (`gender_id`, `gender_type`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `ref_order_status_code`
--

CREATE TABLE `ref_order_status_code` (
  `order_status_code` int(11) NOT NULL,
  `order_status_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_order_status_code`
--

INSERT INTO `ref_order_status_code` (`order_status_code`, `order_status_description`) VALUES
(1, 'Complete'),
(2, 'Cancel'),
(3, 'Pending'),
(4, 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `ref_payment_methods`
--

CREATE TABLE `ref_payment_methods` (
  `payment_method_code` int(11) NOT NULL,
  `payment_method_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_payment_methods`
--

INSERT INTO `ref_payment_methods` (`payment_method_code`, `payment_method_type`) VALUES
(1, 'Cash'),
(2, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `ref_payment_status_code`
--

CREATE TABLE `ref_payment_status_code` (
  `payment_status_code` int(11) NOT NULL,
  `payment_status_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_payment_status_code`
--

INSERT INTO `ref_payment_status_code` (`payment_status_code`, `payment_status_description`) VALUES
(1, 'Paid'),
(2, 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `ref_product_type`
--

CREATE TABLE `ref_product_type` (
  `product_type_code` int(11) NOT NULL,
  `product_type_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_product_type`
--

INSERT INTO `ref_product_type` (`product_type_code`, `product_type_description`) VALUES
(1, 'Jeans'),
(2, 'Shirt'),
(3, 'Dress');

-- --------------------------------------------------------

--
-- Table structure for table `ref_shipment_courier`
--

CREATE TABLE `ref_shipment_courier` (
  `shipment_courier_code` int(11) NOT NULL,
  `shipment_courier_name` varchar(50) NOT NULL,
  `shipment_courier_contact_no` int(11) NOT NULL,
  `shipment_courier_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_shipment_courier`
--

INSERT INTO `ref_shipment_courier` (`shipment_courier_code`, `shipment_courier_name`, `shipment_courier_contact_no`, `shipment_courier_address`) VALUES
(1, 'JnT', 933333, '123 Main Building'),
(2, 'LBC', 966666, '456 Upper Building');

-- --------------------------------------------------------

--
-- Table structure for table `ref_user_category`
--

CREATE TABLE `ref_user_category` (
  `user_category_id` int(11) NOT NULL,
  `user_category_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_user_category`
--

INSERT INTO `ref_user_category` (`user_category_id`, `user_category_description`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_details`
--

CREATE TABLE `shipment_details` (
  `shipment_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `shipment_courier_code` int(11) NOT NULL,
  `shipment_tracking_number` int(11) NOT NULL,
  `shipment_date` date NOT NULL,
  `delivery_status_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment_details`
--

INSERT INTO `shipment_details` (`shipment_id`, `payment_id`, `shipment_courier_code`, `shipment_tracking_number`, `shipment_date`, `delivery_status_code`) VALUES
(1, 1, 1, 7890, '2023-01-02', 2),
(2, 2, 2, 1266, '2023-01-05', 2),
(3, 3, 2, 4456, '2023-01-02', 2),
(4, 4, 2, 1111, '2023-01-03', 2),
(5, 5, 1, 2283, '2023-01-01', 2),
(6, 6, 2, 9214, '2023-01-04', 2),
(7, 7, 1, 4210, '2023-01-05', 2),
(8, 8, 1, 1001, '2023-01-03', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_category_id` (`user_category_id`),
  ADD KEY `admin_gender_id` (`admin_gender_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_category` (`user_category_id`),
  ADD KEY `customer_gender_id` (`customer_gender_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_number`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_status_code` (`order_status_code`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_method_code` (`payment_method_code`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `payment_status_code` (`payment_status_code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type_code` (`product_type_code`);

--
-- Indexes for table `ref_delivery_status`
--
ALTER TABLE `ref_delivery_status`
  ADD PRIMARY KEY (`delivery_status_code`);

--
-- Indexes for table `ref_gender_code`
--
ALTER TABLE `ref_gender_code`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `ref_order_status_code`
--
ALTER TABLE `ref_order_status_code`
  ADD PRIMARY KEY (`order_status_code`);

--
-- Indexes for table `ref_payment_methods`
--
ALTER TABLE `ref_payment_methods`
  ADD PRIMARY KEY (`payment_method_code`);

--
-- Indexes for table `ref_payment_status_code`
--
ALTER TABLE `ref_payment_status_code`
  ADD PRIMARY KEY (`payment_status_code`);

--
-- Indexes for table `ref_product_type`
--
ALTER TABLE `ref_product_type`
  ADD PRIMARY KEY (`product_type_code`);

--
-- Indexes for table `ref_shipment_courier`
--
ALTER TABLE `ref_shipment_courier`
  ADD PRIMARY KEY (`shipment_courier_code`);

--
-- Indexes for table `ref_user_category`
--
ALTER TABLE `ref_user_category`
  ADD PRIMARY KEY (`user_category_id`);

--
-- Indexes for table `shipment_details`
--
ALTER TABLE `shipment_details`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `shipment_courier_code` (`shipment_courier_code`),
  ADD KEY `delivery_status_code` (`delivery_status_code`),
  ADD KEY `payment_id` (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `invoice_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ref_delivery_status`
--
ALTER TABLE `ref_delivery_status`
  MODIFY `delivery_status_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_gender_code`
--
ALTER TABLE `ref_gender_code`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_order_status_code`
--
ALTER TABLE `ref_order_status_code`
  MODIFY `order_status_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ref_payment_methods`
--
ALTER TABLE `ref_payment_methods`
  MODIFY `payment_method_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_payment_status_code`
--
ALTER TABLE `ref_payment_status_code`
  MODIFY `payment_status_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_product_type`
--
ALTER TABLE `ref_product_type`
  MODIFY `product_type_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_shipment_courier`
--
ALTER TABLE `ref_shipment_courier`
  MODIFY `shipment_courier_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_user_category`
--
ALTER TABLE `ref_user_category`
  MODIFY `user_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipment_details`
--
ALTER TABLE `shipment_details`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD CONSTRAINT `admin_details_ibfk_1` FOREIGN KEY (`user_category_id`) REFERENCES `ref_user_category` (`user_category_id`);

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `customer_details_ibfk_1` FOREIGN KEY (`customer_gender_id`) REFERENCES `ref_gender_code` (`gender_id`),
  ADD CONSTRAINT `user_category` FOREIGN KEY (`user_category_id`) REFERENCES `ref_user_category` (`user_category_id`);

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`payment_id`);

--
-- Constraints for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `orders_details_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`),
  ADD CONSTRAINT `orders_details_ibfk_4` FOREIGN KEY (`order_status_code`) REFERENCES `ref_order_status_code` (`order_status_code`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders_details` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_2` FOREIGN KEY (`payment_method_code`) REFERENCES `ref_payment_methods` (`payment_method_code`),
  ADD CONSTRAINT `payment_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders_details` (`order_id`),
  ADD CONSTRAINT `payment_details_ibfk_4` FOREIGN KEY (`payment_status_code`) REFERENCES `ref_payment_status_code` (`payment_status_code`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_code`) REFERENCES `ref_product_type` (`product_type_code`);

--
-- Constraints for table `shipment_details`
--
ALTER TABLE `shipment_details`
  ADD CONSTRAINT `shipment_details_ibfk_2` FOREIGN KEY (`shipment_courier_code`) REFERENCES `ref_shipment_courier` (`shipment_courier_code`),
  ADD CONSTRAINT `shipment_details_ibfk_4` FOREIGN KEY (`delivery_status_code`) REFERENCES `ref_delivery_status` (`delivery_status_code`),
  ADD CONSTRAINT `shipment_details_ibfk_5` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`payment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
