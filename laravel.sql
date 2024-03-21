CREATE DATABASE  IF NOT EXISTS `laianhmi_test` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laianhmi_test`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: laianhmi_test
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bill` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `bill_date` timestamp NOT NULL,
  `totalprice` float NOT NULL,
  `deliverytime` timestamp NULL DEFAULT NULL,
  `status` int DEFAULT NULL,
  `bill_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_bill` (`user_id`,`bill_date`),
  CONSTRAINT `fk_bill_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (1,2,'2021-10-31 17:00:00',12000000,'2021-10-30 02:37:38',2,'bill'),(2,2,'2021-11-07 16:09:32',89580000,'2021-12-29 17:00:00',2,'bill'),(5,2,'2021-11-07 20:45:25',30310000,'2021-11-21 18:45:31',2,'bill'),(6,6,'2021-11-07 20:48:06',51800000,NULL,1,'bill'),(9,2,'2021-11-10 08:20:13',96097000,'2021-11-21 18:44:02',2,'bill'),(10,2,'2021-11-21 18:52:36',56780000,NULL,0,'bill'),(17,10,'2021-11-18 03:16:13',33155000,NULL,0,'cart'),(18,5,'2021-12-07 14:44:40',80620000,NULL,0,'bill'),(20,2,'2021-11-22 15:59:27',66410000,NULL,0,'bill'),(21,6,'2021-11-24 16:42:42',112666000,NULL,0,'cart'),(22,5,'2021-12-07 14:45:52',13090000,NULL,0,'bill'),(24,2,'2021-12-07 15:14:10',13510000,NULL,0,'bill'),(35,5,'2021-12-07 16:34:29',249624000,NULL,0,'bill'),(38,4,'2021-12-08 08:50:25',101500000,NULL,0,'bill'),(39,5,'2021-12-08 08:50:52',50800000,NULL,0,'bill'),(40,5,'2021-12-08 13:44:32',399111000,NULL,0,'bill'),(41,4,'2021-12-08 13:44:03',190615000,NULL,0,'bill'),(45,5,'2021-12-09 10:29:27',134200000,NULL,0,'bill');
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `brandname` varchar(60) NOT NULL,
  `brandcode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'LG','B01'),(2,'Samsung','B02'),(3,'Sony','B03'),(4,'Panasonic','B04');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(60) NOT NULL,
  `categorycode` varchar(50) NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `description` text,
  `thumb` varchar(100) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_parent_id` (`parent_id`),
  CONSTRAINT `fk_category_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Ti vi','ti-vi',NULL,'<h2><strong>TIVI</strong></h2><p>Với thiết kế hiện đại, tivi LG là một điểm nhấn tạo nên ấn tượng khác biệt trong những căn phòng. Công nghệ mới cho phép tivi thể hiện những chi tiết sắc sảo, độ tương phản tối ưu nhất.</p>','/storage/uploads/2021/11/18/TV.webp',1),(2,'Tủ lạnh','tu-lanh',NULL,'<h2><strong>Tủ lạnh</strong></h2><p>Bạn cần một tủ lạnh chứa đựng nhiều mà vẫn vừa vặn với diện tích nhà bếp của mình? Không còn lo lắng mua sắm nhiều và tận hưởng thế giới thực phẩm tươi mát nhất cùng tủ lạnh tiết kiệm điện (tủ lạnh Inverter) của LG.</p>','/storage/uploads/2021/11/18/TL.jpg',1),(3,'Điều hoà','dieu-hoa',NULL,'<h2><strong>Điều hòa</strong></h2><p>Tận hưởng cuộc sống trong môi trường trong sạch, yên tĩnh và thoải mái với máy điều hòa LG. Hệ thống lọc khí diệt khuẩn thế hệ mới giúp điều hòa LG mang đến những gì tốt nhất cho bạn.</p>','/storage/uploads/2021/11/18/DH.webp',1),(4,'Máy giặt','may-giat',NULL,'<h2><strong>Máy Giặt</strong></h2><p>Với sự lựa chọn phong phú cho dòng sản phẩm máy giặt inverter và, LG Việt Nam tự hào mang đến bạn một trải nghiệm mới, tiết kiệm nhiên liệu, nhiều tiện ích thông minh, thời gian và tiền bạc.</p>','/storage/uploads/2021/11/18/MG.webp',1),(5,'TV OLED','tv-oled',1,'<h2><strong>TIVI OLED</strong></h2><p>Phát minh ra TV không được xem là một cuộc cách mạng về công nghệ cho đến khi TV OLED đầu tiên trên thế giới ra đời. Dòng sản phẩm TV OLED của LG được tích hợp những công nghệ của tương lai cùng với tính năng hiện đại nhất.</p>','/storage/uploads/2021/11/18/TV-OLED.jpg',1),(7,'TV UHD','tv-uhd',1,'<h2><strong>TV UHD</strong></h2><p>TV UHD với 8.3 triệu điểm ảnh nhiều gấp 4 lần TV Full HD cho phép bạn trải nghiệm hình ảnh thật hơn bao giờ hết, mang đến những khung hình hoàn mỹ ngay cả khi xem ở khoảng cách gần hoặc rất gần.</p>','/storage/uploads/2021/11/18/UHD.png',1),(8,'TV LED','tv-led',1,NULL,NULL,1),(10,'Tủ lạnh Door-in-Door','tu-lanh-door-in-door',2,'<h2><strong>Tủ lạnh Door-in-door</strong></h2><p>Tủ lạnh Door-In-Door™: Cải tiến về không gian lưu trữ của tủ lạnh LG cho phép bạn nhanh chóng lấy được thực phẩm mình yêu thích và giảm mức độ hao hụt khí lạnh đến 47%.</p>','/storage/uploads/2021/11/18/D-I-D.webp',1),(11,'Tủ lạnh Side-by-Side','tu-lanh-side-by-side',2,'<h2><strong>Tủ lạnh Side-by-Side</strong></h2><p>Bất cứ khi nào bạn cần một tủ lạnh side by side tinh tế, tiện nghi và hiện đại nhất, tủ lạnh 2 cửa LG luôn là sự lựa chọn hàng đầu cho bạn và gia đình.</p>','/storage/uploads/2021/11/18/S-B-S.webp',1),(12,'Tủ lạnh ngăn đá trên','tu-lanh-ngan-da-tren',2,'<h2><strong>Tủ lạnh ngăn đá trên</strong></h2><p>Khám phá sự khác biệt cùng tủ lạnh ngăn đá trên LG, với thiết kế phong cách và công nghệ chăm sóc sức khỏe vượt trội, một lựa chọn thông minh cho gia đình bạn.</p>','/storage/uploads/2021/11/18/N-D-T.webp',1),(13,'Tủ lạnh ngăn đá dưới','tu-lanh-ngan-da-duoi',2,'<h2><strong>Tủ lạnh ngăn đá dưới</strong></h2><p>Khám phá sự khác biệt cùng tủ lạnh ngăn đá dưới LG, với thiết kế phong cách và công nghệ chăm sóc sức khỏe vượt trội, một lựa chọn thông minh cho gia đình bạn.</p>','/storage/uploads/2021/11/18/N-D-D.png',1),(15,'Điều hòa 1 chiều','dieu-hoa-1-chieu',3,'<h2><strong>Điều hòa</strong></h2><p>Tận hưởng cuộc sống trong môi trường trong sạch, yên tĩnh và thoải mái với máy điều hòa LG. Hệ thống lọc khí diệt khuẩn thế hệ mới giúp điều hòa LG mang đến những gì tốt nhất cho bạn.</p>','/storage/uploads/2021/11/18/DH-1-C.png',1),(16,'Điều hòa 2 chiều','dieu-hoa-2-chieu',3,'<h2><strong>Điều hòa</strong></h2><p>Tận hưởng cuộc sống trong môi trường trong sạch, yên tĩnh và thoải mái với máy điều hòa LG. Hệ thống lọc khí diệt khuẩn thế hệ mới giúp điều hòa LG mang đến những gì tốt nhất cho bạn.</p>','/storage/uploads/2021/11/18/DH-1-C.png',1),(17,'Máy giặt lồng đứng','may-giat-long-dung',4,'<h2><strong>Máy giặt lồng đứng</strong></h2><p>Máy giặt lồng đứng (máy giặt cửa trên) LG mang đến công nghệ hiện đại, đáp ứng sự mong chờ của bạn cho một máy giặt cửa trên, giúp cuộc sống bạn thêm thư giãn sau những ngày làm việc.</p>','/storage/uploads/2021/11/18/MG-L-D.png',1),(18,'Máy giặt lồng ngang','may-giat-long-ngang',4,'<h2><strong>Máy giặt lồng ngang</strong></h2><p>Đột phá công nghệ cùng máy giặt lồng ngang (máy giặt cửa trước) LG, trải nghiệm chưa từng có với máy giặt cửa ngang, áo quần sạch hơn, thiết kế tinh tế hơn và tiết kiệm nhiên liệu, thời gian cho gia đình bạn.</p>','/storage/uploads/2021/11/18/MG-L-N.webp',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `cmt_datetime` timestamp NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `context` text NOT NULL,
  `stars` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_comments` (`product_id`,`user_id`,`cmt_datetime`),
  KEY `fk_users_cmt` (`user_id`),
  CONSTRAINT `fk_product_cmt1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_users_cmt` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (5,2,2,'2021-11-10 19:34:16','Good','Sản phẩm tốt, dùng rất oke, giá hợp lý',4),(6,5,2,'2021-11-10 19:34:30','Nice','Sản phẩm tốt, dùng rất oke, giá hợp lý',5),(7,1,2,'2021-11-10 19:35:05','Nice','Sản phẩm tốt, dùng rất oke, giá hợp lý. Hãy mua và trải nghiệm',5);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_image_product_idx` (`product_id`),
  CONSTRAINT `fk_image_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (27,2,'/storage/uploads/2021/11/04/DZ-02.webp'),(28,2,'/storage/uploads/2021/11/04/DZ-03.webp'),(29,2,'/storage/uploads/2021/11/04/DZ-04.webp'),(30,2,'/storage/uploads/2021/11/04/DZ-05.webp'),(31,2,'/storage/uploads/2021/11/04/DZ-08.webp'),(32,3,'/storage/uploads/2021/11/04/DZ-02.webp'),(33,3,'/storage/uploads/2021/11/04/DZ-03.webp'),(34,3,'/storage/uploads/2021/11/04/DZ-04.webp'),(35,3,'/storage/uploads/2021/11/04/DZ-05.webp'),(36,3,'/storage/uploads/2021/11/04/DZ-08.webp'),(37,4,'/storage/uploads/2021/11/04/DZ-02.webp'),(38,4,'/storage/uploads/2021/11/04/DZ-03.webp'),(39,4,'/storage/uploads/2021/11/04/DZ-04.webp'),(40,4,'/storage/uploads/2021/11/04/DZ-05.webp'),(41,4,'/storage/uploads/2021/11/04/DZ-08.webp'),(62,13,'/storage/uploads/2021/11/04/sony1.png'),(63,13,'/storage/uploads/2021/11/04/sony2.png'),(64,13,'/storage/uploads/2021/11/04/sony3.png'),(65,13,'/storage/uploads/2021/11/04/sony4.png'),(66,13,'/storage/uploads/2021/11/04/sony5.png'),(71,17,'/storage/uploads/2021/11/04/dz-2.webp'),(72,17,'/storage/uploads/2021/11/04/dz-4.webp'),(73,17,'/storage/uploads/2021/11/04/dz-7.webp'),(74,17,'/storage/uploads/2021/11/04/dz-8.webp'),(75,17,'/storage/uploads/2021/11/04/dz-9.webp'),(76,18,'/storage/uploads/2021/11/04/1600_2.webp'),(77,18,'/storage/uploads/2021/11/04/1600_3.webp'),(78,18,'/storage/uploads/2021/11/04/1600_4.webp'),(79,18,'/storage/uploads/2021/11/04/1600_5.webp'),(80,18,'/storage/uploads/2021/11/04/1600_8.webp'),(81,20,'/storage/uploads/2021/11/04/sony1.png'),(82,20,'/storage/uploads/2021/11/04/sony2.png'),(83,20,'/storage/uploads/2021/11/04/sony3.png'),(84,20,'/storage/uploads/2021/11/04/sony4.png'),(85,20,'/storage/uploads/2021/11/04/sony5.png'),(86,19,'/storage/uploads/2021/11/04/samsung.webp'),(87,19,'/storage/uploads/2021/11/04/samsung2.webp'),(88,19,'/storage/uploads/2021/11/04/samsung3.webp'),(89,19,'/storage/uploads/2021/11/04/samsung4.webp'),(90,19,'/storage/uploads/2021/11/04/samsung5.webp'),(91,21,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_2.jpg'),(92,21,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_3.jpg'),(93,21,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_4.jpg'),(94,21,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_5.jpg'),(118,7,'/storage/uploads/2021/11/06/large02.webp'),(119,7,'/storage/uploads/2021/11/06/large03.webp'),(120,7,'/storage/uploads/2021/11/06/large05.webp'),(121,7,'/storage/uploads/2021/11/06/large06.webp'),(122,7,'/storage/uploads/2021/11/06/large12.webp'),(123,10,'/storage/uploads/2021/11/04/dz-2.webp'),(124,10,'/storage/uploads/2021/11/04/dz-4.webp'),(125,10,'/storage/uploads/2021/11/04/dz-7.webp'),(126,10,'/storage/uploads/2021/11/04/dz-8.webp'),(127,10,'/storage/uploads/2021/11/04/dz-9.webp'),(128,11,'/storage/uploads/2021/11/04/1600_2.webp'),(129,11,'/storage/uploads/2021/11/04/1600_3.webp'),(130,11,'/storage/uploads/2021/11/04/1600_4.webp'),(131,11,'/storage/uploads/2021/11/04/1600_5.webp'),(132,11,'/storage/uploads/2021/11/04/1600_8.webp'),(133,24,'/storage/uploads/2021/11/04/smart-tivi-samsung-4k-55-inch-55au7700-uhd-art3jL.jpg'),(134,24,'/storage/uploads/2021/11/04/smart-tivi-samsung-4k-55-inch-55au7700-uhd-3Fe7TF.jpg'),(135,24,'/storage/uploads/2021/11/04/smart-tivi-samsung-4k-55-inch-55au7700-uhd-28q2Z3.jpg'),(136,12,'/storage/uploads/2021/11/04/vn-qled-q60a-380027-qa55q65aakxxv-404694106.webp'),(137,12,'/storage/uploads/2021/11/04/vn-qled-q60a-380027-qa55q65aakxxv-404694108.webp'),(138,12,'/storage/uploads/2021/11/04/vn-qled-q60a-380027-qa55q65aakxxv-404694110.webp'),(139,12,'/storage/uploads/2021/11/04/vn-qled-q60a-380027-qa55q65aakxxv-404694112.webp'),(140,12,'/storage/uploads/2021/11/04/vn-qled-q60a-380027-qa55q65aakxxv-404694113.webp'),(141,35,'/storage/uploads/2021/11/04/sony_A8H_1.png'),(142,35,'/storage/uploads/2021/11/04/sony_A8H_2.png'),(143,35,'/storage/uploads/2021/11/04/sony_A8H_3.png'),(144,35,'/storage/uploads/2021/11/04/sony_A8H_4.png'),(145,35,'/storage/uploads/2021/11/04/sony_A8H_5.png'),(146,14,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_2.jpg'),(147,14,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_3.jpg'),(148,14,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_4.jpg'),(149,14,'/storage/uploads/2021/11/04/692_android_tivi_sony_oled_4k_65_inch_xr_65a80j_5.jpg'),(165,1,'/storage/uploads/2021/11/04/DZ-02.webp'),(166,1,'/storage/uploads/2021/11/04/DZ-03.webp'),(167,1,'/storage/uploads/2021/11/04/DZ-04.webp'),(168,1,'/storage/uploads/2021/11/04/DZ-05.webp'),(169,1,'/storage/uploads/2021/11/04/DZ-08.webp'),(170,31,'/storage/uploads/2021/12/08/large02.webp'),(171,31,'/storage/uploads/2021/12/08/large03.webp'),(172,31,'/storage/uploads/2021/12/08/large05.webp'),(173,31,'/storage/uploads/2021/12/08/large06.webp'),(174,31,'/storage/uploads/2021/12/08/large12.webp');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `productname` varchar(150) NOT NULL,
  `pricesell` float NOT NULL,
  `priceentry` float NOT NULL,
  `description` text,
  `content` text,
  `productcode` varchar(150) NOT NULL,
  `category_id` bigint NOT NULL,
  `brand_id` bigint NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `discount` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_cate` (`category_id`),
  KEY `fk_product_brand` (`brand_id`),
  CONSTRAINT `fk_product_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_product_cate` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'LG UP81 43  inch 4K Smart UHD TV',14900000,12000000,'màn 43\", 60hz, 4k','<p>đây là sản phẩm đẹp</p>','lg-up81-43-inch-4k-smart-uhd-tv',7,1,'/storage/uploads/2021/11/03/md07528223-350x350.webp',1,10),(2,'LG UP81 50 inch 4K Smart UHD TV',16900000,14900000,'màn 50\", 60hz, 4k','<p>đây là sản phẩm đẹp</p>','lg-up81-50-inch-4k-smart-uhd-tv',7,1,'/storage/uploads/2021/11/03/md07528223-350x350.webp',1,0),(3,'LG UP81 55 inch 4K Smart UHD TV',19900000,16000000,'màn 55\", 60hz, 4k','<p>đây là sản phẩm đẹp</p>','lg-up81-55-inch-4k-smart-uhd-tv',7,1,'/storage/uploads/2021/11/03/md07528223-350x350.webp',1,0),(4,'LG UP81 65 inch 4K Smart UHD TV',24400000,22000000,'màn 65\", 60hz, 4k','<p>đây là sản phẩm đẹp</p>','lg-up81-65-inch-4k-smart-uhd-tv',7,1,'/storage/uploads/2021/11/03/md07528223-350x350.webp',1,0),(5,'LG Smart Inverter 325L Tủ lạnh ngăn đá dưới (Bạc)',12990000,11000000,'tủ lạnh ngăn đá dưới','<p>đây là sản phẩm đẹp</p>','lg-smart-inverter-325l-tu-lanh-ngan-da-duoi-bac',13,1,'/storage/uploads/2021/11/03/Thumb-350.webp',1,0),(6,'LG DUALCOOL™ Điều hòa Inverter 1 chiều UV 12.000 BTU (1,5HP) V13APFUV',16190000,12990000,'điều hoà 12000 BTU','<p>đây là sản phẩm đẹp</p>','lg-dualcool-dieu-hoa-inverter-1-chieu-uv-12000-btu-15hp-v13apfuv',15,1,'/storage/uploads/2021/11/03/md07525606-350x350.webp',1,0),(7,'LG Smart Inverter™ Máy giặt lồng đứng 9kg (Đen) T2109VSAB',6690000,4000000,'máy giặt 9kg','<ul><li>Tiết kiệm năng lượng với công nghệ Smart Inverter™</li><li>Chu trình giặt tối ưu cho từng loại vải với chuyển động thông minh Smart Motion™</li><li>Giặt xoay chiều TurboDrum™ đánh bật cả các vết bẩn cứng đầu</li><li>Đấm nước Punch+3™ mang tới hiệu quả giặt đồng đều</li><li>Tự động giặt sơ, không cần giặt tay trước</li><li>Thác nước vòng cung giúp hòa tan bột giặt nhanh, giảm thiểu cặn bột giặt</li></ul>','lg-smart-inverter-may-giat-long-dung-9kg-den-t2109vsab',17,1,'/storage/uploads/2021/11/03/350.webp',1,0),(8,'Panasonic Deluxe Iverter Aero',25860000,24190000,'Khử khuẩn nano-G\r\nCánh đảo gió AeroWings™\r\nTiết kiệm năng lượng\r\nKết nối thông minh ComfortCloud\r\nCông nghệ tăng cường nhiệt P-Tech',NULL,'panasonic-deluxe-iverter-aero',15,4,'/storage/uploads/2021/11/03/psn-csu13vkh_1.jpg',1,0),(9,'Samsung Wind-Free Inverter 1.5 HP',18490000,16990000,'Chất làm lạnh R32 thân thiện với môi trường','<p>Chất làm lạnh R32 thân thiện với môi trường<br>Động cơ Digital Inverter Boost siêu tiết kiệm điện<br>Loại bỏ bụi siêu mịn với bộ lọc PM1.0<br>Dễ dàng vệ sinh lưới lọc với bộ lọc Easy Filter Plus<br>Điều khiển từ xa với SmartThings</p>','samsung-wind-free-inverter-15-hp',16,2,'/storage/uploads/2021/11/03/dmcl_450_product_15837_1.png',1,0),(10,'LG A1 65 inch 4K Smart OLED TV',28900000,27500000,'OLED hiển thị dễ chịu cho mắt, thân thiện với môi trường','<p>OLED hiển thị dễ chịu cho mắt, thân thiện với môi trường<br>55 inch<br>4 chế độ OLED Design, OLED Cinema, OLED Gaming, OLED Sport<br>Bộ xử lý AI 4K α7 thế hệ thứ 4<br>AI ThinQ<br>Tích hợp Google Chromecast</p>','lg-a1-65-inch-4k-smart-oled-tv',5,1,'/storage/uploads/2021/11/03/md07528661-350x350.webp',1,0),(11,'LG LM57 43 inch HD TV',7990000,7190000,'Nâng cấp màu sắc sống động','<p>Nâng cấp màu sắc sống động<br>Virtual Surround Plus<br>Dolby Audio<br>Bộ Xử Lý Lõi Tứ<br>Điều khiển thông minh<br>Điều khiển bằng giọng nói</p>','lg-lm57-43-inch-hd-tv',8,1,'/storage/uploads/2021/11/03/1100_1.webp',1,0),(12,'Samsung Smart Tivi QLED 4K 55 inch',22900000,20590000,'Thiết kế thanh mảnh, màn hình tràn viền 4 cạnh','<p>55 inch<br>Thiết kế thanh mảnh, màn hình tràn viền 4 cạnh<br>Độ phân giải 4K<br>Hiển thị 100% dải màu nhờ màn hình chấm lượng tử Quantum Dot<br>Điều khiển One Remote Control tích hợp Solar Cell Remote và Google Assistant</p>','samsung-smart-tivi-qled-4k-55-inch',5,2,'/storage/uploads/2021/11/03/4443c62f0da678f768c11b44a3f045fc.webp',1,0),(13,'Sony BRAVIA XR MASTER Series Z9J',199900000,185000000,'85 inch\r\nĐộ phân giải 8K\r\nCác vùng đèn LED sáng hoặc tối một cách độc lập cho chi tiết vùng sáng và tối chân thực\r\nCognitive Processor XR™ hiểu rõ hoạt động nghe, nhìn của con người để tạo nên cảm giác đắm chìm thực sự\r\nÂm thanh ăn khớp với hình ảnh mang đến trải nghiệm xem đắm chìm\r\nChân đế có nhiều cách bố trí để đặt TV linh hoạt\r\nSmartTV (Google TV)',NULL,'sony-bravia-xr-master-series-z9j',8,3,'/storage/uploads/2021/11/04/sony.png',1,0),(14,'Sony BRAVIA XR A80J',44900000,43590000,'Sự dụng tấm nền OLED rực rỡ','<p>55 inch&nbsp;<br>Độ phân giải 4K<br>Sự dụng tấm nền OLED rực rỡ<br>Cognitive Processor XR™ hiểu rõ hoạt động nghe, nhìn của con người để tạo nên cảm giác đắm chìm thực sự<br>Loa màn hình với Processor XR biến mọi âm thanh trở nên sống động<br>Chân đế có nhiều cách bố trí để đặt TV linh hoạt</p>','sony-bravia-xr-a80j',7,3,'/storage/uploads/2021/11/03/691_android_tivi_sony_oled_4k_55_inch_xr_55a80j_1.jpg',1,0),(15,'Panasonic Serie 1.5 HP Aero Inverter R32',18390000,16990000,'Khử khuẩn nano-G','<p>Khử khuẩn nano-G<br>Cánh đảo gió AeroWings™<br>Tiết kiệm năng lượng<br>Kết nối thông minh ComfortCloud<br>Công nghệ tăng cường nhiệt P-Tech</p>','panasonic-serie-15-hp-aero-inverter-r32',16,4,'/storage/uploads/2021/11/03/psn-csu13vkh_1.jpg',1,0),(16,'LG Inverter Linear™ 550L',36400000,34900000,'Ngăn lấy nước ngoài\r\nKháng khuẩn khử mùi với Hygiene Fresh\r\nTay cầm hốc vuông tinh tế\r\nTiết kiệm điện với máy nén Linear Inverter\r\nChuẩn đoán thông minh Smart Diagnosis™',NULL,'lg-inverter-linear-550l',11,1,'/storage/uploads/2021/11/03/md06238538-350x350.webp',1,0),(17,'LG A1 48 inch 4K Smart OLED TV',28900000,27500000,'OLED hiển thị dễ chịu cho mắt, thân thiện với môi trường\r\n48 inch\r\n4 chế độ OLED Design, OLED Cinema, OLED Gaming, OLED Sport\r\nBộ xử lý AI 4K α7 thế hệ thứ 4\r\nAI ThinQ\r\nTích hợp Google Chromecast','<p>good</p>','lg-a1-48-inch-4k-smart-oled-tv',7,1,'/storage/uploads/2021/11/03/md07528661-350x350.webp',1,1),(18,'LG LM57 55 inch HD TV',7990000,7190000,'Virtual Surround Plus\r\n43 inch\r\nDolby Audio\r\nBộ Xử Lý Lõi Tứ\r\nĐiều khiển thông minh\r\nĐiều khiển bằng giọng nói','<p>good</p>','lg-lm57-55-inch-hd-tv',8,1,'/storage/uploads/2021/11/03/1100_1.webp',1,1),(19,'Samsung Smart Tivi QLED 4K 55 inch',22900000,20590000,'55 inch\r\nThiết kế thanh mảnh, màn hình tràn viền 4 cạnh\r\nĐộ phân giải 4K\r\nHiển thị 100% dải màu nhờ màn hình chấm lượng tử Quantum Dot\r\nĐiều khiển One Remote Control tích hợp Solar Cell Remote và Google Assistant',NULL,'samsung-smart-tivi-qled-4k-55-inch',7,2,'/storage/uploads/2021/11/03/medium_cxn1632294842.jpg',1,1),(20,'Sony BRAVIA XR MASTER Series Z9J',199900000,185000000,'65 inch\r\nĐộ phân giải 6K\r\nCác vùng đèn LED sáng hoặc tối một cách độc lập cho chi tiết vùng sáng và tối chân thực\r\nCognitive Processor XR™ hiểu rõ hoạt động nghe, nhìn của con người để tạo nên cảm giác đắm chìm thực sự\r\nÂm thanh ăn khớp với hình ảnh mang đến trải nghiệm xem đắm chìm\r\nChân đế có nhiều cách bố trí để đặt TV linh hoạt\r\nSmartTV (Google TV)',NULL,'sony-bravia-xr-master-series-z9j',8,3,'/storage/uploads/2021/11/04/sony.png',1,1),(21,'Sony BRAVIA XR A80J',44900000,43590000,'55 inch \r\nĐộ phân giải 4K\r\nSự dụng tấm nền OLED rực rỡ\r\nCognitive Processor XR™ hiểu rõ hoạt động nghe, nhìn của con người để tạo nên cảm giác đắm chìm thực sự\r\nLoa màn hình với Processor XR biến mọi âm thanh trở nên sống động\r\nChân đế có nhiều cách bố trí để đặt TV linh hoạt',NULL,'sony-bravia-xr-a80j',7,3,'/storage/uploads/2021/11/03/691_android_tivi_sony_oled_4k_55_inch_xr_55a80j_1.jpg',1,1),(22,'Panasonic Serie 1.5 HP Aero Inverter R32',18390000,16990000,'Khử khuẩn nano-G','<p>Khử khuẩn nano-G<br>Cánh đảo gió AeroWings™<br>Tiết kiệm năng lượng<br>Kết nối thông minh ComfortCloud<br>Công nghệ tăng cường nhiệt P-Tech</p>','panasonic-serie-15-hp-aero-inverter-r32',16,4,'/storage/uploads/2021/11/17/psn-csu13vkh_1.jpg',1,5),(23,'LG Inverter Linear™ 550L',36400000,34900000,'Ngăn lấy nước ngoài\r\nKháng khuẩn khử mùi với Hygiene Fresh\r\nTay cầm hốc vuông tinh tế\r\nTiết kiệm điện với máy nén Linear Inverter\r\nChuẩn đoán thông minh Smart Diagnosis™','<p>1</p>','lg-inverter-linear-550l',10,1,'/storage/uploads/2021/11/03/md06238538-350x350.webp',1,1),(24,'Samsung Smart TV UHD 4K AU7700',34900000,32900000,'Tích hợp loa HW-A550/XV','<p>Tích hợp loa HW-A550/XV&nbsp;<br>Tìm kiếm giọng nói với Google<br>Công Nghệ Motion Xcelerator cho khung hình rõ nét<br>Tái hiện sắc màu chân thực với công nghệ PurColor</p>','samsung-smart-tv-uhd-4k-au7700',5,2,'/storage/uploads/2021/11/03/vn-uhd-au7000-383862-ua75au7700kxxv-421623884.webp',1,5),(25,'Samsung Side by Side 550L',21400000,19900000,'SpaceMax- Công nghệ tối ưu hóa không gian lưu trữ\r\nLàm lạnh và làm đá nhanh Power Cool/Power Freeze\r\nBộ lọc khử mùi than hoạt tính','<p>nice</p>','samsung-side-by-side-550l',11,2,'/storage/uploads/2021/11/03/vn-side-by-side-rs62r5001b4-rs62r5001b4-sv-black-198134679.webp',1,1),(26,'Panasonic JX620 Series 4K LED Android TV™',23600000,21000000,'4K ULTRA HD LED LCD','<p>4K ULTRA HD LED LCD<br>Bộ xử lý 4K Colour Engine<br>Hexa Chroma Drive<br>Bluetooth® Audio Link<br>Chromecast built-in™</p>','panasonic-jx620-series-4k-led-android-tv',8,4,'/storage/uploads/2021/11/03/ast-1446143.png.pub.thumb.172.229.png',1,1),(27,'Panasonic Aero XZ9XKH',18500000,17490000,'Được trang bị công nghệ nanoe™ X có khả năng ức chế các chất ô nhiễm trong không khí và các chất ô nhiễm bám dính\r\nBảo vệ môi trường không khí trong 24 giờ\r\nTận hưởng khả năng làm mát thoải mái với công nghệ AEROWINGS, iAUTO-X\r\nCảm biến độ ẩm.','<p>Nice</p>','panasonic-aero-xz9xkh',16,4,'/storage/uploads/2021/11/03/ast-1451286.png.pub.thumb.172.229.png',1,1),(28,'Samsung Multidoor 450L',23900000,22000000,'Công Nghệ 2 Dàn Lạnh Độc Lập Twin Cooling Plus\r\nHoàn toàn không lẫn mùi giữa các ngăn\r\nChất liệu thép cao cấp bền đẹp, không bám vân tay','<p>nic4</p>','samsung-multidoor-450l',10,2,'/storage/uploads/2021/11/03/-mFW9o4.png',1,1),(29,'Samsung AI EcoBubble™ 9kg',12250000,11000000,'AI Control ghi nhớ, đề xuất chế độ giặt\r\nEcoBubble™ giặt sạch sâu, bảo vệ sợi vải\r\nQuickDrive™ sạch siêu tốc chỉ 39 phút','<p>nice</p>','samsung-ai-ecobubble-9kg',18,2,'/storage/uploads/2021/11/03/vn-front-loading-washer-ww10t754abts2-380579-ww90tp54dsb-sv-514982268.webp',1,1),(30,'Samsung Smart AI EcoBubble™ 11kg',155900000,145000000,'AI Wash phân tích độ bẩn, tối ưu quy trình giặt\r\nAI Control ghi nhớ, đề xuất chế độ giặt\r\nAI Dispenser tự động phân bổ nước giặt/xả','<p>nice</p>','samsung-smart-ai-ecobubble-11kg',18,2,'/storage/uploads/2021/11/03/vn-front-loading-washer-ww10tp44dsxfq-ww10tp44dsb-sv-514988030.webp',1,1),(31,'Panasonic 10kg NA-F100A9BRV',9890000,9150000,'Máy giặt 11kg Care+  giúp giặt quần áo sạch hơn nhờ tính năng loại bỏ vết bẩn hiệu quả.\r\nStainMaster\r\nHệ thống ActiveFoam\r\nMâm giặt Ag\r\nHệ thống lọc xơ vải Ag lớn','<p>good</p>','panasonic-10kg-na-f100a9brv',17,4,'/storage/uploads/2021/11/03/ast-1342138.png',1,1),(32,'Samsung Digital Inverter WindFree™ 24000BTu/h',32190000,29900000,'Công nghệ WindFree™ làm lạnh nhanh không gió buốt\r\nBộ lọc TriCare lọc 99% virus, vi khuẩn và bụi siêu mịn\r\nDigital Inverter Boost tiết kiệm điện đến 77%','<p>good</p>','samsung-digital-inverter-windfree-24000btuh',16,2,'/storage/uploads/2021/11/03/vn-wall-mount-out-door-ar18tygcdwkxsv-f-ar18tygcdw20-white-217895961.webp',1,1),(33,'Samsung Digital Inverter 24000 BTu/h',28800000,27000000,'Công nghệ DuraFin™ Plus tối ưu vận hành bộ trao đổi nhiệt\r\nAuto Clean tự động làm sạch, ngăn ngừa vi khuẩn và nấm mốc\r\nChất làm lạnh R32 giảm thiểu tác động lên tầng ozone','<p>good</p>','samsung-digital-inverter-24000-btuh',16,2,'/storage/uploads/2021/11/03/vn-wall-mount-out-door-ar18tyhycwkxsv-f-ar18tyhycw20-217658218.webp',1,1),(34,'Samsung Family Hub 550L',50890000,48500000,'ViewInside quản lý thực phẩm mà không cần mở cửa\r\nTự động gợi ý công thức món ăn\r\nTrạm điều khiển các thiết bị thông minh	\r\nMàn Hình Family Board','<p>good</p>','samsung-family-hub-550l',11,2,'/storage/uploads/2021/11/03/vn-side-by-side-rs64t5f01b4-rs64t5f01b4-sv-514887742.webp',1,1),(35,'Sony A8H OLED 4K Ultra HD',40900000,38900000,'OLED mang đến màu đen, độ tương phản và màu sắc tuyệt mỹ vô song','<p>OLED mang đến màu đen, độ tương phản và màu sắc tuyệt mỹ vô song<br>Bộ xử lý hình ảnh X1™ Ultimate cho độ chân thực vô song<br>Nâng cấp bất kỳ nội dung nào lên chất lượng 4K bằng 4K X-Reality™ PRO<br>Âm thanh ăn khớp với hình ảnh mang đến trải nghiệm xem đắm chìm</p>','sony-a8h-oled-4k-ultra-hd',5,3,'/storage/uploads/2021/11/04/sony_A8H.png',1,1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bill`
--

DROP TABLE IF EXISTS `product_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_bill` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint DEFAULT NULL,
  `bill_id` bigint DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantily` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_product_bill` (`product_id`,`bill_id`),
  KEY `fk_bill_product` (`bill_id`),
  CONSTRAINT `fk_bill_product` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`),
  CONSTRAINT `fk_prodcut_bill` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bill`
--

LOCK TABLES `product_bill` WRITE;
/*!40000 ALTER TABLE `product_bill` DISABLE KEYS */;
INSERT INTO `product_bill` VALUES (1,2,1,NULL,1),(2,5,1,NULL,1),(3,2,2,NULL,2),(4,5,2,NULL,2),(5,1,2,NULL,2),(26,1,5,NULL,1),(27,2,5,NULL,1),(28,10,6,NULL,1),(29,12,6,NULL,1),(35,16,9,36400000,1),(36,23,9,36036000,1),(38,28,9,23661000,1),(51,1,6,13410000,3),(52,2,6,16900000,3),(53,3,6,19900000,3),(104,24,17,33155000,1),(105,1,18,13410000,2),(106,2,18,16900000,2),(107,3,18,19900000,1),(108,3,10,19900000,1),(116,15,10,18390000,2),(117,24,20,33155000,3),(118,16,21,36400000,1),(119,23,21,36036000,1),(121,1,21,13410000,4),(122,5,22,12990000,1),(124,1,24,13410000,2),(136,22,35,17470500,9),(141,24,35,33155000,2),(142,5,35,12990000,2),(152,2,38,16900000,5),(153,2,39,16900000,4),(154,2,40,16900000,2),(155,17,40,28611000,5),(156,18,40,7910100,5),(157,17,41,28611000,5),(158,18,41,7910100,5),(167,1,45,13410000,10);
/*!40000 ALTER TABLE `product_bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_receipt`
--

DROP TABLE IF EXISTS `product_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_receipt` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint DEFAULT NULL,
  `receipt_id` bigint DEFAULT NULL,
  `quantily` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_product_receipt` (`product_id`,`receipt_id`),
  KEY `fk_receipt_product` (`receipt_id`),
  CONSTRAINT `fk_prodcut_receipt` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_receipt_product` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_receipt`
--

LOCK TABLES `product_receipt` WRITE;
/*!40000 ALTER TABLE `product_receipt` DISABLE KEYS */;
INSERT INTO `product_receipt` VALUES (83,1,23,10),(84,2,23,20),(85,3,23,10),(86,4,23,10),(87,5,23,10),(88,6,24,10),(89,7,24,10),(90,8,24,10),(91,9,24,10),(92,10,24,10),(93,11,25,10),(94,12,25,10),(95,13,25,10),(96,14,25,10),(97,15,25,10),(98,16,26,10),(99,17,26,10),(100,18,26,10),(101,19,26,10),(102,20,26,10),(103,21,27,10),(104,22,27,10),(105,23,27,10),(106,24,27,10),(107,25,27,10),(108,26,28,10),(109,27,28,10),(110,28,28,10),(111,29,28,10),(112,30,28,10),(113,31,29,10),(114,32,29,10),(115,33,29,10),(116,34,29,10),(117,35,29,10),(118,1,30,10),(119,2,30,10),(120,3,30,10),(121,4,30,10);
/*!40000 ALTER TABLE `product_receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_speciality`
--

DROP TABLE IF EXISTS `product_speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_speciality` (
  `speciality_id` bigint DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  KEY `fk_product_speciality` (`speciality_id`),
  KEY `fk_speciality_product` (`product_id`),
  CONSTRAINT `fk_product_speciality` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`),
  CONSTRAINT `fk_speciality_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_speciality`
--

LOCK TABLES `product_speciality` WRITE;
/*!40000 ALTER TABLE `product_speciality` DISABLE KEYS */;
INSERT INTO `product_speciality` VALUES (13,23),(13,25),(12,28),(13,34),(15,27),(16,32),(16,33),(17,29),(18,30),(15,6),(15,8),(13,16),(11,5),(1,2),(4,2),(7,2),(1,3),(5,3),(7,3),(1,4),(6,4),(7,4),(2,13),(3,13),(7,13),(1,17),(4,17),(7,17),(1,18),(5,18),(7,18),(2,20),(6,20),(8,20),(1,19),(5,19),(8,19),(1,21),(5,21),(7,21),(15,9),(17,7),(1,10),(6,10),(7,10),(1,26),(4,26),(7,26),(15,15),(16,22),(1,11),(3,11),(7,11),(1,24),(5,24),(7,24),(1,12),(5,12),(7,12),(1,35),(5,35),(7,35),(2,14),(4,14),(7,14),(1,1),(3,1),(8,1),(18,31);
/*!40000 ALTER TABLE `product_speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receipt` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `receipt_date` timestamp NOT NULL,
  `totalprice` float NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_receipt` (`user_id`,`receipt_date`),
  CONSTRAINT `fk_receipt_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt`
--

LOCK TABLES `receipt` WRITE;
/*!40000 ALTER TABLE `receipt` DISABLE KEYS */;
INSERT INTO `receipt` VALUES (23,1,'2021-11-06 09:16:53',908000000,1),(24,1,'2021-11-06 09:17:21',856700000,1),(25,1,'2021-11-06 09:17:41',2733600000,1),(26,1,'2021-11-06 09:18:00',2751800000,1),(27,1,'2021-11-06 09:18:19',1482800000,1),(28,1,'2021-11-06 09:18:44',2164900000,1),(29,1,'2021-11-06 09:19:05',1534500000,1),(30,1,'2021-12-09 02:59:00',649000000,1);
/*!40000 ALTER TABLE `receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `rolename` varchar(20) NOT NULL,
  `rolecode` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Khách hàng','KH'),(2,'Nhân viên','NV'),(3,'Quản lý','QL');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speciality`
--

DROP TABLE IF EXISTS `speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `speciality` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `typename` varchar(50) NOT NULL,
  `typenumber` int NOT NULL,
  `mata` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `typeproduct` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_speciality` (`typename`,`typenumber`)
) ENGINE=InnoDB AUTO_INCREMENT=22 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speciality`
--

LOCK TABLES `speciality` WRITE;
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;
INSERT INTO `speciality` VALUES (1,'màn hình',1,'4k','đây là sản phẩm màn 4k','man-hinh','ti-vi'),(2,'màn hình',2,'6k','đây là sản phẩm màn 6k','man-hinh','ti-vi'),(3,'kích thước',1,'43\"','đây là sản phẩm màn 43\"','kich-thuoc','ti-vi'),(4,'kích thước',2,'50\"','đây là sản phẩm màn 50\"','kich-thuoc','ti-vi'),(5,'kích thước',3,'55\"','đây là sản phẩm màn  55\"','kich-thuoc','ti-vi'),(6,'kích thước',4,'65\"','đây là sản phẩm màn 65\"','kich-thuoc','ti-vi'),(7,'tần số',1,'60hz','đây là sản phẩm tần số 60hz','tan-so','ti-vi'),(8,'tần số',2,'120hz','đây là sản phẩm tần số 120hz','tan-so','ti-vi'),(9,'dung tích',1,'125L','tủ lạnh dung tích 125L','dung-tich','tu-lanh'),(10,'dung tích',2,'250L','tủ lạnh dung tích 250L','dung-tich','tu-lanh'),(11,'dung tích',3,'325L','tủ lạnh dung tích 325L','dung-tich','tu-lanh'),(12,'dung tích',4,'450L','tủ lạnh dung tích 450L','dung-tich','tu-lanh'),(13,'dung tích',5,'550L','tủ lạnh dung tích 550L','dung-tich','tu-lanh'),(14,'công suất',1,'9000 BTU','điều hoà dung tích 9000 BTU','cong-suat','dieu-hoa'),(15,'công suất',2,'12000 BTU','điều hoà dung tích 12000 BTU','cong-suat','dieu-hoa'),(16,'công suất',3,'24000 BTU','điều hoà dung tích 24000 BTU','cong-suat','dieu-hoa'),(17,'khối lượng',1,'9kg','máy giặt  dung tích 9kg','khoi-luong','may-giat'),(18,'khối lượng',2,'11kg','máy giặt  dung tích 11kg','khoi-luong','may-giat'),(19,'khối lượng',3,'13kg','máy giặt  dung tích 13kg','khoi-luong','may-giat'),(20,'khối lượng',4,'15kg','máy giặt dung tích 15kg','khoi-luong','may-giat');
/*!40000 ALTER TABLE `speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` int NOT NULL,
  `usercode` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `social_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sanho@gmail.com','$2y$10$2fo7Ygfb6gt42zUKYO9sPevibTLez1d71oI/RdgIIIh0fZTtI/AR2','Đỗ San Hô','0975817230','Hà nam',1,'san-ho','QT','lLfUEljwn6mIXXA1A3z5RhGWxhtzx9wy9q33vjPtgsBZpQvQfNGzuV1OQvjH',NULL),(2,'tahung@gmail.com','$2y$10$2fo7Ygfb6gt42zUKYO9sPevibTLez1d71oI/RdgIIIh0fZTtI/AR2','Tạ Phi Hùng','0834633495','Bắc Giang-Huyện Yên Thế-Xã Xuân Lương-',1,'ta-phi-hung','KH',NULL,NULL),(4,'tuanhieu00@gmail.com','$2y$10$38pKiQ1h8gxB.vOG94ZkL.8qolT0Gw5FMzaiK2PAKMC0r8K37STlO','Dương Tuấn Hiếu','0834633431','Hà Nội-Huyện Phú Xuyên-Xã Chuyên Mỹ-Đồng Vinh',1,'duong-tuan-hieu','KH',NULL,NULL),(5,'tuanhieu342k@gmail.com','$2y$10$FJV2t8jvP94vS9wUgB0AMu8I/ZW2Iz5jCcH9EZU6kjxmPvXM.AHIW','Hiếu Dương','0834633431','Hà Nội-Huyện Phú Xuyên-Xã Chuyên Mỹ-dong vinh',1,'hieu-duong','KH',NULL,'109048871962063870975'),(6,'tuanhieu342000@gmail.com','$2y$10$DSGfxJFuXPWFnaBMglSGW.rvvSsS9szpiuibGCH2uclQd/mF4MDqG','Dương Tuấn Hiếu','0834633431','Hà Nội-Huyện Phú Xuyên-Xã Chuyên Mỹ-Đồng Vinh',1,'duong-tuan-hieu','KH',NULL,'107153489277396593430'),(10,'tuanhieu3400@gmail.com','$2y$10$wztZqTkKku5OFECbwV/YpuSFSOEqBliue27kwe5SSlsxSvsPpCpB6','Hiếu','0834633431',NULL,1,'hieu','KH',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_role`
--

DROP TABLE IF EXISTS `users_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_role` (
  `user_id` bigint NOT NULL,
  `role_id` bigint NOT NULL,
  KEY `fk_users_role` (`user_id`),
  KEY `fk_role_users` (`role_id`),
  CONSTRAINT `fk_role_users` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_role`
--

LOCK TABLES `users_role` WRITE;
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` VALUES (1,3),(2,1),(4,1),(5,1),(6,1),(10,1);
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-17 23:45:49