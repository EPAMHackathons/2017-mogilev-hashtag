/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50717
 Source Host           : localhost
 Source Database       : telehelp

 Target Server Type    : MySQL
 Target Server Version : 50717
 File Encoding         : utf-8

 Date: 04/08/2017 10:45:53 AM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `botan_shortener`
-- ----------------------------
DROP TABLE IF EXISTS `botan_shortener`;
CREATE TABLE `botan_shortener` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `url` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Original URL',
  `short_url` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Shortened URL',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `botan_shortener_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `callback_query`
-- ----------------------------
DROP TABLE IF EXISTS `callback_query`;
CREATE TABLE `callback_query` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'Unique identifier for this query',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier',
  `message_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Unique message identifier',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the message sent via the bot in inline mode, that originated the query',
  `data` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Data associated with the callback button',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `chat_id` (`chat_id`),
  KEY `message_id` (`message_id`),
  KEY `chat_id_2` (`chat_id`,`message_id`),
  CONSTRAINT `callback_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `callback_query_ibfk_2` FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `message` (`chat_id`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `callback_query`
-- ----------------------------
BEGIN;
INSERT INTO `callback_query` VALUES ('339140573878520185', '78962318', '78962318', '36', null, 'identifier', '2017-04-08 10:09:20'), ('339140574672278949', '78962318', '78962318', '91', null, 'job1', '2017-04-08 07:27:41'), ('339140574896997239', '78962318', '78962318', '36', null, 'identifier', '2017-04-08 10:09:13'), ('339140575216845434', '78962318', '78962318', '91', null, 'job2', '2017-04-08 07:27:45'), ('1631953969000196434', '379968893', '379968893', '97', null, 'job1', '2017-04-08 07:27:52'), ('1631953970119786430', '379968893', '379968893', '97', null, 'job2', '2017-04-08 07:27:50');
COMMIT;

-- ----------------------------
--  Table structure for `chat`
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` bigint(20) NOT NULL COMMENT 'Unique user or chat identifier',
  `type` enum('private','group','supergroup','channel') COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Chat type, either private, group, supergroup or channel',
  `title` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT '' COMMENT 'Chat (group) title, is null if chat type is private',
  `username` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Username, for private chats, supergroups and channels if available',
  `all_members_are_administrators` tinyint(1) DEFAULT '0' COMMENT 'True if a all members of this group are admins',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
  `old_id` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier, this is filled when a group is converted to a supergroup',
  PRIMARY KEY (`id`),
  KEY `old_id` (`old_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `chat`
-- ----------------------------
BEGIN;
INSERT INTO `chat` VALUES ('78962318', 'private', null, 'antalos', null, '2017-04-08 09:51:02', '2017-04-08 07:29:38', null), ('379968893', 'private', null, 'SpinyMan', null, '2017-04-08 07:27:01', '2017-04-08 07:27:52', null);
COMMIT;

-- ----------------------------
--  Table structure for `chosen_inline_result`
-- ----------------------------
DROP TABLE IF EXISTS `chosen_inline_result`;
CREATE TABLE `chosen_inline_result` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `result_id` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'Identifier for this result',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `location` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Location object, user''s location',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the sent inline message',
  `query` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'The query that was used to obtain the result',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `chosen_inline_result_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `conversation`
-- ----------------------------
DROP TABLE IF EXISTS `conversation`;
CREATE TABLE `conversation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint(20) DEFAULT NULL COMMENT 'Unique user or chat identifier',
  `status` enum('active','cancelled','stopped') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'active' COMMENT 'Conversation state',
  `command` varchar(160) COLLATE utf8mb4_unicode_520_ci DEFAULT '' COMMENT 'Default command to execute',
  `notes` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Data stored from command',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `chat_id` (`chat_id`),
  KEY `status` (`status`),
  CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `edited_message`
-- ----------------------------
DROP TABLE IF EXISTS `edited_message`;
CREATE TABLE `edited_message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier',
  `message_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Unique message identifier',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `edit_date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was edited in timestamp format',
  `text` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, the actual UTF-8 text of the message max message length 4096 char utf8',
  `entities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text',
  `caption` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For message with caption, the actual UTF-8 text of the caption',
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`),
  KEY `chat_id_2` (`chat_id`,`message_id`),
  CONSTRAINT `edited_message_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`),
  CONSTRAINT `edited_message_ibfk_2` FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `message` (`chat_id`, `id`),
  CONSTRAINT `edited_message_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `edited_message`
-- ----------------------------
BEGIN;
INSERT INTO `edited_message` VALUES ('1', '78962318', '29', '78962318', '2017-04-08 10:07:28', '/job test', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null), ('2', '78962318', '36', '367008735', '2017-04-08 10:09:20', 'inline keyboard', null, null), ('3', '78962318', '37', '78962318', '2017-04-08 10:10:34', '/inlinekeyboard', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":15}]', null), ('4', '379968893', '84', '379968893', '2017-04-08 07:27:40', '/jobs', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null), ('5', '78962318', '91', '367008735', '2017-04-08 07:27:45', 'inline keyboard', null, null), ('6', '379968893', '97', '367008735', '2017-04-08 07:27:52', 'inline keyboard', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `inline_query`
-- ----------------------------
DROP TABLE IF EXISTS `inline_query`;
CREATE TABLE `inline_query` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'Unique identifier for this query',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `location` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Location of the user',
  `query` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Text of the query',
  `offset` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Offset of the result',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `inline_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `jobs`
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `command` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `chat_id` bigint(20) NOT NULL COMMENT 'Unique chat identifier',
  `id` bigint(20) unsigned NOT NULL COMMENT 'Unique message identifier',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier',
  `date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was sent in timestamp format',
  `forward_from` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier, sender of the original message',
  `forward_from_chat` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier, chat the original message belongs to',
  `forward_from_message_id` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier of the original message in the channel',
  `forward_date` timestamp NULL DEFAULT NULL COMMENT 'date the original message was sent in timestamp format',
  `reply_to_chat` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier',
  `reply_to_message` bigint(20) unsigned DEFAULT NULL COMMENT 'Message that this message is reply to',
  `text` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, the actual UTF-8 text of the message max message length 4096 char utf8mb4',
  `entities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text',
  `audio` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Audio object. Message is an audio file, information about the file',
  `document` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Document object. Message is a general file, information about the file',
  `photo` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Array of PhotoSize objects. Message is a photo, available sizes of the photo',
  `sticker` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Sticker object. Message is a sticker, information about the sticker',
  `video` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Video object. Message is a video, information about the video',
  `voice` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Voice Object. Message is a Voice, information about the Voice',
  `contact` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Contact object. Message is a shared contact, information about the contact',
  `location` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Location object. Message is a shared location, information about the location',
  `venue` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Venue object. Message is a Venue, information about the Venue',
  `caption` text COLLATE utf8mb4_unicode_520_ci COMMENT 'For message with caption, the actual UTF-8 text of the caption',
  `new_chat_member` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier, a new member was added to the group, information about them (this member may be bot itself)',
  `left_chat_member` bigint(20) DEFAULT NULL COMMENT 'Unique user identifier, a member was removed from the group, information about them (this member may be bot itself)',
  `new_chat_title` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'A chat title was changed to this value',
  `new_chat_photo` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Array of PhotoSize objects. A chat photo was change to this value',
  `delete_chat_photo` tinyint(1) DEFAULT '0' COMMENT 'Informs that the chat photo was deleted',
  `group_chat_created` tinyint(1) DEFAULT '0' COMMENT 'Informs that the group has been created',
  `supergroup_chat_created` tinyint(1) DEFAULT '0' COMMENT 'Informs that the supergroup has been created',
  `channel_chat_created` tinyint(1) DEFAULT '0' COMMENT 'Informs that the channel chat has been created',
  `migrate_to_chat_id` bigint(20) DEFAULT NULL COMMENT 'Migrate to chat identifier. The group has been migrated to a supergroup with the specified identifie',
  `migrate_from_chat_id` bigint(20) DEFAULT NULL COMMENT 'Migrate from chat identifier. The supergroup has been migrated from a group with the specified identifier',
  `pinned_message` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Message object. Specified message was pinned',
  PRIMARY KEY (`chat_id`,`id`),
  KEY `user_id` (`user_id`),
  KEY `forward_from` (`forward_from`),
  KEY `forward_from_chat` (`forward_from_chat`),
  KEY `reply_to_chat` (`reply_to_chat`),
  KEY `reply_to_message` (`reply_to_message`),
  KEY `new_chat_member` (`new_chat_member`),
  KEY `left_chat_member` (`left_chat_member`),
  KEY `migrate_from_chat_id` (`migrate_from_chat_id`),
  KEY `migrate_to_chat_id` (`migrate_to_chat_id`),
  KEY `reply_to_chat_2` (`reply_to_chat`,`reply_to_message`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`),
  CONSTRAINT `message_ibfk_3` FOREIGN KEY (`forward_from`) REFERENCES `user` (`id`),
  CONSTRAINT `message_ibfk_4` FOREIGN KEY (`forward_from_chat`) REFERENCES `chat` (`id`),
  CONSTRAINT `message_ibfk_5` FOREIGN KEY (`reply_to_chat`, `reply_to_message`) REFERENCES `message` (`chat_id`, `id`),
  CONSTRAINT `message_ibfk_6` FOREIGN KEY (`forward_from`) REFERENCES `user` (`id`),
  CONSTRAINT `message_ibfk_7` FOREIGN KEY (`new_chat_member`) REFERENCES `user` (`id`),
  CONSTRAINT `message_ibfk_8` FOREIGN KEY (`left_chat_member`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `message`
-- ----------------------------
BEGIN;
INSERT INTO `message` VALUES ('78962318', '1', '78962318', '2017-04-08 09:51:02', null, null, null, null, null, null, 'hi', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '2', '78962318', '2017-04-08 09:52:16', null, null, null, null, null, null, 'test', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '3', '78962318', '2017-04-08 09:52:17', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '5', '78962318', '2017-04-08 09:58:25', null, null, null, null, null, null, '/date', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '7', '78962318', '2017-04-08 09:58:31', null, null, null, null, null, null, '/forcereply test', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '9', '78962318', '2017-04-08 09:58:33', null, null, null, null, null, null, 'test', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '10', '78962318', '2017-04-08 09:58:47', null, null, null, null, null, null, 'we', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '11', '78962318', '2017-04-08 09:59:16', null, null, null, null, null, null, '/forcereply test', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '13', '78962318', '2017-04-08 10:00:08', null, null, null, null, null, null, '/forcereply test2', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '15', '78962318', '2017-04-08 10:00:22', null, null, null, null, null, null, '/forcereply test2', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '17', '78962318', '2017-04-08 10:00:57', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '19', '78962318', '2017-04-08 10:01:04', null, null, null, null, null, null, '/echo test', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '21', '78962318', '2017-04-08 10:01:08', null, null, null, null, null, null, '/date moscow', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '23', '78962318', '2017-04-08 10:04:43', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '25', '78962318', '2017-04-08 10:05:33', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '27', '78962318', '2017-04-08 10:07:23', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '29', '78962318', '2017-04-08 10:07:25', null, null, null, null, null, null, '/job', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '31', '78962318', '2017-04-08 10:07:31', null, null, null, null, null, null, '/job tes', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '33', '78962318', '2017-04-08 10:08:41', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '35', '78962318', '2017-04-08 10:08:45', null, null, null, null, null, null, '/inlinekeyboard', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":15}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '36', '367008735', '2017-04-08 10:08:45', null, null, null, null, null, null, 'inline keyboard', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '37', '78962318', '2017-04-08 10:09:33', null, null, null, null, null, null, 'wre', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '38', '78962318', '2017-04-08 10:10:37', null, null, null, null, null, null, '/inlinekeyboard', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":15}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '40', '78962318', '2017-04-08 10:10:45', null, null, null, null, null, null, '@TeleHelp222bot true', '[{\"type\":\"mention\",\"offset\":0,\"length\":15}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '87', '78962318', '2017-04-08 07:27:36', null, null, null, null, null, null, '/jobs', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '90', '78962318', '2017-04-08 07:27:40', null, null, null, null, null, null, '/jobs', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '91', '367008735', '2017-04-08 07:27:40', null, null, null, null, null, null, 'inline keyboard', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '100', '78962318', '2017-04-08 07:27:53', null, null, null, null, null, null, '/JOBS', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '103', '78962318', '2017-04-08 07:27:55', null, null, null, null, null, null, '/jobs', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '106', '78962318', '2017-04-08 07:28:17', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '109', '78962318', '2017-04-08 07:28:47', null, null, null, null, null, null, '/help', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '112', '78962318', '2017-04-08 07:28:51', null, null, null, null, null, null, '/job 1', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '115', '78962318', '2017-04-08 07:28:55', null, null, null, null, null, null, '/job 1', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '118', '78962318', '2017-04-08 07:29:08', null, null, null, null, null, null, '/job', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '121', '78962318', '2017-04-08 07:29:14', null, null, null, null, null, null, '/job', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('78962318', '123', '78962318', '2017-04-08 07:29:38', null, null, null, null, null, null, '/job sadsadf', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('379968893', '83', '379968893', '2017-04-08 07:27:01', null, null, null, null, null, null, 'test3', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('379968893', '84', '379968893', '2017-04-08 07:27:07', null, null, null, null, null, null, '/job', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('379968893', '95', '379968893', '2017-04-08 07:27:47', null, null, null, null, null, null, '/jobs', '[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]', null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null), ('379968893', '97', '367008735', '2017-04-08 07:27:47', null, null, null, null, null, null, 'inline keyboard', null, null, null, '', null, null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `request_limiter`
-- ----------------------------
DROP TABLE IF EXISTS `request_limiter`;
CREATE TABLE `request_limiter` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Unique chat identifier',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the sent inline message',
  `method` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Request method',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Table structure for `servers`
-- ----------------------------
DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `servers_credentials`
-- ----------------------------
DROP TABLE IF EXISTS `servers_credentials`;
CREATE TABLE `servers_credentials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `server_id` int(10) unsigned NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `private_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `login_password` (`login`,`password`),
  KEY `server_id` (`server_id`),
  CONSTRAINT `FK_SERVER_CREDENTIALS_SERVER_ID` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `servers_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `servers_jobs`;
CREATE TABLE `servers_jobs` (
  `server_id` int(10) unsigned NOT NULL,
  `script_id` int(10) unsigned NOT NULL,
  KEY `server_id` (`server_id`),
  KEY `script_id` (`script_id`),
  CONSTRAINT `FK_JOBS_JOB_ID` FOREIGN KEY (`script_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_JOBS_SERVER_ID` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `telegram_update`
-- ----------------------------
DROP TABLE IF EXISTS `telegram_update`;
CREATE TABLE `telegram_update` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'Update''s unique identifier',
  `chat_id` bigint(20) DEFAULT NULL COMMENT 'Unique chat identifier',
  `message_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Unique message identifier',
  `inline_query_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Unique inline query identifier',
  `chosen_inline_result_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Local chosen inline result identifier',
  `callback_query_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Unique callback query identifier',
  `edited_message_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Local edited message identifier',
  PRIMARY KEY (`id`),
  KEY `message_id` (`chat_id`,`message_id`),
  KEY `inline_query_id` (`inline_query_id`),
  KEY `chosen_inline_result_id` (`chosen_inline_result_id`),
  KEY `callback_query_id` (`callback_query_id`),
  KEY `edited_message_id` (`edited_message_id`),
  CONSTRAINT `telegram_update_ibfk_1` FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `message` (`chat_id`, `id`),
  CONSTRAINT `telegram_update_ibfk_2` FOREIGN KEY (`inline_query_id`) REFERENCES `inline_query` (`id`),
  CONSTRAINT `telegram_update_ibfk_3` FOREIGN KEY (`chosen_inline_result_id`) REFERENCES `chosen_inline_result` (`id`),
  CONSTRAINT `telegram_update_ibfk_4` FOREIGN KEY (`callback_query_id`) REFERENCES `callback_query` (`id`),
  CONSTRAINT `telegram_update_ibfk_5` FOREIGN KEY (`edited_message_id`) REFERENCES `edited_message` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `telegram_update`
-- ----------------------------
BEGIN;
INSERT INTO `telegram_update` VALUES ('60497753', '78962318', '1', null, null, null, null), ('60497754', '78962318', '2', null, null, null, null), ('60497755', '78962318', '3', null, null, null, null), ('60497756', '78962318', '5', null, null, null, null), ('60497757', '78962318', '7', null, null, null, null), ('60497758', '78962318', '9', null, null, null, null), ('60497759', '78962318', '10', null, null, null, null), ('60497760', '78962318', '11', null, null, null, null), ('60497761', '78962318', '13', null, null, null, null), ('60497762', '78962318', '15', null, null, null, null), ('60497763', '78962318', '17', null, null, null, null), ('60497764', '78962318', '19', null, null, null, null), ('60497765', '78962318', '21', null, null, null, null), ('60497766', '78962318', '23', null, null, null, null), ('60497767', '78962318', '25', null, null, null, null), ('60497768', '78962318', '27', null, null, null, null), ('60497769', '78962318', '29', null, null, null, null), ('60497770', '78962318', null, null, null, null, '1'), ('60497771', '78962318', '31', null, null, null, null), ('60497772', '78962318', '33', null, null, null, null), ('60497773', '78962318', '35', null, null, null, null), ('60497774', null, null, null, null, '339140574896997239', null), ('60497775', null, null, null, null, '339140573878520185', null), ('60497776', '78962318', '37', null, null, null, null), ('60497777', '78962318', null, null, null, null, '3'), ('60497778', '78962318', '38', null, null, null, null), ('60497779', '78962318', '40', null, null, null, null), ('60497819', '379968893', '83', null, null, null, null), ('60497820', '379968893', '84', null, null, null, null), ('60497821', '78962318', '87', null, null, null, null), ('60497822', '379968893', null, null, null, null, '4'), ('60497823', '78962318', '90', null, null, null, null), ('60497824', null, null, null, null, '339140574672278949', null), ('60497825', null, null, null, null, '339140575216845434', null), ('60497826', '379968893', '95', null, null, null, null), ('60497827', null, null, null, null, '1631953970119786430', null), ('60497828', null, null, null, null, '1631953969000196434', null), ('60497829', '78962318', '100', null, null, null, null), ('60497830', '78962318', '103', null, null, null, null), ('60497831', '78962318', '106', null, null, null, null), ('60497832', '78962318', '109', null, null, null, null), ('60497833', '78962318', '112', null, null, null, null), ('60497834', '78962318', '115', null, null, null, null), ('60497835', '78962318', '118', null, null, null, null), ('60497836', '78962318', '121', null, null, null, null), ('60497837', '78962318', '123', null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL COMMENT 'Unique user identifier',
  `first_name` char(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '' COMMENT 'User''s first name',
  `last_name` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'User''s last name',
  `username` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'User''s username',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('78962318', 'Alexander', 'Savchenkov', 'antalos', '2017-04-08 09:51:02', '2017-04-08 07:29:38'), ('367008735', 'telehelp', null, 'TeleHelp222bot', '2017-04-08 10:08:45', '2017-04-08 07:27:52'), ('379968893', 'Andrew', 'Busel', 'SpinyMan', '2017-04-08 07:27:01', '2017-04-08 07:27:52');
COMMIT;

-- ----------------------------
--  Table structure for `user_chat`
-- ----------------------------
DROP TABLE IF EXISTS `user_chat`;
CREATE TABLE `user_chat` (
  `user_id` bigint(20) NOT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint(20) NOT NULL COMMENT 'Unique user or chat identifier',
  PRIMARY KEY (`user_id`,`chat_id`),
  KEY `chat_id` (`chat_id`),
  CONSTRAINT `user_chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_chat_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
--  Records of `user_chat`
-- ----------------------------
BEGIN;
INSERT INTO `user_chat` VALUES ('78962318', '78962318'), ('367008735', '78962318'), ('367008735', '379968893'), ('379968893', '379968893');
COMMIT;

-- ----------------------------
--  Table structure for `users_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `users_permissions`;
CREATE TABLE `users_permissions` (
  `user_id` bigint(20) unsigned NOT NULL,
  `job_id` int(10) unsigned NOT NULL,
  KEY `job_id` (`job_id`),
  CONSTRAINT `FK_USERS_PERMISSIONS_JOB_ID` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
`id` int(111) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pwd` char(32) NOT NULL,
  `is_root` tinyint(1) NOT NULL,
  `permissions` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `login`, `pwd`, `is_root`, `permissions`, `active`) VALUES
(1, 'root', 'acf7ef943fdeb3cbfed8dd0d8f584731', 1, '', 1);

SET FOREIGN_KEY_CHECKS = 1;
