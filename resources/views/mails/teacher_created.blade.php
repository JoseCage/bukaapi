@component('mail::message')
# Boas Vindas

Olá carissimo **{{ $teacherName }}** seja bem vindo à Buka App.

Clique no botão abaixo para entrar na app.

Email: {{ $teacherEmail }} e a Senha: **** A que definiu ****

@component('mail::button', ['url' => $url])
Abrir app
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
