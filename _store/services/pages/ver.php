<?php
if(!$_SESSION['cp_login']) exit();
if (isset($_POST['expansion']))
{
    $expansion= intval($_POST['expansion']);
    if ($expansion <=4 && $expansion >=0)
    {
        $change=mysql_query("UPDATE account SET `expansion`='".$expansion."' WHERE `id`='".$game_information['id']."' limit 1");
        if ($change)
            echo '<style type="text/css">
      .loader {
        width:24px;
        height:24px;
        background: url("wow/static/images/loaders/canvas-loader.gif") no-repeat;
       }
      </style>
      <center><h3><font color="green">Efectuando el cambio de versión solicitado</font></h3><br /><div class="loader"></div><br /><br /><meta http-equiv="refresh" content="2"/></center>';
        else echo 'Codigo de error: 1452';
    }
    else echo 'Estas seleccionando una expansión inexistente, imposible actualizar';
}else{
    $result = mysql_query("SELECT `expansion` FROM `account` WHERE `id` ='".$game_information['id']."' limit 1")or die("error");
    $data= mysql_fetch_assoc($result);
    switch ($data['expansion']){
        case 0:
            $expansion="World of Warcraft Clásico";
            break;
        case 1:
            $expansion="The Burning Crusade";
            break;
        case 2:
            $expansion="Wrath Of The Lich King";
            break;
        case 3:
            $expansion="Cataclysm";
            break;
    }
    ?>
    <div class="section-title">
    <span>Cambiar versión de juego</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, tu expansión de juego actual es <?php echo $expansion; ?> desde esta página puedes modificarla, recuerda que si seleccionas una versión antigua no verás todas las características del juego.</p>
    </div>
    <span class="clear"><!-- --></span>
    <p><form name="ver" method="post">
    <div><br /><br /><br />
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl" align="center">
	<tr>
	<td width="40%" align="right">Version de juego: &nbsp;</td>
	<td><select name="expansion" class="select">
	                <option value="0" <?php if($data['expansion']==0) echo 'selected="selected"';?>>World of Warcraft: Clásico</option>
	                <option value="1" <?php if($data['expansion']==1) echo 'selected="selected"';?>>World of Warcraft: The Burning Crusade</option>
	                <option value="2" <?php if($data['expansion']==2) echo 'selected="selected"';?>>World of Warcraft: Wrath Of The Lich King</option>
	                <option value="3" <?php if($data['expansion']==3) echo 'selected="selected"';?>>World of Warcraft: Cataclysm</option></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><label>
	<input type="submit" class="button" value="Cambiar versión">
	</label></td>
	</tr>
	</table>
	</div></form></p>
<?php }?>
