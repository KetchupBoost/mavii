<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EventCategoryType extends Enum
{
  const Service = 0;
  const Event = 1;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Service:
				return 'Serviço';
			break;

			case self::Event:
				return 'Evento';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}