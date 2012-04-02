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

class Media_Component extends Component
{
	protected $m_item = array();
	protected $m_items = array();
	protected $m_keys = array();
	protected $m_apiResponse = array();
	protected $m_quickView = array('videos' => array(), 'ss' => array());
	protected $m_totalCount = 0;

	public function initMedia($action, $item = '')
	{
		$item = str_replace('/', '', $item);

		switch ($action)
		{
			case 'videos':
				$this->initVideos($item);
				$this->m_totalCount = $this->c('Db')->wow()->selectCell("SELECT COUNT(*) FROM wow_media_videos");
				break;
			case 'screenshots':
				$this->initScreenshots($item);
				$this->m_totalCount = $this->c('Db')->wow()->selectCell("SELECT COUNT(*) FROM wow_media_screenshots");
				break;
			default:
				$this->initDefault();
				break;
		}

		return $this;
	}

	public function getTotalCount()
	{
		return $this->m_totalCount;
	}

	protected function initDefault()
	{
		$this->m_quickView['videos']['latest'] = $this->c('QueryResult', 'Db')
			->model('WowMediaVideos')
			->limit(2)
			->order(array('WowMediaVideos' => array('post_date')), 'DESC')
			->loadItems();

		$count = $this->c('QueryResult', 'Db')
			->model('WowMediaVideos')
			->fields(array('WowMediaVideos' => array('id')))
			->runFunction('COUNT', 'id')
			->loadItem();
		$this->m_quickView['videos']['count'] = $count['id'];

		$this->m_quickView['ss']['latest'] = $this->c('QueryResult', 'Db')
			->model('WowMediaScreenshots')
			->limit(4)
			->order(array('WowMediaScreenshots' => array('post_date')), 'DESC')
			->loadItems();

		$count = $this->c('QueryResult', 'Db')
			->model('WowMediaScreenshots')
			->fields(array('WowMediaScreenshots' => array('id')))
			->runFunction('COUNT', 'id')
			->loadItem();
		$this->m_quickView['ss']['count'] = $count['id'];

		return $this;
	}

	public function submitScreenshot()
	{
		if (!$this->c('AccountManager')->isLoggedIn() || !$this->c('AccountManager')->user('id'))
			return $this;

		if (!isset($_FILES['ss']) || !$_FILES['ss'])
			return $this->core->redirectUrl('media/screenshots');

		$types = array('image/jpeg', 'image/png', 'image/gif');

		if (!in_array($_FILES['ss']['type'], $types))
			return $this->core->redirectUrl('media/screenshots');

		$maxid = $this->c('Db')->wow()->selectCell("SELECT MAX(id) FROM wow_media_screenshots");

		$d = explode('.', $_FILES['ss']['name']);
		$ext = $d[sizeof($d)-1];
		$file = ($maxid + 1) . '.' . $ext;
		
		if (!getimagesize($_FILES['ss']['tmp_name'])) // First, try to check image size, if TRUE, valid image type
		{
			$this->c('Log')->writeError('%s : The File you are trying to upload is not allowed, unvalid type of image validation, Tmp File: %s File: %s Account: %d, Ip: %s, Ip2: %s', __METHOD__, $_FILES['ss']['tmp_name'], $file, $this->c('AccountManager')->user('id'), $this->c('AccountManager')->get_Realip(), $_SERVER['REMOTE_ADDR']);
			$note = "PHP Shell attemp, No Image Size";
			$hack_report_val = TRUE;
		}
		else // More Secure Data About the upload
		{
			$blacklist = array(".php", ".phtml", ".php3", ".php4", ".js", ".shtml", ".pl" ,".py");
			
			foreach ($blacklist as $blacklists)
			{
				if (preg_match('/$file\$/i', $blacklists)) // Check if is some /blacklist/ in the name
				{
					$this->c('Log')->writeError('%s : The File you are trying to upload is not allowed (PHP) Possible Shell, Tmp File: %s File: %s, Account: %s, Ip: %s, Ip2: %s', __METHOD__, $_FILES['ss']['tmp_name'], $file, $this->c('AccountManager')->user('id'), $this->c('AccountManager')->get_Realip(), $_SERVER['REMOTE_ADDR']);
					$note = "PHP Shell attemp, PHP in code";
					$hack_report_val = TRUE;
				}
			}
		}
		
		// Add report to DB
		if (isset($hack_report_val) == TRUE)
		{
			$this->c('Db')->wow()->query("INSERT INTO wow_hack_reports (user_id,user_ip,tmp_file,file,date,note) VALUES ('%d', '%s', '%s', '%s', '%s', '%s')", $this->c('AccountManager')->user('id'), $this->c('AccountManager')->get_Realip(), $_FILES['ss']['tmp_name'], $file, time(), $note);

			$rName = rand() . '_' . date("Y-m-d");
			move_uploaded_file($_FILES['ss']['tmp_name'], UPLOADS_DIR . 'reports' . DS . $rName.'.txt');
			
			return $this->core->redirectUrl('media/screenshots');
		}

		// Now we have to re-make the image for delete posible PHP comments
		$makeImage = getimagesize($_FILES['ss']['tmp_name']);
		if ($this->makeThumb($_FILES['ss']['tmp_name'], $file, $ext, $makeImage[0], $makeImage[1]) == TRUE)
		{
			// if is correct upload the files to folder
			//move_uploaded_file($_FILES['ss']['tmp_name'], UPLOADS_DIR . 'screenshots' . DS . $file);
			$edt = $this->c('Editing')
				->clearValues()
				->setModel('WowMediaScreenshots')
				->setType('insert');

			$edt->file = $file;
			$edt->post_date = time();
			$edt->approved = 1;
			$edt->sender_id = $this->c('AccountManager')->user('id');

			$edt->save()->clearValues();
		}

		return $this->core->redirectUrl('media/screenshots');
	}

	public function getQuickView()
	{
		return $this->m_quickView;
	}

	protected function initVideos($item)
	{
		if ($item)
			$this->m_item = $this->c('QueryResult', 'Db')
				->model('WowMediaVideos')
				->fieldCondition('key', ' = \'' . addslashes($item) . '\'')
				->loadItem();

		$this->m_items = $this->c('QueryResult', 'Db')
			->model('WowMediaVideos')
			->fieldCondition('approved', ' = 1')
			->order(array('WowMediaVideos' => array('post_date')), 'DESC')
			->limit(15, ($this->getPage(true) * 15))
			->loadItems();

		if ($item)
		{
			if (sizeof($this->m_items > 2))
			{
				$prevFound = false;
				$useNext = false;
				$id = 0;
				$size = sizeof($this->m_items);
				foreach ($this->m_items as $i)
				{
					if ($i['key'] == $item)
					{
						if ($id > 1)
						{
							$this->m_keys['prev'] = $this->m_items[$id-1]['key'];
						}
						else
							$this->m_keys['prev'] = $this->m_items[$size - 1]['key'];

						$this->m_keys['next'] = ($id + 1) < $size ? $this->m_items[$id + 1]['key'] : $this->m_items[0]['key'];
					}
					++$id;
				}
			}
			else
				$this->m_keys = array(
					'next' => sizeof($this->m_items) == 2 ? ($this->m_items[0]['key'] == $item ? $this->m_items[1]['key'] : $this->m_items[0]['key']) : $item,
					'prev' => sizeof($this->m_items) == 2 ? ($this->m_items[1]['key'] == $item ? $this->m_items[0]['key'] : $this->m_items[1]['key']) : $item,
				);

			if (!isset($this->m_keys['prev']))
				$this->m_keys['prev'] = $item;

			if (!isset($this->m_keys['next']))
				$this->m_keys['next'] = $item;
		}

		return $this;
	}

	protected function initScreenshots($item)
	{
		if ($item)
			$this->m_item = $this->c('QueryResult', 'Db')
				->model('WowMediaScreenshots')
				->fieldCondition('id', ' = \'' . intval($item) . '\'')
				->loadItem();

		$this->m_items = $this->c('QueryResult', 'Db')
			->model('WowMediaScreenshots')
			->fieldCondition('approved', ' = 1')
			->order(array('WowMediaScreenshots' => array('post_date')), 'DESC')
			->limit(15, ($this->getPage(true) * 15))
			->loadItems();

		if ($item)
		{
			if (sizeof($this->m_items > 2))
			{
				$prevFound = false;
				$useNext = false;
				$size = sizeof($this->m_items);
				foreach ($this->m_items as $i)
				{
					if ($i['id'] == $item)
					{
						if ($i['id'] > 1)
							$this->m_keys['prev'] = $i['id']-1;
						else
							$this->m_keys['prev'] = $this->m_items[$size - 1]['id'];

						$this->m_keys['next'] = ($i['id'] + 1) < $size ? $i['id']+1 : $this->m_items[0]['id'];
					}
				}
			}
			else
				$this->m_keys = array(
					'next' => sizeof($this->m_items) == 2 ? ($this->m_items[0]['id'] == $item ? $this->m_items[1]['id'] : $this->m_items[0]['id']) : $item,
					'prev' => sizeof($this->m_items) == 2 ? ($this->m_items[1]['id'] == $item ? $this->m_items[0]['id'] : $this->m_items[1]['id']) : $item,
				);

			if (!isset($this->m_keys['prev']))
				$this->m_keys['prev'] = $item;

			if (!isset($this->m_keys['next']))
				$this->m_keys['next'] = $item;
		}

		return $this;
	}

	public function getVideos()
	{
		return $this->m_items;
	}

	public function video($field)
	{
		return isset($this->m_item[$field]) ? $this->m_item[$field] : false;
	}

	public function ss($field)
	{
		return isset($this->m_item[$field]) ? $this->m_item[$field] : false;
	}

	public function getYoutubeId()
	{
		return $this->video('youtube');
	}

	public function getNextKey()
	{
		return $this->m_keys['next'];
	}

	public function getPrevKey()
	{
		return $this->m_keys['prev'];
	}

	public function initApi()
	{
		if (!$this->c('AccountManager')->isLoggedIn())
		{
			$this->m_apiResponse = array('result' => 'Error: you must be logged in!');
			return $this;
		}

		$method = $this->core->getUrlAction(3);

		if (!in_array($method, array('addvideo', 'addscreenshot')))
		{
			$this->m_apiResponse = array('result' => 'Error: unknown API action!');
			return $this;
		}

		switch ($method)
		{
			case 'addvideo':
				if (!isset($_POST['link']) || !isset($_POST['title']))
				{
					$this->m_apiResponse = array('result' => 'Error: all fields are required!');
					return $this;
				}
				$youtube = '';
				$_POST['link'] = str_replace(array('youtube.com/watch?', 'http://', 'www.'), '', $_POST['link']);
				$exp = explode('&', substr($_POST['link'], strpos('?', $_POST['link'])));
				foreach ($exp as &$r)
				{
					if ($t = explode('=', $r))
					{
						if ($t[0] == 'v')
							$youtube = trim($t[1]);
					}
				}
				$title = addslashes($_POST['title']);

				$d = $this->c('QueryResult', 'Db')
					->model('WowMediaVideos')
					->fieldCondition('youtube', ' = \'' . addslashes($youtube) . '\'')
					->loadItem();
				if ($d)
				{
					$this->m_apiResponse = array('result' => 'Error: this video is already in database!');
					unset($d);
					return $this;
				}
				$edt = $this->c('Editing')
					->clearValues()
					->setModel('WowMediaVideos')
					->setType('insert');

				$edt->key = strtolower(str_replace(' ', '-', $_POST['title']));
				$edt->post_date = time();
				$edt->youtube = $youtube;
				$edt->approved = 1;
				$edt->title = $title;
				$edt->sender_id = $this->c('AccountManager')->user('id');
				$edt->save()->clearValues();
				$this->m_apiResponse = array('result' => 'Your video was sent! Please wait while it\'s being approved.');
				unset($edt);
				break;
		}

		return $this;
	}

	public function getApiResponse()
	{
		return $this->m_apiResponse;
	}

	public function getMetaDataItem()
	{
		if (!isset($_GET['id']))
			return false;

		return $this->c('QueryResult', 'Db')
			->model('WowMediaScreenshots')
			->fieldCondition('id', ' = ' . intval($_GET['id']))
			->loadItem();
	}

	public function getSidebarData()
	{
		return $this->c('Db')->wow()->selectRow("SELECT * FROM wow_media_screenshots ORDER BY RAND() LIMIT 1");
	}
	
	public function makeThumb($file_tmp, $file, $type, $max_width, $max_height)
	{
		$screen_dir = UPLOADS_DIR . 'screenshots' . DS . $file;
		
		if ($type == 'jpg')	{
			$src = imagecreatefromjpeg($file_tmp);
		}
		elseif ($type == 'png'){
			$src = imagecreatefrompng($file_tmp);
		}
		elseif ($type == 'gif')	{
			$src = imagecreatefromgif($file_tmp);
		}
		
		if (($oldW = imagesx($src)) < ($oldH = imagesy($src))){
			$newW = $oldW * ($max_width / $oldH);
			$newH = $max_height;
		}
		else{
			$newW = $max_width;
			$newH = $oldH * ($max_height / $oldW);
		}
		
		$new = imagecreatetruecolor($newW, $newH);
		imagecopyresampled($new, $src, 0, 0, 0, 0, $newW, $newH, $oldW, $oldH);
		
		if ($type == 'jpg'){
			imagejpeg($new, $screen_dir);
		}
		elseif($type == 'png'){
			imagepng($new, $screen_dir);
		}
		elseif($type == 'gif'){
			imagegif($new, $screen_dir);
		}
		
		imagedestroy($new); imagedestroy($src);
		
		return TRUE;
	}
}
?>