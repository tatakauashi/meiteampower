-- 公演
DROP TABLE IF EXISTS Stage;
CREATE TABLE Stage (
	stage_id int not null,	-- 公演ID yyyyMMddxx
	revision int not null default 1,	-- リビジョン
	program_id int not null,		-- 演目ID
	team_id int not null,				-- チームID
	stage_date date not null,				-- 公演日
	stage_time int not null,				-- その日の何回目の公演か
	is_shuffled bit not null default false,	-- シャッフル公演かどうか
	is_unofficial bit not null default false,
	regist_time datetime not null,	-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime			-- 削除日時
	PRIMARY KEY (stage_id, revision)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 公演名
DROP TABLE IF EXISTS Program;
CREATE TABLE Program (
	program_id int primary key,				-- 演目ID
	program_name nvarchar(200) not null,	-- 演目名
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime					-- 削除日時
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- チーム
DROP TABLE IF EXISTS Team;
CREATE TABLE Team (
	team_id int primary key,				-- チームID
	team_name nvarchar(200) not null,		-- チーム名
	sort_order int not null,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime					-- 削除日時
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- メンバー
DROP TABLE IF EXISTS Member;
CREATE TABLE Member (
	member_id int primary key,				-- メンバーID
	member_name nvarchar(200) not null,		-- メンバー名
	sort_order nvarchar(200) not null,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime					-- 削除日時
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 所属チーム
DROP TABLE IF EXISTS Belonging;
CREATE TABLE Belonging (
	belonging_id int primary key auto_increment,
	member_id int not null,
	team_id int not null,
	from_date date,
	to_date date,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime					-- 削除日時
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 公演出演メンバー
DROP TABLE IF EXISTS Stage_Member;
CREATE TABLE Stage_Member (
	stage_id int not null,
	member_id int not null,
	revision int not null default 1,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime,					-- 削除日時
	PRIMARY KEY (stage_id, member_id, revision)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Related_Link;
CREATE TABLE Related_Link (
	related_link_id int primary key auto_increment,
	stage_id int not null,
	revision int not null default 1,
	link nvarchar(2050) not null,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime					-- 削除日時
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 生誕祭、最終公演などのイベントのマスタ
DROP TABLE IF EXISTS Event;
CREATE TABLE Event (
	event_id int primary key,
	event_name nvarchar(200) not null,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime					-- 削除日時
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 具体的な生誕祭などの情報
DROP TABLE IF EXISTS Stage_Event;
CREATE TABLE Stage_Event (
	stage_id int not null,
	event_id int not null,
	revision int not null default 1,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime,					-- 削除日時
	KEY stage_id (stage_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- イベントに関連するメンバー
DROP TABLE IF EXISTS Stage_Event_Member;
CREATE TABLE Stage_Event_Member (
	stage_id int not null,
	event_id int not null,
	member_id int not null,
	revision int not null default 1,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime,					-- 削除日時
	KEY stage_id (stage_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Stage_Comment;
CREATE TABLE Stage_Comment (
	stage_id int not null,
	branch_no int not null,
	revision int not null default 1,
	comment text not null,
	regist_time datetime not null,			-- 登録日時
	regist_user varchar(20) NOT NULL,
	delete_time datetime,					-- 削除日時
	PRIMARY KEY (stage_id, branch_no, revision)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
