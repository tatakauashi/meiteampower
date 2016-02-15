-- SELECT sm.stage_id, sm.revision, sm.member_id, m.member_name FROM Stage_Member sm 
SELECT sm.member_id, m.member_name, COUNT(*) AS CNT FROM Stage_Member sm 
JOIN (SELECT s.stage_id, MAX(s.revision) AS revision FROM Stage s GROUP BY s.stage_id) s2
  ON (s2.stage_id = sm.stage_id AND s2.revision = sm.revision)
JOIN Member m ON (m.member_id = sm.member_id)
-- WHERE m.member_id = 48
GROUP BY sm.member_id, m.member_name
-- ORDER BY sm.stage_id, m.member_name;
ORDER BY CNT DESC;



select sm.member_id, m.member_name, count(*) AS CNT from Stage_Member sm
JOIN (Select sm2.stage_id, MAX(sm2.revision) AS revision FROM Stage_Member sm2 GROUP BY sm2.stage_id) sm3 ON (sm3.stage_id =sm.stage_id AND sm3.revision = sm.revision)
JOIN Member m ON (sm.member_id = m.member_id)
WHERE sm.stage_id BETWEEN 2015010101 AND 2015123105
GROUP BY sm.member_id
ORDER BY CNT DESC
;

SELECT t.stage_date, COUNT(*) AS CNT FROM (
	select sm.stage_id, s3.stage_date, s3.delete_time, sm.member_id, sm.revision
	FROM Stage_Member sm
	JOIN (select s.stage_id, MAX(s.revision) AS revision FROM Stage s GROUP BY s.stage_id, s.stage_date) s2
		ON (sm.stage_id = s2.stage_id AND sm.revision = s2.revision)
	JOIN Stage s3 ON (s3.stage_id = s2.stage_id AND s3.revision = s2.revision)
	WHERE sm.member_id = 48 AND s3.delete_time IS NULL
) t
GROUP BY t.stage_date
ORDER BY t.stage_date;


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
 (10064, 4, '2008-10-05', '2009-04-30', NOW(), 'tatakauashi', NULL)
,(10064, 100, '2009-05-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10065, 4, '2008-10-05', '2009-04-30', NOW(), 'tatakauashi', NULL)
,(10065, 100, '2009-05-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10066, 4, '2008-10-05', '2009-07-31', NOW(), 'tatakauashi', NULL)
,(10066, 100, '2009-08-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10067, 4, '2009-05-12', '2009-11-30', NOW(), 'tatakauashi', NULL)
,(10067, 100, '2009-12-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10068, 4, '2008-10-05', '2009-09-30', NOW(), 'tatakauashi', NULL)
,(10068, 100, '2009-10-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
;

select substring(s.stage_date + '', 1, 6) as dt, count(*)
from Stage_View s
JOIN Stage_Member sm ON (s.stage_id = sm.stage_id AND s.revision = sm.revision)
WHERE sm.member_id = 48
GROUP BY dt;


-- 前後の公演を取得する
select s1.* FROM Stage_View s1 WHERE s1.stage_id < 2016011101 order by stage_id desc limit 1
UNION
select s2.* FROM Stage_View s2 WHERE s2.stage_id > 2016011101 order by stage_id limit 1
;
