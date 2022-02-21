<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EventStatus extends Enum
{
	const DisapprovedPayment = 0;
	const Pending = 1;
	const Accepted = 2;
	const Refused = 3;
  const Searching = 4;
  const Waiting = 5;
  const InAttendance = 6;
  const Finished = 7;
  const Cancelled = 8;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::DisapprovedPayment:
				return 'Pagamento Não Aprovado';
			break;

			case self::Pending:
				return 'Aguardando Aprovação do Profissional';
			break;

			case self::Accepted:
				return 'Aguardando Aprovação do Cliente';
			break;

			case self::Searching:
				return 'Procurando Profissional';
			break;

			case self::Waiting:
				return 'Aguardando Profissional';
			break;

			case self::InAttendance:
				return 'Em Atendimento';
			break;

			case self::Finished:
				return 'Finalizado';
			break;

			case self::Cancelled:
				return 'Cancelado';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}