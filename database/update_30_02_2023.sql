-- 30 January 2023 7:05:25 PM
CREATE TABLE `ID324796_chat`.`chat_emoticon` (`id` int AUTO_INCREMENT,`chat_id` int,`emoticon_id` int, PRIMARY KEY (id));

-- 30 January 2023 7:04:42 PM
CREATE TABLE `ID324796_chat`.`emoticons` (`id` int AUTO_INCREMENT,`value` varchar(100), PRIMARY KEY (id));

-- 30 January 2023 7:09:05 PM
INSERT INTO `ID324796_chat`.`emoticons` (`value`) VALUES ('&#128513');
INSERT INTO `ID324796_chat`.`emoticons` (`value`) VALUES ('&#128514');
INSERT INTO `ID324796_chat`.`emoticons` (`value`) VALUES ('&#128517');
INSERT INTO `ID324796_chat`.`emoticons` (`value`) VALUES ('&#128561');

-- 30 January 2023 8:43:41 PM
ALTER TABLE `ID324796_chat`.`chat_emoticon`
ADD COLUMN `user_id` int(11) NULL;