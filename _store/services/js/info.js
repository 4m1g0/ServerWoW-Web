function ChangeGame()
{
	HttpRequest('services/core/changegame.php');
	window.location.href = '?p=14';
}

function ChangePass()
{
    document.getElementById('InfoInput').style.visibility = 'visible';
	document.getElementById('InfoInput').innerHTML = "<font color=#f25f5f><b>Estas a punto de Cambiar tu PASS!</b></font><br><br>Clave Actual: <input id='old_pass' class='inp' size='15' type='password'><br><br> Nueva Clave : <input id='new_pass' class='inp' size='15' type='password'><br><br> Confirmar Clave: <input id='new_pass2' size='15' class='inp' type='password'><br><br><b><a href='#pass' onClick='ChangePass2()'>Cambiar</a></b>";
}

function ChangePass2()
{
  var old_pass  = document.getElementById('old_pass').value;
  var new_pass  = document.getElementById('new_pass').value;
  var new_pass2 = document.getElementById('new_pass2').value;
  
  document.getElementById('InfoInput').innerHTML = HttpRequest('core/changepass.php?old='+old_pass+'&new='+new_pass+'&new2='+new_pass2);

}

function lock(){
	if (!window.confirm('La cuenta quedara Disponible, UNICAMENTE para la ip Actual, estas Seguro?'))return false;
	document.getElementById('InfoInput').innerHTML = HttpRequest('core/lock.php?do=1');
	document.getElementById('InfoInput').style.visibility = 'visible';
 window.location.href = '?p=1';
}

function unlock(){
	if (!window.confirm('La cuenta quedara Disponible, Para Cualquier IP, estas Seguro?'))return false;
	document.getElementById('InfoInput').innerHTML = HttpRequest('core/lock.php?do=0');
	document.getElementById('InfoInput').style.visibility = 'visible';
 window.location.href = '?p=1';
}

function Stat(dat)
{
    document.getElementById('InfoInput').style.visibility = 'visible';
	document.getElementById('InfoInput').innerHTML = HttpRequest('core/stat.php?dat='+dat);
}
