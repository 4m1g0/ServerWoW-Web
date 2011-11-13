<?php if(!$_SESSION['cp_login']) exit();
switchConnection(1,"web_db"); ?>
<br />
<style type="text/css">
.avatar {
	padding:15px;
}

.service {
	width:600px; padding:0 0 0 28px; padding-bottom:70px; float:left; min-height:183px;
}

.submit {
	height:38px;
	width:128px;
	background:url('wow/static/images/services/button.png') no-repeat;
	border:0px;
	color:#E0BB00;
	text-shadow:0px 0px 2px #000;
	font-size:15px;
	font-weight:bold;
}
.submit:hover {
	background-position:0 -41;
}
.submit:active{
	background-position:0 -82;
}
.portrait-b img{ -moz-box-shadow:0 0 10px #000; -webkit-box-shadow:0 0 10px #000; box-shadow:0 0 10px #000;  }
</style>
<?php
if($_POST['avatar'] != ""){
    if($_POST['avatar'] == "blizzard.png" && $account_information['rank']=0){
        echo '
    	<div class="service" align="left">
    	<center>
        <font color="reed"><h3>Procesando tu solicitud</h3></font><br />
        <div class="loader"></div>
    	<br />
    	<font color="red">ERROR</font>
        <meta http-equiv="refresh" content="2"/>
        </center>
    	</div>';
    }else{
	$change_avatar = mysql_query("UPDATE users SET avatar = '".mysql_real_escape_string($_POST['avatar'])."' WHERE id = '".$account_information['id']."'");
	echo '
	<div class="service" align="left">
	<center>
    <font color="green"><h3>Procesando tu solicitud</h3></font><br />
    <div class="loader"></div>
	<br />
	<font color="aqua">Avatar modificado correctamente.</font>
    <meta http-equiv="refresh" content="2"/>
    </center>
	</div>';
    }
}else{
?>
<script>
function colors (color){
    document.getElementById("image").src="images/avatars/2d/"+color;
}
</script>
<div class="section-title">
    <span>Cambiar avatar de la web</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, desde esta página puedes modificar tu avatar, esta imagen se mostrará en toda la web siempre que postees o publiques algén comentario.</p>
    </div>
<form method="POST">
<div style="margin:100px 150px;"><br /><br />
<table border="0" width="300">
<tr>
<td align="center" class="avatar">
<div class="avatar portrait-b"><img id="image" src="images/avatars/2d/<?php echo $account_information['avatar'];?>" /></div>
</td>
</tr>
<tr>
<td align="center">
<select onchange="colors(this.options[this.selectedIndex].value)" name="avatar">
    <option value="1-0.jpg" <?php if($account_information['avatar']=='1-0.jpg') echo 'selected';?>>humano</option>
    <option value="2-0.jpg" <?php if($account_information['avatar']=='2-0.jpg') echo 'selected';?>>Orco</option>
	<option value="3-0.jpg" <?php if($account_information['avatar']=='3-0.jpg') echo 'selected';?>>Enano</option>
	<option value="4-0.jpg" <?php if($account_information['avatar']=='4-0.jpg') echo 'selected';?>>Elfo de la Noche</option>
	<option value="5-0.jpg" <?php if($account_information['avatar']=='5-0.jpg') echo 'selected';?>>No Muerto</option>
	<option value="6-0.jpg" <?php if($account_information['avatar']=='6-0.jpg') echo 'selected';?>>Tauren</option>
	<option value="7-0.jpg" <?php if($account_information['avatar']=='7-0.jpg') echo 'selected';?>>Gnomo</option>
	<option value="8-0.jpg" <?php if($account_information['avatar']=='8-0.jpg') echo 'selected';?>>Troll</option>
	<option value="9-0.jpg" <?php if($account_information['avatar']=='9-0.jpg') echo 'selected';?>>Goblin</option>
	<option value="10-0.jpg" <?php if($account_information['avatar']=='10-0.jpg') echo 'selected';?>>Elfo de Sangre</option>
	<option value="11-0.jpg" <?php if($account_information['avatar']=='11-0.jpg') echo 'selected';?>>Draenei</option>
	<option value="12-0.jpg" <?php if($account_information['avatar']=='12-0.jpg') echo 'selected';?>>Worgen</option>
	<?php if($account_information['avatar']=='blizzard.png')$selected='selected'; if($account_information['rank']>0) echo '<option value="blizzard.png"'.$selected.'>Staff</option>';?>
</select>
</td>
</tr>
<tr>
<td align="center">
<br /><input type="submit" class="submit" name="submit" value="Aceptar"/>
</td>
</tr>
</table>
<br />
</div>
</form>
<?php } ?>

