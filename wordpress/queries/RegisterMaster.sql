SET NAMES utf8;

INSERT INTO Program VALUES
 (1, 'PARTYが始まるよ', now(), null)
,(2, '手をつなぎながら', now(), null)
,(3, '会いたかった', now(), null)
,(4, '制服の芽', now(), null)
,(5, 'パジャマドライブ', now(), null)
,(6, 'ラムネの飲み方', now(), null)
,(7, '逆上がり', now(), null)
,(8, 'RESET', now(), null)
,(9, 'シアターの女神', now(), null)
,(10, '僕の太陽', now(), null)
,(11, 'アップカミング', now(), null)
,(12, 'ミッドナイト', now(), null)
;

INSERT INTO Team (team_id, team_name, regist_time, regist_user)
VALUES
 (1, 'TeamS', NOW(), 'tatakauashi')
,(2, 'TeamKⅡ', NOW(), 'tatakauashi')
,(3, 'TeamE', NOW(), 'tatakauashi')
,(4, '研究生', NOW(), 'tatakauashi')
,(99, 'その他', NOW(), 'tatakauashi')
,(100, '卒業生', NOW(), 'tatakauashi')
;

INSERT INTO Member VALUES
 (1, '東李苑', 101, NOW(), null)
,(2, '犬塚あさな', 102, NOW(), null)
,(3, '大矢真那', 103, NOW(), null)
,(4, '北川綾巴', 104, NOW(), null)
,(5, '後藤理沙子', 105, NOW(), null)
,(6, '杉山愛佳', 106, NOW(), null)
,(7, '竹内舞', 107, NOW(), null)
,(8, '都築里佳', 108, NOW(), null)
,(9, '野口由芽', 109, NOW(), null)
,(10, '野島樺乃', 110, NOW(), null)
,(11, '二村春香', 111, NOW(), null)
,(12, '松井珠理奈', 112, NOW(), null)
,(13, '松本慈子', 113, NOW(), null)
,(14, '宮澤佐江', 114, NOW(), null)
,(15, '宮前杏実', 115, NOW(), null)
,(16, '矢方美紀', 116, NOW(), null)
,(17, '山内鈴蘭', 117, NOW(), null)
,(18, '山田樹奈', 118, NOW(), null)
,(19, '青木詩織', 201, NOW(), null)
,(20, '荒井優希', 202, NOW(), null)
,(21, '石田安奈', 203, NOW(), null)
,(22, '内山命', 204, NOW(), null)
,(23, '江籠裕奈', 205, NOW(), null)
,(24, '大場美奈', 206, NOW(), null)
,(25, '小畑優奈', 207, NOW(), null)
,(26, '北野瑠華', 208, NOW(), null)
,(27, '白井琴望', 209, NOW(), null)
,(28, '惣田紗莉渚', 210, NOW(), null)
,(29, '高木由麻奈', 211, NOW(), null)
,(30, '髙塚夏生', 212, NOW(), null)
,(31, '高柳明音', 213, NOW(), null)
,(32, '竹内彩姫', 214, NOW(), null)
,(33, '日高優月', 215, NOW(), null)
,(34, '古畑奈和', 216, NOW(), null)
,(35, '松村香織', 217, NOW(), null)
,(36, '山下ゆかり', 218, NOW(), null)
,(37, '磯原杏華', 301, NOW(), null)
,(38, '井田玲音名', 302, NOW(), null)
,(39, '市野成美', 303, NOW(), null)
,(40, '梅本まどか', 304, NOW(), null)
,(41, '加藤るみ', 305, NOW(), null)
,(42, '鎌田菜月', 306, NOW(), null)
,(43, '木本花音', 307, NOW(), null)
,(44, '熊崎晴香', 308, NOW(), null)
,(45, '小石公美子', 309, NOW(), null)
,(46, '後藤楽々', 310, NOW(), null)
,(47, '斉藤真木子', 311, NOW(), null)
,(48, '酒井萌衣', 312, NOW(), null)
,(49, '佐藤すみれ', 313, NOW(), null)
,(50, '柴田阿弥', 314, NOW(), null)
,(51, '菅原茉椰', 315, NOW(), null)
,(52, '須田亜香里', 316, NOW(), null)
,(53, '髙寺沙菜', 317, NOW(), null)
,(54, '谷真理佳', 318, NOW(), null)
,(55, '福士奈央', 319, NOW(), null)
,(56, '相川暖花', 401, NOW(), null)
,(57, '浅井裕華', 402, NOW(), null)
,(66, '一色嶺奈', 403, NOW(), null)
,(58, '太田彩夏', 404, NOW(), null)
,(59, '片岡成美', 405, NOW(), null)
,(67, '上村亜柚香', 406, NOW(), null)
,(60, '川崎成美', 407, NOW(), null)
,(61, '末永桜花', 408, NOW(), null)
,(62, '髙畑結希', 409, NOW(), null)
,(63, '町音葉', 410, NOW(), null)
,(68, '水野愛理', 411, NOW(), null)
,(64, '村井純奈', 412, NOW(), null)
,(65, '和田愛菜', 413, NOW(), null)
;

INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user)
VALUES
 (10001, '赤枝里々奈', 100100, NOW(), 'tatakauashi')
,(10002, '阿比留李帆', 100200, NOW(), 'tatakauashi')
,(10003, '井口栞里', 100300, NOW(), 'tatakauashi')
,(10004, '岩永亞美', 100400, NOW(), 'tatakauashi')
,(10005, '今出舞', 100500, NOW(), 'tatakauashi')
,(10006, '上野圭澄', 100600, NOW(), 'tatakauashi')
,(10007, '大脇有紗', 100700, NOW(), 'tatakauashi')
,(10008, '小木曽汐莉', 100800, NOW(), 'tatakauashi')
,(10009, '荻野利沙', 100900, NOW(), 'tatakauashi')
,(10010, '小野晴香', 101000, NOW(), 'tatakauashi')
,(10011, '折戸愛彩', 101100, NOW(), 'tatakauashi')
,(10012, '加藤智子', 101200, NOW(), 'tatakauashi')
,(10013, '金子栞', 101300, NOW(), 'tatakauashi')
,(10014, '木崎ゆりあ', 101400, NOW(), 'tatakauashi')
,(10015, '北原侑奈', 101500, NOW(), 'tatakauashi')
,(10055, '北原里英', 101550, NOW(), 'tatakauashi')
,(10016, '鬼頭桃菜', 101600, NOW(), 'tatakauashi')
,(10017, '木下有希子', 101700, NOW(), 'tatakauashi')
,(10018, '桑原みずき', 101800, NOW(), 'tatakauashi')
,(10051, '神門沙樹', 101850, NOW(), 'tatakauashi')
,(10019, '後藤真由子', 101900, NOW(), 'tatakauashi')
,(10020, '小林亜実', 102000, NOW(), 'tatakauashi')
,(10021, '小林絵未梨', 102100, NOW(), 'tatakauashi')
,(10022, '佐々木柚香', 102200, NOW(), 'tatakauashi')
,(10023, '佐藤聖羅', 102300, NOW(), 'tatakauashi')
,(10024, '佐藤実絵子', 102400, NOW(), 'tatakauashi')
,(10025, '菅なな子', 102500, NOW(), 'tatakauashi')
,(10026, '空美夕日', 102600, NOW(), 'tatakauashi')
,(10027, '高田志織', 102700, NOW(), 'tatakauashi')
,(10053, '田中菜津美', 102725, NOW(), 'tatakauashi')
,(10052, '辻のぞみ', 102750, NOW(), 'tatakauashi')
,(10028, '出口陽', 102800, NOW(), 'tatakauashi')
,(10029, '中西優香', 102900, NOW(), 'tatakauashi')
,(10030, '中村優花', 103000, NOW(), 'tatakauashi')
,(10031, '新土居沙也加', 103100, NOW(), 'tatakauashi')
,(10032, '秦佐和子', 103200, NOW(), 'tatakauashi')
,(10033, '原望奈美', 103300, NOW(), 'tatakauashi')
,(10034, '日置実希', 103400, NOW(), 'tatakauashi')
,(10035, '平田璃香子', 103500, NOW(), 'tatakauashi')
,(10036, '平松可奈子', 103600, NOW(), 'tatakauashi')
,(10037, '藤本美月', 103700, NOW(), 'tatakauashi')
,(10038, '古川愛李', 103800, NOW(), 'tatakauashi')
,(10039, '松井玲奈', 103900, NOW(), 'tatakauashi')
,(10040, '松本梨奈', 104000, NOW(), 'tatakauashi')
,(10041, '間野春香', 104100, NOW(), 'tatakauashi')
,(10042, '水埜帆乃香', 104200, NOW(), 'tatakauashi')
,(10043, '向田茉夏', 104300, NOW(), 'tatakauashi')
,(10044, '矢神久美', 104400, NOW(), 'tatakauashi')
,(10045, '矢野杏月', 104500, NOW(), 'tatakauashi')
,(10046, '山田恵里伽', 104600, NOW(), 'tatakauashi')
,(10047, '山田みずほ', 104700, NOW(), 'tatakauashi')
,(10048, '山田澪花', 104800, NOW(), 'tatakauashi')
,(10049, '山本由香', 104900, NOW(), 'tatakauashi')
,(10050, '若林倫香', 105000, NOW(), 'tatakauashi')
,(10054, '渡辺美優紀', 105100, NOW(), 'tatakauashi')
;


INSERT INTO Belonging
(member_id, team_id, from_date, regist_time, delete_time)
 VALUES
 (1, 1, NOW(), NOW(), null)
,(2, 1, NOW(), NOW(), null)
,(3, 1, NOW(), NOW(), null)
,(4, 1, NOW(), NOW(), null)
,(5, 1, NOW(), NOW(), null)
,(6, 1, NOW(), NOW(), null)
,(7, 1, NOW(), NOW(), null)
,(8, 1, NOW(), NOW(), null)
,(9, 1, NOW(), NOW(), null)
,(10, 1, NOW(), NOW(), null)
,(11, 1, NOW(), NOW(), null)
,(12, 1, NOW(), NOW(), null)
,(13, 1, NOW(), NOW(), null)
,(14, 1, NOW(), NOW(), null)
,(15, 1, NOW(), NOW(), null)
,(16, 1, NOW(), NOW(), null)
,(17, 1, NOW(), NOW(), null)
,(18, 1, NOW(), NOW(), null)
,(19, 2, NOW(), NOW(), null)
,(20, 2, NOW(), NOW(), null)
,(21, 2, NOW(), NOW(), null)
,(22, 2, NOW(), NOW(), null)
,(23, 2, NOW(), NOW(), null)
,(24, 2, NOW(), NOW(), null)
,(25, 2, NOW(), NOW(), null)
,(26, 2, NOW(), NOW(), null)
,(27, 2, NOW(), NOW(), null)
,(28, 2, NOW(), NOW(), null)
,(29, 2, NOW(), NOW(), null)
,(30, 2, NOW(), NOW(), null)
,(31, 2, NOW(), NOW(), null)
,(32, 2, NOW(), NOW(), null)
,(33, 2, NOW(), NOW(), null)
,(34, 2, NOW(), NOW(), null)
,(35, 2, NOW(), NOW(), null)
,(36, 2, NOW(), NOW(), null)
,(37, 3, NOW(), NOW(), null)
,(38, 3, NOW(), NOW(), null)
,(39, 3, NOW(), NOW(), null)
,(40, 3, NOW(), NOW(), null)
,(41, 3, NOW(), NOW(), null)
,(42, 3, NOW(), NOW(), null)
,(43, 3, NOW(), NOW(), null)
,(44, 3, NOW(), NOW(), null)
,(45, 3, NOW(), NOW(), null)
,(46, 3, NOW(), NOW(), null)
,(47, 3, NOW(), NOW(), null)
,(48, 3, NOW(), NOW(), null)
,(49, 3, NOW(), NOW(), null)
,(50, 3, NOW(), NOW(), null)
,(51, 3, NOW(), NOW(), null)
,(52, 3, NOW(), NOW(), null)
,(53, 3, NOW(), NOW(), null)
,(54, 3, NOW(), NOW(), null)
,(55, 3, NOW(), NOW(), null)
,(56, 4, NOW(), NOW(), null)
,(57, 4, NOW(), NOW(), null)
,(58, 4, NOW(), NOW(), null)
,(59, 4, NOW(), NOW(), null)
,(60, 4, NOW(), NOW(), null)
,(61, 4, NOW(), NOW(), null)
,(62, 4, NOW(), NOW(), null)
,(63, 4, NOW(), NOW(), null)
,(64, 4, NOW(), NOW(), null)
,(65, 4, NOW(), NOW(), null)
,(66, 4, NOW(), NOW(), null)
,(67, 4, NOW(), NOW(), null)
,(68, 4, NOW(), NOW(), null)
;

INSERT INTO Event (event_id, event_name, regist_time, regist_user)
VALUES
 (1, '生誕祭', NOW(), 'tatakauashi')
,(2, '劇場最終公演', NOW(), 'tatakauashi')
,(3, 'AKB48劇場出張公演', NOW(), 'tatakauashi')
,(4, 'NMB48劇場出張公演', NOW(), 'tatakauashi')
,(5, 'HKT48劇場出張公演', NOW(), 'tatakauashi')
;

UPDATE Member SET sort_order = 401 WHERE member_id = 56;
UPDATE Member SET sort_order = 402 WHERE member_id = 57;
UPDATE Member SET sort_order = 403 WHERE member_id = 66;
UPDATE Member SET sort_order = 404 WHERE member_id = 58;
UPDATE Member SET sort_order = 405 WHERE member_id = 59;
UPDATE Member SET sort_order = 406 WHERE member_id = 67;
UPDATE Member SET sort_order = 407 WHERE member_id = 60;
UPDATE Member SET sort_order = 408 WHERE member_id = 61;
UPDATE Member SET sort_order = 409 WHERE member_id = 62;
UPDATE Member SET sort_order = 410 WHERE member_id = 63;
UPDATE Member SET sort_order = 411 WHERE member_id = 68;
UPDATE Member SET sort_order = 412 WHERE member_id = 64;
UPDATE Member SET sort_order = 413 WHERE member_id = 65;
;

UPDATE Member SET sort_order = (sort_order - 10000) * 100 + 100000 WHERE member_id >= 10001;

UPDATE Member SET sort_order = 101850 WHERE member_id = 10051;
UPDATE Member SET sort_order = 102750 WHERE member_id = 10052;
UPDATE Member SET sort_order = 102725 WHERE member_id = 10053;
UPDATE Member SET sort_order = 105400 WHERE member_id = 10054;

INSERT INTO Member (member_id, member_name, sort_order, regist_time, regist_user)
VALUES
 (10055, '北原里英', 101550, NOW(), 'tatakauashi')
;

INSERT INTO Team (team_id, team_name, sort_order, regist_time, regist_user)
VALUES
 (100, '卒業生', 100, NOW(), 'tatakauashi')
;

UPDATE Member SET sort_order = 'あすまりおんGOGGGG' WHERE member_id = 1;  -- 東李苑
UPDATE Member SET sort_order = 'いぬつかあさなGGOGGGG' WHERE member_id = 2;  -- 犬塚あさな
UPDATE Member SET sort_order = 'おおやまさなGGGGGG' WHERE member_id = 3;  -- 大矢真那
UPDATE Member SET sort_order = 'きたかわりようはGGOGGCGG' WHERE member_id = 4;  -- 北川綾巴
UPDATE Member SET sort_order = 'ことうりさこOGGGGG' WHERE member_id = 5;  -- 後藤理沙子
UPDATE Member SET sort_order = 'すきやまあいかGOGGGGG' WHERE member_id = 6;  -- 杉山愛佳
UPDATE Member SET sort_order = 'たけうちまいGGGGGG' WHERE member_id = 7;  -- 竹内舞
UPDATE Member SET sort_order = 'つつきりかGOGGG' WHERE member_id = 8;  -- 都築里佳
UPDATE Member SET sort_order = 'のくちゆめGOGGG' WHERE member_id = 9;  -- 野口由芽
UPDATE Member SET sort_order = 'のしまかのGOGGG' WHERE member_id = 10;  -- 野島樺乃
UPDATE Member SET sort_order = 'ふたむらはるかGGGGGGG' WHERE member_id = 11;  -- 二村春香
UPDATE Member SET sort_order = 'まついしゆりなGGGOCGG' WHERE member_id = 12;  -- 松井珠理奈
UPDATE Member SET sort_order = 'まつもとちかこGGGGGGG' WHERE member_id = 13;  -- 松本慈子
UPDATE Member SET sort_order = 'みやさわさえGGOGGG' WHERE member_id = 14;  -- 宮澤佐江
UPDATE Member SET sort_order = 'みやまえあみGGGGGG' WHERE member_id = 15;  -- 宮前杏実
UPDATE Member SET sort_order = 'やかたみきGGGGG' WHERE member_id = 16;  -- 矢方美紀
UPDATE Member SET sort_order = 'やまうちすすらんGGGGGOGG' WHERE member_id = 17;  -- 山内鈴蘭
UPDATE Member SET sort_order = 'やまたしゆなGGOOCG' WHERE member_id = 18;  -- 山田樹奈
UPDATE Member SET sort_order = 'あおきしおりGGGGGG' WHERE member_id = 19;  -- 青木詩織
UPDATE Member SET sort_order = 'あらいゆきGGGGG' WHERE member_id = 20;  -- 荒井優希
UPDATE Member SET sort_order = 'いしたあんなGGOGGG' WHERE member_id = 21;  -- 石田安奈
UPDATE Member SET sort_order = 'うちやまみことGGGGGGG' WHERE member_id = 22;  -- 内山命
UPDATE Member SET sort_order = 'えこゆうなGOGGG' WHERE member_id = 23;  -- 江籠裕奈
UPDATE Member SET sort_order = 'おおはみなGGOGG' WHERE member_id = 24;  -- 大場美奈
UPDATE Member SET sort_order = 'おはたゆなGOGGG' WHERE member_id = 25;  -- 小畑優奈
UPDATE Member SET sort_order = 'きたのるかGGGGG' WHERE member_id = 26;  -- 北野瑠華
UPDATE Member SET sort_order = 'しらいことのGGGGGG' WHERE member_id = 27;  -- 白井琴望
UPDATE Member SET sort_order = 'そうたさりなGGOGGG' WHERE member_id = 28;  -- 惣田紗莉渚
UPDATE Member SET sort_order = 'たかきゆまなGGOGGG' WHERE member_id = 29;  -- 高木由麻奈
UPDATE Member SET sort_order = 'たかつかなつきGGGGGGG' WHERE member_id = 30;  -- 髙塚夏生
UPDATE Member SET sort_order = 'たかやなきあかねGGGGOGGG' WHERE member_id = 31;  -- 高柳明音
UPDATE Member SET sort_order = 'たけうちさきGGGGGG' WHERE member_id = 32;  -- 竹内彩姫
UPDATE Member SET sort_order = 'ひたかゆつきGOGGOG' WHERE member_id = 33;  -- 日高優月
UPDATE Member SET sort_order = 'ふるはたなおGGGGGG' WHERE member_id = 34;  -- 古畑奈和
UPDATE Member SET sort_order = 'まつむらかおりGGGGGGG' WHERE member_id = 35;  -- 松村香織
UPDATE Member SET sort_order = 'やましたゆかりGGGGGGG' WHERE member_id = 36;  -- 山下ゆかり
UPDATE Member SET sort_order = 'いそはらきようかGGGGGCGG' WHERE member_id = 37;  -- 磯原杏華
UPDATE Member SET sort_order = 'いたれおなGOGGG' WHERE member_id = 38;  -- 井田玲音名
UPDATE Member SET sort_order = 'いちのなるみGGGGGG' WHERE member_id = 39;  -- 市野成美
UPDATE Member SET sort_order = 'うめもとまとかGGGGGOG' WHERE member_id = 40;  -- 梅本まどか
UPDATE Member SET sort_order = 'かとうるみGGGGG' WHERE member_id = 41;  -- 加藤るみ
UPDATE Member SET sort_order = 'かまたなつきGGGGGG' WHERE member_id = 42;  -- 鎌田菜月
UPDATE Member SET sort_order = 'きもとかのんGGGGGG' WHERE member_id = 43;  -- 木本花音
UPDATE Member SET sort_order = 'くまさきはるかGGOGGGG' WHERE member_id = 44;  -- 熊崎晴香
UPDATE Member SET sort_order = 'こいしくみこGGGGGG' WHERE member_id = 45;  -- 小石公美子
UPDATE Member SET sort_order = 'ことうららOGGGG' WHERE member_id = 46;  -- 後藤楽々
UPDATE Member SET sort_order = 'さいとうまきこGGGGGGG' WHERE member_id = 47;  -- 斉藤真木子
UPDATE Member SET sort_order = 'さかいめいGGGGG' WHERE member_id = 48;  -- 酒井萌衣
UPDATE Member SET sort_order = 'さとうすみれGGGGGG' WHERE member_id = 49;  -- 佐藤すみれ
UPDATE Member SET sort_order = 'しはたあやGOGGG' WHERE member_id = 50;  -- 柴田阿弥
UPDATE Member SET sort_order = 'すかわらまやGOGGGG' WHERE member_id = 51;  -- 菅原茉椰
UPDATE Member SET sort_order = 'すたあかりGOGGG' WHERE member_id = 52;  -- 須田亜香里
UPDATE Member SET sort_order = 'たかてらさなGGGGGG' WHERE member_id = 53;  -- 髙寺沙菜
UPDATE Member SET sort_order = 'たにまりかGGGGG' WHERE member_id = 54;  -- 谷真理佳
UPDATE Member SET sort_order = 'ふくしなおGGGGG' WHERE member_id = 55;  -- 福士奈央
UPDATE Member SET sort_order = 'あいかわほのかGGGGGGG' WHERE member_id = 56;  -- 相川暖花
UPDATE Member SET sort_order = 'あさいゆうかGGGGGG' WHERE member_id = 57;  -- 浅井裕華
UPDATE Member SET sort_order = 'いつしきれなGCGGGG' WHERE member_id = 66;  -- 一色嶺奈
UPDATE Member SET sort_order = 'おおたあやかGGGGGG' WHERE member_id = 58;  -- 太田彩夏
UPDATE Member SET sort_order = 'かたおかなるみGGGGGGG' WHERE member_id = 59;  -- 片岡成美
UPDATE Member SET sort_order = 'かみむらあゆかGGGGGGG' WHERE member_id = 67;  -- 上村亜柚香
UPDATE Member SET sort_order = 'かわさきなるみGGGGGGG' WHERE member_id = 60;  -- 川崎成美
UPDATE Member SET sort_order = 'すえなかおうかGGGOGGG' WHERE member_id = 61;  -- 末永桜花
UPDATE Member SET sort_order = 'たかはたゆうきGGGGGGG' WHERE member_id = 62;  -- 髙畑結希
UPDATE Member SET sort_order = 'まちおとはGGGGG' WHERE member_id = 63;  -- 町音葉
UPDATE Member SET sort_order = 'みすのあいりGOGGGG' WHERE member_id = 68;  -- 水野愛理
UPDATE Member SET sort_order = 'むらいしゆんなGGGOCGG' WHERE member_id = 64;  -- 村井純奈
UPDATE Member SET sort_order = 'わたあいなGOGGG' WHERE member_id = 65;  -- 和田愛菜
UPDATE Member SET sort_order = 'あかえたりりなGGGOGGG' WHERE member_id = 10001;  -- 赤枝里々奈
UPDATE Member SET sort_order = 'あひるりほGOGGG' WHERE member_id = 10002;  -- 阿比留李帆
UPDATE Member SET sort_order = 'いくちしおりGOGGGG' WHERE member_id = 10003;  -- 井口栞里
UPDATE Member SET sort_order = 'いわなかつくみGGGOGOG' WHERE member_id = 10004;  -- 岩永亞美
UPDATE Member SET sort_order = 'いまてまいGGOGG' WHERE member_id = 10005;  -- 今出舞
UPDATE Member SET sort_order = 'うえのかすみGGGGGG' WHERE member_id = 10006;  -- 上野圭澄
UPDATE Member SET sort_order = 'おおわきありさGGGGGGG' WHERE member_id = 10007;  -- 大脇有紗
UPDATE Member SET sort_order = 'おきそしおりGOGGGG' WHERE member_id = 10008;  -- 小木曽汐莉
UPDATE Member SET sort_order = 'おきのりさGOGGG' WHERE member_id = 10009;  -- 荻野利沙
UPDATE Member SET sort_order = 'おのはるかGGGGG' WHERE member_id = 10010;  -- 小野晴香
UPDATE Member SET sort_order = 'おりとあいさGGGGGG' WHERE member_id = 10011;  -- 折戸愛彩
UPDATE Member SET sort_order = 'かとうともこGGGGGG' WHERE member_id = 10012;  -- 加藤智子
UPDATE Member SET sort_order = 'かねこしおりGGGGGG' WHERE member_id = 10013;  -- 金子栞
UPDATE Member SET sort_order = 'きさきゆりあGOGGGG' WHERE member_id = 10014;  -- 木崎ゆりあ
UPDATE Member SET sort_order = 'きたはらゆうなGGGGGGG' WHERE member_id = 10015;  -- 北原侑奈
UPDATE Member SET sort_order = 'きたはらりえGGGGGG' WHERE member_id = 10055;  -- 北原里英
UPDATE Member SET sort_order = 'きとうももなGGGGGG' WHERE member_id = 10016;  -- 鬼頭桃菜
UPDATE Member SET sort_order = 'きのしたゆきこGGGGGGG' WHERE member_id = 10017;  -- 木下有希子
UPDATE Member SET sort_order = 'くわはらみすきGGOGGOG' WHERE member_id = 10018;  -- 桑原みずき
UPDATE Member SET sort_order = 'こうとさきOGGGG' WHERE member_id = 10051;  -- 神門沙樹
UPDATE Member SET sort_order = 'ことうまゆこOGGGGG' WHERE member_id = 10019;  -- 後藤真由子
UPDATE Member SET sort_order = 'こはやしあみGOGGGG' WHERE member_id = 10020;  -- 小林亜実
UPDATE Member SET sort_order = 'こはやしえみりGOGGGGG' WHERE member_id = 10021;  -- 小林絵未梨
UPDATE Member SET sort_order = 'ささきゆかGGGGG' WHERE member_id = 10022;  -- 佐々木柚香
UPDATE Member SET sort_order = 'さとうせいらGGGGGG' WHERE member_id = 10023;  -- 佐藤聖羅
UPDATE Member SET sort_order = 'さとうみえこGGGGGG' WHERE member_id = 10024;  -- 佐藤実絵子
UPDATE Member SET sort_order = 'すかななこGOGGG' WHERE member_id = 10025;  -- 菅なな子
UPDATE Member SET sort_order = 'そらみゆかGGGGG' WHERE member_id = 10026;  -- 空美夕日
UPDATE Member SET sort_order = 'たかたしおりGGOGGG' WHERE member_id = 10027;  -- 高田志織
UPDATE Member SET sort_order = 'たなかなつみGGGGGG' WHERE member_id = 10053;  -- 田中菜津美
UPDATE Member SET sort_order = 'つしのそみGOGOG' WHERE member_id = 10052;  -- 辻のぞみ
UPDATE Member SET sort_order = 'てくちあきOOGGG' WHERE member_id = 10028;  -- 出口陽
UPDATE Member SET sort_order = 'なかにしゆうかGGGGGGG' WHERE member_id = 10029;  -- 中西優香
UPDATE Member SET sort_order = 'なかむらゆうかGGGGGGG' WHERE member_id = 10030;  -- 中村優花
UPDATE Member SET sort_order = 'にいといさやかGGOGGGG' WHERE member_id = 10031;  -- 新土居沙也加
UPDATE Member SET sort_order = 'はたさわこGGGGG' WHERE member_id = 10032;  -- 秦佐和子
UPDATE Member SET sort_order = 'はらみなみGGGGG' WHERE member_id = 10033;  -- 原望奈美
UPDATE Member SET sort_order = 'ひおきみきGGGGG' WHERE member_id = 10034;  -- 日置実希
UPDATE Member SET sort_order = 'ひらたりかこGGGGGG' WHERE member_id = 10035;  -- 平田璃香子
UPDATE Member SET sort_order = 'ひらまつかなこGGGGGGG' WHERE member_id = 10036;  -- 平松可奈子
UPDATE Member SET sort_order = 'ふしもとみつきGOGGGGG' WHERE member_id = 10037;  -- 藤本美月
UPDATE Member SET sort_order = 'ふるかわあいりGGGGGGG' WHERE member_id = 10038;  -- 古川愛李
UPDATE Member SET sort_order = 'まついれなGGGGG' WHERE member_id = 10039;  -- 松井玲奈
UPDATE Member SET sort_order = 'まつもとりなGGGGGG' WHERE member_id = 10040;  -- 松本梨奈
UPDATE Member SET sort_order = 'まのはるかGGGGG' WHERE member_id = 10041;  -- 間野春香
UPDATE Member SET sort_order = 'みすのほのかGOGGGG' WHERE member_id = 10042;  -- 水埜帆乃香
UPDATE Member SET sort_order = 'むかいたまなつGGGOGGG' WHERE member_id = 10043;  -- 向田茉夏
UPDATE Member SET sort_order = 'やかみくみGOGGG' WHERE member_id = 10044;  -- 矢神久美
UPDATE Member SET sort_order = 'やのあつきGGGOG' WHERE member_id = 10045;  -- 矢野杏月
UPDATE Member SET sort_order = 'やまたえりかGGOGGG' WHERE member_id = 10046;  -- 山田恵里伽
UPDATE Member SET sort_order = 'やまたみすほGGOGOG' WHERE member_id = 10047;  -- 山田みずほ
UPDATE Member SET sort_order = 'やまたれいかGGOGGG' WHERE member_id = 10048;  -- 山田澪花
UPDATE Member SET sort_order = 'やまもとゆかGGGGGG' WHERE member_id = 10049;  -- 山本由香
UPDATE Member SET sort_order = 'わかはやしともかGGOGGGGG' WHERE member_id = 10050;  -- 若林倫香
UPDATE Member SET sort_order = 'わたなへみゆきGGGOGGG' WHERE member_id = 10054;  -- 渡辺美優紀

UPDATE Team SET sort_order = team_id;

INSERT INTO Member VALUES
 (10056, '新海里奈', 'しんかいりなGGGGGG', NOW(), 'tatakauashi', NULL)
,(10057, '鈴木きらら', 'すすきららGOGGG', NOW(), 'tatakauashi', NULL)
,(10058, '高井つき奈', 'たかいつきなGGGGGG', NOW(), 'tatakauashi', NULL)
,(10059, '松下唯', 'まつしたゆいGGGGGG', NOW(), 'tatakauashi', NULL)
,(10060, '山下もえ', 'やましたもえGGGGGG', NOW(), 'tatakauashi', NULL)
,(10061, '森紗雪', 'もりさゆきGGGGG', NOW(), 'tatakauashi', NULL)
,(10062, '市原佑梨', 'いちはらゆりGGGGGG', NOW(), 'tatakauashi', NULL)
,(10063, '前田栄子', 'まえたえいこGGOGGG', NOW(), 'tatakauashi', NULL);

DELETE FROM Belonging;

INSERT INTO Belonging (member_id, team_id, from_date, to_date, regist_time, regist_user, delete_time)
VALUES
 (1, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(1, 3, '2013-07-24', '2014-04-24', NOW(), 'tatakauashi', NULL)
,(1, 4, '2013-01-01', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(2, 1, '2014-08-04', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(2, 4, '2010-12-06', '2014-08-03', NOW(), 'tatakauashi', NULL)
,(3, 1, '2008-10-05', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(4, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(4, 4, '2013-01-01', '2014-04-24', NOW(), 'tatakauashi', NULL)
,(5, 1, '2013-07-23', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(5, 2, '2010-12-06', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(5, 4, '2009-11-14', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(6, 1, '2015-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(6, 4, '2015-03-22', '2015-11-27', NOW(), 'tatakauashi', NULL)
,(7, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(7, 2, '2013-07-25', '2014-04-24', NOW(), 'tatakauashi', NULL)
,(7, 3, '2010-12-06', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(8, 1, '2013-07-23', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(8, 3, '2010-12-06', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(9, 1, '2014-08-04', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(9, 4, '2013-01-01', '2014-08-03', NOW(), 'tatakauashi', NULL)
,(10, 1, '2015-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10, 4, '2015-03-22', '2015-11-27', NOW(), 'tatakauashi', NULL)
,(11, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(11, 2, '2013-07-25', '2014-04-24', NOW(), 'tatakauashi', NULL)
,(11, 4, '2011-11-26', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(12, 1, '2008-10-05', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(13, 1, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(14, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(15, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(15, 3, '2013-07-24', '2014-04-24', NOW(), 'tatakauashi', NULL)
,(15, 4, '2011-11-26', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(16, 1, '2013-07-23', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(16, 2, '2010-12-06', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(16, 4, '2009-11-14', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(17, 1, '2014-04-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(18, 1, '2015-03-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(18, 4, '2013-01-01', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(19, 2, '2015-03-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(19, 4, '2013-01-01', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(20, 2, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(21, 2, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(21, 1, '2013-07-23', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(21, 2, '2009-05-12', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(22, 2, '2013-07-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(22, 3, '2012-08-29', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(22, 4, '2010-12-07', '2012-08-28', NOW(), 'tatakauashi', NULL)
,(22, 2, '2009-05-12', '2010-12-06', NOW(), 'tatakauashi', NULL)
,(23, 2, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(23, 1, '2013-07-23', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(23, 4, '2011-11-26', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(24, 2, '2013-04-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(25, 2, '2015-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(25, 4, '2015-03-22', '2015-11-27', NOW(), 'tatakauashi', NULL)
,(26, 2, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(26, 4, '2013-01-01', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(27, 2, '2015-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(27, 4, '2015-06-12', '2015-11-27', NOW(), 'tatakauashi', NULL)
,(28, 2, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(29, 2, '2013-07-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(29, 3, '2010-12-06', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(30, 2, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(31, 2, '2009-05-12', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(32, 2, '2015-03-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(32, 4, '2013-01-01', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(33, 2, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(33, 4, '2013-01-01', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(34, 2, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(34, 3, '2012-08-29', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(34, 4, '2011-11-26', '2012-08-28', NOW(), 'tatakauashi', NULL)
,(35, 2, '2015-03-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(35, 4, '2009-11-14', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(36, 2, '2013-07-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(36, 3, '2010-12-06', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(37, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(37, 1, '2013-07-23', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(37, 3, '2010-12-06', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(37, 4, '2009-05-12', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(38, 3, '2015-03-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(38, 4, '2013-01-01', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(39, 3, '2013-07-24', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(39, 4, '2011-11-26', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(40, 3, '2010-12-06', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(41, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(41, 2, '2013-07-25', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(41, 1, '2010-08-21', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(41, 4, '2009-05-12', '2010-08-20', NOW(), 'tatakauashi', NULL)
,(42, 3, '2015-03-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(42, 4, '2013-01-01', '2015-03-30', NOW(), 'tatakauashi', NULL)
,(43, 3, '2010-12-06', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(44, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(44, 4, '2013-01-01', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(45, 3, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(46, 3, '2015-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(46, 4, '2015-03-22', '2015-11-27', NOW(), 'tatakauashi', NULL)
,(47, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(47, 1, '2013-07-23', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(47, 3, '2012-08-29', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(47, 4, '2010-12-07', '2012-08-28', NOW(), 'tatakauashi', NULL)
,(47, 2, '2009-05-12', '2010-12-06', NOW(), 'tatakauashi', NULL)
,(48, 3, '2010-12-06', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(49, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(50, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(50, 2, '2013-07-25', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(50, 3, '2010-12-06', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(51, 3, '2015-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(51, 4, '2015-06-12', '2015-11-27', NOW(), 'tatakauashi', NULL)
,(52, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(52, 2, '2013-07-25', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(52, 1, '2010-02-27', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(52, 4, '2009-11-14', '2010-02-26', NOW(), 'tatakauashi', NULL)
,(53, 3, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(54, 3, '2014-05-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(55, 3, '2014-01-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(56, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(57, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(66, 4, '2015-06-12', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(58, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(59, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(67, 4, '2015-06-12', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(60, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(61, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(62, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(63, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(68, 4, '2015-06-12', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(64, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(65, 4, '2015-03-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10001, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10001, 2, '2009-05-12', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10002, 100, '2015-05-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10002, 2, '2014-04-30', '2015-04-30', NOW(), 'tatakauashi', NULL)
,(10002, 1, '2013-07-23', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10002, 2, '2010-12-06', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(10002, 4, '2009-05-12', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(10003, 100, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10003, 3, '2013-07-24', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10003, 2, '2012-08-29', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10003, 4, '2010-12-06', '2012-08-28', NOW(), 'tatakauashi', NULL)
,(10003, 2, '2009-05-12', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(10004, 100, '2015-03-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10004, 3, '2013-07-24', '2015-02-28', NOW(), 'tatakauashi', NULL)
,(10004, 4, '2011-11-26', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(10005, 100, '2012-06-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10005, 4, '2009-11-14', '2012-05-31', NOW(), 'tatakauashi', NULL)
,(10006, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10006, 3, '2010-12-06', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10006, 4, '2009-11-14', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(10007, 100, '2014-07-31', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10007, 3, '2014-05-02', '2014-07-30', NOW(), 'tatakauashi', NULL)
,(10007, 4, '2011-11-26', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(10008, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10008, 2, '2010-02-25', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10008, 4, '2009-11-14', '2010-02-24', NOW(), 'tatakauashi', NULL)
,(10009, 100, '2015-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10009, 4, '2011-11-26', '2015-03-31', NOW(), 'tatakauashi', NULL)
,(10010, 100, '2012-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10010, 1, '2008-10-05', '2012-03-31', NOW(), 'tatakauashi', NULL)
,(10011, 100, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10011, 4, '2013-01-01', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10012, 100, '2014-09-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10012, 2, '2009-05-12', '2014-09-29', NOW(), 'tatakauashi', NULL)
,(10013, 100, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10013, 3, '2010-12-06', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10014, 100, '2014-04-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10014, 1, '2010-06-23', '2014-04-21', NOW(), 'tatakauashi', NULL)
,(10014, 4, '2009-11-14', '2010-06-22', NOW(), 'tatakauashi', NULL)
,(10015, 100, '2013-11-23', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10015, 4, '2013-01-01', '2013-11-22', NOW(), 'tatakauashi', NULL)
,(10055, 100, '2013-04-29', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10055, 1, '2013-01-29', '2013-04-28', NOW(), 'tatakauashi', NULL)
,(10016, 100, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10016, 3, '2013-07-24', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10016, 1, '2012-08-29', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10016, 4, '2010-12-07', '2012-08-28', NOW(), 'tatakauashi', NULL)
,(10016, 2, '2009-05-12', '2010-12-06', NOW(), 'tatakauashi', NULL)
,(10017, 100, '2014-11-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10017, 2, '2014-04-30', '2014-11-27', NOW(), 'tatakauashi', NULL)
,(10017, 3, '2013-07-24', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10017, 1, '2010-02-27', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10017, 4, '2009-11-14', '2010-02-26', NOW(), 'tatakauashi', NULL)
,(10018, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10018, 1, '2008-10-05', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10051, 100, '2015-11-20', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10051, 2, '2014-01-25', '2015-11-19', NOW(), 'tatakauashi', NULL)
,(10019, 100, '2014-07-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10019, 4, '2013-01-01', '2014-07-29', NOW(), 'tatakauashi', NULL)
,(10020, 100, '2015-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10020, 3, '2014-05-02', '2015-03-31', NOW(), 'tatakauashi', NULL)
,(10020, 2, '2013-07-25', '2014-05-01', NOW(), 'tatakauashi', NULL)
,(10020, 3, '2010-12-06', '2013-07-24', NOW(), 'tatakauashi', NULL)
,(10021, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10021, 4, '2010-12-06', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10022, 100, '2015-03-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10022, 4, '2013-01-01', '2015-02-28', NOW(), 'tatakauashi', NULL)
,(10023, 100, '2014-02-28', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10023, 1, '2013-07-23', '2014-02-27', NOW(), 'tatakauashi', NULL)
,(10023, 2, '2009-05-12', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(10023, 4, '2008-10-05', '2009-05-11', NOW(), 'tatakauashi', NULL)
,(10024, 100, '2015-04-13', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10024, 1, '2014-04-25', '2015-04-12', NOW(), 'tatakauashi', NULL)
,(10024, 2, '2009-05-12', '2014-04-24', NOW(), 'tatakauashi', NULL)
,(10024, 4, '2008-10-05', '2009-05-11', NOW(), 'tatakauashi', NULL)
,(10025, 100, '2014-02-24', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10025, 3, '2013-07-24', '2014-02-23', NOW(), 'tatakauashi', NULL)
,(10025, 1, '2012-08-29', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10025, 4, '2011-11-26', '2012-08-28', NOW(), 'tatakauashi', NULL)
,(10026, 100, '2014-06-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10026, 4, '2013-01-01', '2014-05-31', NOW(), 'tatakauashi', NULL)
,(10027, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10027, 1, '2008-10-05', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10053, 100, '2015-05-29', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10053, 1, '2014-04-25', '2015-05-28', NOW(), 'tatakauashi', NULL)
,(10052, 100, '2015-12-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10052, 4, '2015-03-22', '2015-11-30', NOW(), 'tatakauashi', NULL)
,(10028, 100, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10028, 1, '2008-10-05', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10029, 100, '2015-04-13', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10029, 1, '2008-10-05', '2015-04-12', NOW(), 'tatakauashi', NULL)
,(10030, 100, '2012-01-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10030, 3, '2010-12-06', '2011-12-31', NOW(), 'tatakauashi', NULL)
,(10031, 100, '2013-12-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10031, 1, '2013-07-23', '2013-11-30', NOW(), 'tatakauashi', NULL)
,(10031, 4, '2011-11-26', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(10032, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10032, 2, '2010-12-06', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10032, 4, '2009-11-14', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(10033, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10033, 3, '2010-12-06', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10034, 100, '2013-06-02', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10034, 4, '2011-11-26', '2013-06-01', NOW(), 'tatakauashi', NULL)
,(10035, 100, '2012-12-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10035, 1, '2008-10-05', '2012-11-30', NOW(), 'tatakauashi', NULL)
,(10036, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10036, 1, '2008-11-29', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10036, 4, '2008-10-05', '2008-11-28', NOW(), 'tatakauashi', NULL)
,(10037, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10037, 4, '2011-11-26', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10038, 100, '2015-04-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10038, 2, '2009-05-12', '2015-03-31', NOW(), 'tatakauashi', NULL)
,(10039, 100, '2015-09-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10039, 3, '2013-07-24', '2015-08-31', NOW(), 'tatakauashi', NULL)
,(10039, 1, '2008-10-05', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10040, 100, '2014-04-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10040, 2, '2009-05-12', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10041, 100, '2012-05-27', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10041, 3, '2010-12-06', '2012-05-26', NOW(), 'tatakauashi', NULL)
,(10041, 4, '2009-05-12', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(10042, 100, '2015-01-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10042, 2, '2014-04-30', '2014-12-31', NOW(), 'tatakauashi', NULL)
,(10042, 3, '2013-07-24', '2014-04-29', NOW(), 'tatakauashi', NULL)
,(10042, 4, '2010-12-06', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10043, 100, '2014-03-24', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10043, 1, '2013-07-23', '2014-03-23', NOW(), 'tatakauashi', NULL)
,(10043, 2, '2009-05-12', '2013-07-22', NOW(), 'tatakauashi', NULL)
,(10044, 100, '2013-05-07', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10044, 1, '2008-10-05', '2013-05-06', NOW(), 'tatakauashi', NULL)
,(10045, 100, '2014-02-24', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10045, 4, '2013-01-01', '2014-02-23', NOW(), 'tatakauashi', NULL)
,(10046, 100, '2012-05-27', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10046, 3, '2010-12-06', '2012-05-26', NOW(), 'tatakauashi', NULL)
,(10046, 4, '2009-11-14', '2010-12-05', NOW(), 'tatakauashi', NULL)
,(10047, 100, '2015-03-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10047, 2, '2013-10-26', '2015-02-28', NOW(), 'tatakauashi', NULL)
,(10047, 4, '2011-11-26', '2013-10-25', NOW(), 'tatakauashi', NULL)
,(10048, 100, '2015-01-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10048, 3, '2013-07-24', '2014-12-31', NOW(), 'tatakauashi', NULL)
,(10048, 2, '2009-05-12', '2013-07-23', NOW(), 'tatakauashi', NULL)
,(10049, 100, '2014-03-23', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10049, 4, '2013-01-01', '2014-03-22', NOW(), 'tatakauashi', NULL)
,(10050, 100, '2012-08-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10050, 2, '2009-12-06', '2012-07-31', NOW(), 'tatakauashi', NULL)
,(10050, 4, '2009-05-12', '2009-12-05', NOW(), 'tatakauashi', NULL)
,(10054, 100, '2015-05-22', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10054, 1, '2014-04-25', '2015-05-21', NOW(), 'tatakauashi', NULL)
,(10056, 100, '2010-05-09', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10056, 4, '2010-04-02', '2010-05-08', NOW(), 'tatakauashi', NULL)
,(10056, 1, '2008-10-05', '2010-04-01', NOW(), 'tatakauashi', NULL)
,(10057, 100, '2008-11-25', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10057, 1, '2008-10-05', '2008-11-24', NOW(), 'tatakauashi', NULL)
,(10058, 100, '2009-09-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10058, 1, '2008-10-05', '2009-08-31', NOW(), 'tatakauashi', NULL)
,(10059, 100, '2011-10-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10059, 1, '2008-10-05', '2011-09-30', NOW(), 'tatakauashi', NULL)
,(10060, 100, '2009-12-26', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10060, 1, '2008-10-05', '2009-12-25', NOW(), 'tatakauashi', NULL)
,(10061, 100, '2010-05-09', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10061, 4, '2010-04-02', '2010-05-08', NOW(), 'tatakauashi', NULL)
,(10061, 1, '2009-02-14', '2010-04-01', NOW(), 'tatakauashi', NULL)
,(10061, 4, '2008-10-05', '2009-02-13', NOW(), 'tatakauashi', NULL)
,(10062, 100, '2009-12-01', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10062, 2, '2009-05-12', '2009-11-30', NOW(), 'tatakauashi', NULL)
,(10063, 100, '2009-11-30', '9999-12-31', NOW(), 'tatakauashi', NULL)
,(10063, 2, '2009-05-12', '2009-11-29', NOW(), 'tatakauashi', NULL)
;
