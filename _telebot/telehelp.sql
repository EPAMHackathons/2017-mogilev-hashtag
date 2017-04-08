-- MySQL dump 10.13  Distrib 5.7.16, for osx10.11 (x86_64)
--
-- Host: localhost    Database: telehelp
-- ------------------------------------------------------
-- Server version	5.7.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `botan_shortener`
--

DROP TABLE IF EXISTS `botan_shortener`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `botan_shortener`
--

LOCK TABLES `botan_shortener` WRITE;
/*!40000 ALTER TABLE `botan_shortener` DISABLE KEYS */;
/*!40000 ALTER TABLE `botan_shortener` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `callback_query`
--

DROP TABLE IF EXISTS `callback_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `callback_query`
--

LOCK TABLES `callback_query` WRITE;
/*!40000 ALTER TABLE `callback_query` DISABLE KEYS */;
INSERT INTO `callback_query` VALUES (339140573878520185,78962318,78962318,36,NULL,'identifier','2017-04-08 07:09:20'),(339140574896997239,78962318,78962318,36,NULL,'identifier','2017-04-08 07:09:13');
/*!40000 ALTER TABLE `callback_query` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (78962318,'private',NULL,'antalos',NULL,'2017-04-08 06:51:02','2017-04-08 07:10:45',NULL);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chosen_inline_result`
--

DROP TABLE IF EXISTS `chosen_inline_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chosen_inline_result`
--

LOCK TABLES `chosen_inline_result` WRITE;
/*!40000 ALTER TABLE `chosen_inline_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `chosen_inline_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation`
--

LOCK TABLES `conversation` WRITE;
/*!40000 ALTER TABLE `conversation` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edited_message`
--

DROP TABLE IF EXISTS `edited_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edited_message`
--

LOCK TABLES `edited_message` WRITE;
/*!40000 ALTER TABLE `edited_message` DISABLE KEYS */;
INSERT INTO `edited_message` VALUES (1,78962318,29,78962318,'2017-04-08 07:07:28','/job test','[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]',NULL),(2,78962318,36,367008735,'2017-04-08 07:09:20','inline keyboard',NULL,NULL),(3,78962318,37,78962318,'2017-04-08 07:10:34','/inlinekeyboard','[{\"type\":\"bot_command\",\"offset\":0,\"length\":15}]',NULL);
/*!40000 ALTER TABLE `edited_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inline_query`
--

DROP TABLE IF EXISTS `inline_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inline_query`
--

LOCK TABLES `inline_query` WRITE;
/*!40000 ALTER TABLE `inline_query` DISABLE KEYS */;
/*!40000 ALTER TABLE `inline_query` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (78962318,1,78962318,'2017-04-08 06:51:02',NULL,NULL,NULL,NULL,NULL,NULL,'hi',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,2,78962318,'2017-04-08 06:52:16',NULL,NULL,NULL,NULL,NULL,NULL,'test',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,3,78962318,'2017-04-08 06:52:17',NULL,NULL,NULL,NULL,NULL,NULL,'/help','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,5,78962318,'2017-04-08 06:58:25',NULL,NULL,NULL,NULL,NULL,NULL,'/date','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,7,78962318,'2017-04-08 06:58:31',NULL,NULL,NULL,NULL,NULL,NULL,'/forcereply test','[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,9,78962318,'2017-04-08 06:58:33',NULL,NULL,NULL,NULL,NULL,NULL,'test',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,10,78962318,'2017-04-08 06:58:47',NULL,NULL,NULL,NULL,NULL,NULL,'we',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,11,78962318,'2017-04-08 06:59:16',NULL,NULL,NULL,NULL,NULL,NULL,'/forcereply test','[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,13,78962318,'2017-04-08 07:00:08',NULL,NULL,NULL,NULL,NULL,NULL,'/forcereply test2','[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,15,78962318,'2017-04-08 07:00:22',NULL,NULL,NULL,NULL,NULL,NULL,'/forcereply test2','[{\"type\":\"bot_command\",\"offset\":0,\"length\":11}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,17,78962318,'2017-04-08 07:00:57',NULL,NULL,NULL,NULL,NULL,NULL,'/help','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,19,78962318,'2017-04-08 07:01:04',NULL,NULL,NULL,NULL,NULL,NULL,'/echo test','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,21,78962318,'2017-04-08 07:01:08',NULL,NULL,NULL,NULL,NULL,NULL,'/date moscow','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,23,78962318,'2017-04-08 07:04:43',NULL,NULL,NULL,NULL,NULL,NULL,'/help','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,25,78962318,'2017-04-08 07:05:33',NULL,NULL,NULL,NULL,NULL,NULL,'/help','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,27,78962318,'2017-04-08 07:07:23',NULL,NULL,NULL,NULL,NULL,NULL,'/help','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,29,78962318,'2017-04-08 07:07:25',NULL,NULL,NULL,NULL,NULL,NULL,'/job','[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,31,78962318,'2017-04-08 07:07:31',NULL,NULL,NULL,NULL,NULL,NULL,'/job tes','[{\"type\":\"bot_command\",\"offset\":0,\"length\":4}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,33,78962318,'2017-04-08 07:08:41',NULL,NULL,NULL,NULL,NULL,NULL,'/help','[{\"type\":\"bot_command\",\"offset\":0,\"length\":5}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,35,78962318,'2017-04-08 07:08:45',NULL,NULL,NULL,NULL,NULL,NULL,'/inlinekeyboard','[{\"type\":\"bot_command\",\"offset\":0,\"length\":15}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,36,367008735,'2017-04-08 07:08:45',NULL,NULL,NULL,NULL,NULL,NULL,'inline keyboard',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,37,78962318,'2017-04-08 07:09:33',NULL,NULL,NULL,NULL,NULL,NULL,'wre',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,38,78962318,'2017-04-08 07:10:37',NULL,NULL,NULL,NULL,NULL,NULL,'/inlinekeyboard','[{\"type\":\"bot_command\",\"offset\":0,\"length\":15}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78962318,40,78962318,'2017-04-08 07:10:45',NULL,NULL,NULL,NULL,NULL,NULL,'@TeleHelp222bot true','[{\"type\":\"mention\",\"offset\":0,\"length\":15}]',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_limiter`
--

DROP TABLE IF EXISTS `request_limiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_limiter` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
  `chat_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Unique chat identifier',
  `inline_message_id` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Identifier of the sent inline message',
  `method` char(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Request method',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_limiter`
--

LOCK TABLES `request_limiter` WRITE;
/*!40000 ALTER TABLE `request_limiter` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_limiter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telegram_update`
--

DROP TABLE IF EXISTS `telegram_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telegram_update`
--

LOCK TABLES `telegram_update` WRITE;
/*!40000 ALTER TABLE `telegram_update` DISABLE KEYS */;
INSERT INTO `telegram_update` VALUES (60497753,78962318,1,NULL,NULL,NULL,NULL),(60497754,78962318,2,NULL,NULL,NULL,NULL),(60497755,78962318,3,NULL,NULL,NULL,NULL),(60497756,78962318,5,NULL,NULL,NULL,NULL),(60497757,78962318,7,NULL,NULL,NULL,NULL),(60497758,78962318,9,NULL,NULL,NULL,NULL),(60497759,78962318,10,NULL,NULL,NULL,NULL),(60497760,78962318,11,NULL,NULL,NULL,NULL),(60497761,78962318,13,NULL,NULL,NULL,NULL),(60497762,78962318,15,NULL,NULL,NULL,NULL),(60497763,78962318,17,NULL,NULL,NULL,NULL),(60497764,78962318,19,NULL,NULL,NULL,NULL),(60497765,78962318,21,NULL,NULL,NULL,NULL),(60497766,78962318,23,NULL,NULL,NULL,NULL),(60497767,78962318,25,NULL,NULL,NULL,NULL),(60497768,78962318,27,NULL,NULL,NULL,NULL),(60497769,78962318,29,NULL,NULL,NULL,NULL),(60497770,78962318,NULL,NULL,NULL,NULL,1),(60497771,78962318,31,NULL,NULL,NULL,NULL),(60497772,78962318,33,NULL,NULL,NULL,NULL),(60497773,78962318,35,NULL,NULL,NULL,NULL),(60497774,NULL,NULL,NULL,NULL,339140574896997239,NULL),(60497775,NULL,NULL,NULL,NULL,339140573878520185,NULL),(60497776,78962318,37,NULL,NULL,NULL,NULL),(60497777,78962318,NULL,NULL,NULL,NULL,3),(60497778,78962318,38,NULL,NULL,NULL,NULL),(60497779,78962318,40,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `telegram_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (78962318,'Alexander','Savchenkov','antalos','2017-04-08 06:51:02','2017-04-08 07:10:45'),(367008735,'telehelp',NULL,'TeleHelp222bot','2017-04-08 07:08:45','2017-04-08 07:09:20');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_chat`
--

DROP TABLE IF EXISTS `user_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_chat` (
  `user_id` bigint(20) NOT NULL COMMENT 'Unique user identifier',
  `chat_id` bigint(20) NOT NULL COMMENT 'Unique user or chat identifier',
  PRIMARY KEY (`user_id`,`chat_id`),
  KEY `chat_id` (`chat_id`),
  CONSTRAINT `user_chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_chat_ibfk_2` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_chat`
--

LOCK TABLES `user_chat` WRITE;
/*!40000 ALTER TABLE `user_chat` DISABLE KEYS */;
INSERT INTO `user_chat` VALUES (78962318,78962318),(367008735,78962318);
/*!40000 ALTER TABLE `user_chat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-08 10:11:48
