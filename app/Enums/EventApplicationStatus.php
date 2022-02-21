<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EventApplicationStatus extends Enum
{
	const Pending = 0;
	const Accepted = 1;
	const Approved = 2;
	const Refused = 3;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Pending:
				return 'Pendente';
			break;

			case self::Accepted:
				return 'Aceito';
			break;

			case self::Approved:
				return 'Aprovado';
			break;

			case self::Refused:
				return 'Recusado';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}