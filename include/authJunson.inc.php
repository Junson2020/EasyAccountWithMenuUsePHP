<?php
session_start();
if(isset($_SESSION['junsonlicense'])) { $junsonlicense=$_SESSION['junsonlicense']; } else { $junsonlicense=""; }
if(isset($_SESSION['junsonlanguage'])) { $junsonlanguage=$_SESSION['junsonlanguage']; } else { $junsonlanguage=$JUNSON_DEFAULT_LANGUAGE; }
?>
