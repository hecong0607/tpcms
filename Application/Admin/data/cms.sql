-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-25 12:04:29
-- 服务器版本： 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin_menu_rule`
--

CREATE TABLE IF NOT EXISTS `cms_admin_menu_rule` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL COMMENT '父 id',
  `route` varchar(20) NOT NULL COMMENT '模块',
  `type` tinyint(4) unsigned NOT NULL COMMENT '类型（0=菜单；1=菜单+权限；2=权限；',
  `left_name` varchar(255) NOT NULL COMMENT '左边显示（占位用的）',
  `menu_name` varchar(255) NOT NULL COMMENT '名称',
  `rule_name` varchar(255) NOT NULL COMMENT '规则名称',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `list_order` int(11) unsigned NOT NULL COMMENT '排序',
  `logo` varchar(50) NOT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单权限表' AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `cms_admin_menu_rule`
--

INSERT INTO `cms_admin_menu_rule` (`id`, `parent_id`, `route`, `type`, `left_name`, `menu_name`, `rule_name`, `remark`, `list_order`, `logo`) VALUES
(1, 0, '/Admin/Menu/index', 0, '', '菜单管理', '', '', 3, 'list'),
(12, 11, '/Admin/Menu/list', 1, '', '菜单管理', '', '', 1, 'angle-double-right'),
(11, 1, '/Admin/Menu/admin', 0, '', '后台菜单', '', '', 1, 'caret-right'),
(13, 12, '/Admin/Menu/add', 2, '', '菜单添加', '', '', 1, 'angle-right'),
(14, 13, '/Admin/Menu/doAdd', 2, '', '菜单添加--操作', '', '', 1, 'angle-right'),
(15, 12, '/Admin/Menu/save', 2, '', '菜单编辑', '', '', 2, 'angle-right'),
(16, 15, '/Admin/Menu/doSave', 2, '', '菜单编辑--操作', '', '', 1, 'angle-right'),
(17, 12, '/Admin/Menu/show', 2, '', '菜单详情', '', '', 3, 'angle-right'),
(18, 12, '/Admin/Menu/del', 2, '', '菜单删除', '', '', 4, 'angle-right'),
(23, 21, '/Admin/Role/index', 0, '', '管理组', '', '', 1, 'caret-right'),
(24, 23, '/Admin/Role/list', 1, '', '角色管理', '', '', 1, 'angle-double-right'),
(22, 0, '/Admin/Tool/index', 0, '', '扩展工具', '', '', 4, 'cloud'),
(20, 0, '/Admin/Setting/index', 0, '', '设置', '', '', 1, 'cogs'),
(21, 0, '/Admin/User/index', 0, '', '用户管理', '', '', 2, 'group'),
(25, 24, '/Admin/Role/add', 2, '', '角色添加', '', '', 1, 'angle-right'),
(26, 24, '/Admin/Role/save', 2, '', '角色编辑', '', '', 2, 'angle-right'),
(27, 25, '/Admin/Role/doAdd', 2, '', '角色添加--操作', '', '', 1, 'angle-right'),
(28, 26, '/Admin/Role/doSave', 2, '', '角色编辑--操作', '', '', 1, 'angle-right'),
(29, 24, '/Admin/Role/setPower', 2, '', '权限设置', '', '', 3, 'angle-right'),
(30, 24, '/Admin/Role/show', 2, '', '角色详情', '', '', 4, 'angle-right'),
(31, 24, '/Admin/Role/del', 2, '', '角色删除', '', '', 5, 'angle-right'),
(32, 29, '/Admin/Role/doSetPow', 2, '', '权限设置--操作', '', '', 1, 'angle-right'),
(33, 23, '/Admin/User/list', 1, '', '管理员', '', '', 2, 'angle-double-right'),
(34, 33, '/Admin/User/add', 2, '', '管理员添加', '', '', 1, 'angle-right'),
(35, 34, '/Admin/User/doAdd', 2, '', '管理员添加--操作', '', '', 1, 'angle-right'),
(36, 33, '/Admin/User/save', 2, '', '管理员编辑', '', '', 2, 'angle-right'),
(37, 36, '/Admin/User/doSave', 2, '', '管理员编辑--操作', '', '', 1, 'angle-right'),
(38, 33, '/Admin/User/setBlack', 2, '', '管理员拉黑', '', '', 3, 'angle-right'),
(39, 33, '/Admin/User/setEnabl', 2, '', '管理员启用', '', '', 4, 'angle-right'),
(40, 33, '/Admin/User/del', 2, '', '管理员删除', '', '', 5, 'angle-right'),
(41, 20, '/Admin/User/message', 0, '', '个人信息', '', '', 1, 'caret-right'),
(42, 41, '/Admin/User/info', 1, '', '信息修改', '', '', 1, 'angle-double-right'),
(43, 42, '/Admin/User/setInfo', 2, '', '信息修改--操作', '', '', 1, 'angle-right'),
(44, 41, '/Admin/User/pass', 1, '', '密码修改', '', '', 2, 'angle-double-right'),
(45, 44, '/Admin/User/setPass', 2, '', '密码修改--操作', '', '', 1, 'angle-right');

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin_role`
--

CREATE TABLE IF NOT EXISTS `cms_admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `power` text NOT NULL COMMENT '权限拼接',
  `status` tinyint(3) unsigned NOT NULL COMMENT '状态（0=禁用；1=开启）',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `cms_admin_role`
--

INSERT INTO `cms_admin_role` (`id`, `name`, `power`, `status`, `remark`, `create_time`, `update_time`) VALUES
(1, '超级管理员', '0', 1, '拥有网站最高管理员权限！', 1329633709, 1329633709),
(4, '新的测试', '//Admin/Setting/index//,//Admin/User/message//,//Admin/User/info//,//Admin/User/setInfo//,//Admin/User/pass//,//Admin/User/setPass//', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin_route`
--

CREATE TABLE IF NOT EXISTS `cms_admin_route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='路由列表--供菜单创建和修改使用' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `cms_admin_route`
--

INSERT INTO `cms_admin_route` (`id`, `route`, `create_time`) VALUES
(4, '231231', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin_user`
--

CREATE TABLE IF NOT EXISTS `cms_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` char(20) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `realname` char(20) NOT NULL COMMENT '别称',
  `phone` char(20) NOT NULL COMMENT '电话',
  `email` char(20) NOT NULL COMMENT '邮箱',
  `qq` char(20) NOT NULL COMMENT 'QQ号',
  `last_ip` varchar(15) NOT NULL COMMENT '最后登录ip',
  `last_time` int(11) NOT NULL COMMENT '最后登录时间',
  `login_count` int(11) NOT NULL COMMENT '登录次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（0=删除；1=正常；2=黑名单）',
  `token` varchar(255) NOT NULL COMMENT '找回密码用的',
  `role` smallint(5) unsigned NOT NULL COMMENT '账号角色（0:超级管理员，其余按照角色表）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cms_admin_user`
--

INSERT INTO `cms_admin_user` (`id`, `username`, `password`, `realname`, `phone`, `email`, `qq`, `last_ip`, `last_time`, `login_count`, `status`, `token`, `role`) VALUES
(1, 'admin', 'c56d0e9a7ccec67b4ea131655038d604', 'admin', '18688888889', '1234768@qq.com', '123456', '127.0.0.1', 1471587029, 50, 1, '', 1),
(2, 'test123', 'c56d0e9a7ccec67b4ea131655038d604', '管理员', '18688888888', '123456@qq.com', '123456', '127.0.0.1', 1467687072, 47, 1, '', 4);

-- --------------------------------------------------------

--
-- 表的结构 `cms_user`
--

CREATE TABLE IF NOT EXISTS `cms_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` char(20) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `realname` char(20) NOT NULL COMMENT '别称',
  `phone` char(20) NOT NULL COMMENT '电话',
  `email` char(20) NOT NULL COMMENT '邮箱',
  `qq` char(20) NOT NULL COMMENT 'QQ号',
  `last_ip` varchar(15) NOT NULL COMMENT '最后登录ip',
  `last_time` int(11) NOT NULL COMMENT '最后登录时间',
  `login_count` int(11) NOT NULL COMMENT '登录次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（0=删除；1=正常；2=黑名单）',
  `token` varchar(255) NOT NULL COMMENT '找回密码用的',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `cms_user`
--

INSERT INTO `cms_user` (`id`, `username`, `password`, `realname`, `phone`, `email`, `qq`, `last_ip`, `last_time`, `login_count`, `status`, `token`) VALUES
(2, '7489', 'c56d0e9a7ccec67b4ea131655038d604', '', '123', '123', '', '', 0, 0, 1, ''),
(3, '7488', '7363a0d0604902af7b70b271a0b96480', '', '123', '123', '', '', 0, 0, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
