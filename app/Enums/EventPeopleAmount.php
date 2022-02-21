<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EventPeopleAmount extends Enum
{
	const Fifty = 0;
  const FiftyOneHundredAndFifty = 1;
  const OneHundredAndFiftyThreeHundred = 2;
  const ThreeHundredFiveHundred = 3;
  const OverFiveHundred = 4;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Fifty:
				return 'Até 50 pessoas';
			break;

			case self::FiftyOneHundredAndFifty:
				return '50 a 150 pessoas';
			break;

			case self::OneHundredAndFiftyThreeHundred:
				return '150 a 300 pessoas';
			break;

			case self::ThreeHundredFiveHundred:
				return '300 a 500 pessoas';
			break;

			case self::OverFiveHundred:
				return 'Acima de 500 pessoas';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}