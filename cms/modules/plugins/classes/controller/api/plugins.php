<?php defined('SYSPATH') or die('No direct access allowed.');class Controller_API_Plugins extends Controller_System_API{	public $auth_required = array('administrator', 'developer');		public function rest_get()	{		$plugins = array();				foreach (Plugins::find_all() as $plugin)		{			$plugins[] = $this->_get_info($plugin);		}				$this->response($plugins);	}		public function rest_put()	{		Plugins::find_all();		$plugin = Plugins::get_registered( $this->param('id', NULL, TRUE) );		if ( ! $plugin->is_installed() AND (bool) $this->param('installed') === TRUE )		{			$plugin->install();		}		else		{			$plugin->uninstall((bool)$this->param('remove_data'));		}				Kohana::$log->add(Log::INFO, 'Plugin :name :action', array(			':status' => $plugin->is_installed() ? 'install' : 'uninstall',			':name' => $plugin->title()		))->write();		$this->response($this->_get_info($plugin));	}		protected function _get_info( Plugin_Decorator $plugin )	{		return array(			'id' => $plugin->id(),			'title' => $plugin->title(),			'description' => $plugin->description(),			'author' => $plugin->author(),			'installed' => $plugin->is_installed(),			'settings' => $plugin->has_settings_page(),			'icon' => $plugin->icon()		);	}}