-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 07:40 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edfa3ly-yashry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `pkID` int(11) NOT NULL,
  `tsCreatedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_row`
--

CREATE TABLE `tbl_bill_row` (
  `pkID` int(11) NOT NULL,
  `fkBillID` int(11) NOT NULL,
  `fkProductID` int(11) DEFAULT NULL,
  `fkTaxID` int(11) DEFAULT NULL,
  `fkOfferID` int(11) DEFAULT NULL,
  `fldRowType` enum('PRODUCT','TAX','OFFER','') NOT NULL,
  `fldPrice` decimal(11,2) NOT NULL,
  `fldQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE `tbl_offer` (
  `pkID` int(11) NOT NULL,
  `fkProductID` int(11) NOT NULL,
  `fldValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_offer`
--

INSERT INTO `tbl_offer` (`pkID`, `fkProductID`, `fldValue`) VALUES
(1, 4, 10),
(3, 3, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_depend`
--

CREATE TABLE `tbl_offer_depend` (
  `pkID` int(11) NOT NULL,
  `fkOfferID` int(11) NOT NULL,
  `fkProductID` int(11) NOT NULL,
  `fldNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_offer_depend`
--

INSERT INTO `tbl_offer_depend` (`pkID`, `fkOfferID`, `fkProductID`, `fldNum`) VALUES
(1, 1, 4, 1),
(5, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pkID` int(11) NOT NULL,
  `fldName` varchar(255) NOT NULL,
  `fldDescription` text DEFAULT NULL,
  `fldPrice` decimal(11,2) NOT NULL,
  `fldCode` varchar(11) NOT NULL,
  `fkTaxID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pkID`, `fldName`, `fldDescription`, `fldPrice`, `fldCode`, `fkTaxID`) VALUES
(1, 'T-shirt', NULL, '10.99', '1', NULL),
(2, 'Pants ', NULL, '14.99', '2', NULL),
(3, 'Jacket ', NULL, '19.99', '3', NULL),
(4, 'Shoes ', NULL, '24.99', '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `pkID` int(11) NOT NULL,
  `fldName` varchar(255) NOT NULL,
  `fldType` enum('FIXED','PERCENT','','') NOT NULL,
  `fldValue` int(11) NOT NULL,
  `fldOnBill` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`pkID`, `fldName`, `fldType`, `fldValue`, `fldOnBill`) VALUES
(1, 'VAT', 'PERCENT', 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`pkID`);

--
-- Indexes for table `tbl_bill_row`
--
ALTER TABLE `tbl_bill_row`
  ADD PRIMARY KEY (`pkID`),
  ADD KEY `fkBillID` (`fkBillID`),
  ADD KEY `fkProductID` (`fkProductID`),
  ADD KEY `fkTaxID` (`fkTaxID`),
  ADD KEY `fkOfferID` (`fkOfferID`);

--
-- Indexes for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  ADD PRIMARY KEY (`pkID`),
  ADD KEY `fkProductID` (`fkProductID`);

--
-- Indexes for table `tbl_offer_depend`
--
ALTER TABLE `tbl_offer_depend`
  ADD PRIMARY KEY (`pkID`),
  ADD KEY `tbl_offer_depend_ibfk_1` (`fkOfferID`),
  ADD KEY `fkProductID` (`fkProductID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pkID`),
  ADD KEY `tbl_product_ibfk_1` (`fkTaxID`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bill_row`
--
ALTER TABLE `tbl_bill_row`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_offer_depend`
--
ALTER TABLE `tbl_offer_depend`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bill_row`
--
ALTER TABLE `tbl_bill_row`
  ADD CONSTRAINT `tbl_bill_row_ibfk_1` FOREIGN KEY (`fkBillID`) REFERENCES `tbl_bill` (`pkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bill_row_ibfk_2` FOREIGN KEY (`fkProductID`) REFERENCES `tbl_product` (`pkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bill_row_ibfk_3` FOREIGN KEY (`fkTaxID`) REFERENCES `tbl_tax` (`pkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bill_row_ibfk_4` FOREIGN KEY (`fkOfferID`) REFERENCES `tbl_offer` (`pkID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_offer`
--
ALTER TABLE `tbl_offer`
  ADD CONSTRAINT `tbl_offer_ibfk_1` FOREIGN KEY (`fkProductID`) REFERENCES `tbl_product` (`pkID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_offer_depend`
--
ALTER TABLE `tbl_offer_depend`
  ADD CONSTRAINT `tbl_offer_depend_ibfk_1` FOREIGN KEY (`fkOfferID`) REFERENCES `tbl_offer` (`pkID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_offer_depend_ibfk_2` FOREIGN KEY (`fkProductID`) REFERENCES `tbl_product` (`pkID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`fkTaxID`) REFERENCES `tbl_tax` (`pkID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
