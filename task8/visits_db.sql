DROP TABLE IF EXISTS `visits`;
DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `pages` (`page_name`)
VALUES
    ('/task8/index.php'),
    ('/task8/page1.php'),
    ('/task8/page2.php'),
    ('/task8/page3.php');


CREATE TABLE `visits` (
    `id` int NOT NULL AUTO_INCREMENT,
    `page_id` int NOT NULL,
    `visit_time` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`)
);

-- @block
-- Queries
SELECT * FROM `pages`;
SELECT * FROM `visits`;