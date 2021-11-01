<?php

declare(strict_types=1);

namespace App\Router;

use Contributte\ApiRouter\ApiRoute;
use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router[] = new ApiRoute('/devices', 'Device', ['methods' => ['GET', 'POST', 'OPTIONS' => 'options']]);
		$router[] = new ApiRoute('/device_types', 'DeviceType', ['methods' => ['GET']]);
		$router[] = new ApiRoute('/os', 'Os', ['methods' => ['GET']]);
		return $router;
	}
}
