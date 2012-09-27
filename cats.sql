CREATE TABLE `lib_books_cat` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(255) collate utf8_bin NOT NULL COMMENT '分类名',
  `parent_id` int(11) NOT NULL default '0' COMMENT '父ID',
  `level` tinyint(3) NOT NULL default '1' COMMENT '层次',
  `path` varchar(255) collate utf8_bin default NULL COMMENT '路径',
  `is_root` tinyint(1) NOT NULL default '1' COMMENT '根节点?',
  `is_leaf` tinyint(1) NOT NULL default '1' COMMENT '叶节点?',
  `sort_order` tinyint(1) NOT NULL default '0' COMMENT '排序',
  `Avail_days` int(4) NOT NULL default '30' COMMENT '可借阅天数',  
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '添加日期',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '更新日期',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='图书分类表' AUTO_INCREMENT=327 ;