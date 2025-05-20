<x-mail::message>


# Welcome, {{ $user->name }}


Thanks for joining us! We are excited to have you on board.
<x-mail::button :url="'/'">
    Visit Site
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
