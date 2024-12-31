CREATE DATABASE IF NOT EXISTS front_db;

USE front_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(60) NOT NULL,
    pwd VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------
--
-- Table structure for table category
--

CREATE TABLE IF NOT EXISTS category (
  category_id int(12) AUTO_INCREMENT PRIMARY KEY,
  category_name varchar(50) NOT NULL
);

--
-- Dumping data for table category
--

INSERT INTO category (category_id, category_name) VALUES
(1, 'Awards and Trophies'),
(2, 'Gifts and Souvenirs'),
(3, 'Clothing'),
(4, 'Printings'),
(5, 'Office Equipments'),
(6, 'Sport Equipments'),
(7, 'Nametags');

-- --------------------------------------------------------

--
-- Table structure for table inventory
--

CREATE TABLE IF NOT EXISTS inventory (
  inventory_id int(12) AUTO_INCREMENT PRIMARY KEY,
  stock_quantity int(12) NOT NULL,
  option_id int(12) DEFAULT NULL,
  product_id int(12) NOT NULL,
  product_id int FOREIGN KEY REFERENCES product(product_id)
);

-- --------------------------------------------------------

--
-- Table structure for table options
--

CREATE TABLE IF NOT EXISTS options (
  option_id int(12) AUTO_INCREMENT PRIMARY KEY,
  option_colour varchar(50) DEFAULT NULL,
  option_size varchar(50) NOT NULL,
  product_id int(12) NOT NULL,
  product_id int FOREIGN KEY REFERENCES product(product_id)
);

--
-- Dumping data for table options
--

INSERT INTO options (option_id, option_colour, option_size, product_id) VALUES
(1, 'Gold', '400mm(H)x 120mm(L)x 120mm(W)', 1),
(2, 'Gold', '360mm(H)x 100mm(L)x 100mm(W)', 1),
(3, 'Gold', '330mm(H)x 90mm(L)x 90mm(W)', 1),
(4, 'Gold', '290mm(H)x 90mm(L)x 90mm(W)', 1),
(5, 'Gold-Red', '350mm(H)x 79mm(L)x 79mm(W)', 2),
(6, 'Gold-Red', '322mm(H)x 79mm(L)x 79mm(W)', 2),
(7, 'Gold-Red', '295mm(H)x 79mm(L)x 79mm(W)', 2),
(8, 'Gold', '380mm(H)x 79mm(L)x 79mm(W)', 3),
(9, 'Gold', '360mm(H)x 79mm(L)x 79mm(W)', 3),
(10, 'Gold', '315mm(H)x 79mm(L)x 79mm(W)', 3),
(15, 'Gold-Red', '335mm(H)x 120mm(L)x 120mm(W)', 4),
(16, 'Gold-Red', '300mm(H)x 100mm(L)x 100mm(W)', 4),
(17, 'Gold-Red', '270mm(H)x 100mm(L)x 100mm(W)', 4),
(18, 'Gold-Blue', '335mm(H)x 120mm(L)x 120mm(W)', 4),
(19, 'Gold-Blue', '300mm(H)x 100mm(L)x 100mm(W)', 4),
(20, 'Gold-Blue', '270mm(H)x 100mm(L)x 100mm(W)', 4),
(21, 'Gold', '312mm(H)x 100mm(L)x 100mm(W)', 5),
(22, 'Silver', '312mm(H)x 100mm(L)x 100mm(W)', 5),
(23, 'Bronze', '312mm(H)x 100mm(L)x 100mm(W)', 5),
(24, 'Gold', '70mm(H)', 6),
(25, 'Silver', '70mm(H)', 6),
(26, 'Bronze', '70mm(H)', 6),
(27, 'Gold', '70mm(H)', 7),
(28, 'Silver', '70mm(H)', 7),
(29, 'Bronze', '70mm(H)', 7),
(30, 'Gold', '70mm(H)', 8),
(31, 'Silver', '70mm(H)', 8),
(32, 'Bronze', '70mm(H)', 8),
(33, NULL, '270mm(H)x 120mm(L)x 55mm(W)', 9),
(34, NULL, '250mm(H)x 110mm(L)x 55mm(W)', 9),
(35, NULL, '230mm(H)x 110mm(L)x 55mm(W)', 9),
(36, NULL, '235mm(H)x 110mm(L)x 55mm(W)', 10),
(37, NULL, '215mm(H)x 110mm(L)x 55mm(W)', 10),
(38, NULL, '195mm(H)x 110mm(L)x 55mm(W)', 10),
(39, NULL, '215mm(H)x 150mm(L)x 55mm(W)', 11),
(40, NULL, '200mm(H)x 130mm(L)x 55mm(W)', 12),
(41, NULL, '266mm(H)x 266mm(L)x 2mm(W)', 13),
(42, NULL, '215mm(H)x 215mm(L)x 2mm(W)', 13),
(43, NULL, '173mm(H)x 173mm(L)x 2mm(W)', 13),
(44, NULL, '203mm(H)x 203mm(L)x 2mm(W)', 14),
(45, NULL, '5', 17),
(46, NULL, '6', 17),
(47, NULL, '7', 17),
(48, NULL, '7', 18),
(49, NULL, '5', 19),
(50, NULL, '6', 19),
(51, NULL, '7', 19),
(52, NULL, '5', 20),
(53, NULL, '5', 21),
(54, NULL, '4', 22),
(55, NULL, '5', 22),
(56, NULL, '5', 23),
(57, NULL, '5', 24),
(58, NULL, '4', 25),
(59, NULL, '4', 26),
(60, NULL, '4', 27),
(61, NULL, '5', 27),
(62, NULL, '6', 31),
(63, NULL, '7', 32),
(64, NULL, '9.9', 34),
(65, NULL, '9.8', 34),
(66, NULL, '600', 35),
(67, NULL, '700', 35);

-- --------------------------------------------------------

--
-- Table structure for table product
--

CREATE TABLE IF NOT EXISTS product (
  product_id int(12) AUTO_INCREMENT PRIMARY KEY,
  product_name varchar(100) NOT NULL,
  product_description text DEFAULT NULL,
  product_image varchar(100) NOT NULL,
  product_unit_price decimal(10,2) NOT NULL,
  product_bulk_price decimal(10,2) DEFAULT NULL,
  product_created_at timestamp NOT NULL DEFAULT current_timestamp(),
  product_upated_at timestamp NOT NULL DEFAULT current_timestamp(),
  sub_category_id int(12),
  sub_category_id int FOREIGN KEY REFERENCES sub_category(sub_category_id)
);

--
-- Dumping data for table product
--

INSERT INTO product (product_id, product_name, product_description, product_image, product_unit_price, product_bulk_price, product_created_at, product_upated_at, sub_category_id) VALUES
(1, 'CT5003F Acrylic Plastic Trophy', '', 'uploads/Awards and Trophies/trophy/Acrylic Plastic Trophy.png\r\n', 129.00, 109.00, '2024-12-30 02:18:56', '2024-12-30 02:18:56', 1),
(2, 'PT2214F Economic Plastic Trophy', '', 'uploads/Awards and Trophies/trophy/Economic Plastic Trophy.png', 45.00, 42.00, '2024-12-30 04:21:21', '2024-12-30 04:21:21', 1),
(3, 'XT1709F Exclusive Plastic Trophy', '', 'uploads/Awards and Trophies/trophy/Exclusive Plastic Trophy.png', 143.00, 139.00, '2024-12-30 04:24:23', '2024-12-30 04:24:23', 1),
(4, 'BAW696 Metal Cup Trophy', '', 'uploads/Awards and Trophies/trophy/Metal Cup Trophy-Blue.png', 24.00, 22.00, '2024-12-30 04:26:08', '2024-12-30 04:26:08', 1),
(5, 'RC8806 Resin Trophy', '', 'uploads/Awards and Trophies/trophy/Resin Trophy.png', 14.00, 13.00, '2024-12-30 04:28:31', '2024-12-30 04:28:31', 1),
(6, 'MT302 Exclusive Zinc Alloy Medal', '', 'uploads/Awards and Trophies/Medal/MT302 Exclusive Zinc Alloy Medal.png', 9.00, 8.80, '2024-12-30 04:32:35', '2024-12-30 04:32:35', 2),
(7, 'MT301 Exclusive Zinc Alloy Medal', '', 'uploads/Awards and Trophies/Medal/MT301 Exclusive Zinc Alloy Medal.png', 9.00, 8.80, '2024-12-30 04:32:35', '2024-12-30 04:32:35', 2),
(8, 'MT401 Exclusive Zinc Alloy Medal', '', 'uploads/Awards and Trophies/Medal/MT401 Exclusive Zinc Alloy Medal.png', 9.00, 8.80, '2024-12-30 04:32:35', '2024-12-30 04:32:35', 2),
(9, '8354 Exclusive Crystal Plaque', '', 'uploads/Awards and Trophies/Crystal/8354 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(10, '8355 Exclusive Crystal Plaque', '', 'uploads/Awards and Trophies/Crystal/8355 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(11, '8348 Exclusive Crystal Plaque', '', 'uploads/Awards and Trophies/Crystal/8348 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(12, '8349 Exclusive Crystal Plaque', '', 'uploads/Awards and Trophies/Crystal/8349 Exclusive Crystal Plaque.png', 29.00, 28.80, '2024-12-30 04:37:13', '2024-12-30 04:37:13', 3),
(13, '7502 Pewter Tray', '', 'uploads/Awards and Trophies/Pewter/7502 Pewter Tray.png', 19.00, 18.70, '2024-12-30 04:41:27', '2024-12-30 04:41:27', 4),
(14, '7503 Pewter Tray', '', 'uploads/Awards and Trophies/Pewter/7503 Pewter Tray.png', 19.00, 18.70, '2024-12-30 04:41:27', '2024-12-30 04:41:27', 4),
(15, 'HS3V Stopwatch', 'Brand: Casio\r\nMeasuring unit :1/100th of a second\r\nMeasuring capacity : 9:59’59.99″\r\nMode : Net time, split time, 1st/2nd place times', 'uploads/Sport Equipment/Stopwatch/HS3V.png', 165.00, 164.65, '2024-12-30 05:04:21', '2024-12-30 05:04:21', 21),
(16, 'F-011 Stopwatch', 'Brand: Flott\r\nMeasuring unit :1/100th of a second\r\nMeasuring capacity : 9:59’59.99″\r\nMode : Calendar, calendar', 'uploads/Sport Equipment/Stopwatch/F-011.png', 25.00, 24.90, '2024-12-30 05:04:21', '2024-12-30 05:04:21', 21),
(17, 'BG3800 Synthetic Rubber Basketball', NULL, 'uploads/Sport Equipment/Basketball/BG3800 Synthetic Rubber.png', 190.00, 188.00, '2024-12-30 05:12:03', '2024-12-30 05:12:03', 16),
(18, 'BG3000 Synthetic Rubber Basketball', NULL, 'uploads/Sport Equipment/Basketball/BG3000 Synthetic Rubber.png', 119.00, 118.00, '2024-12-30 05:12:03', '2024-12-30 05:12:03', 16),
(19, 'BG3200 Composite Leather Basketball', NULL, 'uploads/Sport Equipment/Basketball/BG3200 Composite Leather.png', 170.00, 169.00, '2024-12-30 05:12:03', '2024-12-30 05:12:03', 16),
(20, 'F5A5000 FIFA quality pro Hybrid TPU leather Footba', NULL, 'uploads/Sport Equipment/Football/F5A5000 FIFA quality pro Hybrid TPU leather.png', 420.00, 419.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(21, 'F5A3555 Accentec PU Football', NULL, 'uploads/Sport Equipment/Football/F5A3555 Accentec PU.png', 179.00, 178.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(22, 'F5A3400 Hybrid PU leather Football', NULL, 'uploads/Sport Equipment/Football/F5A3400 Hybrid PU leather.png', 139.00, 138.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(23, 'F5A2810 PU leather Football', NULL, 'uploads/Sport Equipment/Football/F5A2810 PU leather.png', 119.00, 118.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(24, 'F5A1710 PVC leather Football', NULL, 'uploads/Sport Equipment/Football/F5A1710 PVC leather.png', 89.00, 88.00, '2024-12-30 05:22:36', '2024-12-30 05:22:36', 18),
(25, 'F9F2600 Laminated finish cover PU leather Futsal', NULL, 'uploads/Sport Equipment/Futsal/F9F2600 Laminated finish cover PU leather-Yellow Green.png', 115.00, 113.00, '2024-12-30 05:35:37', '2024-12-30 05:35:37', 20),
(26, 'F9A1510 Synthetic leather Futsal', NULL, 'uploads/Sport Equipment/Futsal/F9A1510 Synthetic leather.png', 95.00, 90.00, '2024-12-30 05:35:37', '2024-12-30 05:35:37', 20),
(27, 'F9A3555 TPU leather Futsal', NULL, 'uploads/Sport Equipment/Futsal/F9A3555 TPU leather.png', 169.00, 167.00, '2024-12-30 05:35:37', '2024-12-30 05:35:37', 20),
(28, 'NITTAKU NSD 40+', 'Sold in 3 pcs\r\nITTF Approved ball\r\n', 'uploads/Sport Equipment/Table Tennis/NITTAKU NSD 40+.png', 30.00, 29.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(29, 'SENKOH 1500 Penhold Style Grip Bat', NULL, 'uploads/Sport Equipment/Table Tennis/SENKOH 1500 Penhold Style Grip Bat.png', 109.90, 108.90, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(30, 'BUTTERFLY A40+ TOURNAMENT', 'ITTF Approved ball', 'uploads/Sport Equipment/Table Tennis/BUTTERFLY A40+ TOURNAMENT.png', 60.00, 59.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(31, 'NAKAMA S6 Sriver Rubber Bat', '', 'uploads/Sport Equipment/Table Tennis/NAKAMA S6 Sriver Rubber Bat.png', 243.70, 242.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(32, 'NAKAMA S7 Sapphira Rubber Bat', '', 'uploads/Sport Equipment/Table Tennis/NAKAMA S7 Sapphira Rubber Bat.png', 243.60, 241.00, '2024-12-30 05:41:50', '2024-12-30 05:41:50', 19),
(33, 'carlton SOLAR 600 Badminton Racket', 'Aluminium Shaft / Steel Frame', 'uploads/Sport Equipment/Badminton/carlton SOLAR 600 Badminton Rackets.png', 50.00, 49.00, '2024-12-31 03:20:20', '2024-12-31 03:20:20', 17),
(34, 'ARMO SPEED Badminton Racket', 'Aluminium Shaft / Steel Frame', 'uploads/Sport Equipment/Badminton/ARMO SPEED Badminton Rackets.png', 39.90, 38.90, '2024-12-31 03:20:20', '2024-12-31 03:20:20', 17),
(35, 'TS POWER Badminton Racket', 'Aluminium Shaft / Steel Frame', 'uploads/Sport Equipment/Badminton/TS POWER Badminton Rackets.png', 39.90, 38.90, '2024-12-31 03:20:20', '2024-12-31 03:20:20', 17);

-- --------------------------------------------------------

--
-- Table structure for table sub_category
--

CREATE TABLE IF NOT EXISTS sub_category (
  sub_category_id int(12) AUTO_INCREMENT PRIMARY KEY,
  sub_category_name varchar(50) NOT NULL,
  category_id int(12) NOT NULL,
  category_id int FOREIGN KEY REFERENCES category(category_id)
);

--
-- Dumping data for table sub_category
--

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
(21, 'Stopwatch', 6);


GRANT ALL PRIVILEGES ON front_db.* TO 'virtuosa'@'%';
FLUSH PRIVILEGES;
