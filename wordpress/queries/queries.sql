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
