DROP TABLE IF EXISTS `sessions`;

-- COMMAND BREAK --

CREATE TABLE `sessions` (
`session_id` VARCHAR(40) DEFAULT '0' NOT NULL,
`ip_address` VARCHAR(16) DEFAULT '0' NOT NULL,
`user_agent` VARCHAR(200) NOT NULL,
`last_activity` INT(10) UNSIGNED DEFAULT 0 NOT NULL,
`user_data` TEXT NULL,
PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Sessions';

-- COMMAND BREAK --

DROP TABLE IF EXISTS `users`;

-- COMMAND BREAK --

CREATE TABLE `users` (
`user_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`user_email` VARCHAR(100) NOT NULL DEFAULT '',
`user_password` VARCHAR(100) NOT NULL DEFAULT '',
`user_firstname` VARCHAR(64) NULL,
`user_lastname` VARCHAR(64) NULL,
`user_updated_at` TIMESTAMP NOT NULL,
`user_created_at` DATETIME NOT NULL,
`user_deleted_at` DATETIME NOT NULL,
UNIQUE KEY (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Users';

-- COMMAND BREAK --

DROP TABLE IF EXISTS `logins`;

-- COMMAND BREAK --

CREATE TABLE `logins` (
`login_user_id` INT(11) NOT NULL DEFAULT '0',
`login_at` TIMESTAMP NOT NULL,
`login_ip_address` VARCHAR(16) DEFAULT '0' NOT NULL,
INDEX (`login_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Logins';