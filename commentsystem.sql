/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : commentsystem

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 15/12/2021 16:26:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent_id` int NULL DEFAULT -1,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `commenter_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `submit_date` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (1, 'sdgagdd', -1, 'asdgasdg', 'asdgg', 'sdag', NULL);
INSERT INTO `comments` VALUES (2, 'ghssdfh', -1, 'dsfhsdh', 'sdfhsdhf', 'sdfhsdfh', '2021-12-13 17:18:15');
INSERT INTO `comments` VALUES (3, 'f64d9c8e51e36403bf550662ef5d543f', -1, 'http://localhost/yorumsistemi/index.php', 'wrwerwer', 'fghdfghdfgdf', '2021-12-15 11:43:24');
INSERT INTO `comments` VALUES (4, 'f64d9c8e51e36403bf550662ef5d543f', 3, 'http://localhost/yorumsistemi/index.php', 'fghfgj', 'ıtyuturty', '2021-12-15 11:50:51');
INSERT INTO `comments` VALUES (5, 'f64d9c8e51e36403bf550662ef5d543f', -1, 'http://localhost/yorumsistemi/index.php?ff=3', 'SAA', 'ASDASDASD', '2021-12-15 11:52:38');
INSERT INTO `comments` VALUES (6, 'f64d9c8e51e36403bf550662ef5d543f', -1, 'http://localhost/yorumsistemi/index.php?sayfa=can', 'fghdfsdfdf', 'qweqweqwe', '2021-12-15 11:52:54');
INSERT INTO `comments` VALUES (7, 'f64d9c8e51e36403bf550662ef5d543f', -1, 'http://localhost/yorumsistemi/index.php', 'Can Hepoğlu', 'sdgagsag', '2021-12-15 13:08:50');
INSERT INTO `comments` VALUES (8, 'f64d9c8e51e36403bf550662ef5d543f', -1, 'http://localhost/yorumsistemi/index.php?sayfa=canhepogli.com', 'Can hobaa', 'bura benim sitem oliim', '2021-12-15 15:22:25');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `namesurname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (2, 'cem', 'cem@htmail.com', '123456');
INSERT INTO `members` VALUES (11, 'onur', 'onur@gmail.com', '123');
INSERT INTO `members` VALUES (12, 'orcun', 'orcun@hotmail.com', '123');
INSERT INTO `members` VALUES (13, 'harun', 'harun@gmail.com', '123');
INSERT INTO `members` VALUES (14, 'samet', 'samet@gmail.com', '123');
INSERT INTO `members` VALUES (16, 'can', 'hepoglucan25@hotmail.com', '123456');

SET FOREIGN_KEY_CHECKS = 1;
