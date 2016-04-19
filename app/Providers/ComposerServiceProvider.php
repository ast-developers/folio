<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 * @return void
	 */
	public function boot()
	{
		$menu = NULL;
		$path           = public_path() . '/reportico/projects';
		$directory_list = File::directories($path);
		foreach ($directory_list as $list_key => $value) {
			$file_list = glob($value . '/*.xml');
			foreach ($file_list as $key => $value) {
				$file             = pathinfo($value);
				$report           = $file['filename'];
				$directory        = $file['dirname'];
				$project          = substr($directory, strrpos($directory, '/') + 1);
				$menu[$project][] = $report;
			}
		}
		View::share('report_menu', $menu);
	}

	/**
	 * Register the application services.
	 * @return void
	 */
	public function register()
	{

	}
}
