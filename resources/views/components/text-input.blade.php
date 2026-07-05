@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm text-slate-900 bg-white focus:border-red-600 focus:ring-red-600'
    ]) }}
>
