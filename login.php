<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
include_once($JUNSON_AUTH_INC);

$data = GetInput();
if(isset($data['uAccount'])) { $username = $data['uAccount']; } else { $username=""; }
if(isset($data['upswd'])) { $password = $data['upswd']; } else { $password=""; }
?>
<HTML>
<HEAD>
<?php
echo "<title>".GetLangStr($junsonlanguage,"Login")."</title>";
?>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
<style>
*{
  -ms-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
  margin: 0;
  padding: 0;
  border: 0;
}

html, body{
  width: 100%;
  height: 100%;
  background: url(../css/sativa.png) repeat fixed;
  font-family: 'Open Sans', sans-serif;
  font-weight: 200;
}

.login{
  position: relative;
  top: 50%;
	width: 250px;
  display: table;
  margin: -150px auto 0 auto;
  background: #fff;
  border-radius: 4px;
}

.loginB{
  position: relative;
  width: 100%;
  display: block;
  background: #408E08;
  padding: 15px;
  color: #fff;
  font-size: 16px;
}

.legend{
  position: relative;
  width: 100%;
  display: block;
  background: #FF7052;
  padding: 15px;
  color: #fff;
  font-size: 20px;
  
  &:after{
    content: '';
    background-image: url(../css/multy-user.png);
    background-size: 100px 100px;
    background-repeat: no-repeat;
    background-position: 152px -16px;
    opacity: 0.06;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    position: absolute;
  }
}

.input{
  position: relative;
  width: 90%;
  margin: 10px auto;
  
  span{
    position: absolute;
    display: block;
    color: darken(#EDEDED, 10%);
    left: 15px;
    top: 8px;
    font-size: 20px;
  }
  
  input{
    width: 100%;
    padding: 10px 5px 10px 40px;
    display: block;
    border: 1px solid #EDEDED;
    border-radius: 4px;
    transition: 0.2s ease-out;
    color: darken(#EDEDED, 30%);
    
    &:focus{
      padding: 10px 5px 10px 10px;
      outline: 0;
      border-color: #FF7052;
    }
  }
}

.submit{
  width: 45px;
  height: 45px;
  display: block;
  margin: 0 auto -15px auto;
  background: #fff;
  border-radius: 100%;
  border: 1px solid #FF7052;
  color: #FF7052;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0px 0px 0px 7px #fff;
  transition: 0.2s ease-out;
  
  &:hover, &:focus{
    background: #FF7052;
    color: #fff;
    outline: 0;
  }
}

.feedback{
  position: absolute;
  bottom: -70px;
  width: 100%;
  text-align: center;
  color: #fff;
  background: #2ecc71;
  padding: 10px 0;
  font-size: 12px;
  display: none;
  opacity: 0;
  
  &:before{
    bottom: 100%;
    left: 50%;
    border: solid transparent;
    content: '';
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-color: rgba(46, 204, 113, 0);
    border-bottom-color: #2ecc71;
    border-width: 10px;
    margin-left: -10px;
    
  }
}

</style> 
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script> 
<?php 
  echo 'var Estr001="'.GetLangStr($junsonlanguage,'Ajax request Fail~').'";';
  echo 'var Estr002="'.GetLangStr($junsonlanguage,'Password not Match~').'";';
  echo 'var Estr003="'.GetLangStr($junsonlanguage,'Verification Code not Match~').'";';
  echo 'var Estr004="'.GetLangStr($junsonlanguage,'LOGIN OK').'";';
  echo 'var Estr005="'.GetLangStr($junsonlanguage,'Others').'";';
?>
$(document).ready ( function() {
  $('#loginB').click(function() {
    $.ajax (
            {
              url:'chklogin.php',
              data:
              {
                uAccount: $('#uAccount').val(),
                upswd:$('#upswd').val(),
                randpswd: $('#randpswd').val()
              },
              error: function(xhr)
              {
                alert(Estr001);
                location.href='login.php';
              },
              success:function(response)
              { 
                if(response=='Error')
                { alert(Estr002);
                  location.href='login.php?uAccount='+$('#uAccount').val();
                }else if(response=='Randnumber')
                { alert(Estr003);
                  location.href='login.php?uAccount='+$('#uAccount').val()+'&upswd='+$('#upswd').val();
                }else if(response=='OK')
                { alert(Estr004);
                  location.href='index.php';
                }else {
                	alert(Estr005+response);
                  location.href='login.php?uAccount='+$('#uAccount').val()+'&upswd='+$('#upswd').val();
                }
              }
    });
  });
});
</script>

<body>
<form class="login">
	<fieldset>
<?php		
  echo "<legend class=\"legend\">".GetLangStr($junsonlanguage,"Login Information")."</legend>";
  echo '<div class="input">';
  echo ' <input type="text" id="uAccount" value="'.$username.'" size="20" placeholder="'.GetLangStr($junsonlanguage,"Account").'">';
  echo ' <span><img src="css/icons8-user-30.png" width="30"></img></span>';
  echo '</div>';

  echo '<div class="input">';
  echo ' <input type="password" id="upswd" value="'.$password.'" size="20" placeholder="'.GetLangStr($junsonlanguage,"Password").'">';
  echo ' <span><img src="css/icons8-lock-50.png" width="30"></img></span>';
  echo '</div>';

  echo '<div class="input">';
  echo ' <font size="3" color="red"><b><img src="randimg.php"></img></b></font>';
  echo ' <input type="text" id="randpswd" placeholder="'.GetLangStr($junsonlanguage,"CAPTCHA").'" maxlength="5" required />';
  echo '</div>';

  echo '  <input class="loginB" type="button" name="loginB" id="loginB" value="'.GetLangStr($junsonlanguage,"Login").'">';

?>
  </table>
</form>
</body>
</HTML>