<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RutValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^(\d{7,8})-([\dkK])$/', (string) $value, $partes)){
            $fail('El RUT debe tener el formato 12345678-9, sin puntos');
            return;
        }
        
        [$completo, $numero, $dv] = $partes;

        if (preg_match('/^(\d)\1+$/', $numero)) {
            $fail('El RUT ingresado no corresponde a una persona real.');
            return;
        }

        if (strtolower($dv) !== $this->calcularDv($numero)) {
            $fail('El digito verificadxor del RUT no es correcto');
        }
    }

    private function calcularDv(string $numero): string
    {
        $suma = 0;
        $multiplicador = 2;

        foreach (array_reverse(str_split($numero)) as $digito) {
            $suma += (int) $digito * $multiplicador;
            $multiplicador = $multiplicador === 7 ? 2 : $multiplicador + 1;
        }

        $resto = 11 - ($suma % 11);

        return match ($resto) {
            11 => '0',
            10 => 'k',
            default => (string) $resto,
        };
    }
}
