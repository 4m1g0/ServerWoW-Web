function changeWaste(clean) {
  var div = document.getElementById('ServiceInput');
  var waste = document.getElementById('wasteList');
	var realm = document.getElementById('realmList');
	if (clean) {
		div.innerHTML = '';
		waste.value = '';
		document.getElementById('spacing').style.height = '120';
	} else {
		if (waste.value != '') {
		document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/' + waste.value + '.php?realm=' + realm.value);
    document.getElementById('ServiceInput').style.visibility = 'visible';
    document.getElementById('spacing').style.height = '0';
    }else {
			div.innerHTML = '';
			document.getElementById('spacing').style.height = '120';
		}

	}
}

function changeRealm() {
	var realm = document.getElementById('realmList');
	changeWaste(true);
}

function dorename() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var renamechar = document.getElementById('renamechar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dorename.php?realm=' + realm.value + '&guid=' + renamechar.value);
	document.getElementById('spacing').style.height = '0';
}

function dosex() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var sexchar = document.getElementById('sexchar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dosex.php?realm=' + realm.value + '&guid=' + sexchar.value);
	document.getElementById('spacing').style.height = '0';
}

function dorace() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var racechar = document.getElementById('racechar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dorace.php?realm=' + realm.value + '&guid=' + racechar.value);
	document.getElementById('spacing').style.height = '0';
}

function dofacc() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var faccchar = document.getElementById('faccchar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dofacc.php?realm=' + realm.value + '&guid=' + faccchar.value);
	document.getElementById('spacing').style.height = '0';
}

function docacc() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var caccchar = document.getElementById('caccchar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/docacc.php?realm=' + realm.value + '&guid=' + caccchar.value);
	document.getElementById('spacing').style.height = '0';
}

function doacc() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var accchar = document.getElementById('accchar');
	var acc = document.getElementById('acc');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doacc.php?realm=' + realm.value + '&guid=' + accchar.value + '&acc=' + acc.value);
	document.getElementById('spacing').style.height = '0';
}

function doproff() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var proffchar = document.getElementById('proffchar');
	var proff = document.getElementById('proff');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doproff.php?realm=' + realm.value + '&guid=' + proffchar.value + '&proff=' + proff.value);
	document.getElementById('spacing').style.height = '0';
}

function doproffsec() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var proffchar = document.getElementById('proffchar');
	var secproff = document.getElementById('secproff');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doproff_sec.php?realm=' + realm.value + '&guid=' + proffchar.value + '&secproff=' + proff.value);
	document.getElementById('spacing').style.height = '0';
}

function dogold() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var goldchar = document.getElementById('goldchar');
	var gold = document.getElementById('gold');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dogold.php?realm=' + realm.value + '&guid=' + goldchar.value + '&gold=' + gold.value);
	document.getElementById('spacing').style.height = '0';
}

function dogoldd() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('bonuswaste');
	var fung = document.getElementById('fungold');
	var funtochar = document.getElementById('funtochar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dogold.php?realm=' + realm.value + '&guid=' + funtochar.value + '&gfun=' + fung.value);
	document.getElementById('spacing').style.height = '0';
}

function dolvl() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('ServiceInput');
	var lvlchar = document.getElementById('lvlchar');
	var lvl = document.getElementById('lvl');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dolvl.php?realm=' + realm.value + '&guid=' + lvlchar.value + '&lvl=' + lvl.value);
	document.getElementById('spacing').style.height = '0';
}

function dobag() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('bonuswaste');
	var bag = document.getElementById('bag');
	var bagtochar = document.getElementById('bagtochar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dobag.php?realm=' + realm.value + '&guid=' + bagtochar.value + '&bag=' + bag.value);
	document.getElementById('spacing').style.height = '0';
}

function domount() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('bonuswaste');
	var mount = document.getElementById('mount');
	var mounttochar = document.getElementById('mounttochar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/domount.php?realm=' + realm.value + '&guid=' + mounttochar.value + '&mount=' + mount.value);

  document.getElementById('spacing').style.height = '0';
}

function doitt() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('bonuswaste');
	var itt = document.getElementById('item');
	var tochar = document.getElementById('tochar');
	document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doitt.php?realm=' + realm.value + '&guid=' + tochar.value + '&itt=' + itt.value);
	document.getElementById('spacing').style.height = '0';
}

function dogift() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('bonuswaste');
	var fun = document.getElementById('funitem');
	var count = document.getElementById('count');
	var funtochar = document.getElementById('funtochar');
document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/dogift.php?realm=' + realm.value + '&guid=' + funtochar.value + '&fun=' + fun.value + '&count=' + count.value);

	document.getElementById('spacing').style.height = '0';
}

function donotuse(c) {
	var realm = document.getElementById('realmList');
document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/donotuse.php?realm=' + realm.value + '&guid=' + c);

	document.getElementById('spacing').style.height = '0';
}


function doshop(a,i) {
	var realm = document.getElementById('realmList');
	var price = document.getElementById('price');
	var buychar = document.getElementById('buychar');
document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doshop.php?realm=' + realm.value + '&guid=' + buychar.value + '&price=' + price.value + '&do=' + a + '&id=' + i);

	document.getElementById('spacing').style.height = '0';
}

function doshopg(a,i) {
	var realm = document.getElementById('realmList');
	var price = document.getElementById('gprice');
	var gold = document.getElementById('gold');
	var goldchar = document.getElementById('goldchar');
document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doshop.php?realm=' + realm.value + '&guid=' + goldchar.value + '&price=' + price.value + '&do=' + a + '&gold=' + gold + '&id=' + i);

	document.getElementById('spacing').style.height = '0';
}

function doitemset() {
	var realm = document.getElementById('realmList');
	var div = document.getElementById('bonuswaste');
	var set = document.getElementById('itemset');
	var settochar = document.getElementById('settochar');
document.getElementById('ServiceInput').innerHTML = HttpRequest('core/_cre/_utils/doitemset.php?realm=' + realm.value + '&guid=' + settochar.value + '&set=' + set.value);

	document.getElementById('spacing').style.height = '0';
}

function showmountpic() {
	var mount = document.getElementById('mount');
	var mountpicdiv = document.getElementById('mountpic');
	if (mount.value != '') {
    document.getElementById('mountpic').innerHTML = HttpRequest('core/screens.php?i='+mount.value+'&t=m');
	} else {
		mountpicdiv.innerHTML = '';
	}
}
function showfunpic() {
	var fun = document.getElementById('funitem');
	var funpicdiv = document.getElementById('funpic');
	if (fun.value != '') {
    document.getElementById('funpic').innerHTML = HttpRequest('core/_cre/_utils/screens.php?i='+fun.value+'&t=f');
	}
	else
	{
		funpicdiv.innerHTML = '';
	}
}
function showpic() {
	var pic = document.getElementById('itt');
	var picdiv = document.getElementById('pic');
	if (pic.value != '') {
    document.getElementById('pic').innerHTML = HttpRequest('core/_cre/_utils/screens.php?i='+pic.value+'&t=p');

  } else {
		funpicdiv.innerHTML = '';
	}
}

function showsetpic() {
	var itemset = document.getElementById('itemset');
	var itemsetpic = document.getElementById('itemsetpic');
	if (itemset.value != '') {
    document.getElementById('itemsetpic').innerHTML = HttpRequest('core/_cre/_utils/screens.php?i='+itemset.value+'&t=s');

  } else {
		itemsetpic.innerHTML = '';
	}
}
