

CREATE TABLE `tblactivitylog` (
  `log_record_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `log_type` enum('add','update','delete') DEFAULT NULL,
  `details` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
INSERT INTO `tblactivitylog` VALUES ('55','1','delete','Deleted barangay: sdfsdfsdf','2024-03-31 10:10:22');
INSERT INTO `tblactivitylog` VALUES ('56','1','add','Add new barangay: testa','2024-03-31 10:12:21');
INSERT INTO `tblactivitylog` VALUES ('57','1','add','Add new barangay: tes','2024-03-31 10:14:16');
INSERT INTO `tblactivitylog` VALUES ('58','1','delete','Deleted barangay: tes','2024-03-31 10:16:59');
INSERT INTO `tblactivitylog` VALUES ('59','1','update','Updated barangay: testa to testasdfdsfdsf','2024-03-31 10:29:01');
INSERT INTO `tblactivitylog` VALUES ('60','1','add','Add new barangay: testsss','2024-03-31 10:29:53');
INSERT INTO `tblactivitylog` VALUES ('61','1','update','Updated barangay: testsss to test','2024-03-31 10:29:58');
INSERT INTO `tblactivitylog` VALUES ('62','1','update','Updated barangay: test to testsfsdfsdf','2024-03-31 10:32:45');
INSERT INTO `tblactivitylog` VALUES ('63','1','update','Updated barangay: testsfsdfsdf to testsssssssssssss','2024-03-31 10:33:45');
INSERT INTO `tblactivitylog` VALUES ('64','1','update','Updated barangay: testsssssssssssss to testAAAAAAA','2024-03-31 10:34:01');
INSERT INTO `tblactivitylog` VALUES ('65','1','update','Updated barangay: testAAAAAAA to testssss','2024-03-31 10:34:42');
INSERT INTO `tblactivitylog` VALUES ('66','1','update','Updated barangay: testssss to testssssaaaaa','2024-03-31 10:34:51');
INSERT INTO `tblactivitylog` VALUES ('67','1','update','Updated barangay: testssssaaaaa to testxda','2024-03-31 10:35:02');
INSERT INTO `tblactivitylog` VALUES ('68','1','delete','Deleted barangay: testxda','2024-03-31 10:35:12');
INSERT INTO `tblactivitylog` VALUES ('69','1','update','Updated barangay: testasdfdsfdsf to testtt','2024-03-31 10:37:10');
INSERT INTO `tblactivitylog` VALUES ('70','1','update','Updated barangay: testtt to testttaaa','2024-03-31 10:37:13');
INSERT INTO `tblactivitylog` VALUES ('71','1','add','Add new barangay: tstt','2024-03-31 21:03:36');
INSERT INTO `tblactivitylog` VALUES ('72','1','add','Add new barangay: testsaaafd','2024-03-31 21:03:56');
INSERT INTO `tblactivitylog` VALUES ('73','1','add','Add new barangay: asdfsdfsdf','2024-03-31 21:05:05');
INSERT INTO `tblactivitylog` VALUES ('74','1','add','Add new barangay: sdfsdfsdf','2024-03-31 21:05:17');
INSERT INTO `tblactivitylog` VALUES ('75','1','add','Add new barangay: xdfsdfsdgdsfg','2024-03-31 21:06:09');
INSERT INTO `tblactivitylog` VALUES ('76','1','add','Add new barangay: xgd','2024-03-31 21:07:35');
INSERT INTO `tblactivitylog` VALUES ('77','1','add','Add new barangay: d','2024-03-31 21:09:23');
INSERT INTO `tblactivitylog` VALUES ('78','1','add','Add new barangay: sdfsdf','2024-03-31 21:09:36');
INSERT INTO `tblactivitylog` VALUES ('79','1','update','Updated barangay: sdfsdf to sdfsdfasdfsdsdf','2024-03-31 21:16:34');
INSERT INTO `tblactivitylog` VALUES ('80','1','delete','Deleted barangay: d','2024-03-31 21:16:40');
INSERT INTO `tblactivitylog` VALUES ('81','1','update','Updated barangay: sdfsdfasdfsdsdf to sdfsdfasdfsdsdfa','2024-03-31 21:17:02');
INSERT INTO `tblactivitylog` VALUES ('82','1','delete','Deleted barangay: xgd','2024-03-31 21:17:09');
INSERT INTO `tblactivitylog` VALUES ('83','1','add','Add new barangay: Vito','2024-03-31 21:23:41');
INSERT INTO `tblactivitylog` VALUES ('84','1','update','Updated barangay: Vito to Vitosdsdf','2024-03-31 21:39:13');


CREATE TABLE `tblbackup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tblbackup` VALUES ('1','1','backup/database_backup_2024-03-30_08-55-28.sql','2024-03-30 15:55:28');
INSERT INTO `tblbackup` VALUES ('2','1','backup/database_backup_2024-03-30_08-55-41.sql','2024-03-30 15:55:41');
INSERT INTO `tblbackup` VALUES ('3','1','backup/database_backup_2024-03-30_09-25-50.sql','2024-03-30 16:25:50');
INSERT INTO `tblbackup` VALUES ('4','1','backup/database_backup_2024-03-30_09-25-55.sql','2024-03-30 16:25:55');
INSERT INTO `tblbackup` VALUES ('5','1','backup/database_backup_2024-03-30_16-16-02.sql','2024-03-30 23:16:02');


CREATE TABLE `tblbarangay` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `barangay` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tblbarangay` VALUES ('9','test');
INSERT INTO `tblbarangay` VALUES ('11','testxd');
INSERT INTO `tblbarangay` VALUES ('12','dfdddf');
INSERT INTO `tblbarangay` VALUES ('13','test bara');
INSERT INTO `tblbarangay` VALUES ('14','testttaaa');
INSERT INTO `tblbarangay` VALUES ('17','tstt');
INSERT INTO `tblbarangay` VALUES ('18','testsaaafd');
INSERT INTO `tblbarangay` VALUES ('19','asdfsdfsdf');
INSERT INTO `tblbarangay` VALUES ('20','sdfsdfsdf');
INSERT INTO `tblbarangay` VALUES ('21','xdfsdfsdgdsfg');
INSERT INTO `tblbarangay` VALUES ('24','sdfsdfasdfsdsdfa');
INSERT INTO `tblbarangay` VALUES ('25','Vitosdsdf');


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
