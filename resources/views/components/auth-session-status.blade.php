@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-bold text-sm text-green-400 italic text-right']) }}>
        {{ $status }}
    </div>
@endif

