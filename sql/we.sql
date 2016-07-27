/*
Navicat MySQL Data Transfer

Source Server         : chuyumi
Source Server Version : 50548
Source Host           : localhost:3306
Source Database       : we

Target Server Type    : MYSQL
Target Server Version : 50548
File Encoding         : 65001

Date: 2016-07-18 20:59:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(255) DEFAULT NULL,
  `m_pid` int(11) DEFAULT NULL,
  `number_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_title` varchar(255) DEFAULT NULL,
  `message_content` varchar(255) DEFAULT NULL,
  `message_this` varchar(255) DEFAULT NULL,
  `number_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for numbers
-- ----------------------------
DROP TABLE IF EXISTS `numbers`;
CREATE TABLE `numbers` (
  `number_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_name` varchar(255) DEFAULT NULL,
  `we_appid` varchar(255) DEFAULT NULL,
  `we_url` varchar(255) DEFAULT NULL,
  `we_token` varchar(255) DEFAULT NULL,
  `we_num` varchar(255) DEFAULT NULL,
  `we_type` varchar(255) DEFAULT NULL,
  `we_appsecret` varchar(255) DEFAULT NULL,
  `we_yuan` varchar(255) DEFAULT NULL,
  `we_st` varchar(255) DEFAULT NULL,
  `we_status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`number_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `psw` varchar(255) DEFAULT NULL,
  `number_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;
