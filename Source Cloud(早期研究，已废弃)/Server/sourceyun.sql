/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50627
Source Host           : localhost:3306
Source Database       : sourceyun

Target Server Type    : MYSQL
Target Server Version : 50627
File Encoding         : 65001

Date: 2015-10-10 17:43:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `files`
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `filename` text NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `md5` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES ('456.exe', 'admin111', '0', '00521225');
INSERT INTO `files` VALUES ('123.exe', 'admin', '1', '00521225');
INSERT INTO `files` VALUES ('123.exe', 'admin', '2', '00521225');
INSERT INTO `files` VALUES ('123.exe', 'admin', '3', '00521225');
INSERT INTO `files` VALUES ('123.exe', 'admin', '4', '00521225');

-- ----------------------------
-- Table structure for `notice`
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `time` text NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('20150914', '欢迎使用私有云平台，平台正在开发中，如果发现任何问题欢迎与我们联系');

-- ----------------------------
-- Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `InitialAvailable` int(11) NOT NULL,
  `CapacityUnit` int(11) NOT NULL,
  `hierarchy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第一栏初始可用容量\r\n第二栏容量单位，以数值形式记录，1为MB,2为GB，3为TB\r\n第三栏等级划分状态，Ture为开启，Flase 为关闭';

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('40', '2', 'False');

-- ----------------------------
-- Table structure for `sys_user`
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `Usedspace` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `answer` text NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第一栏为用户名\r\n第二栏为密码\r\n第三栏为等级\r\n第四栏为分配给该用户的可用容量\r\n第五栏和第六均为忘记密码时找回密码的验证问题和答案';

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('admin', '62DF5F8AED7164AB', '7', '1000', '9999', '1+2+3', '6');
