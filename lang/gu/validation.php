<?php

return [

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'accepted_if' => 'El campo :attribute debe ser aceptado cuando :other sea :value.',
    'active_url' => 'El campo :attribute debe ser una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo debe contener letras.',
    'alpha_dash' => 'El campo :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo debe contener letras y números.',
    'array' => 'El campo :attribute debe ser un array.',
    'ascii' => 'El campo :attribute solo debe contener caracteres alfanuméricos y símbolos de un solo byte.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',

    'between' => [
        'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
        'file' => 'El campo :attribute debe tener entre :min y :max kilobytes.',
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',

    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'can' => 'El campo :attribute contiene un valor no autorizado.',
    'confirmed' => 'La confirmación del campo :attribute no coincide.',
    'contains' => 'El campo :attribute le falta un valor requerido.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El campo :attribute debe ser una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute debe coincidir con el formato :format.',
    'decimal' => 'El campo :attribute debe tener :decimal decimales.',
    'declined' => 'El campo :attribute debe ser rechazado.',
    'declined_if' => 'El campo :attribute debe ser rechazado cuando :other sea :value.',
    'different' => 'El campo :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe ser de :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'doesnt_end_with' => 'El campo :attribute no debe terminar con uno de los siguientes: :values.',
    'doesnt_start_with' => 'El campo :attribute no debe comenzar con uno de los siguientes: :values.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes: :values.',
    'enum' => 'El :attribute seleccionado no es válido.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'extensions' => 'El campo :attribute debe tener una de las siguientes extensiones: :values.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',

    'gt' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'gte' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'hex_color' => 'El campo :attribute debe ser un color hexadecimal válido.',
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado es inválido.',
    'in_array' => 'El campo :attribute debe existir en :other.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'list' => 'El campo :attribute debe ser una lista.',
    'lowercase' => 'El campo :attribute debe estar en minúsculas.',

    'lt' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'lte' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'mac_address' => 'El campo :attribute debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'max_digits' => 'El campo :attribute no debe tener más de :max dígitos.',
    'mimes' => 'El campo:attribute debe ser un archivo del tipo: :values.',
    'mimetypes' => 'El campo :attribute debe ser un archivo del tipo: :values.',

    'min' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'min_digits' => 'El campo :attribute debe tener al menos :min dígitos.',
    'missing' => 'El campo :attribute debe estar ausente.',
    'missing_if' => 'El campo :attribute debe estar ausente cuando :other sea :value.',
    'missing_unless' => 'El campo :attribute debe estar ausente a menos que :other sea :value.',
    'missing_with' => 'El campo :attribute debe estar ausente cuando :values esté presente.',
    'missing_with_all' => 'El campo :attribute debe estar ausente cuando :values estén presentes.',
    'multiple_of' => 'El campo :attribute debe ser un múltiplo de :value.',
    'not_in' => 'El :attribute seleccionado no es válido.',
    'not_regex' => 'El formato del campo :attribute no es válido.',
    'numeric' => 'El campo :attribute debe ser un número.',

    'password' => [
        'letters' => 'El campo :attribute debe contener al menos una letra.',
        'mixed' => 'El campo :attribute debe contener al menos una letra mayúscula y una minúscula.',
        'numbers' => 'El campo :attribute debe contener al menos un número.',
        'symbols' => 'El campo :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'El :attribute proporcionado ha aparecido en una filtración de datos. Por favor, elija un :attribute diferente.',

    ],
   'present' => 'El campo :attribute debe estar presente.',
    'present_if' => 'El campo :attribute debe estar presente cuando :other sea :value.',
    'present_unless' => 'El campo :attribute debe estar presente a menos que :other sea :value.',
    'present_with' => 'El campo :attribute debe estar presente cuando :values esté presente.',
    'present_with_all' => 'El campo :attribute debe estar presente cuando :values estén presentes.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other sea :value.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',
    'regex' => 'El formato del campo :attribute es inválido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other es aceptado.',
    'required_if_declined' => 'El campo :attribute es obligatorio cuando :other es rechazado.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values esté presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values estén presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no esté presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values esté presente.',
    'same' => 'El campo :attribute debe coincidir con :other.',

    'size' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe ser mayor a :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',

    ],
    'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes: :values.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
    'unique' => 'El :attribute ya ha sido tomado.',
    'uploaded' => 'El campo :attribute no se pudo cargar.',
    'uppercase' => 'El campo :attribute debe estar en mayúsculas.',
    'url' => 'El campo :attribute debe ser una URL válida.',
    'ulid' => 'El campo :attribute debe ser un ULID válido.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',


    'custom' => [
        'nombre-del-atributo' => [
            'nombre-de-la-regla' => 'mensaje-personalizado',
        ],
    ],

    'attributes' => [],

];
