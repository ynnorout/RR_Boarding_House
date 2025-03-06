

CREATE TABLE `tblactivitylog` (
  `log_record_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `log_type` enum('add','update','delete') DEFAULT NULL,
  `details` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tblactivitylog` VALUES ('1','1','add','Add new barangay: Bulanon','2024-03-30 22:24:57');
INSERT INTO `tblactivitylog` VALUES ('2','1','update','Updated barangay: Bulanon to Bulanon1','2024-03-30 22:25:01');
INSERT INTO `tblactivitylog` VALUES ('3','1','add','Add new barangay: test','2024-03-30 22:25:07');
INSERT INTO `tblactivitylog` VALUES ('4','1','delete','Deleted barangay: test','2024-03-30 22:25:11');
INSERT INTO `tblactivitylog` VALUES ('5','1','add','Add new barangay: bulanon','2024-03-30 22:31:44');
INSERT INTO `tblactivitylog` VALUES ('6','1','add','Add new barangay: test','2024-03-30 22:33:09');
INSERT INTO `tblactivitylog` VALUES ('7','1','add','Add new barangay: bulanon','2024-03-30 22:33:52');
INSERT INTO `tblactivitylog` VALUES ('8','1','delete','Deleted barangay: bulanon','2024-03-30 22:34:00');
INSERT INTO `tblactivitylog` VALUES ('9','1','add','Add new barangay: bulanon','2024-03-30 22:34:31');
INSERT INTO `tblactivitylog` VALUES ('10','1','delete','Deleted barangay: bulanon','2024-03-30 22:34:34');
INSERT INTO `tblactivitylog` VALUES ('11','1','add','Add new barangay: bulanon','2024-03-30 22:34:59');
INSERT INTO `tblactivitylog` VALUES ('12','1','add','Add new barangay: bulanon','2024-03-30 22:35:16');
INSERT INTO `tblactivitylog` VALUES ('13','1','add','Add new barangay: fsdfsdf','2024-03-30 22:36:38');
INSERT INTO `tblactivitylog` VALUES ('14','1','add','Add new barangay: bulanon','2024-03-30 22:39:19');
INSERT INTO `tblactivitylog` VALUES ('15','1','add','Add new barangay: test1','2024-03-30 22:39:50');
INSERT INTO `tblactivitylog` VALUES ('16','1','add','Add new barangay: test1','2024-03-30 22:40:00');
INSERT INTO `tblactivitylog` VALUES ('17','1','add','Add new barangay: test','2024-03-30 22:45:52');
INSERT INTO `tblactivitylog` VALUES ('18','1','add','Add new barangay: test','2024-03-30 22:46:05');
INSERT INTO `tblactivitylog` VALUES ('19','1','add','Add new barangay: test','2024-03-30 22:46:53');
INSERT INTO `tblactivitylog` VALUES ('20','1','add','Add new barangay: test','2024-03-30 22:49:31');
INSERT INTO `tblactivitylog` VALUES ('21','1','add','Add new barangay: testsetestsetestsetsetset','2024-03-30 22:51:08');
INSERT INTO `tblactivitylog` VALUES ('22','1','add','Add new barangay: sdfsdfsdfsdfsdf','2024-03-30 22:51:23');
INSERT INTO `tblactivitylog` VALUES ('23','1','add','Add new barangay: test','2024-03-30 22:53:09');
INSERT INTO `tblactivitylog` VALUES ('24','1','add','Add new barangay: test','2024-03-30 22:56:39');
INSERT INTO `tblactivitylog` VALUES ('25','1','add','Add new barangay: test','2024-03-30 22:56:46');
INSERT INTO `tblactivitylog` VALUES ('26','1','add','Add new barangay: sdfsdfdsf','2024-03-30 22:58:24');
INSERT INTO `tblactivitylog` VALUES ('27','1','add','Add new barangay: test','2024-03-30 22:58:51');
INSERT INTO `tblactivitylog` VALUES ('28','1','add','Add new barangay: testsdfasdf','2024-03-30 23:00:20');
INSERT INTO `tblactivitylog` VALUES ('29','1','add','Add new barangay: test','2024-03-30 23:00:48');
INSERT INTO `tblactivitylog` VALUES ('30','1','add','Add new barangay: testsdfsdfsdf','2024-03-30 23:03:23');
INSERT INTO `tblactivitylog` VALUES ('31','1','add','Add new barangay: test','2024-03-30 23:03:26');
INSERT INTO `tblactivitylog` VALUES ('32','1','add','Add new barangay: testsdfsdf','2024-03-30 23:05:24');
INSERT INTO `tblactivitylog` VALUES ('33','1','add','Add new barangay: test','2024-03-30 23:05:27');
INSERT INTO `tblactivitylog` VALUES ('34','1','add','Add new barangay: test','2024-03-30 23:06:10');
INSERT INTO `tblactivitylog` VALUES ('35','1','add','Add new barangay: test','2024-03-30 23:06:16');
INSERT INTO `tblactivitylog` VALUES ('36','1','delete','Deleted barangay: test','2024-03-30 23:06:31');
INSERT INTO `tblactivitylog` VALUES ('37','1','delete','Deleted barangay: test','2024-03-30 23:06:35');
INSERT INTO `tblactivitylog` VALUES ('38','1','add','Add new barangay: test','2024-03-30 23:06:51');
INSERT INTO `tblactivitylog` VALUES ('39','1','add','Add new barangay: test','2024-03-30 23:08:40');
INSERT INTO `tblactivitylog` VALUES ('40','1','delete','Deleted barangay: test','2024-03-30 23:08:42');
INSERT INTO `tblactivitylog` VALUES ('41','1','delete','Deleted barangay: test','2024-03-30 23:08:44');
INSERT INTO `tblactivitylog` VALUES ('42','1','add','Add new barangay: test','2024-03-30 23:08:55');
INSERT INTO `tblactivitylog` VALUES ('43','1','add','Add new barangay: test','2024-03-30 23:08:58');
INSERT INTO `tblactivitylog` VALUES ('44','1','add','Add new barangay: testse','2024-03-30 23:10:03');
INSERT INTO `tblactivitylog` VALUES ('45','1','add','Add new barangay: sdfsdf','2024-03-30 23:10:06');
INSERT INTO `tblactivitylog` VALUES ('46','1','delete','Deleted barangay: sdfsdf','2024-03-30 23:10:09');
INSERT INTO `tblactivitylog` VALUES ('47','1','delete','Deleted barangay: testse','2024-03-30 23:10:11');
INSERT INTO `tblactivitylog` VALUES ('48','1','delete','Deleted barangay: test','2024-03-30 23:10:12');
INSERT INTO `tblactivitylog` VALUES ('49','1','delete','Deleted barangay: test','2024-03-30 23:10:13');
INSERT INTO `tblactivitylog` VALUES ('50','1','add','Add new barangay: test','2024-03-30 23:10:16');
INSERT INTO `tblactivitylog` VALUES ('51','1','add','Add new barangay: sdfsdfsdf','2024-03-30 23:10:19');
INSERT INTO `tblactivitylog` VALUES ('52','1','add','Add new barangay: testxd','2024-03-30 23:11:44');
INSERT INTO `tblactivitylog` VALUES ('53','1','add','Add new barangay: dfdddf','2024-03-30 23:12:06');
INSERT INTO `tblactivitylog` VALUES ('54','1','add','Add new barangay: test bara','2024-03-30 23:14:53');


CREATE TABLE `tblbackup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tblbackup` VALUES ('1','1','backup/database_backup_2024-03-30_08-55-28.sql','2024-03-30 15:55:28');
INSERT INTO `tblbackup` VALUES ('2','1','backup/database_backup_2024-03-30_08-55-41.sql','2024-03-30 15:55:41');
INSERT INTO `tblbackup` VALUES ('3','1','backup/database_backup_2024-03-30_09-25-50.sql','2024-03-30 16:25:50');
INSERT INTO `tblbackup` VALUES ('4','1','backup/database_backup_2024-03-30_09-25-55.sql','2024-03-30 16:25:55');


CREATE TABLE `tblbarangay` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `barangay` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tblbarangay` VALUES ('9','test');
INSERT INTO `tblbarangay` VALUES ('10','sdfsdfsdf');
INSERT INTO `tblbarangay` VALUES ('11','testxd');
INSERT INTO `tblbarangay` VALUES ('12','dfdddf');
INSERT INTO `tblbarangay` VALUES ('13','test bara');


CREATE TABLE `tblcompany` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_contact` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tblcompany` VALUES ('1','kasulatan.png','My Company','Manila, Philippines','123456','https://chat.openai.com/');


CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `complete_name` varchar(255) DEFAULT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbluser` VALUES ('1','admin','$2y$10$hgauy44BNQ.S36u0uVhS2OplCumIv3B66.7QLeJ411y4TEPsqKuze','administrator','admin');
INSERT INTO `tbluser` VALUES ('2','usera','$2y$10$PXHGrsIRzH8Ok0rIpD4VLunlB/2iLChqVllZhD3b5tlb2Z1T2jVm2','user/encoder','user');
INSERT INTO `tbluser` VALUES ('3','test','$2y$10$YspmJWbTbIMcc4.97MykXubLxR80VdPpP3tSxgPHfbIORqCu4n9FG','test','admin');
