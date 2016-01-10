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
