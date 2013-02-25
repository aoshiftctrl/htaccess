<?php	
function make_htaccess($user, $authName, $passwdFile="")
{
    
    if(empty($passwdFile))
        $passwdFile=dirname(__FILE__);
    
    
    $access .=    'AuthType Basic' . "\n";
    $access .=    'AuthName "' . $authName . '"' . "\n";
    $access .=    'AuthUserFile ' . $passwdFile . '/.htpasswd' . "\n";
    $access .=    'require valid-user' ."\n";
    
    $handle = fopen(".htaccess","w");
    fputs($handle,$access);
    fclose($handle);

}


function make_htpasswd($user, $passwd, $passwdFile="")
{
    
    if(empty($passwdFile))
    
        $passwdFile=dirname(__FILE__);
     
    $passwd = crypt($passwd);
    $htpasswd = $user . ':' . $passwd . "\n" .$_admin . ':' . $_adminpass . "\n";
    
    $handle = fopen($passwdFile . '/.htpasswd',"a");
    fputs($handle,$htpasswd);
    fclose($handle);
    
}

// Der Text, der angezeigt wird wenn das Login-Fenster geöffnet wird.
$authName = 'htaccess';

//Den kompletten Pfad zu der Datei .htpasswd, ohne abschließenden Slash (/)
$passwdFile = '';

if ($_POST){
	
	if ((empty($_POST["passwd"])) or (empty($_POST["user"]))){
		echo "sry";
	}else{
	  make_htpasswd($_POST["user"], $_POST["passwd"], $passwdFile);
	  make_htaccess($_POST["user"], $authName, $passwdFile);
	}
	
}
?>
<html> 
 <head> 
  <title>htpasswd</title> 
    <meta charset="utf-8">
    
    <style media="screen">
    *{margin: 0; padding: 0; line-height: 1em; font-family: Helvetica, Arial, sans-serif;}	
    body{margin: 50px; background-color: rgb(255,255,255); color: rgb(40,40,40);}
    h1{font-size: 24px; margin: 0 0 10px 0;}
    h2{font-size: 20px; margin: 0 0 10px 0;}
    p{font-size: 16px; line-height: 1.3em; margin: 0 0 10px 0;}
    form input{ margin-bottom:10px; min-width: 200px; padding: 4px; font-size: 14px; outline: none; }
    form input:focus {font-weight: bold; outline: none; }
    form label{display: block;}
    </style>
  
 </head> 
<body> 
 <form method=post action=<?= $_SERVER['PHP_SELF'];?>> 
  <label	for="user">User</label> <input type="text" name="user"><br> 
  <label	for="pass">Pass</label> <input type="text" name="passwd"><br> 
  <input	type="hidden"	name="huser"	value="weigl"	/>
  <input	type="hidden"	name="hpasswd"	value="start"	/>
  <input	type="submit"	name="senden"	value="create htaccess with passwd"	/>
  </form>
  </body> 
</html>