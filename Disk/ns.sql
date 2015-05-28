-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-05-27 17:17:06
-- 服务器版本： 5.5.40
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ns`
--

-- --------------------------------------------------------

--
-- 表的结构 `f_relation`
--

CREATE TABLE IF NOT EXISTS `f_relation` (
  `uname1` varchar(11) NOT NULL,
  `uname2` varchar(11) NOT NULL,
  KEY `uname1` (`uname1`),
  KEY `uname2` (`uname2`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `f_relation`
--

INSERT INTO `f_relation` (`uname1`, `uname2`) VALUES
('r', 's'),
('s', 'r'),
('r', 't'),
('r', 'ss'),
('s4', 'r'),
('s6', 'r');

-- --------------------------------------------------------

--
-- 表的结构 `f_user`
--

CREATE TABLE IF NOT EXISTS `f_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `uname` varchar(32) NOT NULL COMMENT '用户名',
  `tname` varchar(32) DEFAULT NULL COMMENT '真实姓名',
  `pwd` varchar(64) NOT NULL COMMENT '密码hash',
  `authKey` varchar(64) DEFAULT NULL COMMENT '用户id',
  `accessToken` varchar(64) DEFAULT NULL COMMENT 'hash令牌',
  `logtime` int(11) DEFAULT NULL COMMENT '登陆时间',
  `logip` varchar(64) DEFAULT NULL COMMENT '登陆ip',
  `enable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1有效 0无效',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `f_user`
--

INSERT INTO `f_user` (`uid`, `uname`, `tname`, `pwd`, `authKey`, `accessToken`, `logtime`, `logip`, `enable`) VALUES
(1, '1', '123123123123222', 'b8131fc6408c4570c45672e395748a73', NULL, NULL, NULL, NULL, 1),
(2, '2', 'root', '2', NULL, NULL, NULL, NULL, 1),
(3, 'root', NULL, '9a8ae45cd06e4bae5fe52e0ce25f27ca', NULL, NULL, NULL, NULL, 1),
(4, 'root2', NULL, 'root3306', NULL, NULL, NULL, NULL, 1),
(5, 'root33', NULL, 'root3306', NULL, NULL, NULL, NULL, 1),
(6, 'root231', 'root12223', '9a8ae45cd06e4bae5fe52e0ce25f27ca', NULL, NULL, NULL, NULL, 1),
(7, 'root12', 'root23', '9a8ae45cd06e4bae5fe52e0ce25f27ca', NULL, NULL, NULL, NULL, 1),
(8, 'root123', NULL, 'root3306123', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `f_userapi`
--

CREATE TABLE IF NOT EXISTS `f_userapi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `v` varchar(32) DEFAULT NULL,
  `api` varchar(128) DEFAULT NULL,
  `ys` varchar(32) DEFAULT NULL,
  `dis` varchar(256) DEFAULT NULL,
  `request` text,
  `response` text,
  `enable` tinyint(1) NOT NULL,
  `debug` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `type` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `f_userapi`
--

INSERT INTO `f_userapi` (`id`, `name`, `v`, `api`, `ys`, `dis`, `request`, `response`, `enable`, `debug`, `sort`, `type`) VALUES
(1, '查找好友', 'v6', 'friend.search', 'r/s', '模块: 查找好友\n说明 :用户根据用户id查找好友，返回具有改id的用户\n参数 :username用户名\n成功 :\n失败 :', '{\n    "username": "user02"\n}', '{\n    "code": 200,\n    "msg": "succeed",\n    "data": {\n        "username": "li",\n        "userid": "li",\n        "portrait": "http://hebei.sinaimg.cn/2013/0104/U7459P1275DT20130104173656.jpg"\n    }\n}', 1, 0, 9, 'GET'),
(2, '添加好友', 'v6', 'friend.add', 'r/s', '模块 :添加好友\n说明 :\n参数 :targetid将要添加的好友的id,message添加好友附加的内容\n成功 :如果该好友列表中没有这个好友则发出好友添加请求，并反馈“添加好友请求发送成功”，否则其他提醒内容\n失败 :', '{\n    "targetname":"user02"\n}', '{\n    "code": 200,\n    "msg": "succeed",\n    "data": "添加好友请求发送成功"\n}', 1, 0, 9, 'GET'),
(3, '获取好友列表', 'v6', 'friend.getfriends', 'r/s', '模块 :获取好友列表\n说明 :\n参数 :\n成功 :\n失败 :', '{\n    "username": "user01"\n}', '{\n    "code": 200,\n    "msg": "succeed",\n    "data": [\n         {\n            "userid": "zhang",\n            "username": "zhang",\n            "portrait": "http://img.zjolcdn.com/pic/0/06/58/52/6585256_962155.jpg"\n        },\n        {\n            "userid": "user03",\n            "username": "王五",\n            "portrait": "http://img.zjolcdn.com/pic/0/06/58/52/6585256_962155.jpg"\n        },\n        {\n            "userid": "user04",\n            "username": "麻子",\n            "portrait": "http://img.zjolcdn.com/pic/0/06/58/52/6585255_749157.jpg"\n        },\n        {\n            "userid": "user05",\n            "username": "高雷",\n            "portrait": "http://pic.159.com/desk/user/2012/10/26/Jiker201295211551156.jpg"\n        },\n        {\n            "userid": "user06",\n            "username": "苏醒",\n            "portrait": "http://img2.3lian.com/2014/f4/201/d/85.jpg"\n        },\n        {\n            "userid": "user07",\n            "username": "沙宝亮",\n            "portrait": "http://img.dapixie.com/uploads/allimg/111211/1-111211141406.jpg"\n        }\n    ]\n}', 1, 0, 9, 'GET'),
(4, '获取用户token值', 'v6', 'user.gettoken', 'r/s', '模块 :\n说明 :\n参数 :\n成功 :\n失败 :', '{\n    "username": "user01"\n}', '{\n    "code": 200,\n    "msg": "succeed",\n    "data": {\n        "token": "nd787DeXGtYlJG9hc4enUQPdsFArjkVwRsE5q/VVOWVrtOYDQ0sqxJZogb1+7GEeueYpEnn25Dw="\n    }\n}', 1, 1, 9, 'GET'),
(5, '用户获取消息队列', 'v6', 'user.getmessage', 'r/s', '模块 :\n说明 :\n参数 :\n成功 :\n失败 :', '', '{\n    "code": 200,\n    "msg": "succeed",\n    "data": [\n        {\n            "msgtype": "1",\n            "username": "李四",\n            "userid": "user02",\n            "portrait": "http://dmimg.5054399.com/allimg/xztuku/130924007.jpg"\n        }\n    ]\n}', 1, 0, 9, 'GET');

-- --------------------------------------------------------

--
-- 表的结构 `v3_user`
--

CREATE TABLE IF NOT EXISTS `v3_user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(20) NOT NULL COMMENT '用户名',
  `user_password` varchar(32) NOT NULL COMMENT '密码',
  `open_id` varchar(64) DEFAULT NULL,
  `device_id` varchar(64) DEFAULT NULL,
  `user_name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `user_tel` varchar(32) DEFAULT NULL COMMENT '用户联系方式',
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `f_logintime` int(11) DEFAULT NULL,
  `f_loginip` varchar(32) DEFAULT NULL,
  `f_regtime` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `v3_user`
--

INSERT INTO `v3_user` (`user_id`, `user_login`, `user_password`, `open_id`, `device_id`, `user_name`, `user_tel`, `enable`, `f_logintime`, `f_loginip`, `f_regtime`) VALUES
(1, 'dbv3dbv3', 'dbv3dbv3dbv3', NULL, NULL, NULL, NULL, 1, NULL, NULL, 1432716581),
(2, '09876543210', '111111', NULL, NULL, NULL, NULL, 1, 1432718216, '192.168.1.104', 1432717403);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
