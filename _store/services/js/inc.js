function HttpRequest(url)
{
	createLoadingBar();
	var pageRequest = false //variable to hold ajax object

	if (window.XMLHttpRequest) // non-IE
		pageRequest = new XMLHttpRequest();
	else if (window.ActiveXObject) // IE
     	pageRequest = new ActiveXObject("Microsoft.XMLHTTP");
  	else
	{
		alert("Method is not supported. Use \"Save and return\".");
		return;
	}
	
	if (pageRequest)
	{ //if pageRequest is not false
		pageRequest.open('GET', url, false) //get page synchronously
		pageRequest.send(null)
		destroyLoadingBar();
   
		if (window.location.href.indexOf("http")==-1 || pageRequest.status==200)
			return pageRequest.responseText;
	}
}
 
function setOpacity(element, opacity)
{
    if (navigator.userAgent.indexOf("MSIE") != -1)
	{
        var normalized = Math.round(opacity * 100);
        element.style.filter = "alpha(opacity=" + normalized + ")";
    }
	else
	{
        element.style.opacity = opacity;
    }
}

function createLoadingBar()
{
	if (typeof window_width == 'undefined')
	{
		var window_width;
		
		if( typeof( window.innerWidth ) == 'number' )
		{
			window_width = window.innerWidth;
		}
		else if( document.documentElement && document.documentElement.clientWidth )
		{
			window_width = document.documentElement.clientWidth;
		}
		else if( document.body && document.body.clientWidth )
		{
			window_width = document.body.clientWidth;
		}
	}

	window_height = document.body.offsetHeight;

	var left = Math.round(window_width / 2);
	var top = Math.round(window_height / 2);

	var div = document.createElement('lockScreen');
	div.setAttribute('id','lockScreen');
	div.style.position = 'absolute';
	div.style.left = 0;
	div.style.top = 0;
	div.style.width = window_width;
	div.style.height = window_height - top;
	div.style.backgroundColor = '#D4BEA6';
	div.style.paddingTop = top + 'px';
	div.style.zIndex = 2;
	setOpacity(div, 0.5);
	div.innerHTML = '<center><img src="img/ajax-loader.gif" border="0" id="loadingbar"><br><span style="color: #1a1006; font-weight: bold;">Cargando</span></center>';

	document.body.appendChild(div);
}

function destroyLoadingBar()
{
	var div = document.getElementById('lockScreen');
	document.body.removeChild(div);
}

var startTime = 0;

function CheckLP()
{
	if(document.getElementById('login').value && document.getElementById('pass').value)
	{
		var login = document.getElementById('login').value;
		var password = document.getElementById('pass').value;
       	var nowDate = new Date();
		var nowTime = nowDate.getTime();

		if(startTime == 0 || nowTime-startTime > 5000)
		{
			document.getElementById('Message').innerHTML = HttpRequest('core/login.php?login='+login+'&pass='+password);
			document.getElementById('Message').style.visibility = 'visible';
	
			if(document.getElementById('Message').innerHTML == 'Cargando...')
				window.location.href = '?p=6';
			else
				destroyLoadingBar();

			document.getElementById('pass').value = '';
        		
			startTime = nowTime;
		}
		else
		{
			var sec = 3 - Math.floor((nowTime-startTime)/1000);

			if(sec < 4 && sec > 1) 
				var mes = 't1';

			if(sec == 1)
				var mes = 't2';
			
			if(sec == 0)
				var mes = 't3';

			document.getElementById('Message').innerHTML = 't4, t5 '+sec+' '+mes+'.';
			document.getElementById('Message').style.visibility = 'visible';
		}
	}
	else
	{
		document.getElementById('Message').innerHTML = 't7.';
		document.getElementById('Message').style.visibility = 'visible';
	}
}