DROP TABLE IF EXISTS `#__easyfpu`;

CREATE TABLE `#__easyfpu` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`asset_id` INT(10)     NOT NULL DEFAULT '0',
	`greeting` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	`catid` 	int(11)	   NOT NULL DEFAULT '0',
	`params`   VARCHAR(1024) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8mb4
	DEFAULT COLLATE =utf8mb4_unicode_ci;

INSERT INTO `#__easyfpu` (`greeting`) VALUES
('Hello FPU from DB!'),
('Good bye FPU from DB!');