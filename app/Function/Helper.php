<?php

namespace App\Function;
use Illuminate\Support\Str;

// heper di venta un raccoglitore di metodi
class Helper{
    // gli passo il model così per qualsiasi model abbiamo la funzione che ci genera lo slug
    public static function generateSlug($string, $model){
            // della classe Str, usiamo il metodo statico slug
        $slug = Str::slug($string, '-');
        $original_slug = $slug;

        $exixts = $model::where('slug', $slug)->first();
        $c = 1;

        while($exixts){
            $slug = $original_slug . '-' . $c;
            $exixts = $model::where('slug', $slug)->first();
            $c++;
        }

        return $slug;
    }
    public static function formatDate($data){
        $date = date_create($data);
        return date_format($date, 'd/m/Y');
    }
}
