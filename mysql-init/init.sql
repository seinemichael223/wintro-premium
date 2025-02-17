CREATE DATABASE IF NOT EXISTS front_db;

USE front_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(60) NOT NULL,
    pwd VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE
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

CREATE TABLE IF NOT EXISTS transactions (
    tid INT(12) AUTO_INCREMENT PRIMARY KEY,
    payment_amount DECIMAL(10, 2) NOT NULL,
    payment_status VARCHAR(30) NOT NULL DEFAULT 'INCOMPLETE',
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payer_id INT(12) NOT NULL,
    payer_email VARCHAR(80) NOT NULL,
    address_street VARCHAR(255) NOT NULL,
    address_city VARCHAR(100) NOT NULL,
    address_state VARCHAR(100) NOT NULL,
    address_zip VARCHAR(12) NOT NULL,
    address_country VARCHAR(100) NOT NULL,
    FOREIGN KEY (payer_id) REFERENCES users (id)
);

CREATE TABLE IF NOT EXISTS transaction_details (
    tid INT(12), 
    product_name VARCHAR(255) NOT NULL,
    quantity INT(11) NOT NULL,
    FOREIGN KEY (tid) REFERENCES transactions(tid) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    transaction_id INT(12),
    FOREIGN KEY (transaction_id) REFERENCES transactions(tid),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE   
);

INSERT INTO users (full_name, username, pwd, email, phone_number, is_admin) VALUES 
('Alice Wong', 'aliceRabbit21', '$2y$12$nlEDNGNL384lafKuiryfI.KwsQ0JH.d0k./K/nGvlbw3ZOiwyV5Yy', 'alice@gmail.com', '012-222-5555', '1'),
('John Doe', 'john_doe', 'password123', 'john.doe@example.com', '0123456789', FALSE),
('Jane Smith', 'jane_smith', 'securepwd456', 'jane.smith@example.com', '0112233445', FALSE),
('Michael Brown', 'michael_b', 'hashedpwd789', 'michael.brown@example.com', '0133344556', FALSE),
('Susan White', 'susan_white', 'adminpass321', 'susan.white@example.com', '0125566778', FALSE),
('Emma Green', 'emma_g', 'userpwd654', 'emma.green@example.com', '0146677889', FALSE),
('Li Chen', 'li_chen88', '$2y$12$5F43...hashedPwd', 'li.chen@example.com', '011-7894561', FALSE),
('Karen Adams', 'karen_adams', '$2y$12$5H87...hashedPwd', 'karen.adams@example.com', '012-2233445', FALSE),
('Robert Wilson', 'robert_wilson', '$2y$12$6F54...hashedPwd', 'robert.wilson@example.com', '016-3344556', FALSE),
('Olivia Jones', 'olivia_j', '$2y$12$8G23...hashedPwd', 'olivia.jones@example.com', '012-4455667', FALSE),
('Steve Rogers', 'steve_r', '$2y$12$9H42...hashedPwd', 'steve.rogers@example.com', '017-1234567', FALSE),
('Nancy Carter', 'nancy_c', '$2y$12$4G12...hashedPwd', 'nancy.carter@example.com', '018-7654321', FALSE),
('Ethan Morris', 'ethan_m', '$2y$12$7D98...hashedPwd', 'ethan.morris@example.com', '014-6677888', FALSE),
('Mia Anderson', 'mia_a', '$2y$12$3E87...hashedPwd', 'mia.anderson@example.com', '019-3456789', FALSE),
('Lucas King', 'lucas_k', '$2y$12$6F12...hashedPwd', 'lucas.king@example.com', '011-5566778', FALSE),
('Amelia Turner', 'amelia_t', '$2y$12$2A89...hashedPwd', 'amelia.turner@example.com', '018-3344559', FALSE),
('Dylan Hill', 'dylan_h', '$2y$12$8E23...hashedPwd', 'dylan.hill@example.com', '016-1122334', FALSE),
('Harper Wong', 'harper_w', '$2y$12$9B76...hashedPwd', 'harper.wong@example.com', '017-2233445', FALSE),
('Jackson Lee', 'jackson_l', '$2y$12$5C87...hashedPwd', 'jackson.lee@example.com', '014-6677889', FALSE),
('Chloe Harris', 'chloe_h', '$2y$12$1D45...hashedPwd', 'chloe.harris@example.com', '013-2233445', FALSE),
('Ahmad Mohammad', 'harper_w', '$2y$12$9B76...hashedPwd', 'ahmad@email.com', '017-2233485', FALSE),
('Siti Khalifah', 'jackson_l', '$2y$12$5C87...hashedPwd', 'siti@email.com', '014-6077889', FALSE),
('Raj Kumar', 'chloe_h', '$2y$12$1D45...hashedPwd', 'raj@email.com', '013-2239445', FALSE);

INSERT INTO user_address (uid, address_street, address_city, address_state, address_zip, address_country) VALUES
(1, 'Wisma Saberkas', 'Sibu', 'Sarawak', '696969', 'Malaysia');

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
(2, 4, 2, 1),
(3, 0, 3, 1),
(4, 20, 4, 1),
(5, 40, 5, 2),
(6, 3, 6, 2),
(7, 50, 7, 2),
(8, 17, 8, 3),
(9, 32, 9, 3),
(10, 42, 10, 3),
(11, 12, 11, 4),
(12, 9, 12, 4),
(13, 5, 13, 4),
(14, 4, 14, 4),
(15, 23, 15, 4),
(16, 45, 16, 4);


INSERT INTO transactions (payment_amount, payment_status, transaction_date, payer_id, payer_email, address_street, address_city, address_state, address_zip, address_country) VALUES
(150.00, 'SUCCESS', '2025-01-01 10:30:00', 6, 'john.doe@example.com', '123 Main St', 'Kuala Lumpur', 'Selangor', '50000', 'Malaysia'),
(200.50, 'SUCCESS', '2025-01-01 14:45:00', 2, 'jane.smith@example.com', '456 Elm St', 'Petaling Jaya', 'Selangor', '46000', 'Malaysia'),
(50.00, 'FAILED', '2025-01-02 09:00:00', 3, 'michael.brown@example.com', '789 Pine St', 'George Town', 'Penang', '10200', 'Malaysia'),
(300.00, 'SUCCESS', '2025-01-02 16:20:00', 6, 'john.doe@example.com', '123 Main St', 'Kuala Lumpur', 'Selangor', '50000', 'Malaysia'),
(120.75, 'SUCCESS', '2025-01-03 11:10:00', 4, 'susan.white@example.com', '321 Oak St', 'Johor Bahru', 'Johor', '80000', 'Malaysia'),
(180.25, 'SUCCESS', '2025-01-04 12:30:00', 5, 'emma.green@example.com', '987 Maple St', 'Ipoh', 'Perak', '30000', 'Malaysia'),
(150.00, 'SUCCESS', '2025-01-01 10:30:00', 6, 'john.doe@example.com', '123 Main St', 'Kuala Lumpur', 'Selangor', '50000', 'Malaysia'),
(200.50, 'SUCCESS', '2025-01-01 14:45:00', 2, 'jane.smith@example.com', '456 Elm St', 'Petaling Jaya', 'Selangor', '46000', 'Malaysia'),
(50.00, 'FAILED', '2025-01-02 09:00:00', 3, 'michael.brown@example.com', '789 Pine St', 'George Town', 'Penang', '10200', 'Malaysia'),
(300.00, 'SUCCESS', '2025-01-02 16:20:00', 6, 'john.doe@example.com', '123 Main St', 'Kuala Lumpur', 'Selangor', '50000', 'Malaysia'),
(120.75, 'SUCCESS', '2024-12-16 11:10:00', 4, 'susan.white@example.com', '321 Oak St', 'Johor Bahru', 'Johor', '80000', 'Malaysia'),
(180.25, 'SUCCESS', '2024-12-04 12:30:00', 5, 'emma.green@example.com', '987 Maple St', 'Ipoh', 'Perak', '30000', 'Malaysia'),
(250.50, 'SUCCESS', '2024-12-28 15:20:00', 7, 'li.chen@example.com', '456 Cedar St', 'Kuching', 'Sarawak', '93000', 'Malaysia'),
(75.00, 'FAILED', '2025-01-05 09:50:00', 8, 'karen.adams@example.com', '101 Bamboo St', 'Melaka', 'Melaka', '75000', 'Malaysia'),
(450.25, 'SUCCESS', '2024-11-20 16:40:00', 9, 'robert.wilson@example.com', '21 River Rd', 'Shah Alam', 'Selangor', '40000', 'Malaysia'),
(85.00, 'SUCCESS', '2025-01-06 10:00:00', 10, 'olivia.jones@example.com', '88 Blossom Ave', 'Kota Kinabalu', 'Sabah', '88000', 'Malaysia'),
(300.00, 'FAILED', '2024-10-15 14:30:00', 11, 'steve.rogers@example.com', '512 Hill St', 'Alor Setar', 'Kedah', '05000', 'Malaysia'),
(100.00, 'SUCCESS', '2024-12-27 11:45:00', 12, 'nancy.carter@example.com', '201 Pearl St', 'Seremban', 'Negeri Sembilan', '70000', 'Malaysia'),
(65.25, 'SUCCESS', '2024-12-10 13:00:00', 13, 'ethan.morris@example.com', '712 Ocean Blvd', 'Kota Bharu', 'Kelantan', '15000', 'Malaysia'),
(500.00, 'SUCCESS', '2024-12-31 22:15:00', 14, 'mia.anderson@example.com', '904 Moonlight Rd', 'Sibu', 'Sarawak', '96000', 'Malaysia'),
(250.75, 'SUCCESS', '2024-12-28 14:15:00', 15, 'lucas.king@example.com', '405 Sunny Ln', 'Miri', 'Sarawak', '98000', 'Malaysia'),
(220.00, 'SUCCESS', '2024-07-14 17:00:00', 16, 'amelia.turner@example.com', '601 Sunset Dr', 'Sandakan', 'Sabah', '90000', 'Malaysia'),
(120.00, 'FAILED', '2024-12-29 11:30:00', 17, 'dylan.hill@example.com', '15 Pineapple St', 'Klang', 'Selangor', '41050', 'Malaysia'),
(300.00, 'SUCCESS', '2024-12-06 10:50:00', 18, 'harper.wong@example.com', '730 Crystal Ave', 'Tawau', 'Sabah', '91000', 'Malaysia'),
(275.50, 'SUCCESS', '2024-12-14 15:25:00', 19, 'jackson.lee@example.com', '801 Maple Grove', 'Bintulu', 'Sarawak', '97000', 'Malaysia'),
(325.25, 'SUCCESS', '2024-06-22 09:30:00', 20, 'chloe.harris@example.com', '999 Emerald St', 'Kuantan', 'Pahang', '25000', 'Malaysia'),
(299.99, 'SUCCESS', '2024-12-05 10:30:00', 21, 'ahmad@email.com','Jalan SS2/75', 'Petaling Jaya', 'Selangor', '47300', 'Malaysia'),
(159.50, 'SUCCESS', '2024-04-01 14:15:00', 22, 'siti@email.com','Lorong Medan Tuanku 1', 'Kuala Lumpur', 'Wilayah Persekutuan', '50300', 'Malaysia'),
(75.25, 'SUCCESS', '2024-12-23 09:20:00', 23, 'raj@email.com','Jalan Pantai Baharu', 'Johor Bahru', 'Johor', '80300', 'Malaysia'),
(499.99, 'SUCCESS', '2024-12-05 16:45:00', 21, 'ahmad@email.com','Jalan SS2/75', 'Petaling Jaya', 'Selangor', '47300', 'Malaysia'),
(199.99, 'SUCCESS', '2024-01-05 11:30:00', 22, 'siti@email.com','Lorong Medan Tuanku 1', 'Kuala Lumpur', 'Wilayah Persekutuan', '50300', 'Malaysia');


INSERT INTO transaction_details (tid, product_name, quantity) VALUES
(1, 'CT5003F Acrylic Plastic Trophy', 1),
(1, 'PT2214F Economic Plastic Trophy', 2),
(2, 'XT1709F Exclusive Plastic Trophy', 1),
(2, 'BAW696 Metal Cup Trophy', 1),
(3, 'BAW696 Metal Cup Trophy', 1),
(4, '7503 Pewter Tray', 1),
(4, '7502 Pewter Tray', 2),
(5, 'MT301 Exclusive Zinc Alloy Medal', 1),
(5, 'RC8806 Resin Trophy', 1),
(6, 'MT301 Exclusive Zinc Alloy Medal', 1),
(7, 'PT2214F Economic Plastic Trophy', 3),
(8, 'XT1709F Exclusive Plastic Trophy', 1),
(8, 'RC8806 Resin Trophy', 2),
(9, '7503 Pewter Tray', 1),
(9, 'MT301 Exclusive Zinc Alloy Medal', 3),
(10, 'BAW696 Metal Cup Trophy', 2),
(11, 'XT1709F Exclusive Plastic Trophy', 2),
(12, 'MT301 Exclusive Zinc Alloy Medal', 1),
(13, '7502 Pewter Tray', 4),
(14, 'BAW696 Metal Cup Trophy', 3),
(15, 'CT5003F Acrylic Plastic Trophy', 2),
(16, '7503 Pewter Tray', 2),
(17, 'RC8806 Resin Trophy', 3),
(18, 'MT301 Exclusive Zinc Alloy Medal', 2),
(19, '7502 Pewter Tray', 3),
(20, 'PT2214F Economic Plastic Trophy', 4),
(20, 'BAW696 Metal Cup Trophy', 1),
(20, 'RC8806 Resin Trophy', 2),
(19, 'CT5003F Acrylic Plastic Trophy', 1),
(18, '7503 Pewter Tray', 1);

-- Insert test users
INSERT INTO users (full_name, username, pwd, email, phone_number, is_admin) VALUES
('Ahmad bin Ibrahim', 'ahmad123', '$2y$10$abcdefghijklmnopqrstuv', 'ahmad@email.com', '0123456789', 0),
('Siti Nurhaliza', 'siti_n', '$2y$10$abcdefghijklmnopqrstuv', 'siti@email.com', '0167891234', 0),
('Raj Kumar', 'raj_k', '$2y$10$abcdefghijklmnopqrstuv', 'raj@email.com', '0198765432', 0);

-- Insert user addresses
INSERT INTO user_address (uid, address_street, address_city, address_state, address_zip, address_country) VALUES
(1, 'No. 123, Jalan Merdeka', 'Shah Alam', 'Selangor', '40150', 'Malaysia'),
(2, 'Block A-12-3, Pangsapuri Bukit Indah', 'Johor Bahru', 'Johor', '81200', 'Malaysia'),
(3, 'No. 45, Lorong Bukit Bintang', 'Kuala Lumpur', 'Wilayah Persekutuan', '50250', 'Malaysia');

-- Insert transactions
INSERT INTO transactions (payment_amount, payment_status, payer_id, payer_email, address_street, address_city, address_state, address_zip, address_country) VALUES
(299.99, 'COMPLETED', 1, 'ahmad@email.com', 'No. 123, Jalan Merdeka', 'Shah Alam', 'Selangor', '40150', 'Malaysia'),
(150.50, 'PENDING', 2, 'siti@email.com', 'Block A-12-3, Pangsapuri Bukit Indah', 'Johor Bahru', 'Johor', '81200', 'Malaysia'),
(458.00, 'PROCESSING', 3, 'raj@email.com', 'No. 45, Lorong Bukit Bintang', 'Kuala Lumpur', 'Wilayah Persekutuan', '50250', 'Malaysia');

-- Insert transaction details
INSERT INTO transaction_details (tid, product_name, quantity) VALUES
(1, 'CT5003F Acrylic Plastic Trophy', 1),
(1, '7502 Pewter Tray', 2),
(2, 'XT1709F Exclusive Plastic Trophy', 1),
(3, 'XT1709F Exclusive Plastic Trophy', 2),
(3, 'CT5003F Acrylic Plastic Trophy', 1);

-- Insert orders
INSERT INTO orders (user_id, status, transaction_id) VALUES
(1, 'delivered', 1),
(2, 'pending', 2),
(3, 'processing', 3);

GRANT ALL PRIVILEGES ON front_db.* TO 'virtuosa'@'%';
FLUSH PRIVILEGES;
