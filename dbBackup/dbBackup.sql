

CREATE TABLE `userdetails` (
  `userIdentity` int(11) NOT NULL AUTO_INCREMENT,
  `userPermissionNumber` int(11) NOT NULL,
  `agentName` varchar(256) NOT NULL,
  `username` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  PRIMARY KEY (`userIdentity`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO userdetails VALUES
("1","1","Haitomns","haitomns4173","$2y$10$/33PDv5hpvRbAC0PasGi0eubtWg52w2dC8JBTl2GNKXLiKzq.cAiO"),
("2","1","","asdf","$2y$10$I5Ri10KvyDPgW86qSTx5RuWL7bFmQRMSGxbiZot8.JQ6STvAlgcoa"),
("3","2","asdffs","asdfasd","$2y$10$LTGAlvq.vlcy4/O2fwsfouS.JLXEPYjQJe0meDhlriUapOKQGnOmu"),
("4","2","testUser","12345","$2y$10$TLQHKv.IQJyknob2OF8hYebWdB0IlvTXa1LnCOrKknGmjgyRx4Lv."),
("5","1","Test User","user","$2y$10$AToCj/91hFuqgnt27LmPQu2eq0BoAKU65vzhoNoWez1Fts.vdh1QC"),
("6","1","temp user","123456","$2y$10$y1WDj62.znEGWMoERUwZQ.sBY6k1YjSGlI8EN4uKUeqw9QQkyhgBS");




CREATE TABLE `userpermission` (
  `permissionId` int(11) NOT NULL AUTO_INCREMENT,
  `permissionName` varchar(128) NOT NULL,
  PRIMARY KEY (`permissionId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO userpermission VALUES
("1","Central Supervisor"),
("2","Agent");


