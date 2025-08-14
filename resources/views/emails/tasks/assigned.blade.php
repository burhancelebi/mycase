@component('mail::message')
    # Merhaba {{ $task->assignedUser->name }},

    Size yeni bir görev atandı.

    **Görev:** {{ $task->title }}
    **Açıklama:** {{ $task->description }}

    Teşekkürler,
    {{ config('app.name') }}
@endcomponent
