DROP TABLE IF EXISTS `#__easyfpu`;

CREATE TABLE `#__easyfpu` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`asset_id` INT(10)     NOT NULL DEFAULT '0',
	`created`  DATETIME    NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by`  INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`name` VARCHAR(100) NOT NULL,
	`favorite` BOOLEAN NOT NULL DEFAULT FALSE,
	`calories` FLOAT NOT NULL DEFAULT '0.0',
	`carbs` FLOAT NOT NULL DEFAULT '0.0',
	`amount_small` int(11) DEFAULT '0',
	`amount_medium` int(11) DEFAULT '0',
	`amount_large` int(11) DEFAULT '0',
	`comment_small` VARCHAR(100) NOT NULL,
	`comment_medium` VARCHAR(100) NOT NULL,
	`comment_large` VARCHAR(100) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	`params`   VARCHAR(1024) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8mb4
	DEFAULT COLLATE =utf8mb4_unicode_ci;

SET sql_mode = '';
INSERT INTO `#__easyfpu` (`name`, `calories`, `carbs`, `amount_small`, `amount_medium`, `amount_large`, `comment_small`, `comment_medium`, `comment_large`) VALUES
	('Avocado', 220.0, 7.0, 75, 150, 0, 'eine Halbe', 'eine ganze', ''),
    ('Bratwurst (fränkische)', 290.0, 0.0, 176, 300, 0, '1 Bratwurst', '2 Bratwürste', ''),
    ('Chicken McNuggets', 249.0, 17.0, 72, 110, 165, '4 Stück', '6 Stück', '9 Stück'),
    ('Donauwelle', 267.0, 31.0, 100, 0, 0, '1 Stück', '', ''),
    ('Ketchup McDonalds', 115.0, 26.0, 23, 46, 69, '1 Tütchen', '2 Tütchen', '3 Tütchen'),
    ('Käsespätzle', 246.0, 31.0, 200, 0, 0, 'normale Portion', '', ''),
    ('Lasagne', 140.0, 8.0, 160, 200, 0, 'normale Portion', 'große Portion', ''),
    ('Pao de Queso', 256.0, 40.0, 54, 81, 135, '2 Bällchen', '3 Bällchen', '5 Bällchen'),
    ('Pizza Margherita', 199.0, 25.0, 220, 260, 440, '1/2 kleine', '1/2 große', '1 kleine'),
    ('Pommes McDonalds', 289.0, 36.0, 80, 115, 150, 'klein', 'mittel', 'groß'),
    ('Risotto mit Butter und Parmesan', 210.0, 20.0, 240, 0, 0, 'normale Portion', '', ''),
    ('Spaghetti Bolognese', 212.0, 26.0, 160, 200, 0, 'normale Portion', 'große Portion', ''),
    ('Spaghetti mit Tomatensoße', 144.0, 17.0, 160, 200, 0, 'normale Portion', 'große Portion', '');