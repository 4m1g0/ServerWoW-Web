<div id = 'content'>
<?
error_reporting(0);
if (!isset($_GET['do']))
{
?>
	<h2>WoW LCV Realms</h2>
    <p></p>
    <table width = '100%' cellspacing = '0' cellpadding = '0' border = '0' class = "tbl">
    <td>Hola, <? echo $datag['username'];?>!
	<p>Administracion de Cuenta WoW LCV.</p>
	<br><br>
	</td>
    </tr></table>
<?
}

	echo "<h2>Noticias</h2>
 	<p></p>
	<table width=100% align=center border=0 cellspacing='4' cellpadding='0'>";
    switchConnection(1, "realmd");
    $result=dbquery("SELECT * FROM cp_news order by id desc limit $news_count") or die("eror");

	if (dbrows($result) != 0)
	{
		while ($data=dbarray($result))
		{
			echo "<tr>
		    <td><p><b>$data[title]</b></p>$data[news]</td>
		    </tr>
			<tr>
		    <td align=right><font size='1'>Fecha: $data[date] por <b>$data[name]</b></font></td>
    		</tr>";
             
		}
	}
	else
		echo "<tr>
    	<td colspan=2 align=center>De</td>
	    </tr>";
?>
</table>