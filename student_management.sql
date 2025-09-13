-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2025 at 12:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` varchar(4) NOT NULL,
  `stu_first_name` varchar(20) NOT NULL,
  `stu_last_name` varchar(20) NOT NULL,
  `stu_enroll_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_first_name`, `stu_last_name`, `stu_enroll_year`) VALUES
('S001', 'John', 'Doe', 2024),
('S002', 'Brian', 'Philips', 2023),
('S003', 'Jack', 'Pearson', 2024),
('S004', 'Chamal', 'Vitharana', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `stu_id` varchar(4) NOT NULL,
  `sub_code` varchar(7) NOT NULL,
  `choice` varchar(10) NOT NULL,
  `grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`stu_id`, `sub_code`, `choice`, `grade`) VALUES
('S001', 'COM1111', 'core', 'C'),
('S001', 'COM1112', 'core', NULL),
('S001', 'COM1132', 'core', NULL),
('S001', 'COM2112', 'core', NULL),
('S002', 'COM1111', 'core', NULL),
('S002', 'COM1213', 'core', NULL),
('S002', 'COM2272', 'optional', 'B'),
('S003', 'COM1111', 'core', 'C'),
('S003', 'MAT1112', 'core', NULL),
('S003', 'MAT1212', 'core', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_code` varchar(7) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `sub_credits` int(11) NOT NULL,
  `sub_theory` tinyint(1) NOT NULL,
  `sub_practical` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_code`, `sub_name`, `sub_credits`, `sub_theory`, `sub_practical`) VALUES
('COM1111', 'Basic Concepts of Information Technology', 1, 1, 0),
('COM1112', 'Computer Architecture', 2, 1, 0),
('COM1132', 'Internet Services and Web Development', 2, 1, 1),
('COM1213', 'Data Structures and Algorithms', 3, 1, 1),
('COM2112', 'Laboratory Assignments', 2, 0, 1),
('COM2123', 'Object Oriented System Development', 3, 1, 1),
('COM2132', 'Operating Systems', 2, 1, 1),
('COM2213', 'Data Communication & Computer Networks', 3, 1, 1),
('COM2272', 'Data and Network Security', 2, 1, 0),
('COM3122', 'Project Management', 2, 1, 0),
('COM3b33', 'Group Project', 3, 0, 1),
('MAT1112', 'Differential Equation', 2, 1, 0),
('MAT1122', 'Introductory Statistics', 2, 1, 0),
('MAT1212', 'Calculus 1', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `emp_id` char(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`emp_id`, `username`, `password_hash`) VALUES
('E001', 'admin', '7b18601f5caaa6dbbc7ad058ac54a25d30e7a508ce814c41f44ea5cabf9b3181');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`stu_id`,`sub_code`),
  ADD KEY `fk_course` (`sub_code`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_code`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`emp_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
