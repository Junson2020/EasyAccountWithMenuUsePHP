<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);

echo '<header class="hs-menubar">';
echo '   <div class="brand-logo">';
echo '      <a href="index.php"><img src="css/hs-menu.png" title="'.GetLangStr($junsonlanguage,"Junson Menu").'" alt="'.GetLangStr($junsonlanguage,"Junson Menu").'"> </a>';
echo '   </div>';
echo '   <div class="menu-trigger"> <i class="zmdi zmdi-menu"></i></div>';

echo '   <div class="more-trigger toggle" data-reveal=".user-penal"> <i class="zmdi zmdi-more-vert"></i></div>';
echo '</header>';
echo '<section class="box-model">';
echo '   <ul class="user-penal">';
echo '      <li> <a href="accountlist.php"><i class="zmdi zmdi-accounts-list"></i> '.GetLangStr($junsonlanguage,"Account").' </a> </li>';
if(GetAccountGroupByLicense($junsonlicense) == $JUNSON_ROOT) {
echo '      <li> <a href="langlist.php"> <i class="zmdi zmdi-group-work"></i> '.GetLangStr($junsonlanguage,"Language").'  </a> </li>';
echo '      <li> <a href="textencode.php"> <i class="zmdi zmdi-text-format"></i> '.GetLangStr($junsonlanguage,"TextEnCode").'  </a> </li>';
}
echo '      <li> <a href="logout.php"> <i class="zmdi zmdi-run"></i> '.GetLangStr($junsonlanguage,"Logout").'  </a> </li>';
echo '   </ul>';

echo '</section>';
echo '<nav class="hs-navigation">';
echo '   <ul class="nav-links">';

echo '      <li class="has-child">';
echo '         <span class="its-parent">';
echo '         <span class="icon"> <i class="zmdi zmdi-group"></i> ';
echo '         </span>'.GetLangStr($junsonlanguage,"Group/Level Menu").'</span>';
echo '         <ul class="its-children">';
echo '            <li class="has-child">';
echo '               <span class="its-parent">'.GetLangStr($junsonlanguage,"Group").'</span>';
echo '               <ul class="its-children">';
echo '                  <li> <a href="grouplist.php"> '.GetLangStr($junsonlanguage,"Group List").' </a> </li>';
echo '               </ul>';  
echo '            </li>';
echo '            <li class="has-child">';
echo '               <span class="its-parent">'.GetLangStr($junsonlanguage,"Level").'</span>';
echo '               <ul class="its-children">';
echo '                  <li> <a href="levellist.php"> '.GetLangStr($junsonlanguage,"Level List").' </a> </li>';
echo '                  <li> <a href="userlevel.php"> '.GetLangStr($junsonlanguage,"Mapping User Level").' </a> </li>';
echo '                  <li> <a href="grouplevel.php"> '.GetLangStr($junsonlanguage,"Mapping Group Level").' </a> </li>';
echo '               </ul>';
echo '            </li>';
echo '         </ul>';
echo '      </li>';

echo '</nav>';

?>