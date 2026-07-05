<button {{ $attributes->merge(['type' => 'submit', 'class' => 'gsm-button-danger']) }}>
    {{ $slot }}
</button>
