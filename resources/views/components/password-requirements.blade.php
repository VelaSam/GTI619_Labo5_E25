@php
    $user = \App\Models\User::first();
    $requirements = $user ? $user->getPasswordRequirements() : [
        'min_length' => 12,
        'require_lowercase' => true,
        'require_uppercase' => true,
        'require_digit' => true,
        'require_special' => true,
    ];
@endphp

<div class="password-requirements">
    <h6>Exigences du mot de passe:</h6>
    <ul class="list-unstyled">
        <li><i class="fas fa-check text-success"></i> Au moins {{ $requirements['min_length'] }} caractères</li>
        @if($requirements['require_lowercase'])
            <li><i class="fas fa-check text-success"></i> Au moins une lettre minuscule</li>
        @endif
        @if($requirements['require_uppercase'])
            <li><i class="fas fa-check text-success"></i> Au moins une lettre majuscule</li>
        @endif
        @if($requirements['require_digit'])
            <li><i class="fas fa-check text-success"></i> Au moins un chiffre</li>
        @endif
        @if($requirements['require_special'])
            <li><i class="fas fa-check text-success"></i> Au moins un caractère spécial (!@#$%^&*)</li>
        @endif
    </ul>
</div>
