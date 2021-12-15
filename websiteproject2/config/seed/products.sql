-- (A) PRODUCTS TABLE
CREATE TABLE `products` (
  `pid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

ALTER TABLE `products`
  MODIFY `pid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- (B) DUMMY PRODUCTS
INSERT INTO `products` (`pid`, `name`, `image`, `price`) VALUES
(1, 'Grey Hoodie', 'product-1.png', '120.99'),
(2, 'All Black Piece', 'product-2.png', '99.99'),
(3, 'Starburst suit', 'product-3.png', '250.00'),
(4, 'Turqoise sweatshirt', 'product-4.png', '36.99'),
(5, 'Vintage Jean Jacket', 'product-5.png', '269.99'),
(6, 'Glass-ceiling Shatterer', 'product-6.png', '66.99'),
(7, 'Patchwork Leather Jacket', 'product-7.png', '449.99'),
(8, 'Red Flowy Dress', 'product-8.png', '36.99'),
(9, 'Lipstick', 'product-9.png', '16.99'),
(10, 'Red Handbag', 'product-10.png', '666.99'),
(11, 'Prada Handbag', 'product-11.png', '1200.00'),
(12, 'Designer Handbag', 'product-11.png', '6200.00');
