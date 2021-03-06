CREATE DATABASE Geki_Stat_2016;

USE Geki_Stat_2016;

GRANT SELECT, INSERT ON Geki_Stat_2016.* TO geki_user@localhost IDENTIFIED BY 'Geki_user#1';

-- 登録履歴
DROP TABLE IF EXISTS `histories`;
CREATE TABLE `histories` (
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `regist_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_hash`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- 劇場盤確保状況
DROP TABLE IF EXISTS `allocations`;
CREATE TABLE `allocations` (
  `date_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `mei_count` int(11) DEFAULT NULL,
  `other_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`date_id`,`division_id`,`user_hash`,`revision`),
  KEY `date_id` (`date_id`,`division_id`),
  KEY (`user_hash`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- 自分の確保済みの票
DROP TABLE IF EXISTS `my_allocated_votes`;
CREATE TABLE `my_allocated_votes` (
  `my_allocated_votes_id` int primary key auto_increment,
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `mobile` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `reliability` int(11) DEFAULT NULL,
  KEY (`user_hash`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- 把握している友人・知人の票
DROP TABLE IF EXISTS `friends_votes`;
CREATE TABLE `friends_votes` (
  `friends_votes_id` int primary key auto_increment,
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `mobile` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `reliability` int(11) DEFAULT NULL,
  KEY (`user_hash`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- 選対大量購入用予算
DROP TABLE IF EXISTS `bulk_budgets`;
CREATE TABLE `bulk_budgets` (
  `bulk_budgets_id` int primary key auto_increment,
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `money` int(11) DEFAULT NULL,
  `reliability` int(11) DEFAULT NULL,
  KEY (`user_hash`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- その他予算（800円以下で票を取得できるものに限る）
DROP TABLE IF EXISTS `other_budgets`;
CREATE TABLE `other_budgets` (
  `other_budgets_id` int primary key auto_increment,
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `money` int(11) DEFAULT NULL,
  `reliability` int(11) DEFAULT NULL,
  KEY (`user_hash`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

DROP VIEW IF EXISTS `history_latest_view`;
CREATE VIEW `history_latest_view` as
SELECT h.user_hash, MAX(h.revision) as revision FROM `histories` h GROUP BY h.user_hash;

--DROP VIEW IF EXISTS `history_latest_view`;
--CREATE VIEW `history_latest_view` as
--SELECT h.user_hash, MAX(h.revision) as revision FROM `histories` h where h.delete_date is null GROUP BY h.user_hash;


-- サマリーページアクセスログ
DROP TABLE IF EXISTS `summary_access_logs`;
CREATE TABLE `summary_access_logs` (
  `login_id` varchar(100) NOT NULL,
  `user_hash` varchar(100) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `regist_date` datetime DEFAULT NULL,
  KEY (`login_id`),
  KEY (`regist_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- 管理情報
DROP TABLE IF EXISTS `management_informations`;
CREATE TABLE `management_informations` (
  `password` varchar(100) NOT NULL,
  `pass_phrase` varchar(100) NOT NULL,
  `running` tinyint NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `regist_date` datetime NOT NULL,
  KEY (`regist_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

-- insert into histories values ('16d99370', 1, NOW());
-- insert into histories values ('16d99370', 2, NOW());
-- insert into histories values ('16d99370', 3, NOW());

ALTER TABLE histories ADD COLUMN `ip_address` varchar(100) DEFAULT NULL AFTER `revision`;

ALTER TABLE histories ADD COLUMN `delete_date` datetime DEFAULT NULL AFTER `regist_date`;

INSERT INTO `management_informations` VALUES ('c61a92f531d96b886354f5b28615bb28', 'mei2016##1', 1, '', NOW());
INSERT INTO `management_informations` VALUES ('afsafs', 'mei2016##1', 1, '', NOW());

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `user_hash` varchar(100) NOT NULL,
  `revision` int(11) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_hash`,`revision`)
);

