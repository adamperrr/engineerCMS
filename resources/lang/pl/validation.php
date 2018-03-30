<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"             => ":attribute musi zostać zaakceptowane.", //yes, 1, true
    "active_url"           => ":attribute nie jest prawidłowym adresem URL.",
    "after"                => ":attribute musi być datą późniejszą niż :date.",
    'after_or_equal'       => ":attribute musi być datą późniejszą lub równą do :date.",
    "alpha"                => ":attribute może zawierać tylko litery.",
    "alpha_dash"           => ":attribute może zawierać tylko litery, cyfry i podkreślenia.",
    "alpha_num"            => ":attribute może zawierać tylko litery i cyfry.",
    "array"                => ":attribute musi być tablicą.",
    "before"               => ":attribute musi być datą wcześniejszą niż :date.",
    'before_or_equal'      => ":attribute musi być datą wcześniejszą lub równą do :date.",
    "between"              => [
        "numeric" => ":attribute musi być wartością pomiędzy :min i :max.",
        "file"    => ":attribute musi mieć pomiędzy :min a :max kilobajtów.",
        "string"  => ":attribute musi mieć pomiędzy :min a :max znaków.",
        "array"   => ":attribute musi mieć pomiędzy :min a :max pozycji.",
    ],
    "boolean"              => "pole :attribute musi być true lub false",
    "confirmed"            => ":attribute confirmation does not match.",
    "date"                 => ":attribute nie jest prawidłową datą.",
    "date_format"          => ":attribute nie zgadza się z formatem :format.",
    "different"            => ":attribute i :other muszą być różne.",
    "digits"               => ":attribute musi mieć :digits cyfr.",
    "digits_between"       => ":attribute musi mieć pomiędzy :min a :max cyfr.",
    'dimensions'           => ":attribute ma niewłaściwe wymiary obrazu",
    'distinct'             => ":attribute ma zduplikowaną wartość",
    "email"                => ":attribute must be a valid email address.",
    "exists"               => "wybrany :attribute jest nieprawidłowy.",
    'file'                 => ":attribute musi być folderem.",
    'filled'               => ":attribute musi mieć podaną wartość",
    "image"                => ":attribute musi być obrazkiem.",
    "in"                   => "wybrany :attribute jest nieprawidłowy.",
    'in_array'             => 'The :attribute field does not exist in :other.',
    "integer"              => ":attribute musi być liczbą.",
    "ip"                   => ":attribute musi być poprawnym adresem IP.",
    'ipv4'                 => ":attribute musi być prawidłowym adresem IPv4.",
    'ipv6'                 => ":attribute musi być prawidłowym adresem IPv6",
    'json'                 => ":attribute musi być prawidłowym ciągiem JSON.",
    "max"                  => array(
        "numeric" => ":attribute nie może być większy niż :max.",
        "file"    => ":attribute nie może być większy niż :max kilobajtów.",
        "string"  => ":attribute nie może być dłuższy niż :max znaków.",
        "array"   => ":attribute nie może mieć więcej niż :max pozycji.",
    ),
    "mimes"                => ":attribute musi być plikiem typu: :values.",
    'mimetypes'            => ":attribute musi być plikiem typu: :values.",
    "min"                  => array(
        "numeric" => ":attribute musi większy lub równy :min.",
        "file"    => ":attribute musi mieć co najmniej :min kilobajtów.",
        "string"  => ":attribute musi mieć co najmniej :min znaków.",
        "array"   => ":attribute musi mieć co najmniej :min pozycji.",
    ),
    "not_in"               => "wybrany :attribute jest nieprawidłowy.",
    "numeric"              => ":attribute must be a number.",
    'present'              => ":attribute musi być aktualny.",
    "regex"                => "format :attribute jest nieprawidłowy",
    "required"             => "pole :attribute jest wymagane.",
    "required_if"          => "pole :attribute jest wymagane, gdy :other ma wartość :value.",
    'required_unless'      => ":attribute jest wymagane chyba, że :other zawiara wartość :values.",
    "required_with"        => "pole :attribute jest wymagane, gdy :values są zdefiniowane.",
    "required_with_all"    => "pole :attribute jest wymagane, gdy :values są zdefiniowane.",
    "required_without"     => "pole :attribute jest wymagane, gdy :values nie są zdefiniowane.",
    "required_without_all" => "pole :attribute jest wymagane, gdy żadne z :values nie są zdefiniowane.",
    "same"                 => ":attribute i :other muszą być takie same.",
    "size"                 => [
        "numeric" => ":attribute must be :size.",
        "file"    => ":attribute musi mieć :size kilobajtów.",
        "string"  => ":attribute musi mieć :size znaków.",
        "array"   => ":attribute musi zawierać :size pozycji.",
    ],
    'string'               => ":attribute musi być ciągiem tekstowym.",
    'timezone'             => ":attribute musi być poprawną strefą czasową.",
    "unique"               => ":attribute jest już zajęty.",
    'uploaded'             => ":attribute wczytywanie nie powiodło się.",
    "url"                  => "format :attribute jest nieprawidłowy.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'username' => 'nazwa użytkownika'
    ],
];
