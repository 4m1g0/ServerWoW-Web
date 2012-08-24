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

class Wow_Controller_Component extends Controller_Component
{
	protected $m_skipBuild = true;
	protected $m_allowedControllers = array(
		'home', 'character', 'guild', 'game', 'item', 'sidebar', 'community', 'media', 'forum', 'services',
		'blog', 'data', 'spell', 'achievement', 'zone', 'faction', 'account-status', 'search', 'pvp', 'arena',
		'pref', 'store', 'status', 'bugtracker', 'discussion', 'profession'
	);
	
	private function isSpider()
	{  
		// Add as many spiders you want in this array  
		$spiders = array(
			'/Googlebot/i', '/Google Desktop/i', '/AdsBot-Google/i', '/Feedfetcher-Google/i',
			'/Googlebot-Mobile/i', '/Mediapartners-Google/i', '/AppEngine-Google/i',
			'/Yahoo/i', '/Yahoo Slurp/i', '/Yahoo! Slurp/i', '/Slurp/i', '/Bingbot/i',
			'/AltaVista/i', '/Scooter/i', '/alexa/i', '/Lycos/i', '/FAST-WebCrawler/i',
			'/Twitterbot/i', '/facebookexternalhit/i', '/W3C_*Validator/i', '/teoma/i'
		);

		// Loop through each spider and check if it appears in  
		// the User Agent
		$http_user = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
		
		if ($http_user == null)
			return false;
		
		foreach ($spiders as $spider)  
		{
			if (preg_match($spider, $http_user))
				return true;
			else
				return false;
		}
	}

	public function build($core)
	{
		// More Imprvements Needed
		// $proxy = isset($_SERVER['HTTP_FORWARDED']) || isset($_SERVER['HTTP_X_FORWARDED_FOR']) || isset($_SERVER['HTTP_VIA']) || isset($_SERVER['HTTP_USERAGENT_VIA']) || isset($_SERVER['HTTP_PROXY_CONNECTION']) || isset($_SERVER['HTTP_XPROXY_CONNECTION']) || isset($_SERVER['HTTP_PC_REMOTE_ADDR']) || isset($_SERVER['HTTP_CLIENT_IP']);
		
		if ($this->isSpider() == true){
		}
		/*elseif ($_SERVER['HTTP_X_FORWARDED_FOR'] || $_SERVER['HTTP_X_FORWARDED'] || $_SERVER['HTTP_FORWARDED_FOR'] || $_SERVER['HTTP_CLIENT_IP'] || $_SERVER['HTTP_VIA'])
		{
			$core->redirectApp('/login/');
			return $this;
		}*/
		elseif (!$this->c('AccountManager')->isLoggedIn()){
			$core->redirectApp('/login/');
			return $this;
		}
		
		if (!$core->getUrlAction(1))
			$action = 'Home';
		else
			$action = ucfirst(strtolower($core->getUrlAction(1)));

		if (!in_array(strtolower($action), $this->m_allowedControllers))
			$com = 'Error_WoW';
		else
			$com = $action . '_WoW';

		$this->c($com, 'Controller');

		return $this;
	}
}
?>