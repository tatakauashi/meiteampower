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


-- 2016年3月31日23:00:32 シャッフル公演調査。メインチームとそれ以外のメンバーをわけで出力する。
SELECT  t.stage_id
      , t.is_shuffled
--      , count(*) as all
--      , count(case when t.regular = 0 then 1 end) AS regular
      , count(t.regular_name) AS regular
--      , count(case when t.regular = 1 then 1 end) as helper
      , count(t.helper_name) AS helper
--      , count(case when t.regular = 2 then 1 end) as trainee
      , count(t.trainee_name) AS trainee
      , group_concat(t.regular_name order by t.order1, t.order2 separator '・') as regular_name
      , group_concat(t.helper_name order by t.order1, t.order2 separator '・') as helper_name
      , group_concat(t.trainee_name order by t.order1, t.order2 separator '・') as trainee_name
from (
select
    s.stage_id
  , s.stage_date
--  , s.stage_time
  , s.program_id
  , s.is_shuffled + '' AS is_shuffled
--  , s.revision
--  , m.member_id
  , m.member_name
  , m.team_id
  , m.order1
  , m.order2
--  , CASE WHEN (s.program_id = 4 AND m.team_id = 1) OR (s.program_id = 2 AND m.team_id = 3) OR (s.program_id = 6 AND m.team_id = 2) THEN 0
--         WHEN m.team_id = 4 THEN 2 ELSE 1 END AS regular
--  , CASE WHEN regular = 0 THEN m.member_name ELSE null END AS regular_name
  , CASE WHEN (s.program_id = 4 AND m.team_id = 1) OR (s.program_id = 2 AND m.team_id = 3) OR (s.program_id = 6 AND m.team_id = 2) THEN m.member_name ELSE null END AS regular_name
--  , CASE WHEN regular = 1 THEN m.member_name ELSE null END AS helper_name
  , CASE WHEN m.team_id != 4 AND ((s.program_id = 4 AND m.team_id != 1) OR (s.program_id = 2 AND m.team_id != 3) OR (s.program_id = 6 AND m.team_id != 2)) THEN m.member_name ELSE null END AS helper_name
--  , CASE WHEN regular = 2 THEN m.member_name ELSE null END AS trainee_name
  , CASE WHEN m.team_id = 4 THEN m.member_name ELSE null END AS trainee_name
from Stage_View s
JOIN Stage_Member sm ON (sm.stage_id = s.stage_id AND sm.revision = s.revision)
JOIN Member_View m ON (m.member_id = sm.member_id and m.from_date <= s.stage_date AND m.to_date >= s.stage_date)
) t
WHERE t.stage_date BETWEEN '2015-01-01' AND '2016-12-31' and t.program_id in (2, 4, 6)
group by t.stage_id, t.is_shuffled
;

REM SQLをコマンドプロンプトから実行する
>mysql -uroot -p db_wordpress < C:\Users\kie\git\wordpress\queries\Ins.sql > C:\Users\kie\git\wordpress\dump\stage_list_20160428.sql

-- 公演リスト
select s.stage_date, s.stage_time, p.program_name, group_concat(rl.link SEPARATOR '\t') as links
from Stage_View s 
JOIN Program p ON (s.program_id = p.program_id) 
JOIN Stage_Member sm ON (s.stage_id = sm.stage_id AND s.revision = sm.revision AND sm.member_id = 48)
JOIN Related_Link rl ON (s.stage_id = rl.stage_id AND s.revision = rl.revision AND rl.link NOT LIKE 'http://music.geocities.jp/%')
group by s.stage_date, s.stage_time, p.program_name;



-- 2016年8月2日 22:47:21 特定の回数まであとわずか、なメンバーを一覧する。
SELECT -- t.member_id, 
       m.member_name AS `メンバー名`, FLOOR(t.cnt / 100) * 100 + 100 AS `区切りの回数`, 100 - (t.cnt % 100) AS `残り公演数` FROM (
	SELECT sm.member_id, count(*) AS cnt FROM Stage_View s JOIN Stage_Member sm ON (sm.stage_id = s.stage_id AND sm.revision = s.revision)
	WHERE NOT EXISTS (SELECT 'x' FROM Program p WHERE p.program_id = s.program_id AND p.program_id = 51)
	  AND s.stage_date <= '2016-08-02'  -- NOW()
	GROUP BY sm.member_id
) t
JOIN Member m ON (m.member_id = t.member_id) JOIN Belonging b ON (b.member_id = m.member_id)
WHERE b.from_date <= NOW() AND b.to_date >= NOW() AND b.team_id <> 100
ORDER BY `残り公演数`, `区切りの回数` DESC, b.team_id, m.sort_order;
