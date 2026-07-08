-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: telkomsel-inventory-db.mysql.database.azure.com    Database: telkomsel_inventory
-- ------------------------------------------------------
-- Server version	8.0.44-azure

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'create','categories','Menambahkan kategori baru: Spare Device','{\"id\": 1, \"name\": \"Spare Device\", \"created_at\": \"2026-07-04T15:38:33.000000Z\", \"updated_at\": \"2026-07-04T15:38:33.000000Z\", \"description\": \"Perangkat cadangan untuk kebutuhan darurat.\"}','2026-07-04 15:38:33','2026-07-04 15:38:33'),(2,1,'create','categories','Menambahkan kategori baru: Laptop','{\"id\": 2, \"name\": \"Laptop\", \"created_at\": \"2026-07-04T15:38:50.000000Z\", \"updated_at\": \"2026-07-04T15:38:50.000000Z\", \"description\": \"Perangkat laptop untuk kebutuhan operasional kantor.\"}','2026-07-04 15:38:50','2026-07-04 15:38:50'),(3,1,'create','categories','Menambahkan kategori baru: Monitor','{\"id\": 3, \"name\": \"Monitor\", \"created_at\": \"2026-07-04T15:39:13.000000Z\", \"updated_at\": \"2026-07-04T15:39:13.000000Z\", \"description\": \"Layar monitor untuk workstation dan ruang kerja.\"}','2026-07-04 15:39:13','2026-07-04 15:39:13'),(4,1,'create','categories','Menambahkan kategori baru: Access Point','{\"id\": 4, \"name\": \"Access Point\", \"created_at\": \"2026-07-04T15:39:31.000000Z\", \"updated_at\": \"2026-07-04T15:39:31.000000Z\", \"description\": \"Perangkat jaringan wireless kantor.\"}','2026-07-04 15:39:31','2026-07-04 15:39:31'),(5,1,'create','categories','Menambahkan kategori baru: Switch','{\"id\": 5, \"name\": \"Switch\", \"created_at\": \"2026-07-04T15:39:42.000000Z\", \"updated_at\": \"2026-07-04T15:39:42.000000Z\", \"description\": \"Perangkat jaringan untuk distribusi koneksi LAN.\"}','2026-07-04 15:39:42','2026-07-04 15:39:42'),(6,1,'create','categories','Menambahkan kategori baru: Router','{\"id\": 6, \"name\": \"Router\", \"created_at\": \"2026-07-04T15:39:59.000000Z\", \"updated_at\": \"2026-07-04T15:39:59.000000Z\", \"description\": \"Perangkat jaringan untuk koneksi internet.\"}','2026-07-04 15:39:59','2026-07-04 15:39:59'),(7,1,'create','categories','Menambahkan kategori baru: Kabel dan Adapter','{\"id\": 7, \"name\": \"Kabel dan Adapter\", \"created_at\": \"2026-07-04T15:40:15.000000Z\", \"updated_at\": \"2026-07-04T15:40:15.000000Z\", \"description\": \"Perlengkapan kabel, charger, dan adapter.\"}','2026-07-04 15:40:15','2026-07-04 15:40:15'),(8,1,'update','categories','Memperbarui kategori: Perlengkapan Kantor','{\"after\": {\"id\": 2, \"name\": \"Perlengkapan Kantor\", \"created_at\": \"2026-07-04T15:38:50.000000Z\", \"updated_at\": \"2026-07-04T15:44:51.000000Z\", \"description\": \"Peralatan pendukung kegiatan kerja dan operasional kantor.\"}, \"before\": {\"id\": 2, \"name\": \"Laptop\", \"created_at\": \"2026-07-04T15:38:50.000000Z\", \"updated_at\": \"2026-07-04T15:38:50.000000Z\", \"description\": \"Perangkat laptop untuk kebutuhan operasional kantor.\"}}','2026-07-04 15:44:51','2026-07-04 15:44:51'),(9,1,'update','categories','Memperbarui kategori: ATK','{\"after\": {\"id\": 3, \"name\": \"ATK\", \"created_at\": \"2026-07-04T15:39:13.000000Z\", \"updated_at\": \"2026-07-04T15:45:14.000000Z\", \"description\": \"Alat tulis dan perlengkapan administrasi.\"}, \"before\": {\"id\": 3, \"name\": \"Monitor\", \"created_at\": \"2026-07-04T15:39:13.000000Z\", \"updated_at\": \"2026-07-04T15:39:13.000000Z\", \"description\": \"Layar monitor untuk workstation dan ruang kerja.\"}}','2026-07-04 15:45:14','2026-07-04 15:45:14'),(10,1,'update','categories','Memperbarui kategori: Elektronik','{\"after\": {\"id\": 6, \"name\": \"Elektronik\", \"created_at\": \"2026-07-04T15:39:59.000000Z\", \"updated_at\": \"2026-07-04T15:45:34.000000Z\", \"description\": \"Perangkat elektronik pendukung operasional kantor.\"}, \"before\": {\"id\": 6, \"name\": \"Router\", \"created_at\": \"2026-07-04T15:39:59.000000Z\", \"updated_at\": \"2026-07-04T15:39:59.000000Z\", \"description\": \"Perangkat jaringan untuk koneksi internet.\"}}','2026-07-04 15:45:34','2026-07-04 15:45:34'),(11,1,'update','categories','Memperbarui kategori: Komputer dan Laptop','{\"after\": {\"id\": 5, \"name\": \"Komputer dan Laptop\", \"created_at\": \"2026-07-04T15:39:42.000000Z\", \"updated_at\": \"2026-07-04T15:45:54.000000Z\", \"description\": \"Perangkat komputer, laptop, monitor, dan perlengkapan kerja digital.\"}, \"before\": {\"id\": 5, \"name\": \"Switch\", \"created_at\": \"2026-07-04T15:39:42.000000Z\", \"updated_at\": \"2026-07-04T15:39:42.000000Z\", \"description\": \"Perangkat jaringan untuk distribusi koneksi LAN.\"}}','2026-07-04 15:45:54','2026-07-04 15:45:54'),(12,1,'update','categories','Memperbarui kategori: Jaringan','{\"after\": {\"id\": 4, \"name\": \"Jaringan\", \"created_at\": \"2026-07-04T15:39:31.000000Z\", \"updated_at\": \"2026-07-04T15:46:53.000000Z\", \"description\": \"Perangkat pendukung koneksi internet dan jaringan kantor.\"}, \"before\": {\"id\": 4, \"name\": \"Access Point\", \"created_at\": \"2026-07-04T15:39:31.000000Z\", \"updated_at\": \"2026-07-04T15:39:31.000000Z\", \"description\": \"Perangkat jaringan wireless kantor.\"}}','2026-07-04 15:46:53','2026-07-04 15:46:53'),(13,1,'create','categories','Menambahkan kategori baru: Audio Visual','{\"id\": 8, \"name\": \"Audio Visual\", \"created_at\": \"2026-07-04T15:47:11.000000Z\", \"updated_at\": \"2026-07-04T15:47:11.000000Z\", \"description\": \"Perangkat audio, kamera, proyektor, dan kebutuhan meeting.\"}','2026-07-04 15:47:11','2026-07-04 15:47:11'),(14,1,'create','products','Menambahkan barang baru: Lenovo ThinkPad E14 Gen 5','{\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/STCctk3Us8ecrw3Nj8v6pKA86NY1WcEiUo7oKK8E.jpg\", \"stock\": \"8\", \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-04T15:48:14.000000Z\", \"category_id\": \"5\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-04 15:48:14','2026-07-04 15:48:14'),(15,1,'update','products','Memperbarui data barang: Lenovo ThinkPad E14 Gen 5','{\"after\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/5YxLZO9EDUpCov0syqLHyNfnhSA0NStN5u4F0z5n.jpg\", \"stock\": 8, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-04T15:49:09.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/STCctk3Us8ecrw3Nj8v6pKA86NY1WcEiUo7oKK8E.jpg\", \"stock\": 8, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-04T15:48:14.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-04 15:49:09','2026-07-04 15:49:09'),(16,1,'create','products','Menambahkan barang baru: HP ProBook 440 G9','{\"id\": 2, \"code\": \"KOM-0002\", \"name\": \"HP ProBook 440 G9\", \"image\": \"products/UsR7D5M4ALSXaiISqfKcTg6AQZg1Cvd6qIJwm38z.jpg\", \"stock\": \"6\", \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:50:36.000000Z\", \"updated_at\": \"2026-07-04T15:50:36.000000Z\", \"category_id\": \"5\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-04 15:50:36','2026-07-04 15:50:36'),(17,1,'create','products','Menambahkan barang baru: Dell OptiPlex 3000 Micro','{\"id\": 3, \"code\": \"KOM-0003\", \"name\": \"Dell OptiPlex 3000 Micro\", \"image\": \"products/tTv9vpKmjRaHUwmGcCUrqIcY6ipIqd4idGpZhGGC.jpg\", \"stock\": \"5\", \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:51:21.000000Z\", \"updated_at\": \"2026-07-04T15:51:21.000000Z\", \"category_id\": \"5\", \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}','2026-07-04 15:51:21','2026-07-04 15:51:21'),(18,1,'create','products','Menambahkan barang baru: Samsung Monitor 24 Inch','{\"id\": 4, \"code\": \"KOM-0004\", \"name\": \"Samsung Monitor 24 Inch\", \"image\": \"products/iR4ML7QCqnVUg3cVfW2gDAyxPURoIzQCh0sNtICa.jpg\", \"stock\": \"10\", \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:52:26.000000Z\", \"updated_at\": \"2026-07-04T15:52:26.000000Z\", \"category_id\": \"5\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-04 15:52:26','2026-07-04 15:52:26'),(19,1,'update','categories','Memperbarui kategori: Networking Device','{\"after\": {\"id\": 4, \"name\": \"Networking Device\", \"created_at\": \"2026-07-04T15:39:31.000000Z\", \"updated_at\": \"2026-07-04T15:54:12.000000Z\", \"description\": \"Perangkat pendukung koneksi internet dan jaringan kantor.\"}, \"before\": {\"id\": 4, \"name\": \"Jaringan\", \"created_at\": \"2026-07-04T15:39:31.000000Z\", \"updated_at\": \"2026-07-04T15:46:53.000000Z\", \"description\": \"Perangkat pendukung koneksi internet dan jaringan kantor.\"}}','2026-07-04 15:54:12','2026-07-04 15:54:12'),(20,1,'create','products','Menambahkan barang baru: MikroTik Router hAP ac2','{\"id\": 5, \"code\": \"NET-0001\", \"name\": \"MikroTik Router hAP ac2\", \"image\": \"products/cXGoihwh7oLnLPKlcVZ8XR9RD2DcejO13goaqecx.jpg\", \"stock\": \"4\", \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:56:06.000000Z\", \"updated_at\": \"2026-07-04T15:56:06.000000Z\", \"category_id\": \"4\", \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}','2026-07-04 15:56:06','2026-07-04 15:56:06'),(21,1,'create','products','Menambahkan barang baru: Cisco Switch 24 Port SG350','{\"id\": 6, \"code\": \"NET-0002\", \"name\": \"Cisco Switch 24 Port SG350\", \"image\": \"products/2FeGGamTHEMxweWuFKz2Zsjw6SvhStgkIhLMRhRS.jpg\", \"stock\": \"3\", \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:57:09.000000Z\", \"updated_at\": \"2026-07-04T15:57:09.000000Z\", \"category_id\": \"4\", \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}','2026-07-04 15:57:09','2026-07-04 15:57:09'),(22,1,'create','products','Menambahkan barang baru: TP-Link Access Point EAP225','{\"id\": 7, \"code\": \"NET-0003\", \"name\": \"TP-Link Access Point EAP225\", \"image\": \"products/IWdkYsDPMMlEBcswVQ53OMxj8QoDOWTnlW24oJKO.jpg\", \"stock\": \"7\", \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:58:52.000000Z\", \"updated_at\": \"2026-07-04T15:58:52.000000Z\", \"category_id\": \"4\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-04 15:58:52','2026-07-04 15:58:52'),(23,1,'create','products','Menambahkan barang baru: LAN Cable Tester ProKit','{\"id\": 8, \"code\": \"NET-0004\", \"name\": \"LAN Cable Tester ProKit\", \"image\": \"products/yLVPQl2OkdVPKAZx8YT6iDaOAlYK0e9mVzA61Z10.jpg\", \"stock\": \"6\", \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T16:00:00.000000Z\", \"updated_at\": \"2026-07-04T16:00:00.000000Z\", \"category_id\": \"4\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-04 16:00:00','2026-07-04 16:00:00'),(24,1,'create','borrowings','Mencatat peminjaman barang oleh: Ardiansyah Pratama','{\"product\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/5YxLZO9EDUpCov0syqLHyNfnhSA0NStN5u4F0z5n.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-04T15:49:09.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"quantity\": \"1\", \"borrowing\": {\"id\": 1, \"status\": \"borrowed\", \"division\": \"IT\", \"due_date\": \"2026-07-08T00:00:00.000000Z\", \"created_at\": \"2026-07-04T16:09:16.000000Z\", \"updated_at\": \"2026-07-04T16:09:16.000000Z\", \"borrow_date\": \"2026-07-01T00:00:00.000000Z\", \"borrower_name\": \"Ardiansyah Pratama\", \"display_status\": \"borrowed\", \"display_status_label\": \"Dipinjam\"}}','2026-07-04 16:09:16','2026-07-04 16:09:16'),(25,1,'create','products','Menambahkan barang baru: Pulpen Standard AE7','{\"id\": 9, \"code\": \"ATK-0001\", \"name\": \"Pulpen Standard AE7\", \"stock\": \"50\", \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-05T15:15:34.000000Z\", \"updated_at\": \"2026-07-05T15:15:34.000000Z\", \"category_id\": \"3\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-05 15:15:34','2026-07-05 15:15:34'),(26,1,'update','products','Memperbarui data barang: Pulpen Standard AE7','{\"after\": {\"id\": 9, \"code\": \"ATK-0001\", \"name\": \"Pulpen Standard AE7\", \"image\": \"products/xRUSmLUUs2UpdGUSXMkmMZL4lJGKWebPLrBfjtsB.png\", \"stock\": 50, \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-05T15:15:34.000000Z\", \"updated_at\": \"2026-07-05T15:18:11.000000Z\", \"category_id\": 3, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 9, \"code\": \"ATK-0001\", \"name\": \"Pulpen Standard AE7\", \"image\": null, \"stock\": 50, \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-05T15:15:34.000000Z\", \"updated_at\": \"2026-07-05T15:15:34.000000Z\", \"category_id\": 3, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-05 15:18:11','2026-07-05 15:18:11'),(27,1,'update','products','Memperbarui data barang: Pulpen Standard AE7','{\"after\": {\"id\": 9, \"code\": \"ATK-0001\", \"name\": \"Pulpen Standard AE7\", \"image\": \"products/MYlVIZQMfeTj4UUPPZcQwsjjJw6UUKuivhaHoV31.jpg\", \"stock\": 50, \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-05T15:15:34.000000Z\", \"updated_at\": \"2026-07-06T09:57:17.000000Z\", \"category_id\": 3, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 9, \"code\": \"ATK-0001\", \"name\": \"Pulpen Standard AE7\", \"image\": \"products/xRUSmLUUs2UpdGUSXMkmMZL4lJGKWebPLrBfjtsB.png\", \"stock\": 50, \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-05T15:15:34.000000Z\", \"updated_at\": \"2026-07-05T15:18:11.000000Z\", \"category_id\": 3, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 09:57:17','2026-07-06 09:57:17'),(28,1,'update','products','Memperbarui data barang: Lenovo ThinkPad E14 Gen 5','{\"after\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/kUIYLJpfM7g9s5VSYZsNRp2rqJG65Z45vleO7OoE.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T09:57:47.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/5YxLZO9EDUpCov0syqLHyNfnhSA0NStN5u4F0z5n.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-04T16:09:16.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 09:57:47','2026-07-06 09:57:47'),(29,1,'update','products','Memperbarui data barang: Lenovo ThinkPad E14 Gen 5','{\"after\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/FQi8iRt3JoPR9SgINSHzdirb0hqm9TC03qFjD90d.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T09:58:10.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/kUIYLJpfM7g9s5VSYZsNRp2rqJG65Z45vleO7OoE.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T09:57:47.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 09:58:10','2026-07-06 09:58:10'),(30,1,'update','products','Memperbarui data barang: Lenovo ThinkPad E14 Gen 5','{\"after\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/SLWZZqTwBDRMJ3n7PGUMKuXRkiwW77ZrbYLxvAYP.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T10:08:34.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/FQi8iRt3JoPR9SgINSHzdirb0hqm9TC03qFjD90d.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T09:58:10.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 10:08:34','2026-07-06 10:08:34'),(31,1,'update','products','Memperbarui data barang: HP ProBook 440 G9','{\"after\": {\"id\": 2, \"code\": \"KOM-0002\", \"name\": \"HP ProBook 440 G9\", \"image\": \"products/uzw1ocVGUJfistQ0AvJytFQpx2dH6axnaUlpSZND.jpg\", \"stock\": 6, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:50:36.000000Z\", \"updated_at\": \"2026-07-06T10:10:12.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 2, \"code\": \"KOM-0002\", \"name\": \"HP ProBook 440 G9\", \"image\": \"products/UsR7D5M4ALSXaiISqfKcTg6AQZg1Cvd6qIJwm38z.jpg\", \"stock\": 6, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:50:36.000000Z\", \"updated_at\": \"2026-07-04T15:50:36.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 10:10:12','2026-07-06 10:10:12'),(32,1,'update','products','Memperbarui data barang: Dell OptiPlex 3000 Micro','{\"after\": {\"id\": 3, \"code\": \"KOM-0003\", \"name\": \"Dell OptiPlex 3000 Micro\", \"image\": \"products/fxhTVoaQI0Kg8rmKVa88br9UWeVDJrxLBDEUKUv7.jpg\", \"stock\": 5, \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:51:21.000000Z\", \"updated_at\": \"2026-07-06T10:11:49.000000Z\", \"category_id\": 5, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"before\": {\"id\": 3, \"code\": \"KOM-0003\", \"name\": \"Dell OptiPlex 3000 Micro\", \"image\": \"products/tTv9vpKmjRaHUwmGcCUrqIcY6ipIqd4idGpZhGGC.jpg\", \"stock\": 5, \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:51:21.000000Z\", \"updated_at\": \"2026-07-04T15:51:21.000000Z\", \"category_id\": 5, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}}','2026-07-06 10:11:49','2026-07-06 10:11:49'),(33,1,'update','products','Memperbarui data barang: Dell OptiPlex 3000 Micro','{\"after\": {\"id\": 3, \"code\": \"KOM-0003\", \"name\": \"Dell OptiPlex 3000 Micro\", \"image\": \"products/fP6XAtQhbhLiAddgXp1L46TtMNcExL7alWpIlEld.jpg\", \"stock\": 5, \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:51:21.000000Z\", \"updated_at\": \"2026-07-06T10:11:53.000000Z\", \"category_id\": 5, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"before\": {\"id\": 3, \"code\": \"KOM-0003\", \"name\": \"Dell OptiPlex 3000 Micro\", \"image\": \"products/fxhTVoaQI0Kg8rmKVa88br9UWeVDJrxLBDEUKUv7.jpg\", \"stock\": 5, \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:51:21.000000Z\", \"updated_at\": \"2026-07-06T10:11:49.000000Z\", \"category_id\": 5, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}}','2026-07-06 10:11:53','2026-07-06 10:11:53'),(34,1,'update','products','Memperbarui data barang: Lenovo ThinkPad E14 Gen 5','{\"after\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/5nYrs26U1cwKlAYdXrRrxmicGcMHIATdWwu1HWOS.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T10:12:27.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/SLWZZqTwBDRMJ3n7PGUMKuXRkiwW77ZrbYLxvAYP.jpg\", \"stock\": 7, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T10:08:34.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 10:12:27','2026-07-06 10:12:27'),(35,1,'update','products','Memperbarui data barang: Samsung Monitor 24 Inch','{\"after\": {\"id\": 4, \"code\": \"KOM-0004\", \"name\": \"Samsung Monitor 24 Inch\", \"image\": \"products/XC2LkXqKNigu5F0PmM7gCfpcyKXLVhAMBBdK7YlN.jpg\", \"stock\": 10, \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:52:26.000000Z\", \"updated_at\": \"2026-07-06T10:22:36.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 4, \"code\": \"KOM-0004\", \"name\": \"Samsung Monitor 24 Inch\", \"image\": \"products/iR4ML7QCqnVUg3cVfW2gDAyxPURoIzQCh0sNtICa.jpg\", \"stock\": 10, \"location\": \"Gudang Utama\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:52:26.000000Z\", \"updated_at\": \"2026-07-04T15:52:26.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 10:22:36','2026-07-06 10:22:36'),(36,1,'update','products','Memperbarui data barang: MikroTik Router hAP ac2','{\"after\": {\"id\": 5, \"code\": \"NET-0001\", \"name\": \"MikroTik Router hAP ac2\", \"image\": \"products/wPOgdaN9yjmU5LDpA9Cc52gQhNTEKV0XJpYgEqrQ.jpg\", \"stock\": 4, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:56:06.000000Z\", \"updated_at\": \"2026-07-06T10:23:15.000000Z\", \"category_id\": 4, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"before\": {\"id\": 5, \"code\": \"NET-0001\", \"name\": \"MikroTik Router hAP ac2\", \"image\": \"products/cXGoihwh7oLnLPKlcVZ8XR9RD2DcejO13goaqecx.jpg\", \"stock\": 4, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:56:06.000000Z\", \"updated_at\": \"2026-07-04T15:56:06.000000Z\", \"category_id\": 4, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}}','2026-07-06 10:23:15','2026-07-06 10:23:15'),(37,1,'update','products','Memperbarui data barang: Cisco Switch 24 Port SG350','{\"after\": {\"id\": 6, \"code\": \"NET-0002\", \"name\": \"Cisco Switch 24 Port SG350\", \"image\": \"products/NJqziLv3zuyrThbNHhlxEHRWARPceXmNLOL4nB3t.jpg\", \"stock\": 3, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:57:09.000000Z\", \"updated_at\": \"2026-07-06T10:23:30.000000Z\", \"category_id\": 4, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"before\": {\"id\": 6, \"code\": \"NET-0002\", \"name\": \"Cisco Switch 24 Port SG350\", \"image\": \"products/2FeGGamTHEMxweWuFKz2Zsjw6SvhStgkIhLMRhRS.jpg\", \"stock\": 3, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:57:09.000000Z\", \"updated_at\": \"2026-07-04T15:57:09.000000Z\", \"category_id\": 4, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}}','2026-07-06 10:23:30','2026-07-06 10:23:30'),(38,1,'update','products','Memperbarui data barang: TP-Link Access Point EAP225','{\"after\": {\"id\": 7, \"code\": \"NET-0003\", \"name\": \"TP-Link Access Point EAP225\", \"image\": \"products/RFpwfJ1Jobwp6NvpdQxPMimk3A4R4INV1mKSAiJc.jpg\", \"stock\": 7, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:58:52.000000Z\", \"updated_at\": \"2026-07-06T10:23:57.000000Z\", \"category_id\": 4, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 7, \"code\": \"NET-0003\", \"name\": \"TP-Link Access Point EAP225\", \"image\": \"products/IWdkYsDPMMlEBcswVQ53OMxj8QoDOWTnlW24oJKO.jpg\", \"stock\": 7, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:58:52.000000Z\", \"updated_at\": \"2026-07-04T15:58:52.000000Z\", \"category_id\": 4, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 10:23:57','2026-07-06 10:23:57'),(39,1,'create','products','Menambahkan barang baru: Epson Projector EB-X500','{\"id\": 10, \"code\": \"AUD-0001\", \"name\": \"Epson Projector EB-X500\", \"image\": \"products/0qP4QEhSz2or8tZPHaeCg1lOjnxAruNeA4gATJBG.jpg\", \"stock\": \"5\", \"location\": \"Ruang Meeting\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:25:51.000000Z\", \"updated_at\": \"2026-07-06T10:25:51.000000Z\", \"category_id\": \"8\", \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}','2026-07-06 10:25:51','2026-07-06 10:25:51'),(40,1,'create','products','Menambahkan barang baru: Logitech Rally Speaker','{\"id\": 11, \"code\": \"Membuat kode...\", \"name\": \"Logitech Rally Speaker\", \"image\": \"products/Dm7DN24f6GVbxPkik413caP149YVslLGIdhKqBXy.jpg\", \"stock\": \"6\", \"location\": \"Ruang Meeting\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:27:38.000000Z\", \"updated_at\": \"2026-07-06T10:27:38.000000Z\", \"category_id\": \"8\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-06 10:27:40','2026-07-06 10:27:40'),(41,1,'update','products','Memperbarui data barang: LAN Cable Tester ProKit','{\"after\": {\"id\": 8, \"code\": \"NET-0004\", \"name\": \"LAN Cable Tester ProKit\", \"image\": \"products/sVi9ZiOUHpAfqqHgtzvI3oYf4bpMLIF7gqSdAUmn.jpg\", \"stock\": 6, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T16:00:00.000000Z\", \"updated_at\": \"2026-07-06T10:28:38.000000Z\", \"category_id\": 4, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 8, \"code\": \"NET-0004\", \"name\": \"LAN Cable Tester ProKit\", \"image\": \"products/yLVPQl2OkdVPKAZx8YT6iDaOAlYK0e9mVzA61Z10.jpg\", \"stock\": 6, \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T16:00:00.000000Z\", \"updated_at\": \"2026-07-04T16:00:00.000000Z\", \"category_id\": 4, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}}','2026-07-06 10:28:38','2026-07-06 10:28:38'),(42,1,'create','products','Menambahkan barang baru: Canon LBP6030 Printer','{\"id\": 12, \"code\": \"ELE-0001\", \"name\": \"Canon LBP6030 Printer\", \"image\": \"products/8o0VAzMaJL0RcnWHSrTEngD0r8YC7GmAIxteZxZe.jpg\", \"stock\": \"8\", \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:31:10.000000Z\", \"updated_at\": \"2026-07-06T10:31:10.000000Z\", \"category_id\": \"6\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-06 10:31:10','2026-07-06 10:31:10'),(43,1,'delete','products','Menghapus barang: Logitech Rally Speaker','{\"id\": 11, \"code\": \"Membuat kode...\", \"name\": \"Logitech Rally Speaker\", \"image\": \"products/Dm7DN24f6GVbxPkik413caP149YVslLGIdhKqBXy.jpg\", \"stock\": 6, \"location\": \"Ruang Meeting\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:27:38.000000Z\", \"updated_at\": \"2026-07-06T10:27:38.000000Z\", \"category_id\": 8, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-06 10:31:43','2026-07-06 10:31:43'),(44,1,'create','products','Menambahkan barang baru: Logitech Rally Speaker','{\"id\": 13, \"code\": \"AUD-0002\", \"name\": \"Logitech Rally Speaker\", \"image\": \"products/5ujXeg4Om0bbBFaR8h97dRPslEaSqXAitZjFoShG.jpg\", \"stock\": \"6\", \"location\": \"Ruang Meeting\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:32:14.000000Z\", \"updated_at\": \"2026-07-06T10:32:14.000000Z\", \"category_id\": \"8\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-06 10:32:15','2026-07-06 10:32:15'),(45,1,'create','borrowings','Mencatat peminjaman barang oleh: Dimas Pratama','{\"product\": {\"id\": 13, \"code\": \"AUD-0002\", \"name\": \"Logitech Rally Speaker\", \"image\": \"products/5ujXeg4Om0bbBFaR8h97dRPslEaSqXAitZjFoShG.jpg\", \"stock\": 4, \"location\": \"Ruang Meeting\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:32:14.000000Z\", \"updated_at\": \"2026-07-06T10:32:14.000000Z\", \"category_id\": 8, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"quantity\": \"2\", \"borrowing\": {\"id\": 2, \"status\": \"borrowed\", \"division\": \"IT\", \"due_date\": \"2026-02-07T00:00:00.000000Z\", \"created_at\": \"2026-07-06T10:34:31.000000Z\", \"updated_at\": \"2026-07-06T10:34:31.000000Z\", \"borrow_date\": \"2026-02-03T00:00:00.000000Z\", \"borrower_name\": \"Dimas Pratama\", \"display_status\": \"overdue\", \"display_status_label\": \"Terlambat\"}}','2026-07-06 10:34:31','2026-07-06 10:34:31'),(46,1,'return','borrowings','Mencatat pengembalian barang oleh: Dimas Pratama','{\"borrowing\": {\"id\": 2, \"status\": \"returned\", \"division\": \"IT\", \"due_date\": \"2026-02-07T00:00:00.000000Z\", \"created_at\": \"2026-07-06T10:34:31.000000Z\", \"updated_at\": \"2026-07-06T10:34:49.000000Z\", \"borrow_date\": \"2026-02-03T00:00:00.000000Z\", \"return_date\": \"2026-07-06T00:00:00.000000Z\", \"return_note\": \"Dikembalikan lengkap\", \"borrower_name\": \"Dimas Pratama\", \"display_status\": \"returned\", \"return_condition\": \"Baik\", \"display_status_label\": \"Dikembalikan\"}, \"return_note\": \"Dikembalikan lengkap\", \"return_condition\": \"Baik\"}','2026-07-06 10:34:49','2026-07-06 10:34:49'),(47,1,'create','borrowings','Mencatat peminjaman barang oleh: Nadia Putri','{\"product\": {\"id\": 1, \"code\": \"KOM-0001\", \"name\": \"Lenovo ThinkPad E14 Gen 5\", \"image\": \"products/5nYrs26U1cwKlAYdXrRrxmicGcMHIATdWwu1HWOS.jpg\", \"stock\": 6, \"location\": \"Ruang IT\", \"condition\": \"Baik\", \"created_at\": \"2026-07-04T15:48:14.000000Z\", \"updated_at\": \"2026-07-06T10:12:27.000000Z\", \"category_id\": 5, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"quantity\": \"1\", \"borrowing\": {\"id\": 3, \"status\": \"borrowed\", \"division\": \"Finance\", \"due_date\": \"2026-02-14T00:00:00.000000Z\", \"created_at\": \"2026-07-06T10:36:16.000000Z\", \"updated_at\": \"2026-07-06T10:36:16.000000Z\", \"borrow_date\": \"2026-02-10T00:00:00.000000Z\", \"borrower_name\": \"Nadia Putri\", \"display_status\": \"overdue\", \"display_status_label\": \"Terlambat\"}}','2026-07-06 10:36:16','2026-07-06 10:36:16'),(48,1,'return','borrowings','Mencatat pengembalian barang oleh: Nadia Putri','{\"borrowing\": {\"id\": 3, \"status\": \"returned\", \"division\": \"Finance\", \"due_date\": \"2026-02-14T00:00:00.000000Z\", \"created_at\": \"2026-07-06T10:36:16.000000Z\", \"updated_at\": \"2026-07-06T10:36:34.000000Z\", \"borrow_date\": \"2026-02-10T00:00:00.000000Z\", \"return_date\": \"2026-07-06T00:00:00.000000Z\", \"return_note\": \"Digunakan untuk audit internal.\", \"borrower_name\": \"Nadia Putri\", \"display_status\": \"returned\", \"return_condition\": \"Baik\", \"display_status_label\": \"Dikembalikan\"}, \"return_note\": \"Digunakan untuk audit internal.\", \"return_condition\": \"Baik\"}','2026-07-06 10:36:34','2026-07-06 10:36:34'),(49,1,'create','borrowings','Mencatat peminjaman barang oleh: Rizky Maulana','{\"product\": {\"id\": 10, \"code\": \"AUD-0001\", \"name\": \"Epson Projector EB-X500\", \"image\": \"products/0qP4QEhSz2or8tZPHaeCg1lOjnxAruNeA4gATJBG.jpg\", \"stock\": 4, \"location\": \"Ruang Meeting\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T10:25:51.000000Z\", \"updated_at\": \"2026-07-06T10:25:51.000000Z\", \"category_id\": 8, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"quantity\": \"1\", \"borrowing\": {\"id\": 4, \"status\": \"borrowed\", \"division\": \"Marketing\", \"due_date\": \"2026-02-24T00:00:00.000000Z\", \"created_at\": \"2026-07-06T10:37:44.000000Z\", \"updated_at\": \"2026-07-06T10:37:44.000000Z\", \"borrow_date\": \"2026-02-21T00:00:00.000000Z\", \"borrower_name\": \"Rizky Maulana\", \"display_status\": \"overdue\", \"display_status_label\": \"Terlambat\"}}','2026-07-06 10:37:44','2026-07-06 10:37:44'),(50,1,'return','borrowings','Mencatat pengembalian barang oleh: Rizky Maulana','{\"borrowing\": {\"id\": 4, \"status\": \"returned\", \"division\": \"Marketing\", \"due_date\": \"2026-02-24T00:00:00.000000Z\", \"created_at\": \"2026-07-06T10:37:44.000000Z\", \"updated_at\": \"2026-07-06T10:38:14.000000Z\", \"borrow_date\": \"2026-02-21T00:00:00.000000Z\", \"return_date\": \"2026-07-06T00:00:00.000000Z\", \"return_note\": \"Untuk meeting hybrid, barang lengkap\", \"borrower_name\": \"Rizky Maulana\", \"display_status\": \"returned\", \"return_condition\": \"Baik\", \"display_status_label\": \"Dikembalikan\"}, \"return_note\": \"Untuk meeting hybrid, barang lengkap\", \"return_condition\": \"Baik\"}','2026-07-06 10:38:14','2026-07-06 10:38:14'),(51,1,'create','products','Menambahkan barang baru: Kabel HDMI 2 Meter','{\"id\": 14, \"code\": \"KAB-0001\", \"name\": \"Kabel HDMI 2 Meter\", \"image\": \"products/1F0DLXMTwixhDjwfne9OjWJwOVYwVlbnCDyejL4D.jpg\", \"stock\": \"30\", \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T11:14:12.000000Z\", \"updated_at\": \"2026-07-06T11:14:12.000000Z\", \"category_id\": \"7\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-06 11:14:12','2026-07-06 11:14:12'),(52,1,'create','products','Menambahkan barang baru: Adapter USB-C to HDMI','{\"id\": 15, \"code\": \"KAB-0002\", \"name\": \"Adapter USB-C to HDMI\", \"image\": \"products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg\", \"stock\": \"4\", \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T11:15:58.000000Z\", \"updated_at\": \"2026-07-06T11:15:58.000000Z\", \"category_id\": \"7\", \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}','2026-07-06 11:15:58','2026-07-06 11:15:58'),(53,1,'update','products','Memperbarui data barang: Adapter USB-C to HDMI','{\"after\": {\"id\": 15, \"code\": \"KAB-0002\", \"name\": \"Adapter USB-C to HDMI\", \"image\": \"products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg\", \"stock\": 4, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Rusak Ringan\", \"created_at\": \"2026-07-06T11:15:58.000000Z\", \"updated_at\": \"2026-07-06T11:16:13.000000Z\", \"category_id\": 7, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"before\": {\"id\": 15, \"code\": \"KAB-0002\", \"name\": \"Adapter USB-C to HDMI\", \"image\": \"products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg\", \"stock\": 4, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T11:15:58.000000Z\", \"updated_at\": \"2026-07-06T11:15:58.000000Z\", \"category_id\": 7, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}}','2026-07-06 11:16:13','2026-07-06 11:16:13'),(54,1,'update','products','Memperbarui data barang: Adapter USB-C to HDMI','{\"after\": {\"id\": 15, \"code\": \"KAB-0002\", \"name\": \"Adapter USB-C to HDMI\", \"image\": \"products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg\", \"stock\": 4, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T11:15:58.000000Z\", \"updated_at\": \"2026-07-06T11:16:43.000000Z\", \"category_id\": 7, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}, \"before\": {\"id\": 15, \"code\": \"KAB-0002\", \"name\": \"Adapter USB-C to HDMI\", \"image\": \"products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg\", \"stock\": 4, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Rusak Ringan\", \"created_at\": \"2026-07-06T11:15:58.000000Z\", \"updated_at\": \"2026-07-06T11:16:13.000000Z\", \"category_id\": 7, \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}}','2026-07-06 11:16:43','2026-07-06 11:16:43'),(55,1,'create','borrowings','Mencatat peminjaman barang oleh: Devia Tabina','{\"product\": {\"id\": 14, \"code\": \"KAB-0001\", \"name\": \"Kabel HDMI 2 Meter\", \"image\": \"products/1F0DLXMTwixhDjwfne9OjWJwOVYwVlbnCDyejL4D.jpg\", \"stock\": 29, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T11:14:12.000000Z\", \"updated_at\": \"2026-07-06T11:14:12.000000Z\", \"category_id\": 7, \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}, \"quantity\": \"1\", \"borrowing\": {\"id\": 5, \"status\": \"borrowed\", \"division\": \"Operations\", \"due_date\": \"2026-07-08T00:00:00.000000Z\", \"created_at\": \"2026-07-06T11:30:05.000000Z\", \"updated_at\": \"2026-07-06T11:30:05.000000Z\", \"borrow_date\": \"2026-07-06T00:00:00.000000Z\", \"borrower_name\": \"Devia Tabina\", \"display_status\": \"borrowed\", \"display_status_label\": \"Dipinjam\"}}','2026-07-06 11:30:05','2026-07-06 11:30:05'),(56,1,'create','products','Menambahkan barang baru: UPS APC 650VA','{\"id\": 16, \"code\": \"ELE-0002\", \"name\": \"UPS APC 650VA\", \"image\": \"products/wKUcq8GgzHFE3eI6i10JeoBb8I2SPv1MzLOhWEbo.jpg\", \"stock\": \"7\", \"location\": \"Ruang Server\", \"condition\": \"Baik\", \"created_at\": \"2026-07-07T16:49:11.000000Z\", \"updated_at\": \"2026-07-07T16:49:11.000000Z\", \"category_id\": \"6\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-07 16:49:12','2026-07-07 16:49:12'),(57,1,'create','products','Menambahkan barang baru: Tablet Samsung Tab A8','{\"id\": 17, \"code\": \"ELE-0003\", \"name\": \"Tablet Samsung Tab A8\", \"image\": \"products/AqCiGjT6SwZOtzrT589jRs3ePJLzVPfWYXFA7sSv.jpg\", \"stock\": \"2\", \"location\": \"Lemari Operasional\", \"condition\": \"Rusak Berat\", \"created_at\": \"2026-07-07T16:50:48.000000Z\", \"updated_at\": \"2026-07-07T16:50:48.000000Z\", \"category_id\": \"6\", \"stock_status\": \"low_stock\", \"stock_status_label\": \"Stok Menipis\"}','2026-07-07 16:50:48','2026-07-07 16:50:48'),(58,1,'create','products','Menambahkan barang baru: Kertas A4 Sinar Dunia','{\"id\": 18, \"code\": \"ATK-0002\", \"name\": \"Kertas A4 Sinar Dunia\", \"image\": \"products/7Sfv0AiVJAiMCZ7DPiok2lFdPSVvsPKbYuxn2jN1.jpg\", \"stock\": \"20\", \"location\": \"Ruang Administrasi\", \"condition\": \"Baik\", \"created_at\": \"2026-07-07T16:51:51.000000Z\", \"updated_at\": \"2026-07-07T16:51:51.000000Z\", \"category_id\": \"3\", \"stock_status\": \"available\", \"stock_status_label\": \"Tersedia\"}','2026-07-07 16:51:51','2026-07-07 16:51:51'),(59,1,'create','products','Menambahkan barang baru: Whiteboard Magnetic','{\"id\": 19, \"code\": \"PER-0001\", \"name\": \"Whiteboard Magnetic\", \"image\": \"products/zpqCY6INAaAbGLQr6ywPatA5Zsok5zIbUmPhfgrJ.jpg\", \"stock\": \"8\", \"location\": \"Ruang Meeting\", \"condition\": \"Rusak Ringan\", \"created_at\": \"2026-07-07T17:02:26.000000Z\", \"updated_at\": \"2026-07-07T17:02:26.000000Z\", \"category_id\": \"2\", \"stock_status\": \"damaged\", \"stock_status_label\": \"Perlu Perhatian\"}','2026-07-07 17:02:26','2026-07-07 17:02:26'),(60,1,'update','products','Memperbarui data barang: Whiteboard Magnetic','{\"after\": {\"id\": 19, \"code\": \"PER-0001\", \"name\": \"Whiteboard Magnetic\", \"image\": \"products/zpqCY6INAaAbGLQr6ywPatA5Zsok5zIbUmPhfgrJ.jpg\", \"stock\": 8, \"location\": \"Ruang Meeting\", \"condition\": \"Rusak Ringan\", \"created_at\": \"2026-07-07T17:02:26.000000Z\", \"good_stock\": 6, \"updated_at\": \"2026-07-07T17:48:42.000000Z\", \"category_id\": 2, \"stock_status\": \"damaged\", \"damaged_stock\": 2, \"available_stock\": 6, \"condition_summary\": \"Baik: 6 | Rusak Ringan: 2 | Rusak Berat: 0\", \"major_damage_stock\": 0, \"minor_damage_stock\": 2, \"stock_status_label\": \"Perlu Perhatian\"}, \"before\": {\"id\": 19, \"code\": \"PER-0001\", \"name\": \"Whiteboard Magnetic\", \"image\": \"products/zpqCY6INAaAbGLQr6ywPatA5Zsok5zIbUmPhfgrJ.jpg\", \"stock\": 8, \"location\": \"Ruang Meeting\", \"condition\": \"Rusak Ringan\", \"created_at\": \"2026-07-07T17:02:26.000000Z\", \"good_stock\": 8, \"updated_at\": \"2026-07-07T17:02:26.000000Z\", \"category_id\": 2, \"stock_status\": \"damaged\", \"damaged_stock\": 0, \"available_stock\": 8, \"condition_summary\": \"Baik: 8 | Rusak Ringan: 0 | Rusak Berat: 0\", \"major_damage_stock\": 0, \"minor_damage_stock\": 0, \"stock_status_label\": \"Perlu Perhatian\"}}','2026-07-07 17:48:42','2026-07-07 17:48:42'),(61,1,'create','products','Menambahkan barang baru: Kursi Meeting Lipat','{\"id\": 20, \"code\": \"PER-0002\", \"name\": \"Kursi Meeting Lipat\", \"stock\": 30, \"location\": \"Gudang Utama\", \"condition\": \"Rusak Berat\", \"created_at\": \"2026-07-08T09:37:33.000000Z\", \"good_stock\": 20, \"updated_at\": \"2026-07-08T09:37:33.000000Z\", \"category_id\": \"2\", \"stock_status\": \"available\", \"damaged_stock\": 10, \"available_stock\": 20, \"condition_summary\": \"Baik: 20 | Rusak Ringan: 7 | Rusak Berat: 3\", \"major_damage_stock\": 3, \"minor_damage_stock\": 7, \"stock_status_label\": \"Tersedia\"}','2026-07-08 09:37:33','2026-07-08 09:37:33'),(62,1,'update','products','Memperbarui data barang: Kursi Meeting Lipat','{\"after\": {\"id\": 20, \"code\": \"PER-0002\", \"name\": \"Kursi Meeting Lipat\", \"image\": \"products/pYCREt6HgS5rzucjVy8UCsKzpU6cVtNnmdebQuW4.jpg\", \"stock\": 30, \"location\": \"Gudang Utama\", \"condition\": \"Rusak Berat\", \"created_at\": \"2026-07-08T09:37:33.000000Z\", \"good_stock\": 20, \"updated_at\": \"2026-07-08T09:37:51.000000Z\", \"category_id\": 2, \"stock_status\": \"available\", \"damaged_stock\": 10, \"available_stock\": 20, \"condition_summary\": \"Baik: 20 | Rusak Ringan: 7 | Rusak Berat: 3\", \"major_damage_stock\": 3, \"minor_damage_stock\": 7, \"stock_status_label\": \"Tersedia\"}, \"before\": {\"id\": 20, \"code\": \"PER-0002\", \"name\": \"Kursi Meeting Lipat\", \"image\": null, \"stock\": 30, \"location\": \"Gudang Utama\", \"condition\": \"Rusak Berat\", \"created_at\": \"2026-07-08T09:37:33.000000Z\", \"good_stock\": 20, \"updated_at\": \"2026-07-08T09:37:33.000000Z\", \"category_id\": 2, \"stock_status\": \"available\", \"damaged_stock\": 10, \"available_stock\": 20, \"condition_summary\": \"Baik: 20 | Rusak Ringan: 7 | Rusak Berat: 3\", \"major_damage_stock\": 3, \"minor_damage_stock\": 7, \"stock_status_label\": \"Tersedia\"}}','2026-07-08 09:37:51','2026-07-08 09:37:51'),(63,1,'create','products','Menambahkan barang baru: Laptop Cadangan Asus A416','{\"id\": 21, \"code\": \"SPA-0001\", \"name\": \"Laptop Cadangan Asus A416\", \"image\": \"products/JNik8tFL5sy9GcyFrVoIi3QtFEHNfj41taPGU3dY.jpg\", \"stock\": 6, \"location\": \"Gudang IT Lt.3\", \"condition\": \"Rusak Berat\", \"created_at\": \"2026-07-08T09:39:52.000000Z\", \"good_stock\": 5, \"updated_at\": \"2026-07-08T09:39:52.000000Z\", \"category_id\": \"1\", \"stock_status\": \"low_stock\", \"damaged_stock\": 1, \"available_stock\": 5, \"condition_summary\": \"Baik: 5 | Rusak Ringan: 0 | Rusak Berat: 1\", \"major_damage_stock\": 1, \"minor_damage_stock\": 0, \"stock_status_label\": \"Stok Menipis\"}','2026-07-08 09:39:52','2026-07-08 09:39:52'),(64,1,'create','products','Menambahkan barang baru: HP Operasional Samsung A14','{\"id\": 22, \"code\": \"SPA-0002\", \"name\": \"HP Operasional Samsung A14\", \"image\": \"products/Ksyx8ErVu9xlk1azI0RPctlupJwtkTTyNtXbn8co.jpg\", \"stock\": 2, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-08T09:40:28.000000Z\", \"good_stock\": 2, \"updated_at\": \"2026-07-08T09:40:28.000000Z\", \"category_id\": \"1\", \"stock_status\": \"low_stock\", \"damaged_stock\": 0, \"available_stock\": 2, \"condition_summary\": \"Baik: 2 | Rusak Ringan: 0 | Rusak Berat: 0\", \"major_damage_stock\": 0, \"minor_damage_stock\": 0, \"stock_status_label\": \"Stok Menipis\"}','2026-07-08 09:40:28','2026-07-08 09:40:28'),(65,1,'create','products','Menambahkan barang baru: Webcam Cadangan Logitech C270','{\"id\": 23, \"code\": \"SPA-0003\", \"name\": \"Webcam Cadangan Logitech C270\", \"image\": \"products/p3lD3t6LBfcXdITSu9ujSCZjrwYVw9AZXRxyRSIN.jpg\", \"stock\": 0, \"location\": \"Gudang IT Lt.3\", \"condition\": \"Baik\", \"created_at\": \"2026-07-08T09:41:10.000000Z\", \"good_stock\": 0, \"updated_at\": \"2026-07-08T09:41:10.000000Z\", \"category_id\": \"1\", \"stock_status\": \"out_of_stock\", \"damaged_stock\": 0, \"available_stock\": 0, \"condition_summary\": \"Baik: 0 | Rusak Ringan: 0 | Rusak Berat: 0\", \"major_damage_stock\": 0, \"minor_damage_stock\": 0, \"stock_status_label\": \"Habis\"}','2026-07-08 09:41:10','2026-07-08 09:41:10'),(66,1,'create','products','Menambahkan barang baru: Mouse Wireless Logitech M185','{\"id\": 24, \"code\": \"ELE-0004\", \"name\": \"Mouse Wireless Logitech M185\", \"image\": \"products/9BfLwFdt7eenaeGnIk9zNS7Q003vidIFd8C4gQwP.jpg\", \"stock\": 4, \"location\": \"Gudang Utama\", \"condition\": \"Rusak Ringan\", \"created_at\": \"2026-07-08T09:45:02.000000Z\", \"good_stock\": 3, \"updated_at\": \"2026-07-08T09:45:02.000000Z\", \"category_id\": \"6\", \"stock_status\": \"low_stock\", \"damaged_stock\": 1, \"available_stock\": 3, \"condition_summary\": \"Baik: 3 | Rusak Ringan: 1 | Rusak Berat: 0\", \"major_damage_stock\": 0, \"minor_damage_stock\": 1, \"stock_status_label\": \"Stok Menipis\"}','2026-07-08 09:45:02','2026-07-08 09:45:02'),(67,2,'create','borrowings','Mencatat peminjaman barang oleh: Fajar Nugroho','{\"product\": {\"id\": 15, \"code\": \"KAB-0002\", \"name\": \"Adapter USB-C to HDMI\", \"image\": \"products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg\", \"stock\": 2, \"location\": \"Gudang IT Lt.1\", \"condition\": \"Baik\", \"created_at\": \"2026-07-06T11:15:58.000000Z\", \"good_stock\": 2, \"updated_at\": \"2026-07-08T12:20:20.000000Z\", \"category_id\": 7, \"stock_status\": \"low_stock\", \"damaged_stock\": 0, \"available_stock\": 2, \"condition_summary\": \"Baik: 2 | Rusak Ringan: 0 | Rusak Berat: 0\", \"major_damage_stock\": 0, \"minor_damage_stock\": 0, \"stock_status_label\": \"Stok Menipis\"}, \"quantity\": \"2\", \"borrowing\": {\"id\": 6, \"status\": \"borrowed\", \"division\": \"Human Resources\", \"due_date\": \"2026-03-15T00:00:00.000000Z\", \"created_at\": \"2026-07-08T12:20:20.000000Z\", \"updated_at\": \"2026-07-08T12:20:20.000000Z\", \"borrow_date\": \"2026-03-11T00:00:00.000000Z\", \"borrower_name\": \"Fajar Nugroho\", \"display_status\": \"overdue\", \"display_status_label\": \"Terlambat\"}}','2026-07-08 12:20:20','2026-07-08 12:20:20'),(68,2,'return','borrowings','Mencatat pengembalian barang oleh: Fajar Nugroho','{\"borrowing\": {\"id\": 6, \"status\": \"returned\", \"division\": \"Human Resources\", \"due_date\": \"2026-03-15T00:00:00.000000Z\", \"created_at\": \"2026-07-08T12:20:20.000000Z\", \"updated_at\": \"2026-07-08T12:20:52.000000Z\", \"borrow_date\": \"2026-03-11T00:00:00.000000Z\", \"return_date\": \"2026-07-08T00:00:00.000000Z\", \"return_note\": \"Dikembalikan lengkap\", \"borrower_name\": \"Fajar Nugroho\", \"display_status\": \"returned\", \"return_condition\": \"Baik\", \"display_status_label\": \"Dikembalikan\"}, \"return_note\": \"Dikembalikan lengkap\", \"return_condition\": \"Baik\"}','2026-07-08 12:20:52','2026-07-08 12:20:52'),(69,2,'create','borrowings','Mencatat peminjaman barang oleh: Citra Lestari','{\"product\": {\"id\": 21, \"code\": \"SPA-0001\", \"name\": \"Laptop Cadangan Asus A416\", \"image\": \"products/JNik8tFL5sy9GcyFrVoIi3QtFEHNfj41taPGU3dY.jpg\", \"stock\": 5, \"location\": \"Gudang IT Lt.3\", \"condition\": \"Rusak Berat\", \"created_at\": \"2026-07-08T09:39:52.000000Z\", \"good_stock\": 4, \"updated_at\": \"2026-07-08T12:43:05.000000Z\", \"category_id\": 1, \"stock_status\": \"low_stock\", \"damaged_stock\": 1, \"available_stock\": 4, \"condition_summary\": \"Baik: 4 | Rusak Ringan: 0 | Rusak Berat: 1\", \"major_damage_stock\": 1, \"minor_damage_stock\": 0, \"stock_status_label\": \"Stok Menipis\"}, \"quantity\": \"1\", \"borrowing\": {\"id\": 7, \"status\": \"borrowed\", \"division\": \"Customer Service\", \"due_date\": \"2026-04-28T00:00:00.000000Z\", \"created_at\": \"2026-07-08T12:43:05.000000Z\", \"updated_at\": \"2026-07-08T12:43:05.000000Z\", \"borrow_date\": \"2026-04-18T00:00:00.000000Z\", \"borrower_name\": \"Citra Lestari\", \"display_status\": \"overdue\", \"display_status_label\": \"Terlambat\"}}','2026-07-08 12:43:05','2026-07-08 12:43:05'),(70,2,'return','borrowings','Mencatat pengembalian barang oleh: Citra Lestari','{\"borrowing\": {\"id\": 7, \"status\": \"returned\", \"division\": \"Customer Service\", \"due_date\": \"2026-04-28T00:00:00.000000Z\", \"created_at\": \"2026-07-08T12:43:05.000000Z\", \"updated_at\": \"2026-07-08T12:43:25.000000Z\", \"borrow_date\": \"2026-04-18T00:00:00.000000Z\", \"return_date\": \"2026-07-08T00:00:00.000000Z\", \"return_note\": \"dikembalikan lengkap dan dalam kondisi baik\", \"borrower_name\": \"Citra Lestari\", \"display_status\": \"returned\", \"return_condition\": \"Baik\", \"display_status_label\": \"Dikembalikan\"}, \"return_note\": \"dikembalikan lengkap dan dalam kondisi baik\", \"return_condition\": \"Baik\"}','2026-07-08 12:43:25','2026-07-08 12:43:25');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrowing_details`
--

DROP TABLE IF EXISTS `borrowing_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrowing_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `borrowing_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `borrowing_details_borrowing_id_foreign` (`borrowing_id`),
  KEY `borrowing_details_product_id_foreign` (`product_id`),
  CONSTRAINT `borrowing_details_borrowing_id_foreign` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `borrowing_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrowing_details`
--

LOCK TABLES `borrowing_details` WRITE;
/*!40000 ALTER TABLE `borrowing_details` DISABLE KEYS */;
INSERT INTO `borrowing_details` VALUES (1,1,1,1,'2026-07-04 16:09:16','2026-07-04 16:09:16'),(2,2,13,2,'2026-07-06 10:34:31','2026-07-06 10:34:31'),(3,3,1,1,'2026-07-06 10:36:16','2026-07-06 10:36:16'),(4,4,10,1,'2026-07-06 10:37:44','2026-07-06 10:37:44'),(5,5,14,1,'2026-07-06 11:30:05','2026-07-06 11:30:05'),(6,6,15,2,'2026-07-08 12:20:20','2026-07-08 12:20:20'),(7,7,21,1,'2026-07-08 12:43:05','2026-07-08 12:43:05');
/*!40000 ALTER TABLE `borrowing_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrowings`
--

DROP TABLE IF EXISTS `borrowings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrowings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `borrower_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('borrowed','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'borrowed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrowings`
--

LOCK TABLES `borrowings` WRITE;
/*!40000 ALTER TABLE `borrowings` DISABLE KEYS */;
INSERT INTO `borrowings` VALUES (1,'Ardiansyah Pratama','IT','2026-07-01','2026-07-08',NULL,NULL,NULL,'borrowed','2026-07-04 16:09:16','2026-07-04 16:09:16'),(2,'Dimas Pratama','IT','2026-02-03','2026-02-07','2026-07-06','Baik','Dikembalikan lengkap','returned','2026-07-06 10:34:31','2026-07-06 10:34:49'),(3,'Nadia Putri','Finance','2026-02-10','2026-02-14','2026-07-06','Baik','Digunakan untuk audit internal.','returned','2026-07-06 10:36:16','2026-07-06 10:36:34'),(4,'Rizky Maulana','Marketing','2026-02-21','2026-02-24','2026-07-06','Baik','Untuk meeting hybrid, barang lengkap','returned','2026-07-06 10:37:44','2026-07-06 10:38:14'),(5,'Devia Tabina','Operations','2026-07-06','2026-07-08',NULL,NULL,NULL,'borrowed','2026-07-06 11:30:05','2026-07-06 11:30:05'),(6,'Fajar Nugroho','Human Resources','2026-03-11','2026-03-15','2026-07-08','Baik','Dikembalikan lengkap','returned','2026-07-08 12:20:20','2026-07-08 12:20:52'),(7,'Citra Lestari','Customer Service','2026-04-18','2026-04-28','2026-07-08','Baik','dikembalikan lengkap dan dalam kondisi baik','returned','2026-07-08 12:43:05','2026-07-08 12:43:25');
/*!40000 ALTER TABLE `borrowings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Spare Device','Perangkat cadangan untuk kebutuhan darurat.','2026-07-04 15:38:33','2026-07-04 15:38:33'),(2,'Perlengkapan Kantor','Peralatan pendukung kegiatan kerja dan operasional kantor.','2026-07-04 15:38:50','2026-07-04 15:44:51'),(3,'ATK','Alat tulis dan perlengkapan administrasi.','2026-07-04 15:39:13','2026-07-04 15:45:14'),(4,'Networking Device','Perangkat pendukung koneksi internet dan jaringan kantor.','2026-07-04 15:39:31','2026-07-04 15:54:12'),(5,'Komputer dan Laptop','Perangkat komputer, laptop, monitor, dan perlengkapan kerja digital.','2026-07-04 15:39:42','2026-07-04 15:45:54'),(6,'Elektronik','Perangkat elektronik pendukung operasional kantor.','2026-07-04 15:39:59','2026-07-04 15:45:34'),(7,'Kabel dan Adapter','Perlengkapan kabel, charger, dan adapter.','2026-07-04 15:40:15','2026-07-04 15:40:15'),(8,'Audio Visual','Perangkat audio, kamera, proyektor, dan kebutuhan meeting.','2026-07-04 15:47:11','2026-07-04 15:47:11');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'0001_01_01_000003_roles',1),(5,'0001_01_01_000004_user_role',1),(6,'0001_01_01_000005_categories',1),(7,'0001_01_01_000006_products',1),(8,'0001_01_01_000007_borrowings',1),(9,'0001_01_01_000008_borrowing_details',1),(10,'2026_07_04_065256_create_activity_logs_table',1),(11,'2026_07_04_065343_return_fields',1),(12,'2026_07_04_082841_division',1),(13,'2026_07_05_174317_profile_photo',2),(14,'2026_07_08_000001_stock_condition',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `good_stock` int unsigned NOT NULL DEFAULT '0',
  `minor_damage_stock` int unsigned NOT NULL DEFAULT '0',
  `major_damage_stock` int unsigned NOT NULL DEFAULT '0',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` enum('Baik','Rusak Ringan','Rusak Berat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_code_unique` (`code`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,5,'KOM-0001','Lenovo ThinkPad E14 Gen 5',7,7,0,0,'Ruang IT','Baik','products/5nYrs26U1cwKlAYdXrRrxmicGcMHIATdWwu1HWOS.jpg','2026-07-04 15:48:14','2026-07-06 10:36:34'),(2,5,'KOM-0002','HP ProBook 440 G9',6,6,0,0,'Ruang IT','Baik','products/uzw1ocVGUJfistQ0AvJytFQpx2dH6axnaUlpSZND.jpg','2026-07-04 15:50:36','2026-07-06 10:10:12'),(3,5,'KOM-0003','Dell OptiPlex 3000 Micro',5,5,0,0,'Gudang Utama','Baik','products/fP6XAtQhbhLiAddgXp1L46TtMNcExL7alWpIlEld.jpg','2026-07-04 15:51:21','2026-07-06 10:11:53'),(4,5,'KOM-0004','Samsung Monitor 24 Inch',10,10,0,0,'Gudang Utama','Baik','products/XC2LkXqKNigu5F0PmM7gCfpcyKXLVhAMBBdK7YlN.jpg','2026-07-04 15:52:26','2026-07-06 10:22:36'),(5,4,'NET-0001','MikroTik Router hAP ac2',4,4,0,0,'Ruang Server','Baik','products/wPOgdaN9yjmU5LDpA9Cc52gQhNTEKV0XJpYgEqrQ.jpg','2026-07-04 15:56:06','2026-07-06 10:23:15'),(6,4,'NET-0002','Cisco Switch 24 Port SG350',3,3,0,0,'Ruang Server','Baik','products/NJqziLv3zuyrThbNHhlxEHRWARPceXmNLOL4nB3t.jpg','2026-07-04 15:57:09','2026-07-06 10:23:30'),(7,4,'NET-0003','TP-Link Access Point EAP225',7,7,0,0,'Ruang Server','Baik','products/RFpwfJ1Jobwp6NvpdQxPMimk3A4R4INV1mKSAiJc.jpg','2026-07-04 15:58:52','2026-07-06 10:23:57'),(8,4,'NET-0004','LAN Cable Tester ProKit',6,6,0,0,'Ruang Server','Baik','products/sVi9ZiOUHpAfqqHgtzvI3oYf4bpMLIF7gqSdAUmn.jpg','2026-07-04 16:00:00','2026-07-06 10:28:38'),(9,3,'ATK-0001','Pulpen Standard AE7',50,50,0,0,'Ruang Administrasi','Baik','products/MYlVIZQMfeTj4UUPPZcQwsjjJw6UUKuivhaHoV31.jpg','2026-07-05 15:15:34','2026-07-06 09:57:17'),(10,8,'AUD-0001','Epson Projector EB-X500',5,5,0,0,'Ruang Meeting','Baik','products/0qP4QEhSz2or8tZPHaeCg1lOjnxAruNeA4gATJBG.jpg','2026-07-06 10:25:51','2026-07-06 10:38:14'),(12,6,'ELE-0001','Canon LBP6030 Printer',8,8,0,0,'Ruang Administrasi','Baik','products/8o0VAzMaJL0RcnWHSrTEngD0r8YC7GmAIxteZxZe.jpg','2026-07-06 10:31:10','2026-07-06 10:31:10'),(13,8,'AUD-0002','Logitech Rally Speaker',6,6,0,0,'Ruang Meeting','Baik','products/5ujXeg4Om0bbBFaR8h97dRPslEaSqXAitZjFoShG.jpg','2026-07-06 10:32:14','2026-07-06 10:34:49'),(14,7,'KAB-0001','Kabel HDMI 2 Meter',29,29,0,0,'Gudang IT Lt.1','Baik','products/1F0DLXMTwixhDjwfne9OjWJwOVYwVlbnCDyejL4D.jpg','2026-07-06 11:14:12','2026-07-06 11:30:05'),(15,7,'KAB-0002','Adapter USB-C to HDMI',4,4,0,0,'Gudang IT Lt.1','Baik','products/9tj1vzr8i0O8NWHsnYf6KFA0x6FnWdLOs4SMReqb.jpg','2026-07-06 11:15:58','2026-07-08 12:20:52'),(16,6,'ELE-0002','UPS APC 650VA',7,7,0,0,'Ruang Server','Baik','products/wKUcq8GgzHFE3eI6i10JeoBb8I2SPv1MzLOhWEbo.jpg','2026-07-07 16:49:11','2026-07-07 16:49:11'),(17,6,'ELE-0003','Tablet Samsung Tab A8',2,2,0,0,'Lemari Operasional','Rusak Berat','products/AqCiGjT6SwZOtzrT589jRs3ePJLzVPfWYXFA7sSv.jpg','2026-07-07 16:50:48','2026-07-07 16:50:48'),(18,3,'ATK-0002','Kertas A4 Sinar Dunia',20,20,0,0,'Ruang Administrasi','Baik','products/7Sfv0AiVJAiMCZ7DPiok2lFdPSVvsPKbYuxn2jN1.jpg','2026-07-07 16:51:51','2026-07-07 16:51:51'),(19,2,'PER-0001','Whiteboard Magnetic',8,6,2,0,'Ruang Meeting','Rusak Ringan','products/zpqCY6INAaAbGLQr6ywPatA5Zsok5zIbUmPhfgrJ.jpg','2026-07-07 17:02:26','2026-07-07 17:48:42'),(20,2,'PER-0002','Kursi Meeting Lipat',30,20,7,3,'Gudang Utama','Rusak Berat','products/pYCREt6HgS5rzucjVy8UCsKzpU6cVtNnmdebQuW4.jpg','2026-07-08 09:37:33','2026-07-08 09:37:51'),(21,1,'SPA-0001','Laptop Cadangan Asus A416',6,5,0,1,'Gudang IT Lt.3','Rusak Berat','products/JNik8tFL5sy9GcyFrVoIi3QtFEHNfj41taPGU3dY.jpg','2026-07-08 09:39:52','2026-07-08 12:43:25'),(22,1,'SPA-0002','HP Operasional Samsung A14',2,2,0,0,'Gudang IT Lt.1','Baik','products/Ksyx8ErVu9xlk1azI0RPctlupJwtkTTyNtXbn8co.jpg','2026-07-08 09:40:28','2026-07-08 09:40:28'),(23,1,'SPA-0003','Webcam Cadangan Logitech C270',0,0,0,0,'Gudang IT Lt.3','Baik','products/p3lD3t6LBfcXdITSu9ujSCZjrwYVw9AZXRxyRSIN.jpg','2026-07-08 09:41:10','2026-07-08 09:41:10'),(24,6,'ELE-0004','Mouse Wireless Logitech M185',4,3,1,0,'Gudang Utama','Rusak Ringan','products/9BfLwFdt7eenaeGnIk9zNS7Q003vidIFd8C4gQwP.jpg','2026-07-08 09:45:02','2026-07-08 09:45:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','2026-07-04 12:51:28','2026-07-04 12:51:28'),(2,'Staff','2026-07-04 12:51:29','2026-07-04 12:51:29'),(3,'Manager','2026-07-04 12:51:29','2026-07-04 12:51:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1mNvTX4WTsegF1gGmge0nNwvzDqxPTBEO4YkzMi2',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTml5N0Z2S2h4eEY5UVl1dG9ybHN5YmNuOWhDWmlwd1UzaDZxbHRiUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783175778),('1xfsKqsWQ1XqanFuOJ2iWYRmyPgohvJuuV0UGSgR',NULL,'127.0.0.1','curl/7.74.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEVodjN0TVRzOVRmaTYxa2Jka1VlMzc4RXNkR2F5ZUlGQ045SFQxNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783175430),('704IfwRXLUrD03pVtRxgtqrAeano16djA0cSdQ3Q',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTlrWTl2dnVocFFFR3ZKUWgxQ2JtbTVyT1Z4U3dJT3RmcFNmVWhqQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783171615),('auLSeqwQuSA09vFvNHMATAhMwho78b6fhPZgYaLF',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVVZREZGUU5yMENMcHNNNm51Y3RlWVRscjFWTlNHUkt5bE5tYjhEaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783170164),('bIeq1J5CfG1tJizTHRdVmNW4RkoDK6cskEdAjNdT',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTZKZ3NQU0pJMlFTUlBUU0ZQTndGcHVxSEtuT3htRm0wRVh0aXF1dSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783173783),('clBrL2JIFJ6BlaCw76p4Nw6TYgkMx5Ml2OCbeHla',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1NmekJ2eGtCSHBycXpQS2NDeG9qcTJZN0dOYjl6SW9GWVJBZGF0QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783170564),('dpHWQeoCGODstZWE3kMJcRGDg5I3SsZVyN2Mdq8B',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWng4elNtb0RhZ2lxbzJ4RjNZUmc1ajlHQU5XdXVRT0g4QjR4WTlEaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783172576),('GLkg6uNfqIBNQNR4ducZCkN74p5U4ulQKlnbYdpJ',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGQ4N1QycXhzMHFCOFZmUVNScEVYVnZpbmpCb0NSUHJPQkFuNk5MaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783171604),('jPrSP8spH88q0FU40fA9cwvCv79CwaLa3yWH3vpS',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUY1Q0xEY2pVZVBIOGNHUmgzSHZhcjZPMUFkSWFpNTRVaHFKVHZhbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6OTQ6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1783173663),('k3XZO9zgSCDEryAGLbkQe2C7qwEIfTGfVGkAoh7O',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHdPM0w1NlRCTUMyOVl6ZmtSZG93WnNTTlhXMkdSTXFTUTdnNnR1NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783172018),('pFFB2yGPdOBelVYt7f87oJknVkDuWHuVaXuhbpo8',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWE3UmpnQ2xuamZQS1JUOGlINU1uamxKeHlkclFOVEVubkNDVUY5QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783173472),('QGxvoN9C0hxi5mHX5cwwqp9Lp9tkwZ77EhSxWnPC',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibktqZ1haM21xNmx2M2hVOVdhOGxTNWtrY3BuZndYd0hPeDlHNmtpNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783173468),('QQYfekDEWuWwnMlOYDV1GqGfm4VXZBhxcxPzvM0P',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoic1lCUjBaRlNId1JwRG9mV05CTzFNb2lGNzZ0UUptczczOUEyeEl1dyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783171356),('RhBcsQq1lo00D0FGN0Amd9tb6sEfsHDpA3Ai2jWE',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzlpaWJoV2QyWUM4OFRrNmxhOVVhMVhjczJhT0IxT3MzeDdFcFBIRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783173804),('TBU8gf2vP3vAFePp5Kf1IEmXeVLTtE7KWXCw0mmE',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3JMNVhrWWxkcExYMnVQWFo0WnN2bGRTN0xTT2FoU1pGZHJKdThnNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783170164),('TRzwtUaLFBu8VHHi87Yi6fgdyN7Ua7NweUoOp2XU',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWM1TkhxR2FoSzhqcWtibHhCQkxib2VwUWRVcWtCZlVXdFRWNTJrciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783170988),('xEMn71HB4mb0f7l2fRJo20tImamVV7TLXUdzGGMl',NULL,'169.254.130.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibG01emdCWnNzNjV5bWN0N1NXUEo4ekxyVjVicUNMODhQT1lIVVJCaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODg6Imh0dHA6Ly90ZWxrb21zZWwtaW52ZW50b3J5LWF5ZXNoYS1iYWN0ZnVoemZtZzBnY2FkLmluZG9uZXNpYWNlbnRyYWwtMDEuYXp1cmV3ZWJzaXRlcy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1783175765);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','admin@example.com','profile-photos/p6q4w6mKDqAuzFY3tf45cGY5swZDFFoMQOu9uMo3.jpg',NULL,'$2y$12$lg2xPktC59iBhAISo9xvDOyF.8Zg4rXIveHr53msDVuJvCD6JqWWq','yBudSOMhpNBi3lX4IeizbbPQmm0A0OHsBCzZCQI8aVDXA9kHqeTEQhXYtLvU','2026-07-04 12:51:30','2026-07-06 11:44:45'),(2,2,'Staff','staff@example.com',NULL,NULL,'$2y$12$biIsQxkY44GqF5GjmI/pWu8mX3EGRsltQtl9AFGXo5z3QytvBHfYu',NULL,'2026-07-04 12:51:31','2026-07-04 12:51:31'),(3,3,'Manager','manager@example.com',NULL,NULL,'$2y$12$.vpc7kkjSswCybYLNiNY3.Hy/FAsQ43yRbVTpitrr39fwIbLszBjy',NULL,'2026-07-04 12:51:32','2026-07-04 12:51:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-08 20:11:04
