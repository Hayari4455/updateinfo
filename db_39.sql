-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 05:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_39`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(6) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `teacher_id`) VALUES
(1, '64/38', 1),
(2, '64/39', 2),
(3, '61/40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_surname` varchar(100) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_phone` varchar(10) NOT NULL,
  `student_photo` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `student_name`, `student_surname`, `student_address`, `student_phone`, `student_photo`, `room_id`) VALUES
(48, '644230035', 'Ford', 'da', 'nakhonpathom', '025846947', 'download (3).jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `teacher_surname` varchar(100) NOT NULL,
  `teacher_phone` varchar(10) NOT NULL,
  `teacher_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `teacher_surname`, `teacher_phone`, `teacher_email`) VALUES
(1, 'Suksawat', 'Saelim', '0982466872', 's.suksawat@webmail.npru.ac.th'),
(2, 'Pitchaya', 'Sukpung', '0981234567', 'Pitchaya@webmail.npru.ac.th'),
(3, 'Paripat', 'Srisomboon', '0948464447', 'Paripat@webmail.npru.ac.th');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `urole`, `created_at`) VALUES
(2, 'suksawat', 'jaidee', 'admin@gmail.com', '$2y$10$gkPQNpmUlXjUjY8gBbuX7Oil41mVUsuQmiGsJjAqXh4rhzI3wudYC', 'admin', '2023-09-26 03:43:04'),
(3, 'Jame', 'Booze', 'user@gmail.com', '$2y$10$/cLtljLswHyK6BYkndEnxubSTU428i9NU/MptDlnJ0ZfymiFBFbum', 'user', '2023-09-26 03:51:05'),
(17, 'Jame', 'Booze', 'aj.aoaae3@gmail.com', '$2y$10$KD.KUt19L33CT/hwt1BLm.B9Zr/703fZQXrh6lwQa6COn3zVDV62a', 'user', '2023-10-12 02:59:58'),
(18, 'Jeen', 'Bu', 'udsy_n@hotmail.com', '$2y$10$NmjJaeEUJ6IVr3fHVwA.gupkZV0qGYTiIiAnr0ycLuwHO9OxgCZcK', 'user', '2023-10-12 03:16:26'),
(19, 'atithep', 'komutchay', '644230036@webmail.npru.ac.th', '$2y$10$1WCbgCuO.YDeu.tTBv3BLu4BhAPedXk/mWOHFFUE0aRh7wP4URVlS', 'admin', '2023-10-26 01:33:04'),
(20, 'Atithep', 'Komutchay', 'fordddda@gmail.com', '$2y$10$./ke5YE3uwn3AWJ289UfMOR/48uUHf3ZvHugM6C4pNQIC/GqfxBDu', 'users', '2023-10-26 02:15:35'),
(21, 'fordza', 'za', '6025151@webmail.npru.ac.th', '$2y$10$fTqtoKThjTr0fE9X4HOxYuvCpBTmPXpu30MlVDQ2hQ3GmAUXi7rpa', 'admin', '2023-11-02 02:08:33'),
(22, 'fordzama', 'namo', '644230036@gmail.com', '$2y$10$kBmfGMrGFBMDu.4I7h7un.OeJEew0AXAEVfQOCnKsQscxHg8HucD2', 'admin', '2023-11-09 01:28:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
