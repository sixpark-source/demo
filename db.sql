-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-01-09 11:16:39
-- 服务器版本： 5.7.9-log
-- PHP 版本： 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `auth_client_example`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs_attach`
--

CREATE TABLE `bbs_attach` (
  `aid` int(11) UNSIGNED NOT NULL,
  `tid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `filesize` int(8) UNSIGNED NOT NULL DEFAULT '0',
  `width` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `height` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `filename` char(120) NOT NULL DEFAULT '',
  `orgfilename` char(120) NOT NULL DEFAULT '',
  `filetype` char(7) NOT NULL DEFAULT '',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `comment` char(100) NOT NULL DEFAULT '',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '0',
  `golds` int(11) NOT NULL DEFAULT '0',
  `rmbs` int(11) NOT NULL DEFAULT '0',
  `isimage` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_cache`
--

CREATE TABLE `bbs_cache` (
  `k` char(32) NOT NULL DEFAULT '',
  `v` mediumtext NOT NULL,
  `expiry` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_cache`
--

INSERT INTO `bbs_cache` (`k`, `v`, `expiry`) VALUES
('bbs_runtime', '{\n    \"users\": 1,\n    \"posts\": 0,\n    \"threads\": 0,\n    \"todayusers\": 0,\n    \"todayposts\": 0,\n    \"todaythreads\": 0,\n    \"onlines\": 1,\n    \"cron_1_last_date\": 1673262579,\n    \"cron_2_last_date\": 1673193600\n}', 0),
('bbs_grouplist', '{\n    \"0\": {\n        \"gid\": \"0\",\n        \"name\": \"游客组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"0\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"0\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"1\": {\n        \"gid\": \"1\",\n        \"name\": \"管理员组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"1\",\n        \"allowupdate\": \"1\",\n        \"allowdelete\": \"1\",\n        \"allowmove\": \"1\",\n        \"allowbanuser\": \"1\",\n        \"allowdeleteuser\": \"1\",\n        \"allowviewip\": \"1\"\n    },\n    \"2\": {\n        \"gid\": \"2\",\n        \"name\": \"超级版主组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"1\",\n        \"allowupdate\": \"1\",\n        \"allowdelete\": \"1\",\n        \"allowmove\": \"1\",\n        \"allowbanuser\": \"1\",\n        \"allowdeleteuser\": \"1\",\n        \"allowviewip\": \"1\"\n    },\n    \"4\": {\n        \"gid\": \"4\",\n        \"name\": \"版主组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"1\",\n        \"allowupdate\": \"1\",\n        \"allowdelete\": \"1\",\n        \"allowmove\": \"1\",\n        \"allowbanuser\": \"1\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"1\"\n    },\n    \"5\": {\n        \"gid\": \"5\",\n        \"name\": \"实习版主组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"1\",\n        \"allowupdate\": \"1\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"1\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"6\": {\n        \"gid\": \"6\",\n        \"name\": \"待验证用户组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"0\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"0\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"7\": {\n        \"gid\": \"7\",\n        \"name\": \"禁止用户组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"0\",\n        \"allowread\": \"0\",\n        \"allowthread\": \"0\",\n        \"allowpost\": \"0\",\n        \"allowattach\": \"0\",\n        \"allowdown\": \"0\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"101\": {\n        \"gid\": \"101\",\n        \"name\": \"一级用户组\",\n        \"creditsfrom\": \"0\",\n        \"creditsto\": \"50\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"102\": {\n        \"gid\": \"102\",\n        \"name\": \"二级用户组\",\n        \"creditsfrom\": \"50\",\n        \"creditsto\": \"200\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"103\": {\n        \"gid\": \"103\",\n        \"name\": \"三级用户组\",\n        \"creditsfrom\": \"200\",\n        \"creditsto\": \"1000\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"104\": {\n        \"gid\": \"104\",\n        \"name\": \"四级用户组\",\n        \"creditsfrom\": \"1000\",\n        \"creditsto\": \"10000\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    },\n    \"105\": {\n        \"gid\": \"105\",\n        \"name\": \"五级用户组\",\n        \"creditsfrom\": \"10000\",\n        \"creditsto\": \"10000000\",\n        \"allowread\": \"1\",\n        \"allowthread\": \"1\",\n        \"allowpost\": \"1\",\n        \"allowattach\": \"1\",\n        \"allowdown\": \"1\",\n        \"allowtop\": \"0\",\n        \"allowupdate\": \"0\",\n        \"allowdelete\": \"0\",\n        \"allowmove\": \"0\",\n        \"allowbanuser\": \"0\",\n        \"allowdeleteuser\": \"0\",\n        \"allowviewip\": \"0\"\n    }\n}', 0),
('bbs_forumlist', '{\n    \"1\": {\n        \"fid\": \"1\",\n        \"name\": \"默认版块\",\n        \"rank\": \"0\",\n        \"threads\": \"0\",\n        \"todayposts\": \"0\",\n        \"todaythreads\": \"0\",\n        \"brief\": \"默认版块介绍\",\n        \"announcement\": \"\",\n        \"accesson\": \"0\",\n        \"orderby\": \"0\",\n        \"create_date\": \"0\",\n        \"icon\": \"0\",\n        \"moduids\": \"\",\n        \"seo_title\": \"\",\n        \"seo_keywords\": \"\",\n        \"create_date_fmt\": \"1970-1-1\",\n        \"icon_url\": \"view/img/forum.png\",\n        \"accesslist\": [],\n        \"modlist\": []\n    }\n}', 1673262639);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_forum`
--

CREATE TABLE `bbs_forum` (
  `fid` int(11) UNSIGNED NOT NULL,
  `name` char(16) NOT NULL DEFAULT '',
  `rank` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `threads` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `todayposts` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `todaythreads` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `brief` text NOT NULL,
  `announcement` text NOT NULL,
  `accesson` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `orderby` tinyint(11) NOT NULL DEFAULT '0',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `icon` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `moduids` char(120) NOT NULL DEFAULT '',
  `seo_title` char(64) NOT NULL DEFAULT '',
  `seo_keywords` char(64) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_forum`
--

INSERT INTO `bbs_forum` (`fid`, `name`, `rank`, `threads`, `todayposts`, `todaythreads`, `brief`, `announcement`, `accesson`, `orderby`, `create_date`, `icon`, `moduids`, `seo_title`, `seo_keywords`) VALUES
(1, '默认版块', 0, 0, 0, 0, '默认版块介绍', '', 0, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `bbs_forum_access`
--

CREATE TABLE `bbs_forum_access` (
  `fid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `allowread` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `allowthread` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `allowattach` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `allowdown` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_group`
--

CREATE TABLE `bbs_group` (
  `gid` smallint(6) UNSIGNED NOT NULL,
  `name` char(20) NOT NULL DEFAULT '',
  `creditsfrom` int(11) NOT NULL DEFAULT '0',
  `creditsto` int(11) NOT NULL DEFAULT '0',
  `allowread` int(11) NOT NULL DEFAULT '0',
  `allowthread` int(11) NOT NULL DEFAULT '0',
  `allowpost` int(11) NOT NULL DEFAULT '0',
  `allowattach` int(11) NOT NULL DEFAULT '0',
  `allowdown` int(11) NOT NULL DEFAULT '0',
  `allowtop` int(11) NOT NULL DEFAULT '0',
  `allowupdate` int(11) NOT NULL DEFAULT '0',
  `allowdelete` int(11) NOT NULL DEFAULT '0',
  `allowmove` int(11) NOT NULL DEFAULT '0',
  `allowbanuser` int(11) NOT NULL DEFAULT '0',
  `allowdeleteuser` int(11) NOT NULL DEFAULT '0',
  `allowviewip` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_group`
--

INSERT INTO `bbs_group` (`gid`, `name`, `creditsfrom`, `creditsto`, `allowread`, `allowthread`, `allowpost`, `allowattach`, `allowdown`, `allowtop`, `allowupdate`, `allowdelete`, `allowmove`, `allowbanuser`, `allowdeleteuser`, `allowviewip`) VALUES
(0, '游客组', 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(1, '管理员组', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '超级版主组', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, '版主组', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
(5, '实习版主组', 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0),
(6, '待验证用户组', 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(7, '禁止用户组', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(101, '一级用户组', 0, 50, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(102, '二级用户组', 50, 200, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(103, '三级用户组', 200, 1000, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(104, '四级用户组', 1000, 10000, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(105, '五级用户组', 10000, 10000000, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_kv`
--

CREATE TABLE `bbs_kv` (
  `k` char(32) NOT NULL DEFAULT '',
  `v` mediumtext NOT NULL,
  `expiry` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_kv`
--

INSERT INTO `bbs_kv` (`k`, `v`, `expiry`) VALUES
('last_version', '1672651499', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_modlog`
--

CREATE TABLE `bbs_modlog` (
  `logid` int(11) UNSIGNED NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `subject` char(32) NOT NULL DEFAULT '',
  `comment` char(64) NOT NULL DEFAULT '',
  `rmbs` int(11) NOT NULL DEFAULT '0',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `action` char(16) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_mypost`
--

CREATE TABLE `bbs_mypost` (
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_mythread`
--

CREATE TABLE `bbs_mythread` (
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tid` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_post`
--

CREATE TABLE `bbs_post` (
  `tid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pid` int(11) UNSIGNED NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isfirst` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userip` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `images` smallint(6) NOT NULL DEFAULT '0',
  `files` smallint(6) NOT NULL DEFAULT '0',
  `doctype` tinyint(3) NOT NULL DEFAULT '0',
  `quotepid` int(11) NOT NULL DEFAULT '0',
  `message` longtext NOT NULL,
  `message_fmt` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_queue`
--

CREATE TABLE `bbs_queue` (
  `queueid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `v` int(11) NOT NULL DEFAULT '0',
  `expiry` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_session`
--

CREATE TABLE `bbs_session` (
  `sid` char(32) NOT NULL DEFAULT '0',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fid` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `url` char(32) NOT NULL DEFAULT '',
  `ip` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `useragent` char(128) NOT NULL DEFAULT '',
  `data` char(255) NOT NULL DEFAULT '',
  `bigdata` tinyint(1) NOT NULL DEFAULT '0',
  `last_date` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_session`
--

INSERT INTO `bbs_session` (`sid`, `uid`, `fid`, `url`, `ip`, `useragent`, `data`, `bigdata`, `last_date`) VALUES
('d9ofnh446upsm3lcuo09rt2qe5', 5002372, 18, 'forum-18.htm', 2130706433, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '', 0, 1673262615);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_session_data`
--

CREATE TABLE `bbs_session_data` (
  `sid` char(32) NOT NULL DEFAULT '0',
  `last_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_table_day`
--

CREATE TABLE `bbs_table_day` (
  `year` smallint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '年',
  `month` tinyint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '月',
  `day` tinyint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '日',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '时间戳',
  `table` char(16) NOT NULL DEFAULT '' COMMENT '表名',
  `maxid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '最大ID',
  `count` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '总数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_thread`
--

CREATE TABLE `bbs_thread` (
  `fid` smallint(6) NOT NULL DEFAULT '0',
  `tid` int(11) UNSIGNED NOT NULL,
  `top` tinyint(1) NOT NULL DEFAULT '0',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userip` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `subject` char(128) NOT NULL DEFAULT '',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `last_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `posts` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `images` tinyint(6) NOT NULL DEFAULT '0',
  `files` tinyint(6) NOT NULL DEFAULT '0',
  `mods` tinyint(6) NOT NULL DEFAULT '0',
  `closed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `firstpid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lastuid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lastpid` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_thread_top`
--

CREATE TABLE `bbs_thread_top` (
  `fid` smallint(6) NOT NULL DEFAULT '0',
  `tid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `top` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user`
--

CREATE TABLE `bbs_user` (
  `uid` int(11) UNSIGNED NOT NULL COMMENT '用户编号',
  `gid` smallint(6) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户组编号',
  `email` char(40) NOT NULL DEFAULT '' COMMENT '邮箱',
  `username` char(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `realname` char(16) NOT NULL DEFAULT '' COMMENT '用户名',
  `idnumber` char(19) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `password_sms` char(16) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(16) NOT NULL DEFAULT '' COMMENT '密码混杂',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `qq` char(15) NOT NULL DEFAULT '' COMMENT 'QQ',
  `threads` int(11) NOT NULL DEFAULT '0' COMMENT '发帖数',
  `posts` int(11) NOT NULL DEFAULT '0' COMMENT '回帖数',
  `credits` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `golds` int(11) NOT NULL DEFAULT '0' COMMENT '金币',
  `rmbs` int(11) NOT NULL DEFAULT '0' COMMENT '人民币',
  `create_ip` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时IP',
  `create_date` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `login_ip` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时IP',
  `login_date` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
  `logins` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `avatar` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户最后更新图像时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_user`
--

INSERT INTO `bbs_user` (`uid`, `gid`, `email`, `username`, `realname`, `idnumber`, `password`, `password_sms`, `salt`, `mobile`, `qq`, `threads`, `posts`, `credits`, `golds`, `rmbs`, `create_ip`, `create_date`, `login_ip`, `login_date`, `logins`, `avatar`) VALUES
(1, 1, 'admin@admin.com', 'admin', '', '', '1f877bd7caa3673bc452b41ed28151db', '', 'T5DZM2MCW4UCH76K', '', '', 0, 0, 0, 0, 0, 2130706433, 1672295918, 2130706433, 1672299161, 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user_auth`
--

CREATE TABLE `bbs_user_auth` (
  `uid` int(11) NOT NULL,
  `username` varchar(199) NOT NULL,
  `token` varchar(250) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `bbs_user_auth`
--

INSERT INTO `bbs_user_auth` (`uid`, `username`, `token`, `expires`) VALUES
(5002372, 'Goforit', 'bXoeI9ByaDLzfv12b6R96+J5ksw93jHeefjMgXm5BKWIhFQCcyqknq7Z2/0m1HH0mhi/F3SSE5hyU3arFJMV0VyCvRNhHjiJOb7Rs65Pb8A=', 1673348992);

--
-- 转储表的索引
--

--
-- 表的索引 `bbs_attach`
--
ALTER TABLE `bbs_attach`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- 表的索引 `bbs_cache`
--
ALTER TABLE `bbs_cache`
  ADD PRIMARY KEY (`k`);

--
-- 表的索引 `bbs_forum`
--
ALTER TABLE `bbs_forum`
  ADD PRIMARY KEY (`fid`);

--
-- 表的索引 `bbs_forum_access`
--
ALTER TABLE `bbs_forum_access`
  ADD PRIMARY KEY (`fid`,`gid`);

--
-- 表的索引 `bbs_group`
--
ALTER TABLE `bbs_group`
  ADD PRIMARY KEY (`gid`);

--
-- 表的索引 `bbs_kv`
--
ALTER TABLE `bbs_kv`
  ADD PRIMARY KEY (`k`);

--
-- 表的索引 `bbs_modlog`
--
ALTER TABLE `bbs_modlog`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `uid` (`uid`,`logid`),
  ADD KEY `tid` (`tid`);

--
-- 表的索引 `bbs_mypost`
--
ALTER TABLE `bbs_mypost`
  ADD PRIMARY KEY (`uid`,`pid`),
  ADD KEY `tid` (`tid`);

--
-- 表的索引 `bbs_mythread`
--
ALTER TABLE `bbs_mythread`
  ADD PRIMARY KEY (`uid`,`tid`);

--
-- 表的索引 `bbs_post`
--
ALTER TABLE `bbs_post`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `tid` (`tid`,`pid`),
  ADD KEY `uid` (`uid`);

--
-- 表的索引 `bbs_queue`
--
ALTER TABLE `bbs_queue`
  ADD UNIQUE KEY `queueid` (`queueid`,`v`),
  ADD KEY `expiry` (`expiry`);

--
-- 表的索引 `bbs_session`
--
ALTER TABLE `bbs_session`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `ip` (`ip`),
  ADD KEY `fid` (`fid`),
  ADD KEY `uid_last_date` (`uid`,`last_date`);

--
-- 表的索引 `bbs_session_data`
--
ALTER TABLE `bbs_session_data`
  ADD PRIMARY KEY (`sid`);

--
-- 表的索引 `bbs_table_day`
--
ALTER TABLE `bbs_table_day`
  ADD PRIMARY KEY (`year`,`month`,`day`,`table`);

--
-- 表的索引 `bbs_thread`
--
ALTER TABLE `bbs_thread`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `lastpid` (`lastpid`),
  ADD KEY `fid` (`fid`,`tid`),
  ADD KEY `fid_2` (`fid`,`lastpid`);

--
-- 表的索引 `bbs_thread_top`
--
ALTER TABLE `bbs_thread_top`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `top` (`top`,`tid`),
  ADD KEY `fid` (`fid`,`top`);

--
-- 表的索引 `bbs_user`
--
ALTER TABLE `bbs_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `gid` (`gid`);

--
-- 表的索引 `bbs_user_auth`
--
ALTER TABLE `bbs_user_auth`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bbs_attach`
--
ALTER TABLE `bbs_attach`
  MODIFY `aid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `bbs_forum`
--
ALTER TABLE `bbs_forum`
  MODIFY `fid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `bbs_modlog`
--
ALTER TABLE `bbs_modlog`
  MODIFY `logid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `bbs_post`
--
ALTER TABLE `bbs_post`
  MODIFY `pid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `bbs_thread`
--
ALTER TABLE `bbs_thread`
  MODIFY `tid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `bbs_user`
--
ALTER TABLE `bbs_user`
  MODIFY `uid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户编号', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `bbs_user_auth`
--
ALTER TABLE `bbs_user_auth`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5002373;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
