@component('mail::message')
# Seu evento foi aceito

### O evento *{{ $data->name }}* foi aceito por {{ $data->professional->name }}

*Preço*
@currency($data->price)

@endcomponent
