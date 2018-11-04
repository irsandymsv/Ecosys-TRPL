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

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'gt'                   => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'string'  => 'The :attribute must be greater than :value characters.',
        'array'   => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        'string'  => 'The :attribute must be greater than or equal :value characters.',
        'array'   => 'The :attribute must have :value items or more.',
    ],
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

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
        'nama'          =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'max'       =>  'Data tidak valid, harap masukkan data dengan benar',
            'regex'     =>  'Data tidak valid, harap masukkan data dengan benar',
        ],
        'username'      =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'unique'    =>  'Data tidak valid, harap masukkan data dengan benar',
            'alpha_dash'=>  'Data tidak valid, harap masukkan data dengan benar',
            'max'       =>  'Data tidak valid, harap masukkan data dengan benar',
        ],
        'email'         =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'email'     =>  'Data tidak valid, harap masukkan data dengan benar',
            'max'       =>  'Data tidak valid, harap masukkan data dengan benar',
            'unique'    =>  'Data tidak valid, harap masukkan data dengan benar',
        ],
        'password'      =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'min'       =>  'Data tidak valid, harap masukkan data dengan benar',
            'regex'     =>  'Data tidak valid, harap masukkan data dengan benar'
        ],
        'jenis_kelamin' =>[
            'required'  =>  'Harap isi data dengan lengkap',
        ],
        'alamat_asal'   => [
            'required'  =>  'Harap isi data dengan lengkap',
            'max'       =>  'Data tidak valid, harap masukkan data dengan benar',
            'min'       =>  'Data tidak valid, harap masukkan data dengan benar',
            'not_regex' =>  'Data tidak valid, harap masukkan data dengan benar'
        ],
        'id_prov_asal'  =>[
            'required'  =>  'Harap isi data dengan lengkap',
        ],
        'id_kab_asal'   =>[
          'required'    =>  'Harap isi data dengan lengkap',  
        ],
        'alamat_tinggal'    =>[
            'required'      =>  'Harap isi data dengan lengkap',
            'max'           =>  'Data tidak valid, harap masukkan data dengan benar',
            'min'           =>  'Data tidak valid, harap masukkan data dengan benar',
            
        ],
        'profesi_id'    =>[
            'required'  =>  'Harap isi data dengan lengkap',
        ],
        'tempat_lahir'  =>[
            'required'  => 'Harap isi data dengan lengkap',
            'alpha'     => 'Data tidak valid, harap masukkan data dengan benar',
            'max'       => 'Data tidak valid, harap masukkan data dengan benar',
            'regex'     => 'Data tidak valid, harap masukkan data dengan benar'
        ],
        'tanggal_lahir' =>[
            'required'  => 'Harap isi data dengan lengkap',
        ],
        'no_hp'         =>[
            'required'  =>  'Harap isi data dengan lengkap',
            // 'numeric'   =>  'Harap hanya masukkan angka',
            'digits_between'    =>  'Data tidak valid, harap masukkan data dengan benar',
            'unique'    =>  'Data tidak valid, harap masukkan data dengan benar',
        ],
        'nik'           =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'unique'    =>  'Data tidak valid, harap masukkan data dengan benar',
            'digits'    =>  'Data tidak valid, harap masukkan data dengan benar',
        ],
        'id_role'       => [
            'required'  =>  'Harap isi data dengan lengkap',
        ],
        'koordinat'     =>[
            'required'  =>  'Harap isi semua kolom dan pilihan',
        ],
        'judul'         =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'min'       =>  'Data tidak valid, harap masukkan data dengan benar',
            'unique'    =>  'Data tidak valid, harap masukkan data dengan benar',
        ],
        'isi'           => [
            'required'  =>  'Harap isi data dengan lengkap',
            'min'       => 'Data tidak valid, harap masukkan data dengan benar',
        ],
        'tag'           =>[
            'required'  =>  'Harap isi data dengan lengkap',
            'prof'      =>  'Harap isi data dengan lengkap',
        ]

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

    'attributes' => [],

];
