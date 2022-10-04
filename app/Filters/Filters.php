<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $methods = [
        'post' => ['csrf'],
    ];

    	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	*/
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'authGuard' => \App\Filters\AuthGuard::class,
	];
}