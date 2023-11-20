/*
 Navicat Premium Data Transfer

 Source Server         : PhpMyAdmin
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : uts

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 20/11/2023 15:39:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cerita
-- ----------------------------
DROP TABLE IF EXISTS `cerita`;
CREATE TABLE `cerita`  (
  `idcerita` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `idusers_pembuat_awal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idcerita`) USING BTREE,
  INDEX `idusers_pembuat_awal`(`idusers_pembuat_awal` ASC) USING BTREE,
  INDEX `idcerita`(`idcerita` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cerita
-- ----------------------------
INSERT INTO `cerita` VALUES (4, 'tes judul', '1');
INSERT INTO `cerita` VALUES (5, 'dandut', '1');
INSERT INTO `cerita` VALUES (6, 'Penguatan Kelembagaan Kabupaten/Kota Layak Anak (KLA)', '1');

-- ----------------------------
-- Table structure for paragraf
-- ----------------------------
DROP TABLE IF EXISTS `paragraf`;
CREATE TABLE `paragraf`  (
  `idparagraf` int NOT NULL AUTO_INCREMENT,
  `idusers` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `idcerita` int NULL DEFAULT NULL,
  `isi_paragraf` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tanggal_buat` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idparagraf`) USING BTREE,
  INDEX `idusers`(`idusers` ASC) USING BTREE,
  INDEX `idcerita`(`idcerita` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of paragraf
-- ----------------------------
INSERT INTO `paragraf` VALUES (1, '1', 4, ' do eiusmod tempor incididunt ut labore et dolore magna aliqua. Felis bibendum ut tristique et egestas quis ipsum. Morbi tempus iaculis urna id volutpat lacus. Augue eget arcu dictum varius duis at consectetur lorem. Amet commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Pellentesque sit amet porttitor eget dolor morbi non. Sed arcu non odio euismod lacinia at. Et tortor at risus viverra adipiscing at in tellus integer. Nec sagittis aliquam malesuada bibendum ar', '2023-11-20 14:59:38');
INSERT INTO `paragraf` VALUES (2, '1', 5, ' do eiusmod tempor incididunt ut labore et dolore magna aliqua. Felis bibendum ut tristique et egestas quis ipsum. Morbi tempus iaculis urna id volutpat lacus. Augue eget arcu dictum varius duis at consectetur lorem. Amet commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Pellentesque sit amet porttitor eget dolor morbi non. Sed arcu non odio euismod lacinia at. Et tortor at risus viverra adipiscing at in tellus integer. Nec sagittis aliquam malesuada bibendum ar', '2023-11-20 15:20:28');
INSERT INTO `paragraf` VALUES (3, '', 5, 'assalamualaikum wr.wb', '2023-11-20 15:25:11');
INSERT INTO `paragraf` VALUES (4, '1', 6, '1. The word \"hutan\" can be rewritten in various ways to convey the same meaning. \r\n2. Examples of synonymous words for \"hutan\" include forest, jungle, woodland, and bush. \r\n3. Ultimately, the choice of word depends on the context in which it is being used and personal preference.', '2023-11-20 15:34:12');
INSERT INTO `paragraf` VALUES (5, '1', 6, '1. The sea is a term commonly used to describe the extensive saltwater that envelops the majority of the Earth\'s surface.\r\n2. The sea, an apparently boundless stretch of saltwater, is frequently denoted as the ocean.\r\n3. Countless marine creatures inhabit the sea, an immense and enigmatic water body.', '2023-11-20 15:37:16');
INSERT INTO `paragraf` VALUES (6, '1', 6, '1. A creature of frightening appearance and often immense size is commonly referred to as a monster. \r\n2. A being that is typically depicted as terrifying or dangerous due to its appearance or behavior is known as a monster. \r\n3. A monster is a fictional or mythical creature that is often portrayed as a threat to humans or other living beings.', '2023-11-20 15:37:43');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idusers`) USING BTREE,
  INDEX `idusers`(`idusers` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'dani', '1234', '$2y$12$QrxDNr.6aREzpOrFotwvmuetDICG/YwRhJ6TwU7EOK2cKTzObAfTi');
INSERT INTO `users` VALUES (2, 'gamal', '890', '$2y$12$yIunzaIvKSrB1nRRa4ebUO.rI.W4zb.WsIsI099L70YB1zdVy/dRu');

SET FOREIGN_KEY_CHECKS = 1;
