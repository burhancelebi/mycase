@component('mail::message')
    # Task Completed

    The task "{{ $task->title }}" has been completed.

    Thanks,
    {{ config('app.name') }}
@endcomponent
