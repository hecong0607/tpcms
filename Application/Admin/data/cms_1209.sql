-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-12-09 11:21:36
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
  `route` varchar(255) NOT NULL COMMENT '模块',
  `type` tinyint(4) unsigned NOT NULL COMMENT '类型（0=菜单；1=菜单+权限；2=权限；',
  `left_name` varchar(255) NOT NULL COMMENT '左边显示（占位用的）',
  `menu_name` varchar(255) NOT NULL COMMENT '名称',
  `rule_name` varchar(255) NOT NULL COMMENT '规则名称',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `list_order` int(11) unsigned NOT NULL COMMENT '排序',
  `logo` varchar(50) NOT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='后台菜单权限表' AUTO_INCREMENT=77 ;

--
-- 转存表中的数据 `cms_admin_menu_rule`
--

INSERT INTO `cms_admin_menu_rule` (`id`, `parent_id`, `route`, `type`, `left_name`, `menu_name`, `rule_name`, `remark`, `list_order`, `logo`) VALUES
(1, 0, '/Admin/Menu/index', 0, '', '菜单管理', '', '', 3, 'list'),
(11, 1, '/Admin/Menu/admin', 0, '', '后台菜单', '', '', 1, 'caret-right'),
(12, 11, '/Admin/Menu/list', 1, '', '菜单管理', '', '', 1, 'angle-double-right'),
(13, 12, '/Admin/Menu/add', 2, '', '菜单添加', '', '', 1, 'angle-right'),
(14, 13, '/Admin/Menu/doAdd', 2, '', '菜单添加--操作', '', '', 1, 'angle-right'),
(15, 12, '/Admin/Menu/save', 2, '', '菜单编辑', '', '', 2, 'angle-right'),
(16, 15, '/Admin/Menu/doSave', 2, '', '菜单编辑--操作', '', '', 1, 'angle-right'),
(17, 12, '/Admin/Menu/show', 2, '', '菜单详情', '', '', 3, 'angle-right'),
(18, 12, '/Admin/Menu/del', 2, '', '菜单删除', '', '', 4, 'angle-right'),
(20, 0, '/Admin/Setting/index', 0, '', '设置', '', '', 1, 'cogs'),
(21, 0, '/Admin/User/index', 0, '', '用户管理', '', '', 2, 'group'),
(22, 0, '/Admin/Tool/index', 0, '', '扩展工具', '', '', 5, 'cloud'),
(23, 21, '/Admin/Role/index', 0, '', '管理组', '', '', 1, 'caret-right'),
(24, 23, '/Admin/Role/list', 1, '', '角色管理', '', '', 1, 'angle-double-right'),
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
(45, 44, '/Admin/User/setPass', 2, '', '密码修改--操作', '', '', 1, 'angle-right'),
(46, 11, '/Admin/Route/list', 1, '', '后台路由', '', '', 2, 'angle-double-right'),
(47, 20, '/Admin/Set/Index', 0, '', '站点设置', '', '', 0, 'caret-right'),
(48, 47, '/Admin/Set/Index', 1, '', '基础设置', '', '', 0, 'angle-double-right'),
(49, 0, '/Article/Site/List', 0, '', '文章管理', '', '', 4, 'file-text'),
(50, 49, '/Article/Site/List', 0, '', '文章管理', '', '', 1, 'caret-right'),
(51, 50, '/Article/Site/List', 1, '', '文章列表', '', '', 1, 'angle-double-right'),
(52, 49, '/Article/Section/list', 0, '', '栏目管理', '', '', 1, 'caret-right'),
(53, 52, '/Article/Section/listAdmin', 1, '', '栏目列表--管理员', '', '', 2, 'angle-double-right'),
(54, 51, '/Article/Site/add', 2, '', '文章添加', '', '', 1, 'angle-right'),
(55, 51, '/Article/Site/save', 2, '', '文章编辑', '', '', 2, 'angle-right'),
(56, 51, '/Article/Site/del', 2, '', '文章删除', '', '', 3, 'angle-right'),
(57, 54, '/Article/Site/doAdd', 2, '', '文章添加--操作', '', '', 1, 'angle-right'),
(58, 55, '/Article/Site/doSave', 2, '', '文章编辑--操作', '', '', 1, 'angle-right'),
(59, 51, '/Article/Face/upload', 2, '', '文章图片上传--操作', '', '', 4, 'angle-right'),
(60, 53, '/Article/Section/add', 2, '', '栏目添加', '', '', 1, 'angle-double-right'),
(61, 53, '/Article/Section/save', 2, '', '栏目编辑', '', '', 2, 'angle-double-right'),
(62, 53, '/Article/Section/del', 2, '', '栏目删除', '', '', 3, 'angle-double-right'),
(63, 60, '/Article/Section/doAdd', 2, '', '栏目添加--操作', '', '', 1, 'angle-right'),
(64, 61, '/Article/Section/doSave', 2, '', '栏目编辑--操作', '', '', 1, 'angle-right'),
(65, 52, '/Article/Section/list', 1, '', '栏目列表', '', '', 1, 'angle-double-right'),
(66, 65, '/Article/Section/show', 2, '', '栏目详情', '', '', 1, 'angle-right'),
(67, 53, '/Article/Section/showAdmin', 2, '', '栏目详情', '', '', 4, 'angle-right'),
(68, 50, '/Article/Site/listAdmin', 1, '', '文章列表--管理员', '', '', 2, 'angle-double-right'),
(69, 68, '/Article/Site/setPend', 2, '', '设置审核', '', '', 3, 'angle-right'),
(72, 51, '/Article/Site/release', 2, '', '设置发布状态', '', '', 5, 'angle-right'),
(73, 49, '/Article/Tags/list', 0, '', '标签管理--管理员', '', '', 3, 'caret-right'),
(74, 73, '/Article/Tags/list', 1, '', '标签列表', '', '', 1, 'angle-double-right'),
(75, 68, '/Article/Site/setPopular', 2, '', '设置热门', '', '', 1, 'angle-right'),
(76, 68, '/Article/Site/setRecommend', 2, '', '设置推荐', '', '', 2, 'angle-right');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `cms_admin_role`
--

INSERT INTO `cms_admin_role` (`id`, `name`, `power`, `status`, `remark`, `create_time`, `update_time`) VALUES
(1, '超级管理员', '0', 1, '拥有网站最高管理员权限！', 1329633709, 1329633709);

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin_route`
--

CREATE TABLE IF NOT EXISTS `cms_admin_route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='路由列表--供菜单创建和修改使用' AUTO_INCREMENT=78 ;

--
-- 转存表中的数据 `cms_admin_route`
--

INSERT INTO `cms_admin_route` (`id`, `route`, `create_time`) VALUES
(13, '/Admin/Menu/del', 1472196111),
(14, '/Admin/Menu/doAdd', 1472197656),
(15, '/Admin/Public/login', 1472197673),
(16, '/Admin/Menu/add', 1472197675),
(18, '/Admin/Menu/icons', 1472197700),
(19, '/Admin/Menu/save', 1472197701),
(20, '/Admin/Home/index', 1472197726),
(21, '/Admin/Home/main', 1472197726),
(22, '/Admin/Menu/doSave', 1472197726),
(23, '/Admin/Menu/show', 1472197726),
(24, '/Admin/Menu/list', 1472197726),
(25, '/Admin/Public/doLogin', 1472197726),
(26, '/Admin/Public/logout', 1472197726),
(27, '/Admin/Public/verify', 1472197726),
(28, '/Admin/Role/add', 1472197726),
(29, '/Admin/Role/doAdd', 1472197726),
(30, '/Admin/Role/save', 1472197726),
(31, '/Admin/Role/doSave', 1472197726),
(32, '/Admin/Role/show', 1472197726),
(33, '/Admin/Role/list', 1472197726),
(34, '/Admin/Role/del', 1472197726),
(35, '/Admin/Role/setPower', 1472197726),
(36, '/Admin/Role/doSetPower', 1472197726),
(37, '/Admin/Route/list', 1472197726),
(38, '/Admin/Route/del', 1472197726),
(39, '/Admin/Route/add', 1472197726),
(40, '/Admin/Route/refresh', 1472197726),
(41, '/Admin/User/add', 1472197726),
(42, '/Admin/User/doAdd', 1472197726),
(43, '/Admin/User/save', 1472197726),
(44, '/Admin/User/doSave', 1472197726),
(45, '/Admin/User/list', 1472197726),
(46, '/Admin/User/del', 1472197726),
(47, '/Admin/User/setBlack', 1472197726),
(48, '/Admin/User/setEnable', 1472197726),
(49, '/Admin/User/info', 1472197726),
(50, '/Admin/User/pass', 1472197726),
(51, '/Admin/User/setInfo', 1472197726),
(52, '/Admin/User/setPass', 1472197726),
(53, '/Admin/Set/Index', 1478759491),
(54, '/Admin/Set/Update', 1480413285),
(55, '/Article/Face/upload', 1480492695),
(56, '/Article/Section/list', 1480492695),
(57, '/Article/Section/listAdmin', 1480492695),
(58, '/Article/Section/add', 1480492695),
(59, '/Article/Section/doAdd', 1480492695),
(60, '/Article/Section/save', 1480492695),
(61, '/Article/Section/doSave', 1480492695),
(62, '/Article/Section/show', 1480492695),
(63, '/Article/Section/del', 1480492695),
(64, '/Article/Site/add', 1480492695),
(65, '/Article/Site/doAdd', 1480492695),
(66, '/Article/Site/save', 1480492695),
(67, '/Article/Site/doSave', 1480492695),
(68, '/Article/Site/list', 1480492695),
(69, '/Article/Site/del', 1480492695),
(71, '/Article/Tags/list', 1480577179),
(72, '/Article/Site/listAdmin', 1480585028),
(73, '/Article/Site/release', 1480585030),
(74, '/Article/Site/setPend', 1480585032),
(75, '/Article/Site/setRecommend', 1481009447),
(76, '/Article/Site/setPopular', 1481009449),
(77, '/Article/Section/showAdmin', 1481167274);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `cms_admin_user`
--

INSERT INTO `cms_admin_user` (`id`, `username`, `password`, `realname`, `phone`, `email`, `qq`, `last_ip`, `last_time`, `login_count`, `status`, `token`, `role`) VALUES
(1, 'admin', 'c56d0e9a7ccec67b4ea131655038d604', 'admin', '18688888889', '1234768@qq.com', '123456', '127.0.0.1', 1471587029, 50, 1, '', 1),
(2, 'hecong', 'c56d0e9a7ccec67b4ea131655038d604', '管理员', '18688888888', '123456@qq.com', '123456', '127.0.0.1', 1467687072, 47, 1, '', 4);

-- --------------------------------------------------------

--
-- 表的结构 `cms_article`
--

CREATE TABLE IF NOT EXISTS `cms_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `section_id` int(11) unsigned NOT NULL COMMENT '栏目id',
  `face` varchar(255) NOT NULL COMMENT '封面图片',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `summary` varchar(255) NOT NULL COMMENT '摘要',
  `content` text NOT NULL COMMENT '内容',
  `tags` varchar(255) NOT NULL COMMENT '标签',
  `view` int(11) unsigned NOT NULL COMMENT '访问量',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '修改时间',
  `status` tinyint(3) unsigned NOT NULL COMMENT '状态（0=待发布，1=发布）',
  `popular` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '热门（0=不是，1=是）',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '推荐（0=不推荐，1=推荐）',
  `flag` tinyint(3) unsigned NOT NULL COMMENT '标识（0=已审核，1=未审核待修改，2=未审核已修改）',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `cms_article`
--

INSERT INTO `cms_article` (`id`, `user_id`, `section_id`, `face`, `thumb`, `title`, `summary`, `content`, `tags`, `view`, `create_time`, `update_time`, `status`, `popular`, `recommend`, `flag`) VALUES
(1, 1, 5, '/Public/images/face/20161124/5836bca04ae58.png', '', '测试标签2', '这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要', '&lt;p&gt;是否&lt;/p&gt;', '', 5, 1479982242, 1481186904, 1, 0, 0, 0),
(3, 2, 7, '', '', '测试标签', '', '', '新的标签1，新的标签2', 0, 1480408982, 1480486214, 1, 0, 0, 0),
(4, 1, 7, '/Public/images/face/20161202/5841306512829.jpg', '/Public/images/thumb/5841306512829.jpg', '打算', '这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要这里是摘要', '&lt;p style=&quot;text-align: center; &quot;&gt;&lt;b&gt;这里是测试&lt;/b&gt;&lt;/p&gt;&lt;p&gt;是的，这里是测试内容，&lt;font color=&quot;#ff0000&quot;&gt;红色&lt;/font&gt;，&lt;font color=&quot;#0000ff&quot;&gt;蓝色&lt;/font&gt;，&lt;font color=&quot;#ffcc00&quot;&gt;黄色&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '标签1，标签2，标签3，标签4，标签5，标签6，标签7，标签8，新的标签1', 0, 1480409379, 1481186876, 1, 1, 0, 0),
(5, 1, 5, '', '', '打算', '', '', '', 0, 1480409421, 1481186916, 1, 0, 0, 0),
(6, 1, 7, '', '', '打算', '', '', '', 0, 1480409437, 1481186852, 1, 1, 0, 0),
(7, 1, 4, '/Public/images/face/20161208/5849234d0b16f.jpg', '/Public/images/thumb/5849234d0b16f.jpg', '打算', '', '', '', 0, 1480409452, 1481188175, 1, 0, 0, 0),
(8, 1, 5, '', '', '打算', '今天发现系统后台的某个抓取页面突然失效了，Google了一下，大概意思就是，在主线程里使用同步的ajax请求对用户体验有影响，所以不让用了。先是把async: false注释掉，发现抓取依然是不行。照理这个是警告，不会阻止程序的运行才对的。于是加上$.ajax的error选项，发现jqXHR.status输出 200，就是网络是通的。而jqXHR.responseText返回了一处PHP报错，定位到错误处，发现$array file_get_contents($url); 报错了', '', '', 0, 1480409682, 1481186669, 1, 1, 0, 0),
(9, 1, 9, '', '', '这是一个什么样的网站', '这是一个什么样的网站的摘要', '&lt;p&gt;这是一个什么样的网站的内容&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://www.baidu.com&quot; target=&quot;_blank&quot;&gt;@百度&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', 0, 1481250641, 1481251304, 1, 0, 1, 0),
(10, 1, 10, '', '', '现代简明魔法', 'http://www.nowamagic.net', '', '', 0, 1481252860, 1481255422, 1, 0, 0, 0),
(11, 1, 11, '/Public/images/face/20161209/584a279629c0d.jpg', '/Public/images/thumb/584a279629c0d.jpg', '图赏一', '', '', '', 0, 1481254810, 0, 1, 0, 0, 0),
(12, 1, 12, '/Public/images/face/20161209/584a2a3229273.jpg', '/Public/images/thumb/584a2a3229273.jpg', '以图明志一', '', '', '', 0, 1481255490, 0, 1, 0, 0, 0),
(13, 1, 12, '/Public/images/face/20161209/584a559e42137.jpg', '/Public/images/thumb/584a559e42137.jpg', '以图明志二', '', '', '', 0, 1481266591, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_article_face`
--

CREATE TABLE IF NOT EXISTS `cms_article_face` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '创建者id',
  `url` varchar(255) NOT NULL COMMENT '网络地址',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `time` int(11) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章封面图片列表' AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `cms_article_face`
--

INSERT INTO `cms_article_face` (`id`, `user_id`, `url`, `thumb`, `time`) VALUES
(8, 1, '/Public/images/face/20161124/58365da4e9973.png', '', 1479957924),
(9, 1, '/Public/images/face/20161124/58365de5b8726.png', '', 1479957989),
(10, 1, '/Public/images/face/20161124/58365e3b99e85.png', '', 1479958075),
(11, 1, '/Public/images/face/20161124/583664080eb96.png', '', 1479959560),
(12, 1, '/Public/images/face/20161124/5836bca04ae58.png', '', 1479982240),
(13, 1, '/Public/images/face/20161129/583d2d87a012f.jpg', '', 1480404359),
(14, 1, '/Public/images/face/20161201/583ffa43f2b6b.png', '', 1480587844),
(15, 1, '/Public/images/face/20161202/5840ca1e2da0b.png', '', 1480641054),
(16, 1, '/Public/images/face/20161202/5840cc0da418a.png', '', 1480641549),
(17, 1, '/Public/images/face/20161202/5840cc1a9e28f.png', '', 1480641562),
(18, 1, '/Public/images/face/20161202/5840cc216a199.gif', '', 1480641569),
(19, 1, '/Public/images/face/20161202/5840d388bbdfc.jpg', '', 1480643464),
(20, 1, '/Public/images/face/20161202/5840d4d98dcbc.jpg', '', 1480643801),
(21, 1, '/Public/images/face/20161202/5840dbb1f0fa0.jpg', '', 1480645554),
(22, 1, '/Public/images/face/20161202/5840dbff656ed.png', '', 1480645631),
(23, 1, '/Public/images/face/20161202/5840dcdb1c49b.jpg', '/Public/images/thumb/5840dcdb1c49b.jpg', 1480645851),
(24, 1, '/Public/images/face/20161202/5840decdac9a8.jpg', '/Public/images/thumb/5840decdac9a8.jpg', 1480646349),
(25, 1, '/Public/images/face/20161202/5841306512829.jpg', '/Public/images/thumb/5841306512829.jpg', 1480667237),
(26, 1, '/Public/images/face/20161208/5849234d0b16f.jpg', '/Public/images/thumb/5849234d0b16f.jpg', 1481188173),
(27, 1, '/Public/images/face/20161209/584a279629c0d.jpg', '/Public/images/thumb/584a279629c0d.jpg', 1481254806),
(28, 1, '/Public/images/face/20161209/584a2a3229273.jpg', '/Public/images/thumb/584a2a3229273.jpg', 1481255474),
(29, 1, '/Public/images/face/20161209/584a559e42137.jpg', '/Public/images/thumb/584a559e42137.jpg', 1481266590);

-- --------------------------------------------------------

--
-- 表的结构 `cms_article_section`
--

CREATE TABLE IF NOT EXISTS `cms_article_section` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '栏目父id',
  `user_id` int(11) unsigned NOT NULL COMMENT '创建者id',
  `name` varchar(255) NOT NULL COMMENT '栏目名称',
  `content` text NOT NULL COMMENT '具体内容',
  `face` varchar(255) NOT NULL COMMENT '封面图片',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `status` tinyint(3) unsigned NOT NULL COMMENT '状态（0删除，1正常）',
  `type` tinyint(3) unsigned NOT NULL COMMENT '类型（0=文章，1=图片）',
  `list_order` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章栏目表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `cms_article_section`
--

INSERT INTO `cms_article_section` (`id`, `parent_id`, `user_id`, `name`, `content`, `face`, `thumb`, `status`, `type`, `list_order`, `create_time`, `update_time`) VALUES
(1, 3, 1, 'IT人家', '&lt;p style=&quot;text-align: left;&quot;&gt;这里是一级栏目，底下有图赏分类栏目&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '/Public/images/face/20161202/5840d388bbdfc.jpg', '', 1, 0, 3, 1479974922, 1481248023),
(3, 0, 2, '博客', '&lt;p&gt;这里是博客的栏目&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', 1, 0, 2, 1479975775, 1481186106),
(4, 3, 2, '数据结构', '&lt;p&gt;这里是图赏分类栏目，分类的文章主要是封面图片，一般没有内容&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '/Public/images/face/20161202/5840decdac9a8.jpg', '/Public/images/thumb/5840decdac9a8.jpg', 1, 0, 4, 1479975775, 1481250591),
(5, 3, 1, '编程语言', '&lt;p&gt;这里是某个分类&lt;/p&gt;', '', '', 1, 0, 1, 1481165873, 1481186113),
(6, 3, 1, '计算机算法', '&lt;p&gt;根据最新来，本类型不写文章&lt;/p&gt;', '', '', 1, 0, 5, 1481185533, 1481248060),
(7, 3, 1, '前端设计', '&lt;p&gt;前端设计文章&lt;/p&gt;', '', '', 1, 0, 2, 1481186316, 0),
(8, 0, 1, '站点文章', '&lt;p&gt;本栏目为站点文章，用于站点固定链接文章&lt;/p&gt;', '', '', 1, 0, 1, 1481249047, 0),
(9, 8, 1, '主页右侧文章', '&lt;p&gt;主页右侧的文章，显示简介，不显示内容&lt;/p&gt;', '', '', 1, 0, 1, 1481250582, 1481250705),
(10, 8, 1, '友情链接文章', '&lt;p&gt;这里是友情链接文章的栏目&lt;/p&gt;&lt;p&gt;摘要为链接，标题为名称，不获取内容&lt;/p&gt;', '', '', 1, 0, 2, 1481252799, 1481252908),
(11, 8, 1, '图赏文章', '&lt;p&gt;这里是图赏的文章，只存在封面图片，以排序最大的为准&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', 1, 1, 3, 1481254750, 1481254780),
(12, 8, 1, '以图明志（600*248）', '&lt;p&gt;这是栏目页面的以图明志，图片规格：600*248&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', 1, 0, 4, 1481255324, 1481266706);

-- --------------------------------------------------------

--
-- 表的结构 `cms_article_section_config`
--

CREATE TABLE IF NOT EXISTS `cms_article_section_config` (
  `group_id` int(11) unsigned NOT NULL COMMENT '分组id',
  `section_id` int(11) unsigned NOT NULL COMMENT '栏目id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cms_article_tags`
--

CREATE TABLE IF NOT EXISTS `cms_article_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '标签名',
  `num` int(11) unsigned NOT NULL COMMENT '引用数量',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='标签列表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `cms_article_tags`
--

INSERT INTO `cms_article_tags` (`id`, `name`, `num`) VALUES
(1, '标签1', 1),
(2, '标签3', 1),
(3, '标签4', 1),
(4, '新的标签1', 2),
(5, '新的标签2', 1),
(6, '标签2', 1),
(7, '标签5', 1),
(8, '标签6', 1),
(9, '标签7', 1),
(10, '标签8', 1),
(11, '标签8,标签', 0),
(12, '', 5);

-- --------------------------------------------------------

--
-- 表的结构 `cms_article_tags_map`
--

CREATE TABLE IF NOT EXISTS `cms_article_tags_map` (
  `tag_id` int(11) unsigned NOT NULL COMMENT '标签id',
  `article_id` int(11) unsigned NOT NULL COMMENT '文章id',
  KEY `tag_id` (`tag_id`,`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签-文章-地图表';

--
-- 转存表中的数据 `cms_article_tags_map`
--

INSERT INTO `cms_article_tags_map` (`tag_id`, `article_id`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 3),
(4, 4),
(5, 3),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(12, 9),
(12, 10),
(12, 11),
(12, 12),
(12, 13);

-- --------------------------------------------------------

--
-- 表的结构 `cms_config`
--

CREATE TABLE IF NOT EXISTS `cms_config` (
  `name` varchar(50) NOT NULL,
  `type` varchar(150) NOT NULL COMMENT '多个默认值用|分隔',
  `value` text NOT NULL,
  `info` varchar(20) NOT NULL,
  `desc` text NOT NULL,
  `gid` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配置表';

--
-- 转存表中的数据 `cms_config`
--

INSERT INTO `cms_config` (`name`, `type`, `value`, `info`, `desc`, `gid`, `sort`, `status`) VALUES
('article_name', 'type=text&style=width:240px', '文章2', '文章测试', '文章测试详情', 3, 0, 1),
('hidden_description', 'type=textarea&rows=5&cols=93', '吾爱源码', '大的输入框', '这里是提示', 1, 0, 0),
('hidden_logo', 'type=image', '图片地址', '上传图片', '这里是提示', 1, 0, 0),
('hidden_name', 'type=text&style=width:240px', '这里是当前值', '输入框信息', '这里是提示', 1, 0, 0),
('hidden_onoff', 'type=radio', 'false', '开启关闭按钮', '这里是提示', 1, 0, 0),
('hidden_redirect', 'type=select&multiple=multiple&value=0:不跳转|1:自动跳转|2:询问跳转', '1', '选择框', '这里是提示', 1, 0, 0),
('site_name', 'type=text&style=width:240px', '河淙5', '站点名称', '网站的站点名称', 2, 0, 1),
('site_onoff', 'type=radio&value=0:关闭|1:开启', '1', '开启关闭按钮', '这里是提示', 2, 0, 1),
('site_redirect', 'type=select&value=0:不跳转|1:自动跳转|2:询问跳转', '1', '测试框', '这是测试', 2, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_config_group`
--

CREATE TABLE IF NOT EXISTS `cms_config_group` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '分组前缀',
  `gsort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='配置分组' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cms_config_group`
--

INSERT INTO `cms_config_group` (`gid`, `gname`, `name`, `gsort`, `status`) VALUES
(1, '隐藏例子', 'hidden', 0, 0),
(2, '基础设置', 'site', 1, 1),
(3, '文章设置', 'artice', 2, 1),
(4, '首页栏目显示设置', 'section_home_view', 3, 0),
(5, '博客栏目显示设置', 'section_blog_view', 4, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
