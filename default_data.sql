
--
-- Base DATA
--
-- UPDATE `setting` SET content='hand_made' WHERE name='theme';
-- UPDATE `setting` SET content='width,96,true,true' WHERE name='thumb_small';
-- UPDATE `setting` SET content='Hand Made' WHERE name='site_title';


INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(1, '직업', ' 대분류 카테고리 직업 ', 0, 1, 0);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(2, '부동산', ' 대분류 카테고리 부동산 ', 0, 1, 0);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(3, '생활 로그', ' 대분류 카테고리 생활 로그 ', 0, 1, 0);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(4, '업체', ' 대분류 카테고리 업체 ', 0, 1, 0);

INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(5, '컴퓨터/통신', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(6, '전기/전자', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(7, '가구/비품', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(8, '여성/유아/학생', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(9, '레저/취미/종교', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(10, '식품/건강/기타', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(11, '영업/산업용품', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(12, '전문대여', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(13, '전문대행', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(14, '전문상담', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(15, '배달운송', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(16, '설비/인테리어', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(17, '주문제작', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(19, '세일정보', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(20, '사업정보/대리점', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(21, '건강/병원', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(22, '학원생/회원모집', ' 업체 하위 카테고리 ', 0, 1, 4);
INSERT INTO `categories` (`id`, `name`, `description`, `weight`, `display`, `parent_id`) VALUES 
							(23, '상담/모집기타', ' 업체 하위 카테고리 ', 0, 1, 4);
--  지역게시판
--  직거래장터
    
-- DELETE FROM `categories`;
