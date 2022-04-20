/*
Navicat MySQL Data Transfer

Source Server         : MyKoneksi
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tp2_dpbo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-04-20 23:53:02
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `bidang_divisi`
-- ----------------------------
DROP TABLE IF EXISTS `bidang_divisi`;
CREATE TABLE `bidang_divisi` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `id_divisi` int(11) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_bidang`),
  KEY `id_divisi` (`id_divisi`),
  CONSTRAINT `id_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bidang_divisi
-- ----------------------------
INSERT INTO `bidang_divisi` VALUES ('1', '1', 'Goldlaner');
INSERT INTO `bidang_divisi` VALUES ('2', '2', 'Midlaner');
INSERT INTO `bidang_divisi` VALUES ('9', '33', 'Jungler');

-- ----------------------------
-- Table structure for `divisi`
-- ----------------------------
DROP TABLE IF EXISTS `divisi`;
CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of divisi
-- ----------------------------
INSERT INTO `divisi` VALUES ('1', 'Marksman');
INSERT INTO `divisi` VALUES ('2', 'Mage');
INSERT INTO `divisi` VALUES ('33', 'Assassins');
INSERT INTO `divisi` VALUES ('35', 'Support');

-- ----------------------------
-- Table structure for `pengurus`
-- ----------------------------
DROP TABLE IF EXISTS `pengurus`;
CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL AUTO_INCREMENT,
  `nim` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id_pengurus`),
  KEY `id_bidang` (`id_bidang`),
  CONSTRAINT `id_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang_divisi` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pengurus
-- ----------------------------
INSERT INTO `pengurus` VALUES ('1', '2001521', 'Xavier', '4', '2', '62603990543c8.jpg');
INSERT INTO `pengurus` VALUES ('2', '2001522', 'Wanwan', '9', '1', '626039f69c14c.jpg');
INSERT INTO `pengurus` VALUES ('3', '2001559', 'Luo Yi', '15', '2', '62603a3ec71dd.jpg');
