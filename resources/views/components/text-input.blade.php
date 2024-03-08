@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-black focus:border-facilityEaseYellow focus:ring-facilityEaseYellow rounded shadow-sm h-svh', 'style' => 'border-color: #d2d8dd; height: 38px;']) !!}>

