DROP TABLE IF EXISTS Meimei_Posts;
CREATE TABLE Meimei_Posts (
	post_link varchar(200) PRIMARY KEY,
	post_date datetime,
	rss text not null,
	json text not null,
	html text not null,
	post_type int not null,
	regist_ip varchar(20) NOT NULL,
	regist_time datetime not null,
	regist_user varchar(20) NOT NULL
);


INSERT INTO Meimei_Posts (
	post_link,
	post_date,
	rss,
	json,
	html,
	post_type,
	regist_ip,
	regist_time,
	regist_user
)
VALUES (
	'hoge_01',
	null,
	'rss_01',
	'json_01',
	'html_01',
	1,
	'regist_ip_01',
	NOW(),
	'regist_user_01'
);
