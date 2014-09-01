DROP TABLE IF EXISTS `attendees`;
DROP TABLE IF EXISTS `bash`;

CREATE TABLE `attendees` (
  `bash_id` varchar(100) NOT NULL,
  `participant_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `org` varchar(255) NOT NULL,
  `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`bash_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bash` (
  `id` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_link` varchar(255) NOT NULL,
  `project_logo_url` varchar(255) NOT NULL,
  `contact_person` mediumtext NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_url` varchar(255) NOT NULL,
  `pictures` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;