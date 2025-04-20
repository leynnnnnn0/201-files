<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasEnumOptions
{
    public static function options()
    {
        $data = array_column(self::cases(), 'value');
        $values = collect($data)->map(function ($item) {
            if (str_contains('cos/jop', $item)) return Str::upper($item);
            return Str::title($item);
        });
        return array_combine($data, $values->toArray());
    }
}
