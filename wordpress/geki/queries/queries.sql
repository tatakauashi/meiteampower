
SELECT t.user_hash, t.revision, sum(votes) as votes from (
  SELECT h.user_hash, h.revision, sum(a.mei_count + a.other_count) as votes
  from history_latest_view h 
  JOIN allocations a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision
 UNION
  SELECT h.user_hash, h.revision, sum(a.mobile * 10 + a.other) as votes
  from history_latest_view h 
  JOIN my_allocated_votes a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision
 UNION
  SELECT h.user_hash, h.revision, sum(a.mobile * 5 + a.other) as votes
  from history_latest_view h 
  JOIN friends_votes a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision
 UNION
  SELECT h.user_hash, h.revision, floor(a.money / 800) as votes
  from history_latest_view h 
  JOIN bulk_budgets a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision
) t
group by t.user_hash, t.revision
;

-- 2016/05/07 03:51
insert into votes values
  ('0dc05a87',6,169)
, ('16d99370',17,3909)
, ('62c40225',1,80)
, ('75a0a3b5',1,396)
, ('b75f62a0',1,751)
, ('c1f66ed4',2,267)
, ('c372fbfe',5,38)
, ('ca05101f',1,0)
, ('e0a708e2',1,1689)
, ('fe4fd181',1,175)


SELECT sum(a.money) as votes
from history_latest_view h 
JOIN bulk_budgets a ON (a.user_hash = h.user_hash AND a.revision = h.revision)

SELECT sum(floor(a.money / 800)) as votes
from history_latest_view h 
JOIN bulk_budgets a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
;


  SELECT sum(a.mobile * 5 + a.other) as votes
  from history_latest_view h 
  JOIN friends_votes a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision

  SELECT sum(a.mobile * 10 + a.other) as votes
  from history_latest_view h 
  JOIN my_allocated_votes a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision


  SELECT h.user_hash, h.revision, date_id, division_id, a.mei_count, a.other_count as votes
  from history_latest_view h 
  JOIN allocations a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
  group by h.user_hash, h.revision


SELECT h.user_hash, h.revision, a.mei_count, a.other_count, mav.mobile as my_mob, mav.other as my_other, fv.mobile as f_mob, fv.other as f_other, bb.money
FROM history_latest_view h 
JOIN (
  SELECT `Allocation`.user_hash, `Allocation`.revision, sum(`Allocation`.mei_count) as mei_count, sum(`Allocation`.other_count) as other_count
  FROM allocations `Allocation`
  group by `Allocation`.user_hash, `Allocation`.revision) a ON (a.user_hash = h.user_hash AND a.revision = h.revision)
JOIN my_allocated_votes mav ON (mav.user_hash = h.user_hash AND mav.revision = h.revision)
JOIN friends_votes fv ON (fv.user_hash = h.user_hash AND fv.revision = h.revision)
JOIN bulk_budgets bb ON (bb.user_hash = h.user_hash AND bb.revision = h.revision)
;
