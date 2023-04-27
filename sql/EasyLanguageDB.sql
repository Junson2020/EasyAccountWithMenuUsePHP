--
-- ��Ʈw�G `junson_user`
--

-- --------------------------------------------------------

--
-- ��ƪ��c `groupitem`
--

CREATE TABLE `groupitem` (
  `gname` varchar(30) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `power` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `groupitem`
--

INSERT INTO `groupitem` (`gname`, `descr`, `power`) VALUES
('admin', 'Administrator', '88888'),
('operator', 'Operator', '55555'),
('root', 'root', '99999'),
('SuperUser', 'SuperUser', '77777'),
('viewer', 'Viewer', '11111');

-- --------------------------------------------------------

--
-- ��ƪ��c `grouplevel`
--

CREATE TABLE `grouplevel` (
  `u_group` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `grouplevel`
--

INSERT INTO `grouplevel` (`u_group`, `lname`) VALUES
('admin', 'GroupList'),
('admin', 'GroupSave'),
('admin', 'LangList'),
('admin', 'LangSave'),
('admin', 'LevelList'),
('admin', 'LevelSave'),
('admin', 'UserDEL'),
('admin', 'UserEdit'),
('admin', 'UserLevel'),
('admin', 'UserList'),
('root', 'GroupList'),
('root', 'GroupSave'),
('root', 'LangList'),
('root', 'LangSave'),
('root', 'LevelList'),
('root', 'LevelSave'),
('root', 'UserDEL'),
('root', 'UserEdit'),
('root', 'UserLevel'),
('root', 'UserList');

-- --------------------------------------------------------

--
-- ��ƪ��c `langitem`
--

CREATE TABLE `langitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `langitem`
--

INSERT INTO `langitem` (`lname`, `descr`, `stopyn`) VALUES
('en', 'English', 'N'),
('zhtw', 'Chinese for Taiwan', 'N');

-- --------------------------------------------------------

--
-- ��ƪ��c `langword`
--

CREATE TABLE `langword` (
  `lang` varchar(20) NOT NULL,
  `wording` varchar(150) NOT NULL,
  `trans` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `langword`
--

INSERT INTO `langword` (`lang`, `wording`, `trans`) VALUES
('zhtw', 'Account', '�b��'),
('zhtw', 'Account Deleted', 'Account Deleted(�b���w�R��)'),
('zhtw', 'Account Edit', '�b���s��'),
('zhtw', 'Action', '�ʧ@'),
('zhtw', 'Add', '�s�W'),
('zhtw', 'Ajax request Fail~', 'Ajax���~~'),
('zhtw', 'CAPTCHA', '���ҽX'),
('zhtw', 'Cell', '��ʹq��'),
('zhtw', 'DB Connect Error:', '��Ʈw�s�����~:'),
('zhtw', 'DeleteAccount', '�R���b��'),
('zhtw', 'DeleteGroup', '�R���s��'),
('zhtw', 'DeleteLanguage', '�R���y��'),
('zhtw', 'DeleteLevel', '�R���v��'),
('zhtw', 'Description', '�y�z'),
('zhtw', 'Email', '�q�l�l��H�c'),
('zhtw', 'Empty Message~', '�ťհT��~'),
('zhtw', 'Encode', '�s�X���r'),
('zhtw', 'Encode Text', '�s�X��J����r'),
('zhtw', 'ERROR: Function Error~', '���~: �\����~~'),
('zhtw', 'ERROR: Item Empty ~', '���~: ���تť� ~'),
('zhtw', 'Error: Level Deny', '���~: �L�v��'),
('zhtw', 'ERROR: Parameter Empty ~', '���~: �Ѽƪť� ~'),
('zhtw', 'ERROR: Parameter Fail ~', '���~: �ѼƤ����T ~'),
('zhtw', 'ERROR: SQL:', '��Ʈw�d�߿��~:'),
('zhtw', 'GO', '����'),
('zhtw', 'Group', '�s��'),
('zhtw', 'Group Deleted', '�w�R���s��'),
('zhtw', 'Group Edit', '�s�սs��'),
('zhtw', 'Group Level Edit', '�s���v���s��'),
('zhtw', 'Group List', '�s�զC��'),
('zhtw', 'Group Name', '�s�զW��'),
('zhtw', 'GroupName', '�s�զW��'),
('zhtw', 'Home', '����'),
('zhtw', 'Item', '����'),
('zhtw', 'Keyword', '��J��r'),
('zhtw', 'Language', '�y��'),
('zhtw', 'Language Deleted', '�y���w�R��'),
('zhtw', 'Language Edit', '�y���s��'),
('zhtw', 'Language List', '�y���C��'),
('zhtw', 'Language Name', '�y���W��'),
('zhtw', 'LanguageName', '�y���W��'),
('zhtw', 'Level', '�v��'),
('zhtw', 'Level Deleted', '�v���w�R��'),
('zhtw', 'Level Edit', '�v���s��'),
('zhtw', 'Level List', '�v���C��'),
('zhtw', 'Level Name', '�v���W��'),
('zhtw', 'LevelName', '�v���W��'),
('zhtw', 'License Timeout', '�v���L��'),
('zhtw', 'Login', '�n�J'),
('zhtw', 'Login Information', '�n�J��T'),
('zhtw', 'LOGIN OK', '���T�n�J'),
('zhtw', 'Logout', '�n�X'),
('zhtw', 'Logout OK~', '�w�n�X'),
('zhtw', 'Mapping Group Level', '�t�m�ӧO�s���v��'),
('zhtw', 'Mapping User Level', '�t�m�ӧO�b���v��'),
('zhtw', 'Modify', '�s��'),
('zhtw', 'New Account', '�s�W�b��'),
('zhtw', 'New Group', '�s�W�s��'),
('zhtw', 'New Language', '�s�W�y��'),
('zhtw', 'New Level', '�s�W�v��'),
('zhtw', 'Not Modify ~ Delete Not Permit~', '�S�ק�~ �S�v���R��~'),
('zhtw', 'Not Modify ~ Function Error~', '�S�ק�~ �\����~~'),
('zhtw', 'Not Modify ~ Group Level Duplicate Error~', '�S�ק�~�s���v������~'),
('zhtw', 'Not Modify ~ Level Deny Error~', '�S�ק�~�v������~'),
('zhtw', 'Not Modify ~ Modify Not Permit~', '�S�ק�~ �S�v���ק�~'),
('zhtw', 'Not Modify ~ Parameter Empty~', '�S�ק�~ �Ѽƪť�~'),
('zhtw', 'Not Modify ~ Password Empty~', '�S�ק�~ �K�X�ť�~'),
('zhtw', 'Not Modify ~ Password Verify Not Match~', '�S�ק�~ �K�X���Ҥ����T~'),
('zhtw', 'Not Modify ~ Power is Number form 11111 to 88888 ~', '�S�ק�~�[�v���ƽп�J�Ʀr11111~88888~'),
('zhtw', 'OK', '����'),
('zhtw', 'Others', '��L'),
('zhtw', 'Password', '�K�X'),
('zhtw', 'Password not Match~', '�K�X���~~'),
('zhtw', 'Password Verify', '�K�X����'),
('zhtw', 'Please Setup DB Name', '�г]�w��Ʈw�W��'),
('zhtw', 'Power', '�[�v����'),
('zhtw', 'Select Group To Setup Level', '��ܤ@�Ӹs�ըӳ]�w�v��'),
('zhtw', 'Select User To Setup Level', '��ܱ��]�w�v�����b��'),
('zhtw', 'Selectable items', '�i��ܶ���'),
('zhtw', 'Selection items', '�w��ܶ���'),
('zhtw', 'Stop', '����'),
('zhtw', 'TextEnCode', '��r�s�X'),
('zhtw', 'User Level Edit', '�b���v���s��'),
('zhtw', 'User List', '�b���C��'),
('zhtw', 'Username', '�W�r'),
('zhtw', 'Value', '���'),
('zhtw', 'Verification Code not Match~', '���ҽX���~~'),
('zhtw', 'Watched', '�i��'),
('zhtw', 'Will Delete This Account', '�N�R�����b��'),
('zhtw', 'Will Delete This Group', '�N�R�����s��'),
('zhtw', 'Will Delete This Language', '�N�R�����y��'),
('zhtw', 'Will Delete This Level', '�N�R�����v��');

-- --------------------------------------------------------

--
-- ��ƪ��c `levelitem`
--

CREATE TABLE `levelitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `levelitem`
--

INSERT INTO `levelitem` (`lname`, `descr`, `stopyn`) VALUES
('GroupList', 'GroupList', 'N'),
('GroupSave', 'GroupSave', 'N'),
('LangList', 'Language List', 'N'),
('LangSave', 'Language Save', 'N'),
('LevelList', 'LevelList', 'N'),
('LevelSave', 'LevelSave', 'N'),
('UserDEL', 'Delete User', 'N'),
('UserEdit', 'UserEdit', 'N'),
('UserLevel', 'UserLevel', 'N'),
('UserList', 'UserList', 'N');

-- --------------------------------------------------------

--
-- ��ƪ��c `logdata`
--

CREATE TABLE `logdata` (
  `logid` bigint(20) NOT NULL,
  `logtext` text NOT NULL,
  `logtime` varchar(20) NOT NULL,
  `logfrom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `randkey`
--

CREATE TABLE `randkey` (
  `randsn` varchar(128) NOT NULL,
  `keyitem` varchar(100) NOT NULL,
  `addtime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `randpswd`
--

CREATE TABLE `randpswd` (
  `licensenumber` varchar(128) NOT NULL,
  `pswd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `userinfo`
--

CREATE TABLE `userinfo` (
  `u_account` varchar(30) NOT NULL,
  `u_pswd` varchar(30) DEFAULT NULL,
  `u_name` varchar(100) DEFAULT NULL,
  `u_cell` varchar(30) DEFAULT NULL,
  `u_group` varchar(30) DEFAULT NULL,
  `u_email` varchar(50) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL,
  `u_fixtime` varchar(30) DEFAULT NULL,
  `u_lastfix` varchar(30) DEFAULT NULL,
  `u_language` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `userinfo`
--

INSERT INTO `userinfo` (`u_account`, `u_pswd`, `u_name`, `u_cell`, `u_group`, `u_email`, `stopyn`, `u_fixtime`, `u_lastfix`, `u_language`) VALUES
('junson', 'junson2020', 'test', '0000000', 'root', '', 'N', NULL, NULL, 'zhtw');

-- --------------------------------------------------------

--
-- ��ƪ��c `userlevel`
--

CREATE TABLE `userlevel` (
  `u_account` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `userlicenseall`
--

CREATE TABLE `userlicenseall` (
  `ulid` bigint(20) NOT NULL,
  `u_account` varchar(30) DEFAULT NULL,
  `u_name` varchar(50) DEFAULT NULL,
  `licensenumber` varchar(100) DEFAULT NULL,
  `endtime` varchar(30) DEFAULT NULL,
  `u_group` varchar(255) DEFAULT NULL,
  `u_language` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �w�ɦL��ƪ�����
--

--
-- ��ƪ���� `groupitem`
--
ALTER TABLE `groupitem`
  ADD PRIMARY KEY (`gname`);

--
-- ��ƪ���� `grouplevel`
--
ALTER TABLE `grouplevel`
  ADD PRIMARY KEY (`u_group`,`lname`);

--
-- ��ƪ���� `langitem`
--
ALTER TABLE `langitem`
  ADD PRIMARY KEY (`lname`);

--
-- ��ƪ���� `langword`
--
ALTER TABLE `langword`
  ADD PRIMARY KEY (`lang`,`wording`) USING BTREE;

--
-- ��ƪ���� `levelitem`
--
ALTER TABLE `levelitem`
  ADD PRIMARY KEY (`lname`);

--
-- ��ƪ���� `logdata`
--
ALTER TABLE `logdata`
  ADD PRIMARY KEY (`logid`);

--
-- ��ƪ���� `randkey`
--
ALTER TABLE `randkey`
  ADD PRIMARY KEY (`randsn`);

--
-- ��ƪ���� `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`u_account`);

--
-- ��ƪ���� `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`u_account`,`lname`);

--
-- ��ƪ���� `userlicenseall`
--
ALTER TABLE `userlicenseall`
  ADD PRIMARY KEY (`ulid`);

--
-- �b�ɦL����ƪ�ϥΦ۰ʻ��W(AUTO_INCREMENT)
--

--
-- �ϥθ�ƪ�۰ʻ��W(AUTO_INCREMENT) `logdata`
--
ALTER TABLE `logdata`
  MODIFY `logid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- �ϥθ�ƪ�۰ʻ��W(AUTO_INCREMENT) `userlicenseall`
--
ALTER TABLE `userlicenseall`
  MODIFY `ulid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;