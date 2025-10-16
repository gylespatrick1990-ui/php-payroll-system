-- Payroll System Database Schema
-- Compatible with MySQL 5.7+ / MariaDB 10.3+

CREATE DATABASE IF NOT EXISTS `payroll_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `payroll_db`;

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','employee') NOT NULL DEFAULT 'employee',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Employees table
CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `emp_code` VARCHAR(50) NOT NULL UNIQUE,
  `position` VARCHAR(100) NOT NULL,
  `rate` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_employees_user_id`
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Payroll entries table
CREATE TABLE IF NOT EXISTS `payroll_entries` (
  `payroll_id` INT AUTO_INCREMENT PRIMARY KEY,
  `emp_id` INT NOT NULL,
  `payroll_period` DATE NOT NULL,
  `base_salary` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `absences` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `overtime` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `sss` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `tax` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `other_deductions` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  -- Auto computed STORED generated column
  `net_salary` DECIMAL(10,2) AS (`base_salary` + `overtime` - (`absences` + `sss` + `tax` + `other_deductions`)) STORED,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_payroll_emp_id`
    FOREIGN KEY (`emp_id`) REFERENCES `employees`(`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX `idx_emp_period` (`emp_id`, `payroll_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
