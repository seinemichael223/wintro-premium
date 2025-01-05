CREATE DATABASE IF NOT EXISTS front_db;

USE front_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(60) NOT NULL,
    pwd VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS user_address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uid INT NOT NULL,
    address_street VARCHAR(255) NOT NULL,
    address_city VARCHAR(100) NOT NULL,
    address_state VARCHAR(100) NOT NULL,
    address_zip VARCHAR(12) NOT NULL,
    address_country VARCHAR(100) NOT NULL,
    FOREIGN KEY (uid) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS category (
    category_id INT(12) AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS sub_category (
    sub_category_id INT(12) AUTO_INCREMENT PRIMARY KEY,
    sub_category_name VARCHAR(50) NOT NULL,
    category_id INT(12) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category (category_id)
);

CREATE TABLE IF NOT EXISTS contact_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    company VARCHAR(255),
    phone VARCHAR(15) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS product (
    product_id INT(12) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    product_description TEXT DEFAULT NULL,
    product_image VARCHAR(200) NOT NULL,
    product_unit_price DECIMAL(10, 2) NOT NULL,
    product_bulk_price DECIMAL(10, 2) DEFAULT NULL,
    product_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    product_upated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    sub_category_id INT(12),
    FOREIGN KEY (sub_category_id) REFERENCES sub_category(sub_category_id)
);

CREATE TABLE IF NOT EXISTS options (
    option_id INT(12) AUTO_INCREMENT PRIMARY KEY,
    option_colour VARCHAR(50),
    option_size VARCHAR(50) NOT NULL,
    product_id INT(12) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product (product_id)
);

CREATE TABLE IF NOT EXISTS inventory (
    inventory_id INT(12) AUTO_INCREMENT PRIMARY KEY,
    stock_quantity INT(12) NOT NULL,
    option_id INT(12),
    product_id INT(12) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product (product_id),
    FOREIGN KEY (option_id) REFERENCES options (option_id)
);


INSERT INTO category (category_name) VALUES
('Awards and Trophies'),
('Gifts and Souvenirs'),
('Clothing'),
('Printings'),
('Office Equipments'),
('Sport Equipments'),
('Nametags');

INSERT INTO sub_category (sub_category_id, sub_category_name, category_id) VALUES
(1, 'Trophy', 1),
(2, 'Medal', 1),
(3, 'Crystal', 1),
(4, 'Pewter Award', 1),
(5, 'Stationary Hamper', 2),
(6, 'Food Hamper', 2),
(7, 'Jersey', 3),
(8, 'T-shirt', 3),
(9, 'Uniform', 3),
(10, 'Corporate', 3),
(11, 'Sticker', 4),
(12, 'Certificate', 4),
(13, 'Banner', 4),
(14, 'Signboard', 4),
(15, 'Pre Inked Stamp & Cop', 5),
(16, 'Basketball', 6),
(17, 'Badminton', 6),
(18, 'Football', 6),
(19, 'Table Tennis', 6),
(20, 'Futsal', 6),
(21, 'Stopwatch', 6),
(22, 'Nametags', 7);

INSERT INTO product (product_id, product_name, product_description, product_image, product_unit_price, product_bulk_price, product_created_at, product_upated_at, sub_category_id) VALUES
(1, 'CT5003F Acrylic Plastic Trophy', '', 'Product/uploads/AwardsAndTrophies/Trophy/Acrylic Plastic Trophy.png', 129.00, 109.00, '2024-12-30 02:18:56', '2024-12-30 02:18:56', 1),
(2, 'PT2214F Economic Plastic Trophy', '', 'Product/uploads/AwardsAndTrophies/Trophy/Economic Plastic Trophy.png', 45.00, 42.00, '2024-12-30 04:21:21', '2024-12-30 04:21:21', 1),
(3, 'XT1709F Exclusive Plastic Trophy', '', 'Product/uploads/AwardsAndTrophies/Trophy/Exclusive Plastic Trophy.png', 143.00, 139.00, '2024-12-30 04:24:23', '2024-12-30 04:24:23', 1),
(4, 'BAW696 Metal Cup Trophy', '', 'Product/uploads/AwardsAndTrophies/Trophy/Metal Cup Trophy-Blue.png', 24.00, 22.00, '2024-12-30 04:26:08', '2024-12-30 04:26:08', 1),
(5, 'RC8806 Resin Trophy', '', 'Product/uploads/AwardsAndTrophies/Trophy/Resin Trophy.png', 14.00, 13.00, '2024-12-30 04:28:31', '2024-12-30 04:28:31', 1),
(6, 'MT302 Exclusive Zinc Alloy Medal', '', 'Product/uploads/AwardsAndTrophies/Medal/MT302 Exclusive Zinc Alloy Medal.png', 9.00, 8.80, '2024-12-30 04:32:35', '2024-12-30 04:32:35', 2),
(7, 'MT301 Exclusive Zinc Alloy Medal', '', 'Product/uploads/AwardsAndTrophies/Medal/MT301 Exclusive Zinc Alloy Medal.png', 9.00, 8.80, '2024-12-30 04:32:35', '2024-12-30 04:32:35', 2),
(8, 'MT401 Exclusive Zinc Alloy Medal', '', 'Product/uploads/AwardsAndTrophies/Medal/MT401 Exclusive Zinc Alloy Medal.png', 9.00, 8.80, '2024-12-30 04:32:35', '2024-12-30 04:32:35', 2),
(9, '8354 Exclusive Crystal Plaque', '', 'Product/uploads/AwardsAndTrophies/Crystal/8354 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(10, '8355 Exclusive Crystal Plaque', '', 'Product/uploads/AwardsAndTrophies/Crystal/8355 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(11, '8348 Exclusive Crystal Plaque', '', 'Product/uploads/AwardsAndTrophies/Crystal/8348 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(12, '8349 Exclusive Crystal Plaque', '', 'Product/uploads/AwardsAndTrophies/Crystal/8349 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(13, '7502 Pewter Tray', '', 'Product/uploads/AwardsAndTrophies/Pewter/7502 Pewter Tray.png', 19.00, 18.70, '2024-12-30 04:41:27', '2024-12-30 04:41:27', 4),
(14, '7503 Pewter Tray', '', 'Product/uploads/AwardsAndTrophies/Pewter/7503 Pewter Tray.png', 19.00, 18.70, '2024-12-30 04:41:27', '2024-12-30 04:41:27', 4),
(15, 'HS3V Stopwatch', 'Brand: Casio\r\nMeasuring unit :1/100th of a second\r\nMeasuring capacity : 9:59’59.99″\r\nMode : Net time, split time, 1st/2nd place times', 'Product/uploads/Sport Equipment/Stopwatch/HS3V.png', 165.00, 164.65, '2024-12-30 05:04:21', '2024-12-30 05:04:21', 21),
(16, 'F-011 Stopwatch', 'Brand: Flott\r\nMeasuring unit :1/100th of a second\r\nMeasuring capacity : 9:59’59.99″\r\nMode : Calendar, calendar', 'Product/uploads/Sport Equipment/Stopwatch/F-011.png', 25.00, 24.90, '2024-12-30 05:04:21', '2024-12-30 05:04:21', 21),
(17, 'BG3800 Synthetic Rubber Basketball', NULL, 'Product/uploads/Sport Equipment/Basketball/BG3800 Synthetic Rubber.png', 190.00, 188.00, '2024-12-30 05:12:03', '2024-12-30 05:12:03', 16),
(18, 'BG3000 Synthetic Rubber Basketball', NULL, 'Product/uploads/Sport Equipment/Basketball/BG3000 Synthetic Rubber.png', 119.00, 118.00, '2024-12-30 05:12:03', '2024-12-30 05:12:03', 16),
(19, 'BG3200 Composite Leather Basketball', NULL, 'Product/uploads/Sport Equipment/Basketball/BG3200 Composite Leather.png', 170.00, 169.00, '2024-12-30 05:12:03', '2024-12-30 05:12:03', 16),
(20, 'F5A5000 FIFA quality pro Hybrid TPU leather Footba', NULL, 'Product/uploads/Sport Equipment/Football/F5A5000 FIFA quality pro Hybrid TPU leather.png', 420.00, 419.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(21, 'F5A3555 Accentec PU Football', NULL, 'Product/uploads/Sport Equipment/Football/F5A3555 Accentec PU.png', 179.00, 178.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(22, 'F5A3400 Hybrid PU leather Football', NULL, 'Product/uploads/Sport Equipment/Football/F5A3400 Hybrid PU leather.png', 139.00, 138.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(23, 'F5A2810 PU leather Football', NULL, 'Product/uploads/Sport Equipment/Football/F5A2810 PU leather.png', 119.00, 118.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(24, 'F5A1710 PVC leather Football', NULL, 'Product/uploads/Sport Equipment/Football/F5A1710 PVC leather.png', 89.00, 88.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(25, 'F9F2600 Laminated finish cover PU leather Futsal', NULL, 'Product/uploads/Sport Equipment/Futsal/F9F2600 Laminated finish cover PU leather-Yellow Green.png', 115.00, 113.00, '2024-12-30 05:35:37', '2024-12-30 05:35:37', 20),
(26, 'F9A1510 Synthetic leather Futsal', NULL, 'Product/uploads/Sport Equipment/Futsal/F9A1510 Synthetic leather.png', 95.00, 90.00, '2024-12-30 05:35:37', '2024-12-30 05:35:37', 20),
(27, 'F9A3555 TPU leather Futsal', NULL, 'Product/uploads/Sport Equipment/Futsal/F9A3555 TPU leather.png', 169.00, 167.00, '2024-12-30 05:35:37', '2024-12-30 05:35:37', 20),
(28, 'NITTAKU NSD 40+', 'Sold in 3 pcs\r\nITTF Approved ball\r\n', 'Product/uploads/Sport Equipment/Table Tennis/NITTAKU NSD 40+.png', 30.00, 29.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(29, 'SENKOH 1500 Penhold Style Grip Bat', NULL, 'Product/uploads/Sport Equipment/Table Tennis/SENKOH 1500 Penhold Style Grip Bat.png', 109.90, 108.90, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(30, 'BUTTERFLY A40+ TOURNAMENT', 'ITTF Approved ball', 'Product/uploads/Sport Equipment/Table Tennis/BUTTERFLY A40+ TOURNAMENT.png', 60.00, 59.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(31, 'NAKAMA S6 Sriver Rubber Bat', '', 'Product/uploads/Sport Equipment/Table Tennis/NAKAMA S6 Sriver Rubber Bat.png', 243.70, 242.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(32, 'NAKAMA S7 Sapphira Rubber Bat', '', 'Product/uploads/Sport Equipment/Table Tennis/NAKAMA S7 Sapphira Rubber Bat.png', 243.60, 241.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(33, 'carlton SOLAR 600 Badminton Racket', 'Aluminium Shaft / Steel Frame', 'Product/uploads/Sport Equipment/Badminton/carlton SOLAR 600 Badminton Rackets.png', 50.00, 49.00, '2024-12-31 03:20:20', '2024-12-31 03:20:20', 17),
(34, 'ARMO SPEED Badminton Racket', 'Aluminium Shaft / Steel Frame', 'Product/uploads/Sport Equipment/Badminton/ARMO SPEED Badminton Rackets.png', 39.90, 38.90, '2024-12-31 03:20:20', '2024-12-31 03:20:20', 17),
(35, 'TS POWER Badminton Racket', 'Aluminium Shaft / Steel Frame', 'Product/uploads/Sport Equipment/Badminton/TS POWER Badminton Rackets.png', 39.90, 38.90, '2024-12-31 03:20:20', '2024-12-31 03:20:20', 17),
(37, 'FH3441 Food Hamper B', NULL, 'Product/uploads/GiftsAndSouvenirs/Food Hamper/FH3441 Food Hamper B.webp', 89.99, 88.00, '2025-01-04 23:49:01', '2025-01-04 23:56:30', 6),
(38, 'FH3440 Food Hamper C', NULL, 'Product/uploads/GiftsAndSouvenirs/Food Hamper/FH3440 Food Hamper C.webp', 89.99, 88.00, '2025-01-04 23:49:01', '2025-01-04 23:56:30', 6),
(39, 'FH3449 Food Hamper D', NULL, 'Product/uploads/GiftsAndSouvenirs/Food Hamper/FH3449 Food Hamper D.webp', 79.99, 77.00, '2025-01-04 23:49:01', '2025-01-04 23:56:30', 6),
(40, 'SH1101 Stationary Hamper Set A', '', 'Product/uploads/GiftsAndSouvenirs/Stationary Hamper/SH1101 Stationary Hamper Set A.png', 19.50, 19.00, '2025-01-04 23:49:01', '2025-01-04 23:49:01', 5),
(41, 'SH1102 Stationary Hamper Set B', NULL, 'Product/uploads/GiftsAndSouvenirs/Stationary Hamper/SH1102 Stationary Hamper Set B.png', 15.70, 15.00, '2025-01-04 23:49:01', '2025-01-04 23:49:01', 5),
(42, 'SH1103 Stationary Hamper Set C', '', 'Product/uploads/GiftsAndSouvenirs/Stationary Hamper/SH1103 Stationary Hamper Set C.png', 20.50, 19.80, '2025-01-04 23:49:01', '2025-01-04 23:49:01', 5),
(43, 'PC1233 Pre Inked Stamp', NULL, 'Product/uploads/OfficeEquipment/PC1233 Pre Inked Stamp.jpg', 31.50, 31.00, '2025-01-04 23:55:05', '2025-01-04 23:55:05', 15),
(44, 'PC1234 Pre Inked Stamp', NULL, 'Product/uploads/OfficeEquipment/PC1234 Pre Inked Stamp.jpg', 31.50, 31.00, '2025-01-04 23:55:05', '2025-01-04 23:55:05', 15),
(45, 'PC1235 Pre Inked Stamp', NULL, 'Product/uploads/OfficeEquipment/PC1235 Pre Inked Stamp.jpg', 31.50, 31.00, '2025-01-04 23:55:05', '2025-01-04 23:55:05', 15),
(46, 'PC1236 Pre Inked Stamp', NULL, 'Product/uploads/OfficeEquipment/PC1236 Pre Inked Stamp.jpg', 31.50, 31.00, '2025-01-04 23:55:05', '2025-01-04 23:55:05', 15),
(47, 'TG1276 Nametag', NULL, 'Product/uploads/Nametags/TG1276 Nametag.webp', 20.00, 18.00, '2025-01-04 23:58:47', '2025-01-05 00:01:37', 7),
(48, 'TG1278 Nametag', '', 'Product/uploads/Nametags/TG1278 Nametag.jpg', 20.00, 18.00, '2025-01-04 23:58:47', '2025-01-05 00:01:37', 7);

INSERT INTO options (option_colour, option_size, product_id) VALUES
('Gold', '400mm(H)x 120mm(L)x 120mm(W)', 1),
('Gold', '360mm(H)x 100mm(L)x 100mm(W)', 1),
('Gold', '330mm(H)x 90mm(L)x 90mm(W)', 1),
('Gold', '290mm(H)x 90mm(L)x 90mm(W)', 1),
('Gold-Red', '350mm(H)x 79mm(L)x 79mm(W)', 2),
('Gold-Red', '322mm(H)x 79mm(L)x 79mm(W)', 2),
('Gold-Red', '295mm(H)x 79mm(L)x 79mm(W)', 2),
('Gold', '380mm(H)x 79mm(L)x 79mm(W)', 3),
('Gold', '360mm(H)x 79mm(L)x 79mm(W)', 3),
('Gold', '315mm(H)x 79mm(L)x 79mm(W)', 3),
('Gold-Red', '335mm(H)x 120mm(L)x 120mm(W)', 4),
('Gold-Red', '300mm(H)x 100mm(L)x 100mm(W)', 4),
('Gold-Red', '270mm(H)x 100mm(L)x 100mm(W)', 4),
('Gold-Blue', '335mm(H)x 120mm(L)x 120mm(W)', 4),
('Gold-Blue', '300mm(H)x 100mm(L)x 100mm(W)', 4),
('Gold-Blue', '270mm(H)x 100mm(L)x 100mm(W)', 4),
('Gold', '312mm(H)x 100mm(L)x 100mm(W)', 5),
('Silver', '312mm(H)x 100mm(L)x 100mm(W)', 5),
('Bronze', '312mm(H)x 100mm(L)x 100mm(W)', 5),
('Gold', '70mm(H)', 6),
('Silver', '70mm(H)', 6),
('Bronze', '70mm(H)', 6),
('Gold', '70mm(H)', 7),
('Silver', '70mm(H)', 7),
('Bronze', '70mm(H)', 7),
('Gold', '70mm(H)', 8),
('Silver', '70mm(H)', 8),
('Bronze', '70mm(H)', 8),
(NULL, '270mm(H)x 120mm(L)x 55mm(W)', 9),
(NULL, '250mm(H)x 110mm(L)x 55mm(W)', 9),
(NULL, '230mm(H)x 110mm(L)x 55mm(W)', 9),
(NULL, '235mm(H)x 110mm(L)x 55mm(W)', 10),
(NULL, '215mm(H)x 110mm(L)x 55mm(W)', 10),
(NULL, '195mm(H)x 110mm(L)x 55mm(W)', 10),
(NULL, '215mm(H)x 150mm(L)x 55mm(W)', 11),
(NULL, '200mm(H)x 130mm(L)x 55mm(W)', 12),
(NULL, '266mm(H)x 266mm(L)x 2mm(W)', 13),
(NULL, '215mm(H)x 215mm(L)x 2mm(W)', 13),
(NULL, '173mm(H)x 173mm(L)x 2mm(W)', 13),
(NULL, '203mm(H)x 203mm(L)x 2mm(W)', 14),
(NULL, '5', 17),
(NULL, '6', 17),
(NULL, '7', 17),
(NULL, '7', 18),
(NULL, '5', 19),
(NULL, '6', 19),
(NULL, '7', 19),
(NULL, '5', 20),
(NULL, '5', 21),
(NULL, '4', 22),
(NULL, '5', 22),
(NULL, '5', 23),
(NULL, '5', 24),
(NULL, '4', 25),
(NULL, '4', 26),
(NULL, '4', 27),
(NULL, '5', 27),
(NULL, '6', 31),
(NULL, '7', 32),
(NULL, '9.9', 34),
(NULL, '9.8', 34),
(NULL, '600', 35),
(NULL, '700', 35),
('Silver', '1\'\' x 3\'\'', 47),
('Gold', '1\'\' x 3\'\'', 47),
('Brown', '1\'\' x 3\'\'', 48),
('Gold', '1\'\' x 3\'\'', 48),
('Silver', '1\'\' x 3\'\'', 48),
('Black', '1\'\' x 3\'\'', 48);

INSERT INTO inventory (inventory_id, stock_quantity, option_id, product_id) VALUES
(1, 10, 1, 1),
(2, 20, 2, 1),
(3, 12, 3, 1),
(4, 20, 4, 1);

GRANT ALL PRIVILEGES ON front_db.* TO 'virtuosa'@'%';
FLUSH PRIVILEGES;
