<div class="section-title">
<span>Obtener creditos</span>
<p>Hola <?php echo $_SESSION['username']; ?>, con esta opción puedes obtener créditos enviando una donación por paypal, recibirás creditos en función de la cantidad que aportes, selecciona tu recopensa.</p>
</div>
<span class="clear"><!-- --></span>
<?

header("Cache-control: no-cache, must-revalidate\r\n");

	require_once("_pp/config.php");

	if(isset($_GET['char']))
	{
		$Name = mysql_real_escape_string($_GET['char']);
		$Realm = mysql_real_escape_string($_GET['realm']);
		$Realm = (int)$Realm+1;
		
		switchConnection(1,"realmd");

		$res = dbquery("SELECT id FROM account WHERE username='{$Name}'");
		if(dbrows($res) == 1)
		{
			$row = dbarray($res);
			echo $row['id'];
		}
		else
		{
			echo "0";
			die;
		}
	}
	else
	{
		switchConnection(1,"realmd");
		$res = dbquery("SELECT entry,name FROM cp_realms_pp");
		
		$REALMS = "{";
		while($row = dbarray($res))
		{
			$REALMS .= ((int)$row['entry']-1).":\"".$row['name']."\",";
		}
		$REALMS .= "\"undefined\":0}";
		$res = dbquery("SELECT entry,name,realm,description,price FROM cp_items_pp");
		$REWARDS = "{";
		while($row = dbarray($res))
		{
			$REWARDS .= ((int)$row['entry']-1).":{name:\"".$row['name']."\",realm:".((int)$row['realm']-1).",description:\"".addslashes($row['description'])."\",price:".$row['price']."},";
			$DESCRIPTIONS .= "<div class=\"SlidingPanelsContent\" style=\"padding:2px;\">".$row['description']."</div>";
		}
		$REWARDS .= "\"undefined\":0}";
		$REWARDS = str_replace("\r","\\r",$REWARDS);
		$REWARDS = str_replace("\n","\\n",$REWARDS);
		include("_pp/form.php");
	}

?>
