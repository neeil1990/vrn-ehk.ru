<?php

namespace Bitrix\Calendar\Sync\Caldav;

class Helper
{
	public const CALDAV_TYPE = 'caldav';
	public const YANDEX_TYPE = 'yandex';


	/**
	 * @param string|null $serverHost
	 * @return bool
	 */
	public function isYandex(?string $serverHost): bool
	{
		return $serverHost === 'caldav.yandex.ru';
	}
}