-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 07 日 20:24
-- 服务器版本: 5.5.29-0ubuntu0.12.10.1
-- PHP 版本: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mintcode_achieve`
--

-- --------------------------------------------------------

--
-- 表的结构 `mt_timetable`
--

CREATE TABLE IF NOT EXISTS `mt_timetable` (
  `time_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增的时间ID',
  `user_id` bigint(20) NOT NULL COMMENT '用户ID',
  `start_time` time DEFAULT NULL COMMENT '上班时间',
  `end_time` time DEFAULT NULL COMMENT '下班时间',
  PRIMARY KEY (`time_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户时刻表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `mt_timetable`
--

INSERT INTO `mt_timetable` (`time_id`, `user_id`, `start_time`, `end_time`) VALUES
(1, 1, '09:30:00', '18:30:00');

-- --------------------------------------------------------

--
-- 表的结构 `mt_useraccount`
--

CREATE TABLE IF NOT EXISTS `mt_useraccount` (
  `account_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '流水ID',
  `user_id` bigint(20) NOT NULL COMMENT '用户ID',
  `start_time` time NOT NULL DEFAULT '00:00:00' COMMENT '上班时间',
  `end_time` time NOT NULL DEFAULT '00:00:00' COMMENT '下班时间',
  `account_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`account_id`,`account_date`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='流水表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mt_userinfo`
--

CREATE TABLE IF NOT EXISTS `mt_userinfo` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `user_authority` int(11) NOT NULL DEFAULT '0' COMMENT '用户权限',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `mt_userinfo`
--

INSERT INTO `mt_userinfo` (`user_id`, `username`, `password`, `user_authority`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 2);

--
-- 限制导出的表
--

--
-- 限制表 `mt_timetable`
--
ALTER TABLE `mt_timetable`
  ADD CONSTRAINT `mt_timetable_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mt_userinfo` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
