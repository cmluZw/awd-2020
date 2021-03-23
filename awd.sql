# Host: localhost  (Version: 5.7.26)
# Date: 2021-03-23 14:54:05
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "game"
#

CREATE TABLE `game` (
  `match_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `solve_num` int(5) NOT NULL DEFAULT '0',
  `team_id` varchar(255) NOT NULL DEFAULT '0',
  `web_ip` varchar(255) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `submit` varchar(255) DEFAULT NULL,
  `is_run` int(11) DEFAULT '0',
  `score` bigint(20) DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "game"
#


#
# Structure for table "match_info"
#

CREATE TABLE `match_info` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_code` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `match_name` varchar(255) DEFAULT NULL,
  `is_run` int(11) DEFAULT '0',
  PRIMARY KEY (`match_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "match_info"
#


#
# Structure for table "team"
#

CREATE TABLE `team` (
  `team_id` varchar(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `member_num` int(11) DEFAULT '0',
  `now_num` int(11) DEFAULT '0',
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "team"
#

INSERT INTO `team` VALUES ('01MJQJ','team1',4,1),('AQUBI6','ring_team',4,2),('YLX88F','第一小分队',4,4);

#
# Structure for table "user"
#

CREATE TABLE `user` (
  `u_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `information` text,
  `history_team` text,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (2,'zhfine','12345678','Paranoid_ZH@163.com','YLX88F',NULL,NULL,'YLX88F,'),(3,'ring_ring','12345678','1551505032@qq.com','AQUBI6',NULL,NULL,'AQUBI6,'),(4,'jv','12345678','112233','YLX88F',NULL,NULL,'YLX88F,'),(17,'hhh','12345678','45332349@qq.com','01MJQJ',NULL,NULL,'01MJQJ,');
