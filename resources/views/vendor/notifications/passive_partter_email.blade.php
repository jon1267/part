@component('mail::message')
<p>
    <img src="{{ asset('/images/notify_logo.png') }}" width="120px" alt="Small Logo">
</p>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

<p>
    <img src="{{ asset('/images/clock.jpg') }}" width="160px" alt="Clock">
</p>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('С наилучшими пожеланиями,')<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Если у Вас Проблемы с нажатием кнопки \":actionText\" , скопируйте и вставьте эту ссыку\n".
    'в адресной строке вашего браузера:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
