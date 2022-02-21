@component('mail::message')
# Nova Mensagem de Contato

* Nome: {{ $data['name'] }}
* E-mail: {{ $data['email'] }}
* Telefone: {{ $data['phone'] }}
* Celular: {{ $data['cellphone'] }}

{{ $data['body'] }}

@endcomponent