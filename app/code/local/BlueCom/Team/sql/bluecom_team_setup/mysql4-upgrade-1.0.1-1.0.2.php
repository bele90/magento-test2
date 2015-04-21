<?php
$installer = $this;
$installer->startSetup();

try{
    $installer->run("
DROP TABLE IF EXISTS {$this->getTable('bluecom_team/department')};
CREATE TABLE {$this->getTable('bluecom_team/department')} (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL
    PRIMARY KEY ( `id` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(1, 'Demandware');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(2, 'Hybris');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(3, 'Magento');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(4, 'Magento Guru');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(5, 'Management Board');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(6, 'HR');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(7, 'Accountant');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(8, 'Reception');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(9, 'Project Manager');
INSERT INTO {$this->getTable('bluecom_team/department')} VALUES(11, 'Internship');

DROP TABLE IF EXISTS {$this->getTable('bluecom_team/member')};
CREATE TABLE {$this->getTable('bluecom_team/member')} (
    `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cellphone` varchar(20) NOT NULL,
  `skype` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `youtube` varchar(200) NOT NULL,
  `yahoo` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `joineddate` date NOT NULL,
  `taxid` varchar(10) NOT NULL,
  `personalid` varchar(12) NOT NULL,
  `address` varchar(200) NOT NULL,
  `homephone` varchar(15) NOT NULL,
  `material_status` tinyint(4) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `avatar` varchar(200) NOT NULL
    PRIMARY KEY ( `id` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


INSERT INTO {$this->getTable('bluecom_team/member')} VALUES(4, 'Viet', 'Nguyen', 'viet.nguyen@bluecomgroup.com', '0982.82.82.82', 'viet.nguyen', 'viet.nguyen', 'viet.nguyen', 'viet.nguyen', 'viet.nguyen', '2015-04-15', '2015-04-23', '', '', '', '', 0, 1, 1, '');
INSERT INTO {$this->getTable('bluecom_team/member')} VALUES(6, 'Chau', 'Nguyen', 'chau.nguyen@bluecomgroup.com', '0909.778.561', 'chau.nguyen_skype', 'https://www.facebook.com/chau.nguyen', 'https://www.youtube.com/chau.nguyen', 'chau.nguyen_yaoo', 'https://linkedin.com/chau.nguyen', '2015-11-10', '2015-11-15', '125566322', '2714644526', '36 Nguyen Chanh Sat, F13, Tan Binh, HCM', '', 3, 0, 2, '');
INSERT INTO {$this->getTable('bluecom_team/member')} VALUES(7, 'Ngoc', 'Truong', 'ngoc.truong@bluecomgroup.com', '5563322555', 'skype id', 'facebook id', 'youtube id', 'yahoo id', 'linkedin id', '2015-04-06', '2015-04-22', '125566322', '2714644526', '', '', 2, 1, 1, '');


DROP TABLE IF EXISTS {$this->getTable('bluecom_team/memdept')};
CREATE TABLE {$this->getTable('bluecom_team/memdept')} (
   `member_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(4, 2);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(4, 11);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(4, 3);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(4, 4);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(4, 5);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(6, 7);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(6, 11);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(7, 3);
INSERT INTO {$this->getTable('bluecom_team/memdept')} VALUES(7, 4);
");
}catch(Exception $e){}

$installer->endSetup();
