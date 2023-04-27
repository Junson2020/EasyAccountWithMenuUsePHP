--
-- 資料庫： `junson_user`
--

-- --------------------------------------------------------

--
-- 資料表結構 `groupitem`
--

CREATE TABLE `groupitem` (
  `gname` varchar(30) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `power` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `groupitem`
--

INSERT INTO `groupitem` (`gname`, `descr`, `power`) VALUES
('admin', 'Administrator', '88888'),
('operator', 'Operator', '55555'),
('root', 'root', '99999'),
('SuperUser', 'SuperUser', '77777'),
('viewer', 'Viewer', '11111');

-- --------------------------------------------------------

--
-- 資料表結構 `grouplevel`
--

CREATE TABLE `grouplevel` (
  `u_group` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `grouplevel`
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
-- 資料表結構 `langitem`
--

CREATE TABLE `langitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `langitem`
--

INSERT INTO `langitem` (`lname`, `descr`, `stopyn`) VALUES
('en', 'English', 'N'),
('zhtw', 'Chinese for Taiwan', 'N');

-- --------------------------------------------------------

--
-- 資料表結構 `langword`
--

CREATE TABLE `langword` (
  `lang` varchar(20) NOT NULL,
  `wording` varchar(150) NOT NULL,
  `trans` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `langword`
--

INSERT INTO `langword` (`lang`, `wording`, `trans`) VALUES
('zhtw', 'Account', '帳號'),
('zhtw', 'Account Deleted', 'Account Deleted(帳號已刪除)'),
('zhtw', 'Account Edit', '帳號編輯'),
('zhtw', 'Action', '動作'),
('zhtw', 'Add', '新增'),
('zhtw', 'Ajax request Fail~', 'Ajax錯誤~'),
('zhtw', 'CAPTCHA', '驗證碼'),
('zhtw', 'Cell', '行動電話'),
('zhtw', 'DB Connect Error:', '資料庫連結錯誤:'),
('zhtw', 'DeleteAccount', '刪除帳號'),
('zhtw', 'DeleteGroup', '刪除群組'),
('zhtw', 'DeleteLanguage', '刪除語言'),
('zhtw', 'DeleteLevel', '刪除權限'),
('zhtw', 'Description', '描述'),
('zhtw', 'Email', '電子郵件信箱'),
('zhtw', 'Empty Message~', '空白訊息~'),
('zhtw', 'Encode', '編碼後文字'),
('zhtw', 'Encode Text', '編碼輸入的文字'),
('zhtw', 'ERROR: Function Error~', '錯誤: 功能錯誤~'),
('zhtw', 'ERROR: Item Empty ~', '錯誤: 項目空白 ~'),
('zhtw', 'Error: Level Deny', '錯誤: 無權限'),
('zhtw', 'ERROR: Parameter Empty ~', '錯誤: 參數空白 ~'),
('zhtw', 'ERROR: Parameter Fail ~', '錯誤: 參數不正確 ~'),
('zhtw', 'ERROR: SQL:', '資料庫查詢錯誤:'),
('zhtw', 'GO', '執行'),
('zhtw', 'Group', '群組'),
('zhtw', 'Group Deleted', '已刪除群組'),
('zhtw', 'Group Edit', '群組編輯'),
('zhtw', 'Group Level Edit', '群組權限編輯'),
('zhtw', 'Group List', '群組列表'),
('zhtw', 'Group Name', '群組名稱'),
('zhtw', 'GroupName', '群組名稱'),
('zhtw', 'Home', '首頁'),
('zhtw', 'Item', '項目'),
('zhtw', 'Keyword', '輸入文字'),
('zhtw', 'Language', '語言'),
('zhtw', 'Language Deleted', '語言已刪除'),
('zhtw', 'Language Edit', '語言編輯'),
('zhtw', 'Language List', '語言列表'),
('zhtw', 'Language Name', '語言名稱'),
('zhtw', 'LanguageName', '語言名稱'),
('zhtw', 'Level', '權限'),
('zhtw', 'Level Deleted', '權限已刪除'),
('zhtw', 'Level Edit', '權限編輯'),
('zhtw', 'Level List', '權限列表'),
('zhtw', 'Level Name', '權限名稱'),
('zhtw', 'LevelName', '權限名稱'),
('zhtw', 'License Timeout', '權限過期'),
('zhtw', 'Login', '登入'),
('zhtw', 'Login Information', '登入資訊'),
('zhtw', 'LOGIN OK', '正確登入'),
('zhtw', 'Logout', '登出'),
('zhtw', 'Logout OK~', '已登出'),
('zhtw', 'Mapping Group Level', '配置個別群組權限'),
('zhtw', 'Mapping User Level', '配置個別帳號權限'),
('zhtw', 'Modify', '編輯'),
('zhtw', 'New Account', '新增帳號'),
('zhtw', 'New Group', '新增群組'),
('zhtw', 'New Language', '新增語言'),
('zhtw', 'New Level', '新增權限'),
('zhtw', 'Not Modify ~ Delete Not Permit~', '沒修改~ 沒權限刪除~'),
('zhtw', 'Not Modify ~ Function Error~', '沒修改~ 功能錯誤~'),
('zhtw', 'Not Modify ~ Group Level Duplicate Error~', '沒修改~群組權限重複~'),
('zhtw', 'Not Modify ~ Level Deny Error~', '沒修改~權限不足~'),
('zhtw', 'Not Modify ~ Modify Not Permit~', '沒修改~ 沒權限修改~'),
('zhtw', 'Not Modify ~ Parameter Empty~', '沒修改~ 參數空白~'),
('zhtw', 'Not Modify ~ Password Empty~', '沒修改~ 密碼空白~'),
('zhtw', 'Not Modify ~ Password Verify Not Match~', '沒修改~ 密碼驗證不正確~'),
('zhtw', 'Not Modify ~ Power is Number form 11111 to 88888 ~', '沒修改~加權指數請輸入數字11111~88888~'),
('zhtw', 'OK', '完成'),
('zhtw', 'Others', '其他'),
('zhtw', 'Password', '密碼'),
('zhtw', 'Password not Match~', '密碼錯誤~'),
('zhtw', 'Password Verify', '密碼驗證'),
('zhtw', 'Please Setup DB Name', '請設定資料庫名稱'),
('zhtw', 'Power', '加權指數'),
('zhtw', 'Select Group To Setup Level', '選擇一個群組來設定權限'),
('zhtw', 'Select User To Setup Level', '選擇欲設定權限的帳號'),
('zhtw', 'Selectable items', '可選擇項目'),
('zhtw', 'Selection items', '已選擇項目'),
('zhtw', 'Stop', '停用'),
('zhtw', 'TextEnCode', '文字編碼'),
('zhtw', 'User Level Edit', '帳號權限編輯'),
('zhtw', 'User List', '帳號列表'),
('zhtw', 'Username', '名字'),
('zhtw', 'Value', '資料'),
('zhtw', 'Verification Code not Match~', '驗證碼錯誤~'),
('zhtw', 'Watched', '可視'),
('zhtw', 'Will Delete This Account', '將刪除此帳號'),
('zhtw', 'Will Delete This Group', '將刪除此群組'),
('zhtw', 'Will Delete This Language', '將刪除此語言'),
('zhtw', 'Will Delete This Level', '將刪除此權限');

-- --------------------------------------------------------

--
-- 資料表結構 `levelitem`
--

CREATE TABLE `levelitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `levelitem`
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
-- 資料表結構 `logdata`
--

CREATE TABLE `logdata` (
  `logid` bigint(20) NOT NULL,
  `logtext` text NOT NULL,
  `logtime` varchar(20) NOT NULL,
  `logfrom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `randkey`
--

CREATE TABLE `randkey` (
  `randsn` varchar(128) NOT NULL,
  `keyitem` varchar(100) NOT NULL,
  `addtime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `randpswd`
--

CREATE TABLE `randpswd` (
  `licensenumber` varchar(128) NOT NULL,
  `pswd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `userinfo`
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
-- 傾印資料表的資料 `userinfo`
--

INSERT INTO `userinfo` (`u_account`, `u_pswd`, `u_name`, `u_cell`, `u_group`, `u_email`, `stopyn`, `u_fixtime`, `u_lastfix`, `u_language`) VALUES
('junson', 'junson2020', 'test', '0000000', 'root', '', 'N', NULL, NULL, 'zhtw');

-- --------------------------------------------------------

--
-- 資料表結構 `userlevel`
--

CREATE TABLE `userlevel` (
  `u_account` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `userlicenseall`
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
-- 已傾印資料表的索引
--

--
-- 資料表索引 `groupitem`
--
ALTER TABLE `groupitem`
  ADD PRIMARY KEY (`gname`);

--
-- 資料表索引 `grouplevel`
--
ALTER TABLE `grouplevel`
  ADD PRIMARY KEY (`u_group`,`lname`);

--
-- 資料表索引 `langitem`
--
ALTER TABLE `langitem`
  ADD PRIMARY KEY (`lname`);

--
-- 資料表索引 `langword`
--
ALTER TABLE `langword`
  ADD PRIMARY KEY (`lang`,`wording`) USING BTREE;

--
-- 資料表索引 `levelitem`
--
ALTER TABLE `levelitem`
  ADD PRIMARY KEY (`lname`);

--
-- 資料表索引 `logdata`
--
ALTER TABLE `logdata`
  ADD PRIMARY KEY (`logid`);

--
-- 資料表索引 `randkey`
--
ALTER TABLE `randkey`
  ADD PRIMARY KEY (`randsn`);

--
-- 資料表索引 `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`u_account`);

--
-- 資料表索引 `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`u_account`,`lname`);

--
-- 資料表索引 `userlicenseall`
--
ALTER TABLE `userlicenseall`
  ADD PRIMARY KEY (`ulid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `logdata`
--
ALTER TABLE `logdata`
  MODIFY `logid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `userlicenseall`
--
ALTER TABLE `userlicenseall`
  MODIFY `ulid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;