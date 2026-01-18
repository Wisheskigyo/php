-- SQL export for IT Shop
CREATE DATABASE IF NOT EXISTS `it` CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `it`;

DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `stock` INT NOT NULL DEFAULT 0,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `customer_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `address` TEXT NOT NULL,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_fk` (`product_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products` (`name`, `category`, `price`, `stock`, `description`) VALUES
('Office PC', 'Asztali gép', 189999, 8, 'Stabil i5 konfiguráció, 16GB RAM, 512GB SSD.'),
('Gaming PC', 'Asztali gép', 399999, 5, 'RTX 4060, Ryzen 5, 16GB RAM, 1TB NVMe SSD.'),
('Ultrabook 14"', 'Laptop', 299999, 7, 'Könnyű, 10 órás üzemidő, 16GB RAM, 512GB SSD.'),
('27" IPS monitor', 'Monitor', 89999, 12, 'QHD felbontás, 75Hz, vékony káva.'),
('Mechanikus billentyűzet', 'Periféria', 34999, 20, 'Tactile kapcsolók, fehér háttérvilágítás.');
