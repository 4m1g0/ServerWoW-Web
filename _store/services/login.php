<?php
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
if (!$_SESSION['username'])
{
	echo 'debes estar logeado';
}
else
{
	if(!$_SESSION['cp_login'])
	{
		echo "___HERE1____";
		if(isset($_POST['login']))
		{
			echo "___HERE2____";
		    switchConnection(1,"realmd");
			echo "___HERE3____";
		    $accountName = stripslashes($_POST['login']);
		    $accountPass = stripslashes($_POST['pass']);
		    // check pass
		    include "services/include/login_functions.php";
			echo "___HERE4____";
			$sha_pass_hash = sha_game($accountName,$accountPass); 
			echo "___HERE5____";
		    $login_query = mysql_query("SELECT `id` FROM `account` WHERE username = '".mysql_real_escape_string($accountName)."' AND `sha_pass_hash` = '".$sha_pass_hash."'");
		    // reconect web_db
			echo "___HERE6____";
		    switchConnection(1,"web_db");
		    
			if($login = mysql_fetch_assoc($login_query))
			{
			    $_SESSION['cp_login']=true;
			    $query = mysql_query("UPDATE `users` SET `last_login` = UNIX_TIMESTAMP() WHERE username = '".mysql_real_escape_string($accountName)."'");
      ?>
      <center>
      <h3><font color="green"><?php echo$lang['LOGINFRAME_LOGIN']; ?></font></h3><br />
      <div class="loader"></div>
        <br /><br /><meta http-equiv="refresh" content="2"/>
        </center>
        <?php
	        }
			else
			{
	      ?>
      <center>
      <h3><font color="red"><?php echo $lang['LOGINFRAME_INVALID']; ?></font></h3><br />
      <div class="loader"></div>
      <meta http-equiv="refresh" content="2"/>
      </center>   
		<?php
        	}
		}
		else
		{
	?>
<div class="section-title">
    <span>Inicio de sesión</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, por seguridad debes insertar nuevamente tu contraseña para poder modificar las opciones de cuenta.</p>
</div>	
<span class="clear"><!-- --></span>
<form action="?p=<?php echo $_GET['p']; ?>" method="post">
<div style="margin:10px 150px;">
		<table class="tbl" border="0">
			<tbody>
         <tr>
         <td colspan="2" align="center"><noscript><center>
           <span class="error">Administracion de Cuenta</span>
         </center></noscript></td>
         <tr>
         <td><input name="login" id="login" type="hidden" value="<?php echo $_SESSION['username']; ?>"></td>
         </tr>
         <tr>
         <td align="right">Contraseña: &nbsp;</td>
         <td><input name="pass" class="registration" size="24"  id="pass" type="password"></td>
         </tr>
         <tr>
         <td colspan="2" height="7"></td>
         </tr>
         <tr>
         <td colspan="2" align="center"><input type='submit' class="button" alt='Ingresar' title='Ingresar' value='Ingresar' ></td>
         </tr>
         <TR>
         <TD colSpan=2 height=15></TD>
         </TR>
    </TBODY>
  </table>
  </div>
    </form>
	  <?php
		}
	}
	else
	{
		echo '<meta http-equiv="refresh" content="0"/>';
	}
}
?>