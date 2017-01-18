/*
MySQL Data Transfer
Source Host: localhost
Source Database: oa
Target Host: localhost
Target Database: oa
Date: 2017/1/16 ����һ ���� 6:33:01
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for oa_absolute
-- ----------------------------
DROP TABLE IF EXISTS `oa_absolute`;
CREATE TABLE `oa_absolute` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_sid` int(11) NOT NULL,
  `a_uid` int(11) NOT NULL,
  `a_left` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_top` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_zIndex` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_addressbook
-- ----------------------------
DROP TABLE IF EXISTS `oa_addressbook`;
CREATE TABLE `oa_addressbook` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_uid` int(11) NOT NULL,
  `a_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_pname` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_company` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `a_telephone` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_fax` varchar(20) COLLATE utf8_bin NOT NULL,
  `a_address` varchar(50) COLLATE utf8_bin NOT NULL,
  `a_qq` varchar(20) COLLATE utf8_bin NOT NULL,
  `a_email` varchar(30) COLLATE utf8_bin NOT NULL,
  `a_note` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_apply
-- ----------------------------
DROP TABLE IF EXISTS `oa_apply`;
CREATE TABLE `oa_apply` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_uid` int(11) NOT NULL,
  `a_mudi_uid` int(11) NOT NULL,
  `a_type` tinyint(4) NOT NULL,
  `a_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `a_is_approval` tinyint(4) NOT NULL,
  `a_is_look` tinyint(4) NOT NULL,
  `a_reply` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_chatroom
-- ----------------------------
DROP TABLE IF EXISTS `oa_chatroom`;
CREATE TABLE `oa_chatroom` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_user` varchar(30) COLLATE utf8_bin NOT NULL,
  `c_msg` text COLLATE utf8_bin NOT NULL,
  `c_time` int(11) NOT NULL,
  `c_expression` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_company
-- ----------------------------
DROP TABLE IF EXISTS `oa_company`;
CREATE TABLE `oa_company` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_cname` varchar(30) COLLATE utf8_bin NOT NULL,
  `c_cphone` varchar(50) COLLATE utf8_bin NOT NULL,
  `c_telephone` varchar(50) COLLATE utf8_bin NOT NULL,
  `c_email` varchar(40) COLLATE utf8_bin NOT NULL,
  `c_fax` varchar(20) COLLATE utf8_bin NOT NULL,
  `c_address` varchar(50) COLLATE utf8_bin NOT NULL,
  `c_city` varchar(20) COLLATE utf8_bin NOT NULL,
  `c_qq` varchar(20) COLLATE utf8_bin NOT NULL,
  `c_site_url` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_config
-- ----------------------------
DROP TABLE IF EXISTS `oa_config`;
CREATE TABLE `oa_config` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_switch` tinyint(4) NOT NULL,
  `c_is_loginTime` tinyint(4) NOT NULL,
  `c_logTime` varchar(30) COLLATE utf8_bin NOT NULL,
  `c_is_loginWarning` tinyint(4) NOT NULL,
  `c_warningNum` tinyint(4) NOT NULL,
  `c_is_log` tinyint(4) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_customer
-- ----------------------------
DROP TABLE IF EXISTS `oa_customer`;
CREATE TABLE `oa_customer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_uid` int(11) NOT NULL,
  `c_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `c_phone` varchar(30) COLLATE utf8_bin NOT NULL,
  `c_spots` tinyint(4) NOT NULL,
  `c_hots` tinyint(4) NOT NULL,
  `c_hots_info` varchar(60) COLLATE utf8_bin NOT NULL,
  `c_sex` tinyint(4) NOT NULL,
  `c_type` tinyint(4) NOT NULL,
  `c_phase` tinyint(4) NOT NULL,
  `c_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_customermore
-- ----------------------------
DROP TABLE IF EXISTS `oa_customermore`;
CREATE TABLE `oa_customermore` (
  `m_cid` int(11) NOT NULL,
  `m_telephone` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_email` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_fax` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_qq` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_zip` varchar(10) COLLATE utf8_bin NOT NULL,
  `m_address` varchar(50) COLLATE utf8_bin NOT NULL,
  `m_company` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_companyAddress` varchar(50) COLLATE utf8_bin NOT NULL,
  `m_business` varchar(20) COLLATE utf8_bin NOT NULL,
  `m_appellation` varchar(20) COLLATE utf8_bin NOT NULL,
  `m_position` varchar(20) COLLATE utf8_bin NOT NULL,
  `m_source` tinyint(4) NOT NULL,
  `m_credit` tinyint(4) NOT NULL,
  `m_relation` tinyint(4) NOT NULL,
  `m_jiazhi` tinyint(4) NOT NULL,
  `m_contact` tinyint(4) NOT NULL,
  `m_papers_type` tinyint(4) NOT NULL,
  `m_papers_num` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_note` varchar(100) COLLATE utf8_bin NOT NULL,
  `m_addtime` int(11) NOT NULL,
  PRIMARY KEY (`m_cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_department
-- ----------------------------
DROP TABLE IF EXISTS `oa_department`;
CREATE TABLE `oa_department` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `d_description` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_email
-- ----------------------------
DROP TABLE IF EXISTS `oa_email`;
CREATE TABLE `oa_email` (
  `em_id` int(11) NOT NULL AUTO_INCREMENT,
  `em_title` varchar(30) COLLATE utf8_bin NOT NULL,
  `em_content` text COLLATE utf8_bin NOT NULL,
  `em_filename` varchar(50) COLLATE utf8_bin NOT NULL,
  `em_fileUpload` varchar(50) COLLATE utf8_bin NOT NULL,
  `em_uid` int(11) NOT NULL,
  `em_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `em_sname` varchar(30) COLLATE utf8_bin NOT NULL,
  `em_source` varchar(30) COLLATE utf8_bin NOT NULL,
  `em_purpose` varchar(30) COLLATE utf8_bin NOT NULL,
  `em_status` tinyint(4) NOT NULL DEFAULT '0',
  `em_addtime` int(11) NOT NULL,
  `em_look_is` tinyint(4) NOT NULL DEFAULT '0',
  `em_type` tinyint(4) NOT NULL DEFAULT '0',
  `em_receive_is` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`em_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_emailconfig
-- ----------------------------
DROP TABLE IF EXISTS `oa_emailconfig`;
CREATE TABLE `oa_emailconfig` (
  `ec_id` int(11) NOT NULL AUTO_INCREMENT,
  `ec_uid` int(11) NOT NULL,
  `ec_type` varchar(20) COLLATE utf8_bin NOT NULL,
  `ec_smtpserver` varchar(30) COLLATE utf8_bin NOT NULL,
  `ec_smtppost` tinyint(4) NOT NULL,
  `ec_smtpuser` varchar(50) COLLATE utf8_bin NOT NULL,
  `ec_smtppass` varchar(50) COLLATE utf8_bin NOT NULL,
  `ec_sendtime` int(11) NOT NULL,
  PRIMARY KEY (`ec_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_employees
-- ----------------------------
DROP TABLE IF EXISTS `oa_employees`;
CREATE TABLE `oa_employees` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(20) COLLATE utf8_bin NOT NULL,
  `u_password` char(32) COLLATE utf8_bin NOT NULL,
  `u_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `u_phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `u_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `u_email_in` varchar(50) COLLATE utf8_bin NOT NULL,
  `u_sex` tinyint(4) NOT NULL,
  `u_age` tinyint(4) NOT NULL,
  `u_position` int(11) NOT NULL,
  `u_department` int(11) NOT NULL,
  `u_enable` tinyint(4) NOT NULL,
  `u_lasttime` int(11) NOT NULL,
  `u_status` tinyint(4) NOT NULL,
  `u_resume_url` varchar(50) COLLATE utf8_bin NOT NULL,
  `u_window` tinyint(4) NOT NULL,
  `u_head` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_filecabinet
-- ----------------------------
DROP TABLE IF EXISTS `oa_filecabinet`;
CREATE TABLE `oa_filecabinet` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_uid` int(11) NOT NULL,
  `f_path` varchar(50) COLLATE utf8_bin NOT NULL,
  `f_filename` varchar(30) COLLATE utf8_bin NOT NULL,
  `f_newname` varchar(50) COLLATE utf8_bin NOT NULL,
  `f_addtime` int(11) NOT NULL,
  `f_size` varchar(30) COLLATE utf8_bin NOT NULL,
  `f_type` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_goods
-- ----------------------------
DROP TABLE IF EXISTS `oa_goods`;
CREATE TABLE `oa_goods` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `g_jiage` float NOT NULL,
  `g_sum` int(11) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_goodsmanage
-- ----------------------------
DROP TABLE IF EXISTS `oa_goodsmanage`;
CREATE TABLE `oa_goodsmanage` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT,
  `gm_gid` int(11) NOT NULL,
  `gm_gname` varchar(30) COLLATE utf8_bin NOT NULL,
  `gm_uid` int(11) NOT NULL,
  `gm_uname` varchar(30) COLLATE utf8_bin NOT NULL,
  `gm_gtime` int(11) NOT NULL,
  `gm_gsum` int(11) NOT NULL,
  `gm_givename` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`gm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_iteminfo
-- ----------------------------
DROP TABLE IF EXISTS `oa_iteminfo`;
CREATE TABLE `oa_iteminfo` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_vid` int(11) NOT NULL,
  `i_title` varchar(30) COLLATE utf8_bin NOT NULL,
  `i_count` int(11) NOT NULL,
  `i_order` tinyint(4) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_jinji
-- ----------------------------
DROP TABLE IF EXISTS `oa_jinji`;
CREATE TABLE `oa_jinji` (
  `j_id` int(11) NOT NULL AUTO_INCREMENT,
  `j_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `j_content` varchar(200) COLLATE utf8_bin NOT NULL,
  `j_starttime` int(11) NOT NULL,
  PRIMARY KEY (`j_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_joblog
-- ----------------------------
DROP TABLE IF EXISTS `oa_joblog`;
CREATE TABLE `oa_joblog` (
  `j_id` int(11) NOT NULL AUTO_INCREMENT,
  `j_uid` int(11) NOT NULL,
  `j_date` int(11) NOT NULL,
  `j_content` text COLLATE utf8_bin NOT NULL,
  `j_result` varchar(50) COLLATE utf8_bin NOT NULL,
  `j_note` varchar(200) COLLATE utf8_bin NOT NULL,
  `j_boss_review` varchar(255) COLLATE utf8_bin NOT NULL,
  `j_rname` varchar(30) COLLATE utf8_bin NOT NULL,
  `j_look_review` tinyint(4) NOT NULL,
  PRIMARY KEY (`j_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_layout
-- ----------------------------
DROP TABLE IF EXISTS `oa_layout`;
CREATE TABLE `oa_layout` (
  `cl_id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_eid` int(11) NOT NULL,
  `cl_x` varchar(30) NOT NULL,
  `cl_y` varchar(30) NOT NULL,
  `cl_z` varchar(30) NOT NULL,
  `cl_title` varchar(30) NOT NULL,
  `cl_did` int(11) NOT NULL,
  PRIMARY KEY (`cl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for oa_log
-- ----------------------------
DROP TABLE IF EXISTS `oa_log`;
CREATE TABLE `oa_log` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_uid` int(11) NOT NULL,
  `l_time` int(11) NOT NULL,
  `l_content` varchar(50) COLLATE utf8_bin NOT NULL,
  `l_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_meeting
-- ----------------------------
DROP TABLE IF EXISTS `oa_meeting`;
CREATE TABLE `oa_meeting` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `m_starttime` int(11) NOT NULL,
  `m_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_yuyue_id` int(11) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_meetingnotice
-- ----------------------------
DROP TABLE IF EXISTS `oa_meetingnotice`;
CREATE TABLE `oa_meetingnotice` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_department` int(11) NOT NULL,
  `n_uid` int(11) NOT NULL,
  `n_mid` int(11) NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_meetingroom
-- ----------------------------
DROP TABLE IF EXISTS `oa_meetingroom`;
CREATE TABLE `oa_meetingroom` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `r_renshu` int(11) NOT NULL,
  `r_is_open` tinyint(4) NOT NULL,
  `r_is_appointment` tinyint(4) NOT NULL DEFAULT '0',
  `r_is_clean` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_memo
-- ----------------------------
DROP TABLE IF EXISTS `oa_memo`;
CREATE TABLE `oa_memo` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_uid` int(11) NOT NULL,
  `m_time` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_msg` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_message
-- ----------------------------
DROP TABLE IF EXISTS `oa_message`;
CREATE TABLE `oa_message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `m_addtime` int(11) NOT NULL,
  `m_sendname` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_sendUid` int(11) NOT NULL,
  `m_rename` varchar(30) COLLATE utf8_bin NOT NULL,
  `m_reUid` int(11) NOT NULL,
  `m_looks_is` tinyint(4) NOT NULL DEFAULT '0',
  `m_reply_is` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_notice
-- ----------------------------
DROP TABLE IF EXISTS `oa_notice`;
CREATE TABLE `oa_notice` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `n_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `n_addtime` int(11) NOT NULL,
  `n_rUid` int(11) NOT NULL,
  `n_target` tinyint(4) NOT NULL,
  `n_rname` varchar(30) COLLATE utf8_bin NOT NULL,
  `n_department` int(11) NOT NULL,
  `n_audit` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_online
-- ----------------------------
DROP TABLE IF EXISTS `oa_online`;
CREATE TABLE `oa_online` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_uid` int(11) NOT NULL,
  `o_time` int(11) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_permissions
-- ----------------------------
DROP TABLE IF EXISTS `oa_permissions`;
CREATE TABLE `oa_permissions` (
  `p_uid` int(11) NOT NULL,
  `p_column_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `p_column_id` tinyint(4) NOT NULL,
  `p_column_enable` tinyint(4) NOT NULL,
  `p_column_sonName` varchar(200) COLLATE utf8_bin NOT NULL,
  `p_column_son` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_position
-- ----------------------------
DROP TABLE IF EXISTS `oa_position`;
CREATE TABLE `oa_position` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_description` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_project
-- ----------------------------
DROP TABLE IF EXISTS `oa_project`;
CREATE TABLE `oa_project` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_starttime` int(11) NOT NULL,
  `p_endtime` int(11) NOT NULL,
  `p_employees` varchar(30) COLLATE utf8_bin NOT NULL,
  `p_manage` varchar(30) COLLATE utf8_bin NOT NULL,
  `p_audit` varchar(30) COLLATE utf8_bin NOT NULL,
  `p_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `p_progress` tinyint(4) NOT NULL,
  `p_document` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_is_over` tinyint(4) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_projectlog
-- ----------------------------
DROP TABLE IF EXISTS `oa_projectlog`;
CREATE TABLE `oa_projectlog` (
  `pl_id` int(11) NOT NULL AUTO_INCREMENT,
  `pl_pid` int(11) NOT NULL,
  `pl_time` int(11) NOT NULL,
  `pl_content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_quickbooks
-- ----------------------------
DROP TABLE IF EXISTS `oa_quickbooks`;
CREATE TABLE `oa_quickbooks` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `q_department` varchar(20) COLLATE utf8_bin NOT NULL,
  `q_position` varchar(20) COLLATE utf8_bin NOT NULL,
  `q_phone` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_schedule
-- ----------------------------
DROP TABLE IF EXISTS `oa_schedule`;
CREATE TABLE `oa_schedule` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_uid` int(11) NOT NULL,
  `s_day` varchar(20) COLLATE utf8_bin NOT NULL,
  `s_month` varchar(20) COLLATE utf8_bin NOT NULL,
  `s_content` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_section
-- ----------------------------
DROP TABLE IF EXISTS `oa_section`;
CREATE TABLE `oa_section` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_space
-- ----------------------------
DROP TABLE IF EXISTS `oa_space`;
CREATE TABLE `oa_space` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_uid` int(11) NOT NULL,
  `s_space` int(11) NOT NULL,
  `s_free_space` int(11) unsigned NOT NULL,
  `s_upload_is` tinyint(4) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_tasks
-- ----------------------------
DROP TABLE IF EXISTS `oa_tasks`;
CREATE TABLE `oa_tasks` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_uid` int(11) NOT NULL,
  `t_addtime` int(11) NOT NULL,
  `t_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `t_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `t_isOK` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_url
-- ----------------------------
DROP TABLE IF EXISTS `oa_url`;
CREATE TABLE `oa_url` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_uid` int(11) NOT NULL,
  `u_number` tinyint(4) NOT NULL,
  `u_url` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_voteinfo
-- ----------------------------
DROP TABLE IF EXISTS `oa_voteinfo`;
CREATE TABLE `oa_voteinfo` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `v_starttime` int(11) NOT NULL,
  `v_endtime` int(11) NOT NULL,
  `v_type` tinyint(4) NOT NULL,
  `v_display` tinyint(4) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_voteuser
-- ----------------------------
DROP TABLE IF EXISTS `oa_voteuser`;
CREATE TABLE `oa_voteuser` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_vid` int(11) NOT NULL,
  `u_uid` int(11) NOT NULL,
  `u_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `u_addtime` int(11) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for oa_yuyuemeeting
-- ----------------------------
DROP TABLE IF EXISTS `oa_yuyuemeeting`;
CREATE TABLE `oa_yuyuemeeting` (
  `y_id` int(11) NOT NULL AUTO_INCREMENT,
  `y_uid` int(11) NOT NULL,
  `y_uname` varchar(30) COLLATE utf8_bin NOT NULL,
  `y_yuyue_starttime` int(11) NOT NULL,
  `y_yuyue_endtime` int(11) NOT NULL,
  `y_room_id` int(11) NOT NULL,
  PRIMARY KEY (`y_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `oa_absolute` VALUES ('1', '1', '1', '-2', '-8', '2');
INSERT INTO `oa_absolute` VALUES ('2', '2', '1', '-3', '-21', '3');
INSERT INTO `oa_absolute` VALUES ('3', '3', '1', '2', '-1', '2');
INSERT INTO `oa_absolute` VALUES ('4', '4', '1', '', '', '');
INSERT INTO `oa_absolute` VALUES ('5', '5', '1', '', '', '');
INSERT INTO `oa_absolute` VALUES ('6', '6', '1', '', '', '');
INSERT INTO `oa_absolute` VALUES ('7', '1', '2', '', '', '');
INSERT INTO `oa_absolute` VALUES ('8', '2', '2', '', '', '');
INSERT INTO `oa_absolute` VALUES ('9', '3', '2', '', '', '');
INSERT INTO `oa_absolute` VALUES ('10', '4', '2', '', '', '');
INSERT INTO `oa_absolute` VALUES ('11', '5', '2', '', '', '');
INSERT INTO `oa_absolute` VALUES ('12', '6', '2', '', '', '');
INSERT INTO `oa_addressbook` VALUES ('1', '1', '张玉望', 'zhangyuwang', '中南海', '13888888888', '010-89738888', '010-89738888', '沙河', '85681649', '85681649@qq.com', '这是备注');
INSERT INTO `oa_apply` VALUES ('1', '1', '2', '1', '1111', '0', '0', '');
INSERT INTO `oa_apply` VALUES ('2', '1', '2', '2', '11111111111111', '0', '0', '');
INSERT INTO `oa_apply` VALUES ('3', '1', '2', '2', '', '0', '0', '');
INSERT INTO `oa_apply` VALUES ('4', '1', '2', '1', '', '0', '0', '');
INSERT INTO `oa_apply` VALUES ('5', '5', '1', '1', '这是申请内容', '1', '1', '陈功');
INSERT INTO `oa_chatroom` VALUES ('1', '总经理', 0x31313131313131313131, '1484545316', '');
INSERT INTO `oa_chatroom` VALUES ('2', '222222222', 0x3232323232323232323232, '1484545319', '');
INSERT INTO `oa_company` VALUES ('1', '图森', '138888888888', '0101111111', '85681749@qq.com', '1111111', '沙河', '北京1', '', '');
INSERT INTO `oa_config` VALUES ('1', '1', '0', '22:00-8:00', '0', '3', '0');
INSERT INTO `oa_customer` VALUES ('1', '1', '张玉望', '13811111111', '1', '2', '热点说明', '1', '2', '1', '2');
INSERT INTO `oa_customer` VALUES ('2', '5', '张玉望', '13811111111', '1', '2', '热点说明', '1', '2', '1', '2');
INSERT INTO `oa_customermore` VALUES ('1', '010-895432443', '85681649@qq.com', '010-895432443', '85681649', '1000000', '昌平沙河', '图森', '铁建广场', '做网站', '习总', '国家主席', '1', '2', '2', '2', '2', '1', '11111111111111111111111', '', '1484554135');
INSERT INTO `oa_customermore` VALUES ('2', '010-895432443', '85681649@qq.com', '010-895432443', '85681649', '1000000', '昌平沙河', '图森', '铁建广场', '做网站', '习总', '国家主席', '1', '2', '2', '2', '2', '1', '11111111111111111111111', '', '1484554135');
INSERT INTO `oa_department` VALUES ('1', '管理层', '管理层描述');
INSERT INTO `oa_department` VALUES ('2', '技术部', '');
INSERT INTO `oa_department` VALUES ('3', '', '');
INSERT INTO `oa_department` VALUES ('4', '12222222', '');
INSERT INTO `oa_department` VALUES ('5', '生活部', '');
INSERT INTO `oa_email` VALUES ('2', '这是邮件标题', 0xE8BF99E698AFE982AEE4BBB6E58685E5AEB9, '', '', '1', '总经理', '张玉望', '这是源地址', 'zhangyuwang@qq.com', '1', '1484537773', '0', '0', '1');
INSERT INTO `oa_email` VALUES ('3', '这是邮件标题', '', '新建文本文档 (2).txt', '587c41696bd30.txt', '1', '总经理', '张玉望', '这是源地址', 'zhangyuwang@qq.com', '1', '1484538217', '0', '0', '1');
INSERT INTO `oa_email` VALUES ('4', '这是邮件标题', 0xE8BF99E698AFE982AEE4BBB6E58685E5AEB9, '', '', '5', '总经理', '张玉望', '这是源地址', 'zhangyuwang@qq.com', '1', '1484537773', '0', '1', '0');
INSERT INTO `oa_email` VALUES ('5', '这是邮件标题', '', '新建文本文档 (2).txt', '587c41696bd30.txt', '5', '总经理', '张玉望', '这是源地址', 'zhangyuwang@qq.com', '1', '1484538217', '0', '1', '0');
INSERT INTO `oa_email` VALUES ('6', '这是有邮件标题', 0xE8BF99E698AFE982AEE4BBB6E58685E5AEB9, '新建文本文档 (2).txt', '587c5f7859102.txt', '5', '张玉望', '总经理', 'zhangyuwang@qq.com', 'admin@oa.com', '1', '1484545912', '0', '0', '1');
INSERT INTO `oa_email` VALUES ('7', '这是有邮件标题', 0xE8BF99E698AFE982AEE4BBB6E58685E5AEB9, '新建文本文档 (2).txt', '587c5f7859102.txt', '1', '张玉望', '总经理', 'zhangyuwang@qq.com', 'admin@oa.com', '1', '1484545912', '1', '1', '0');
INSERT INTO `oa_employees` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '总经理', '15193884510', '1124470898@qq.com', 'admin@oa.com', '1', '26', '1', '1', '1', '1375343939', '0', '587c7ccd0cb36.docx', '0', '');
INSERT INTO `oa_employees` VALUES ('5', 'zhangyuwang', 'e10adc3949ba59abbe56e057f20f883e', '张玉望', '13888888888', '85681649@qq.com', 'zhangyuwang@qq.com', '1', '22', '3', '2', '1', '0', '0', '', '0', '');
INSERT INTO `oa_joblog` VALUES ('1', '1', '1484547064', 0xE8BF99E698AFE5B7A5E4BD9CE697A5E5BF97, '进行中', '这是日志备注', '', '', '0');
INSERT INTO `oa_joblog` VALUES ('2', '5', '1484551019', 0xE8BF99E698AFE5B7A5E4BD9CE697A5E5BF97, '进行中', '这是日志备注', '这是评价', '总经理', '1');
INSERT INTO `oa_layout` VALUES ('1', '1', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('2', '1', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('3', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('4', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('5', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('6', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('7', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('8', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('9', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('10', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('11', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('12', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('13', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('14', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('15', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('16', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('17', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('18', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('19', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('20', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('21', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('22', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('23', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('24', '2', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('25', '3', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('26', '3', '', '', '', '', '0');
INSERT INTO `oa_layout` VALUES ('27', '3', '', '', '', '', '0');
INSERT INTO `oa_meetingroom` VALUES ('1', '第一会议室', '200', '1', '0', '1');
INSERT INTO `oa_meetingroom` VALUES ('2', '第二会议室', '200', '0', '0', '1');
INSERT INTO `oa_meetingroom` VALUES ('3', '第三会议室', '200', '1', '0', '1');
INSERT INTO `oa_meetingroom` VALUES ('4', '第四会议室', '220', '1', '0', '1');
INSERT INTO `oa_memo` VALUES ('1', '1', '2017-01-16', '。。。。');
INSERT INTO `oa_memo` VALUES ('2', '1', '2017-01-16', '过年好');
INSERT INTO `oa_message` VALUES ('1', '这是总经理发给张玉望的', '1484539504', '总经理', '1', '张玉望', '5', '1', '0');
INSERT INTO `oa_message` VALUES ('2', '这是张玉望发给总经理的', '1484539728', '张玉望', '5', '总经理', '1', '1', '1');
INSERT INTO `oa_message` VALUES ('3', '这是张玉望发给总经理测试的', '1484539742', '张玉望', '5', '总经理', '1', '1', '0');
INSERT INTO `oa_message` VALUES ('6', '1111111111111', '1484539790', '总经理', '1', '张玉望', '5', '0', '0');
INSERT INTO `oa_message` VALUES ('7', '1111111', '1484549403', '总经理', '1', '张玉望', '0', '0', '0');
INSERT INTO `oa_notice` VALUES ('1', '这是公告标题 ', '这是公告内容', '1484543621', '1', '1', '总经理', '1', '0');
INSERT INTO `oa_notice` VALUES ('2', '这是公告标题', '这是公告内容', '1484543650', '1', '2', '总经理', '1', '0');
INSERT INTO `oa_notice` VALUES ('3', '这是公告标题', '这是对部门所有员工', '1484549688', '1', '1', '总经理', '1', '0');
INSERT INTO `oa_notice` VALUES ('4', '这是公告标题', '这是对公司所有员工 ', '1484549706', '1', '2', '总经理', '1', '0');
INSERT INTO `oa_notice` VALUES ('5', '这是公共标题', '对部门所有员工', '1484549819', '5', '1', '张玉望', '2', '0');
INSERT INTO `oa_notice` VALUES ('6', '这是公告标题', '这是对公司所有员工', '1484549832', '5', '2', '张玉望', '2', '0');
INSERT INTO `oa_online` VALUES ('1', '1', '1484562574');
INSERT INTO `oa_online` VALUES ('2', '2', '0');
INSERT INTO `oa_online` VALUES ('3', '3', '1484530419');
INSERT INTO `oa_online` VALUES ('4', '4', '1484536927');
INSERT INTO `oa_online` VALUES ('5', '5', '1484552375');
INSERT INTO `oa_permissions` VALUES ('1', '我的办公桌', '1', '1', '电子邮件|短信息|公告通知|请假/外出申请|日程安排|找工作日志|通讯簿', '1,1,1,1,1,1,1');
INSERT INTO `oa_permissions` VALUES ('1', '会议管理', '2', '1', '会议安排|会议管理|会议室预约|会议室添加|会议室管理', '1,1,1,1,1');
INSERT INTO `oa_permissions` VALUES ('1', '员工管理', '3', '1', '上传个人简历|管理员工|任务分派|任务管理|紧急通告发布', '1,1,1,1,1');
INSERT INTO `oa_permissions` VALUES ('1', '客户管理', '4', '1', '新建客户|管理客户|共享客户', '1,1,1');
INSERT INTO `oa_permissions` VALUES ('1', '系统设置', '6', '1', '公司结构|用户管理|权限管理', '1,1,1');
INSERT INTO `oa_permissions` VALUES ('1', '项目管理', '5', '1', '新建项目|管理项目', '1,1');
INSERT INTO `oa_permissions` VALUES ('5', '我的办公桌', '1', '1', '电子邮件|短信息|公告通知|请假/外出申请|日程安排|找工作日志|通讯簿|控制面板', '1,1,1,1,1,1,1,1');
INSERT INTO `oa_permissions` VALUES ('5', '会议管理', '2', '1', '会议安排|会议管理|会议室预约|会议室添加|会议室管理', '1,1,1,1,1');
INSERT INTO `oa_permissions` VALUES ('5', '员工管理', '3', '1', '上传个人简历|管理员工|任务分派|任务管理|紧急通告发布', '1,1,1,1,1');
INSERT INTO `oa_permissions` VALUES ('5', '客户管理', '4', '1', '新建客户|管理客户|共享客户', '1,1,1');
INSERT INTO `oa_permissions` VALUES ('5', '项目管理', '5', '1', '新建项目|管理项目', '1,1,1');
INSERT INTO `oa_permissions` VALUES ('5', '系统设置', '6', '1', '公司结构|用户管理|权限管理', '1,1');
INSERT INTO `oa_position` VALUES ('1', '总经理', '总经理描述');
INSERT INTO `oa_position` VALUES ('2', '财务部', '');
INSERT INTO `oa_position` VALUES ('3', '技术部经理', '');
INSERT INTO `oa_position` VALUES ('4', '前台接待', '');
INSERT INTO `oa_project` VALUES ('1', '这是项目名称', '1483372800', '1485273600', '5|1', '1|总经理', '1|总经理', '这是项目内容1', '0', '', '0');
INSERT INTO `oa_project` VALUES ('2', '这是项目名称', '1483977600', '1484582400', '5|1', '1|总经理', '5|张玉望', '', '0', '', '0');
INSERT INTO `oa_projectlog` VALUES ('1', '0', '1484555875', 0xE8BF99E698AFE9A1B9E79BAEE697A5E5BF97E58685E5AEB9);
INSERT INTO `oa_projectlog` VALUES ('2', '0', '1484555911', 0xE8BF99E698AFE9A1B9E79BAEE697A5E5BF97);
INSERT INTO `oa_projectlog` VALUES ('3', '0', '1484556165', 0xE8BF99E698AFE9A1B9E79BAEE697A5E5BF97);
INSERT INTO `oa_projectlog` VALUES ('4', '1', '1484556502', 0xE8BF99E698AFE697A5E5BF97E58685E5AEB93131);
INSERT INTO `oa_quickbooks` VALUES ('1', '总经理', '管理层', '总经理', '15193884510');
INSERT INTO `oa_schedule` VALUES ('1', '1', '2', '01', '');
INSERT INTO `oa_section` VALUES ('1', '公告通知');
INSERT INTO `oa_section` VALUES ('2', '公共交流');
INSERT INTO `oa_section` VALUES ('3', '备忘录');
INSERT INTO `oa_section` VALUES ('4', '投票');
INSERT INTO `oa_section` VALUES ('6', '网站地图');
INSERT INTO `oa_section` VALUES ('5', '话题交流');
INSERT INTO `oa_space` VALUES ('1', '2', '20000', '20000', '1');
INSERT INTO `oa_space` VALUES ('2', '3', '20000', '20000', '1');
INSERT INTO `oa_space` VALUES ('4', '5', '20000', '20000', '1');
INSERT INTO `oa_tasks` VALUES ('1', '0', '1484553745', '总经理', '', '1');
INSERT INTO `oa_url` VALUES ('1', '2', '1', '');
INSERT INTO `oa_url` VALUES ('2', '2', '2', '');
INSERT INTO `oa_url` VALUES ('3', '2', '3', '');
INSERT INTO `oa_url` VALUES ('4', '2', '4', '');
INSERT INTO `oa_url` VALUES ('5', '2', '5', '');
INSERT INTO `oa_url` VALUES ('6', '2', '6', '');
INSERT INTO `oa_url` VALUES ('7', '2', '7', '');
INSERT INTO `oa_url` VALUES ('8', '3', '1', '');
INSERT INTO `oa_url` VALUES ('9', '3', '2', '');
INSERT INTO `oa_url` VALUES ('10', '3', '3', '');
INSERT INTO `oa_url` VALUES ('11', '3', '4', '');
INSERT INTO `oa_url` VALUES ('12', '3', '5', '');
INSERT INTO `oa_url` VALUES ('13', '3', '6', '');
INSERT INTO `oa_url` VALUES ('14', '3', '7', '');
INSERT INTO `oa_url` VALUES ('15', '4', '1', '');
INSERT INTO `oa_url` VALUES ('16', '4', '2', '');
INSERT INTO `oa_url` VALUES ('17', '4', '3', '');
INSERT INTO `oa_url` VALUES ('18', '4', '4', '');
INSERT INTO `oa_url` VALUES ('19', '4', '5', '');
INSERT INTO `oa_url` VALUES ('20', '4', '6', '');
INSERT INTO `oa_url` VALUES ('21', '4', '7', '');
INSERT INTO `oa_url` VALUES ('22', '5', '1', '');
INSERT INTO `oa_url` VALUES ('23', '5', '2', '');
INSERT INTO `oa_url` VALUES ('24', '5', '3', '');
INSERT INTO `oa_url` VALUES ('25', '5', '4', '');
INSERT INTO `oa_url` VALUES ('26', '5', '5', '');
INSERT INTO `oa_url` VALUES ('27', '5', '6', '');
INSERT INTO `oa_url` VALUES ('28', '5', '7', '');
INSERT INTO `oa_yuyuemeeting` VALUES ('4', '1', '总经理', '1484582460', '1484841660', '4');
INSERT INTO `oa_yuyuemeeting` VALUES ('3', '1', '总经理', '1483200060', '1483200060', '0');
