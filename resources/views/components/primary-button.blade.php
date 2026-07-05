<button {{ $attributes->merge(['type' => 'submit', 'class' => 'gsm-button-primary']) }}>
    {{ $slot }}
</button>
