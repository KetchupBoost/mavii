@component('mail::message')
# Nova Solicitação de Evento

### O evento *{{ $data->name }}* foi criado por {{ $data->user->name }}

*Data/Horário*\
{{ \Carbon\Carbon::parse($data->start_date)->format('d') }} de {{ \Carbon\Carbon::parse($data->start_date)->formatLocalized('%B') }} de {{ \Carbon\Carbon::parse($data->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($data->start_hour)->format('H:i') }}

*Local*\
{{ $data->location }}

*Qt. de Pessoas*\
{{ \App\Enums\EventPeopleAmount::getDescription($data->people_amount) }}

*Descrição*\
{{ $data->description }}

@endcomponent
