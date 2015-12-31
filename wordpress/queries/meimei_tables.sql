DROP TABLE IF EXISTS `meimei_message`;
CREATE TABLE `meimei_message` (
  `message_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `internet_id` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `is_js_ok` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `pen_color` int(11) DEFAULT NULL,
  `message` longtext NOT NULL,
  `view_language` int(11) NOT NULL,
  `write_language` varchar(255) DEFAULT NULL,
  `regist_date` varchar(32) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `user_id` (`session_id`),
  KEY `internet_id` (`internet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO meimei_message (
  `session_id`
 ,`name`
 ,`pen_color`
 ,`message`
 ,`view_language`
 ,`write_language`
)
values (
  'test_session_id'
 ,'hoge-test kun.'
 ,1
 ,'this is a test message.'
 ,1
 ,'japanese!'
);

DROP TABLE IF EXISTS Color_Palette;
CREATE TABLE Color_Palette (
    color_id int not null primary key,
    color_name nvarchar(20) not null
) engine=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO Color_Palette ( color_id, color_name )
VALUES
(0, '指定なし')
,(1, '黒')
,(2, '赤')
,(3, '青')
,(4, '黄色')
,(5, '緑')
,(6, 'オレンジ')
,(7, '紫')
,(8, '茶色')
;

CREATE TABLE Language (
    lang_id int not null primary key,
    lang_name nvarchar(40) not null
) engine=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO Language ( lang_id, lang_name )
VALUES
(0, '日本語')
,(1, '英語')
,(2, '中国語')
;

CREATE TABLE Check_Message (
   message_id int primary key,
   regist_date datetime
) engine=InnoDB DEFAULT CHARSET=utf8;
