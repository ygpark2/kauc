SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- DROP TABLE `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_message`
--
-- DROP TABLE `user_message`;
CREATE TABLE IF NOT EXISTS `user_message` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `send_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `receive_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--
-- DROP TABLE `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `birth` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `twitter_id` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `facebook_id` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `introduction` text COLLATE utf8_bin NOT NULL,
  `geo_loc` GEOMETRY NOT NULL,
  `zoom_level` tinyint(2) NOT NULL DEFAULT '0',
  `open_keys` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  SPATIAL INDEX(`geo_loc`),
  FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_comments`
--
-- DROP TABLE `user_comments`;
CREATE TABLE IF NOT EXISTS `user_comments` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_jobs`
--
-- DROP TABLE `favorite_geo_markers`;
CREATE TABLE IF NOT EXISTS `favorite_geo_markers` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `geo_loc` GEOMETRY NOT NULL,
  `zoom_level` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  SPATIAL INDEX(`geo_loc`),
  FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------


--
-- Table structure for table `geo_log_tag`
--
-- DROP TABLE `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY (`tag`),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_businesses`
--
-- DROP TABLE `geo_businesses`;
CREATE TABLE IF NOT EXISTS `geo_businesses` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(8) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `geo_loc` GEOMETRY NOT NULL,
  `zoom_level` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  SPATIAL INDEX(`geo_loc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_businesses_contents`
--
-- DROP TABLE `geo_business_contents`;
CREATE TABLE IF NOT EXISTS `geo_business_contents` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `geo_business_id` int(18) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_business_id`) REFERENCES geo_businesses (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_business_comments`
--
-- DROP TABLE `geo_business_comments`;
CREATE TABLE IF NOT EXISTS `geo_business_comments` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `geo_business_id` int(18) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_business_id`) REFERENCES geo_businesses (`id`) ON DELETE CASCADE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_businesses`
--
-- DROP TABLE `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `weight` tinyint(1) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_business_categories`
--
-- DROP TABLE `geo_business_categories`;
CREATE TABLE IF NOT EXISTS `geo_business_categories` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `category_id` int(8) unsigned NOT NULL,
  `geo_business_id` int(18) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES categories (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`geo_business_id`) REFERENCES geo_businesses (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_jobs`
--
-- DROP TABLE `geo_jobs`;
CREATE TABLE IF NOT EXISTS `geo_jobs` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(8) NOT NULL DEFAULT '-1',
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `geo_loc` GEOMETRY NOT NULL,
  `zoom_level` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  SPATIAL INDEX(`geo_loc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_job_contents`
--
-- DROP TABLE `geo_job_contents`;
CREATE TABLE IF NOT EXISTS `geo_job_contents` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `geo_job_id` int(18) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_job_id`) REFERENCES geo_jobs (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_job_comments`
--
-- DROP TABLE `geo_job_comments`;
CREATE TABLE IF NOT EXISTS `geo_job_comments` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `geo_job_id` int(18) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_job_id`) REFERENCES geo_jobs (`id`) ON DELETE CASCADE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_job_tag`
--
-- DROP TABLE `geo_job_tag`;
CREATE TABLE IF NOT EXISTS `geo_job_tag` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `geo_job_id` int(18) NOT NULL,
  `tag_id` int(18) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_job_id`) REFERENCES geo_jobs (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`) REFERENCES tags (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_properties`
--
-- DROP TABLE `geo_properties`;
CREATE TABLE IF NOT EXISTS `geo_properties` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1',
  `price` int(15) NOT NULL DEFAULT '0',
  `price_unit` varchar(15) NOT NULL DEFAULT '',
  `geo_loc` GEOMETRY NOT NULL,
  `zoom_level` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  SPATIAL INDEX(`geo_loc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_property_contents`
--
-- DROP TABLE `geo_property_contents`;
CREATE TABLE IF NOT EXISTS `geo_property_contents` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `geo_property_id` int(18) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_property_id`) REFERENCES geo_properties (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_property_comments`
--

CREATE TABLE IF NOT EXISTS `geo_property_comments` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `geo_property_id` int(18) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_property_id`) REFERENCES geo_properties (`id`) ON DELETE CASCADE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_logs`
--
-- DROP TABLE `geo_logs`;
CREATE TABLE IF NOT EXISTS `geo_logs` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `geo_loc` GEOMETRY NOT NULL,
  `zoom_level` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  SPATIAL INDEX(`geo_loc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_log_contents`
--
-- DROP TABLE `geo_log_contents`;
CREATE TABLE IF NOT EXISTS `geo_log_contents` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `geo_log_id` int(18) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_log_id`) REFERENCES geo_logs (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_log_comments`
--
-- DROP TABLE `geo_log_comments`;
CREATE TABLE IF NOT EXISTS `geo_log_comments` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `geo_log_id` int(18) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_log_id`) REFERENCES geo_logs (`id`) ON DELETE CASCADE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `geo_log_tag`
--
-- DROP TABLE `geo_log_tag`;
CREATE TABLE IF NOT EXISTS `geo_log_tag` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `geo_log_id` int(18) NOT NULL,
  `tag_id` int(18) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`geo_log_id`) REFERENCES geo_logs (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`) REFERENCES tags (`id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

