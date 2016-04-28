-- 公演にrevision, regist_userを追加
ALTER TABLE Stage ADD COLUMN revision int NOT NULL DEFAULT 1 AFTER stage_id;
ALTER TABLE Stage ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Stage DROP PRIMARY KEY, ADD PRIMARY KEY (stage_id, revision);

-- 公演出演メンバーにrevision, regist_userを追加
ALTER TABLE Stage_Member ADD COLUMN revision int NOT NULL DEFAULT 1 AFTER member_id;
ALTER TABLE Stage_Member ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Stage_Member DROP PRIMARY KEY, ADD PRIMARY KEY (stage_id, member_id, revision);

-- Related_Linkにrevision, regist_userを追加
ALTER TABLE Related_Link
     ADD COLUMN revision int NOT NULL DEFAULT 1 AFTER stage_id
    ,ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;

-- Stage_Event
ALTER TABLE Stage_Event DROP PRIMARY KEY;
ALTER TABLE Stage_Event
     ADD COLUMN revision int NOT NULL DEFAULT 1 AFTER event_id
    ,ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Stage_Event ADD PRIMARY KEY (stage_id, event_id, revision);
ALTER TABLE Stage_Event DROP COLUMN stage_event_id;

-- Stage_Event_Member
ALTER TABLE Stage_Event_Member DROP PRIMARY KEY;
ALTER TABLE Stage_Event_Member
     ADD COLUMN stage_id int NOT NULL AFTER stage_event_member_id
    ,ADD COLUMN event_id int NOT NULL AFTER stage_id
    ,ADD COLUMN revision int NOT NULL DEFAULT 1 AFTER member_id
    ,ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Stage_Event_Member DROP COLUMN stage_event_member_id;
ALTER TABLE Stage_Event_Member ADD PRIMARY KEY (stage_id, event_id, member_id, revision);


-- Program
ALTER TABLE Program ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Team ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Member ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Belonging ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;
ALTER TABLE Event ADD COLUMN regist_user varchar(20) NOT NULL AFTER regist_time;

UPDATE Stage SET regist_user = 'tatakauashi';
UPDATE Program SET regist_user = 'tatakauashi';
UPDATE Team SET regist_user = 'tatakauashi';
UPDATE Member SET regist_user = 'tatakauashi';
UPDATE Belonging SET regist_user = 'tatakauashi';
UPDATE Stage_Member SET regist_user = 'tatakauashi';
UPDATE Related_Link SET regist_user = 'tatakauashi';
UPDATE Event SET regist_user = 'tatakauashi';
UPDATE Stage_Event SET regist_user = 'tatakauashi';
UPDATE Stage_Event_Member SET regist_user = 'tatakauashi';

ALTER TABLE Stage_Event DROP PRIMARY KEY, ADD KEY stage_id(stage_id);
ALTER TABLE Stage_Event_Member DROP PRIMARY KEY, ADD KEY stage_id(stage_id);

ALTER TABLE Stage ADD COLUMN is_unofficial bit not null default false AFTER is_shuffled;

ALTER TABLE Belonging ADD COLUMN to_date date default null AFTER from_date;

ALTER TABLE Member DROP COLUMN sort_order;
ALTER TABLE Member ADD COLUMN sort_order NVARCHAR(200) NOT NULL AFTER member_name;

ALTER TABLE Team ADD COLUMN sort_order int not null AFTER team_name;

ALTER TABLE Stage_Event DROP KEY stage_id;
ALTER TABLE Stage_Event ADD PRIMARY KEY stage_id(stage_id, event_id, revision);
ALTER TABLE Stage_Event_Member DROP KEY stage_id;
ALTER TABLE Stage_Event_Member ADD PRIMARY KEY stage_id(stage_id, event_id, member_id, revision);

CREATE OR REPLACE VIEW Stage_Latest_View AS
SELECT s2.stage_id, MAX(s2.revision) AS revision FROM Stage s2 GROUP BY s2.stage_id;

CREATE OR REPLACE VIEW Stage_View AS
SELECT s.* FROM Stage s
JOIN Stage_Latest_View sv ON (s.stage_id = sv.stage_id AND s.revision = sv.revision)
WHERE s.delete_time IS NULL;

CREATE OR REPLACE VIEW Member_View AS
SELECT m.member_id
     , m.member_name
     , t.team_id
     , t.team_name
     , b.from_date
     , b.to_date
     , t.sort_order AS order1
     , m.sort_order AS order2
FROM Member m
JOIN Belonging b ON (m.member_id = b.member_id)
JOIN Team t ON (t.team_id = b.team_id)
ORDER BY t.sort_order, m.sort_order
;

-- 2016年1月11日 18:50:14
INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user, delete_time)
VALUES
 (10064, '稲垣ほなみ', 'いなかきほなみGGOGGGG', NOW(), 'tatakauashi', NULL)
,(10065, '尾関きはる', 'おせききはるGOGGGG', NOW(), 'tatakauashi', NULL)
,(10066, '柴木愛子', 'しはきあいこGOGGGG', NOW(), 'tatakauashi', NULL)
,(10067, '橋本あゆみ', 'はしもとあゆみGGGGGGG', NOW(), 'tatakauashi', NULL)
,(10068, '前川愛佳', 'まえかわあいかGGGGGGG', NOW(), 'tatakauashi', NULL)
;

INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES 
 (10064, 4,   '2008-10-05', '2009-04-30', NOW(), 'tatakauashi', NULL)
,(10064, 100, '2009-05-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10065, 4,   '2008-10-05', '2009-04-30', NOW(), 'tatakauashi', NULL)
,(10065, 100, '2009-05-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10066, 4,   '2008-10-05', '2009-07-31', NOW(), 'tatakauashi', NULL)
,(10066, 100, '2009-08-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10067, 4,   '2009-05-12', '2009-11-30', NOW(), 'tatakauashi', NULL)
,(10067, 100, '2009-12-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10068, 4,   '2008-10-05', '2009-09-30', NOW(), 'tatakauashi', NULL)
,(10068, 100, '2009-10-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

-- 2016年2月10日 22:52:47 きょんちゃん卒業
update Belonging set to_date = '2016-01-31' where belonging_id = 142;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
values (37, 100, '2016-02-01', '9999-12-31', NOW(), 'tatakauashi', NULL);

-- 2016年2月15日 23:17:24 まあちゃん、小石ちゃん卒業
update Belonging set to_date = '2016-02-29' where belonging_id = 150;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
values (40, 100, '2016-03-01', '9999-12-31', NOW(), 'tatakauashi', NULL);

update Belonging set to_date = '2016-02-29' where belonging_id = 160;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
values (45, 100, '2016-03-01', '9999-12-31', NOW(), 'tatakauashi', NULL);

-- 2016年3月5日 23:44:16 佐江ちゃん、ゆかりちゃんが卒業
update Belonging set to_date = '2016-03-31' where belonging_id = 96;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
values (14, 100, '2016-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL);

update Belonging set to_date = '2016-03-31' where belonging_id = 140;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
values (36, 100, '2016-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL);


-- 2016年3月12日 11:32:11 東日本大震災復興支援公演
INSERT INTO Program VALUES
(51, '特別公演', now(), 'tatakauashi', null)
;
INSERT INTO Event (event_id, event_name, regist_time, regist_user)
VALUES
(71, '東日本大震災復興支援公演', NOW(), 'tatakauashi')
;
INSERT INTO Event (event_id, event_name, regist_time, regist_user)
VALUES
(50, '元旦公演', NOW(), 'tatakauashi')
;


-- Stage_Memberテーブルに「一部出演か」のフラグを追加する
ALTER TABLE Stage_Member
  ADD COLUMN is_partial bit not null default false AFTER revision;


-- 半田礼音さん追加
INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user, delete_time)
VALUES
 (10069, '半田礼音', 'はんたあやねGGOGGG', NOW(), 'tatakauashi', NULL)
;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES 
 (10069, 4,   '2009-11-14', '2010-05-08', NOW(), 'tatakauashi', NULL)
,(10069, 100, '2010-05-09', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

-- 伊藤茜さん追加
INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user, delete_time)
VALUES
 (10070, '伊藤茜', 'いとうあかねGGGGGG', NOW(), 'tatakauashi', NULL)
;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES 
 (10070, 4,   '2013-01-01', '2013-05-09', NOW(), 'tatakauashi', NULL)
,(10070, 100, '2013-05-10', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

-- 宮脇理子さん追加
INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user, delete_time)
VALUES
 (10071, '宮脇理子', 'みやわきりこGGGGGG', NOW(), 'tatakauashi', NULL)
;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES 
 (10071, 4,   '2013-01-01', '2013-03-11', NOW(), 'tatakauashi', NULL)
,(10071, 100, '2013-03-12', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

-- 旧劇場最終公演での昇格発表より、所属日を修正。昇格発表の翌日から昇格先チーム所属に。
update Belonging set from_date='2012-08-30' WHERE from_date='2012-08-29' and member_id = 10016;
update Belonging set from_date='2012-08-30' WHERE from_date='2012-08-29' and member_id = 10025;
update Belonging set from_date='2012-08-30' WHERE from_date='2012-08-29' and member_id = 10003;
update Belonging set from_date='2012-08-30' WHERE from_date='2012-08-29' and member_id = 22;
update Belonging set from_date='2012-08-30' WHERE from_date='2012-08-29' and member_id = 47;
update Belonging set from_date='2012-08-30' WHERE from_date='2012-08-29' and member_id = 34;

update Belonging set to_date='2012-08-29' WHERE to_date='2012-08-28' and member_id = 10016;
update Belonging set to_date='2012-08-29' WHERE to_date='2012-08-28' and member_id = 10025;
update Belonging set to_date='2012-08-29' WHERE to_date='2012-08-28' and member_id = 10003;
update Belonging set to_date='2012-08-29' WHERE to_date='2012-08-28' and member_id = 22;
update Belonging set to_date='2012-08-29' WHERE to_date='2012-08-28' and member_id = 47;
update Belonging set to_date='2012-08-29' WHERE to_date='2012-08-28' and member_id = 34;

-- 2016年3月27日14:43:44 山田菜々さん追加
INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user, delete_time)
VALUES
 (10072, '山田菜々', 'やまたななGGOGG', NOW(), 'tatakauashi', NULL)
;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES 
 (10072, 2,   '2014-04-30', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(10072, 100, '2015-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

-- 2016年3月27日15:04:37 「元旦公演」を「元日公演」に修正
update Event set event_name = '元日公演' where event_id = 50;

-- 2016年3月27日 15:09:21 ゆりあちゃんの苗字を変更
UPDATE Member SET member_name = '木﨑ゆりあ' WHERE member_id = 10014;

-- 2016年3月27日14:43:44 野々山茉琳さん追加
INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user, delete_time)
VALUES
 (10073, '野々山茉琳', 'ののやままりんGGGGGGG', NOW(), 'tatakauashi', NULL)
;
INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES 
 (10073, 4,   '2010-12-06', '2011-02-23', NOW(), 'tatakauashi', NULL)
,(10073, 100, '2011-02-24', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

-- イベントに「その他特別公演」を追加
INSERT INTO Event VALUES
(6, 'その他出張公演', now(), 'tatakauashi', null)
;
