ALTER TABLE `#__easyfpu` DROP COLUMN `greeting`;
ALTER TABLE `#__easyfpu` ADD COLUMN `name` VARCHAR(100) NOT NULL AFTER `created_by`;
ALTER TABLE `#__easyfpu` ADD COLUMN `favorite` BOOLEAN NOT NULL DEFAULT FALSE AFTER `name`;
ALTER TABLE `#__easyfpu` ADD COLUMN `calories` FLOAT NOT NULL DEFAULT '0.0' AFTER `favorite`;
ALTER TABLE `#__easyfpu` ADD COLUMN `carbs` FLOAT NOT NULL DEFAULT '0.0' AFTER `calories`;
ALTER TABLE `#__easyfpu` ADD COLUMN `amount_small` int(11) DEFAULT '0' AFTER `carbs`;
ALTER TABLE `#__easyfpu` ADD COLUMN `amount_medium` int(11) DEFAULT '0' AFTER `amount_small`;
ALTER TABLE `#__easyfpu` ADD COLUMN `amount_large` int(11) DEFAULT '0' AFTER `amount_medium`;
ALTER TABLE `#__easyfpu` ADD COLUMN `comment_small` VARCHAR(100) NOT NULL AFTER `amount_large`;
ALTER TABLE `#__easyfpu` ADD COLUMN `comment_medium` VARCHAR(100) NOT NULL AFTER `comment_small`;
ALTER TABLE `#__easyfpu` ADD COLUMN `comment_large` VARCHAR(100) NOT NULL AFTER `comment_medium`;
