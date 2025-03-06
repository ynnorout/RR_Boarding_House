

CREATE TABLE `tblbackup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `tblbarangay` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `barangay` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblbarangay VALUES ('3','Poblacion 1');
INSERT INTO tblbarangay VALUES ('5','Poblacion 2');
INSERT INTO tblbarangay VALUES ('6','Vito');
INSERT INTO tblbarangay VALUES ('7','Bulanon');
INSERT INTO tblbarangay VALUES ('8','Old Sagay');


CREATE TABLE `tblcompany` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_contact` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblcompany VALUES ('1','kasulatan.png','testaaa','testaaa','testaaa','testaaa');


CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `complete_name` varchar(255) DEFAULT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbluser VALUES ('1','admin','$2y$10$hgauy44BNQ.S36u0uVhS2OplCumIv3B66.7QLeJ411y4TEPsqKuze','administrator','admin');
INSERT INTO tbluser VALUES ('2','usera','$2y$10$PXHGrsIRzH8Ok0rIpD4VLunlB/2iLChqVllZhD3b5tlb2Z1T2jVm2','user/encoder','user');
INSERT INTO tbluser VALUES ('3','test','$2y$10$YspmJWbTbIMcc4.97MykXubLxR80VdPpP3tSxgPHfbIORqCu4n9FG','test','admin');
