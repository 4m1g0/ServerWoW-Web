<?php

/**
 * Copyright (C) 2009-2011 Shadez <https://github.com/Shadez>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **/

class Sms_Component extends Controller_Component
{
	public function checkCode($code, $type)
	{
		if (!$code || !$type)
			return false;

		// Already used code?
		if ($this->isUsedCode($code))
			return false;

		switch ($type)
		{
			case 'allopass':
				$auth = urlencode("251040/989132/4580667");
				$r = @file("http://payment.allopass.com/acte/access.apu?ids=251040&idd=989132&code[]=".$code);
				$r = @file("http://payment.allopass.com/api/checkcode.apu?code=$code&auth=$auth");

				if (substr($r[0],0,2) != "OK")
					return false;
				break;
			case 'sepomo':
				$code = strtoupper($code);
				$code = str_replace(" ","",$code);
				$code = htmlentities($code);
				$fp = fsockopen ("69.36.9.147", 8090, $errno, $errstr, 30); // Abre el socket para la conexión http

				if (!$fp)
					return false;

				$query="codigo=$code&cliente=SETA6";
				$request = "GET /clientes/SMS_API_OUT.jsp" . "?" . "$query" . " HTTP/1.1\r\n";
				$request .= "Host: 69.36.9.147\r\n\r\n";

				fputs ($fp, $request);

				$cadena = '';
				while (!feof($fp)) 
				{
					$cadena.= fgets ($fp, 4096);

					if (substr_count($cadena, "<valor>") > 0) 
						break;
				}
				fclose ($fp);
				$comodin = explode("<codigo>",$cadena);
				$comodin2 = explode("</codigo>",$comodin[1]);
				$resultado = $comodin2[0];
				$comodin = explode("<valor>",$cadena);
				$comodin2 = explode("</valor>",$comodin[1]);
				$codval = $comodin2[0];
				if ($resultado != '1')
					return false;
				break;
			default:
				return false;
		}

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('SmsCodes')
			->setType('insert');

		$edt->account = $this->c('AccountManager')->user('id');
		$edt->code = $code;
		$edt->cel = '';
		$edt->timestamp = time();
		$edt->type = $type;

		$edt->save()->clearValues();

		$query = $this->c('Db')->realm()->selectRow("SELECT account_id FROM account_points WHERE account_id = %d", $this->c('AccountManager')->user('id'));

		if ($query)
			$this->c('Db')->realm()->query("UPDATE account_points SET amount = %d WHERE account_id = %d LIMIT 1", ($this->c('AccountManager')->user('amount') + STORE_SMS_POINTS), $this->c('AccountManager')->user('id'));
		else
			$this->c('Db')->realm()->query("INSERT INTO account_points (account_id, amount) VALUES ('%d', '%d')", $this->c('AccountManager')->user('id'), STORE_SMS_POINTS);

		return true;
	}

	protected function isUsedCode($code)
	{
		$info = $this->c('QueryResult', 'Db')
			->model('SmsCodes')
			->fieldCondition('code', ' = \'' . $code . '\'')
			->loadItem();

		if ($info)
			return true;

		return false;
	}
}