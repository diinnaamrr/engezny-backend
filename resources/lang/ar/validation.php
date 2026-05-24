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

    'accepted' => 'يجب قبول الـ :attribute.',
    'active_url' => 'الـ :attribute ليس رابطًا صحيحًا.',
    'after' => 'يجب أن يكون الـ :attribute تاريخًا لاحقًا لـ :date.',
    'after_or_equal' => 'يجب أن يكون الـ :attribute تاريخًا لاحقًا أو مطابقًا لـ :date.',
    'alpha' => 'يجب أن يحتوي الـ :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي الـ :attribute على أحرف وأرقام وشرطات فقط.',
    'alpha_num' => 'يجب أن يحتوي الـ :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون الـ :attribute مصفوفة.',
    'before' => 'يجب أن يكون الـ :attribute تاريخًا سابقًا لـ :date.',
    'before_or_equal' => 'يجب أن يكون الـ :attribute تاريخًا سابقًا أو مطابقًا لـ :date.',
    'between' => [
        'numeric' => 'يجب أن يكون الـ :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الـ :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute بين :min و :max حرفًا/أحرف.',
        'array' => 'يجب أن يحتوي الـ :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean' => 'يجب أن يكون حقل الـ :attribute صحيحًا (true) أو خاطئًا (false).',
    'confirmed' => 'تأكيد الـ :attribute غير مطابق.',
    'date' => 'الـ :attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون الـ :attribute تاريخًا مطابقًا لـ :date.',
    'date_format' => 'الـ :attribute لا يطابق الصيغة :format.',
    'different' => 'يجب أن يكون الـ :attribute و :other مختلفين.',
    'digits' => 'يجب أن يحتوي الـ :attribute على :digits أرقام.',
    'digits_between' => 'يجب أن يحتوي الـ :attribute على أرقام تتراوح بين :min و :max.',
    'dimensions' => 'يحتوي الـ :attribute على أبعاد صورة غير صالحة.',
    'distinct' => 'يحتوي حقل الـ :attribute على قيمة مكررة.',
    'email' => 'يجب أن يكون الـ :attribute عنوان بريد إلكتروني صالحًا.',
    'ends_with' => 'يجب أن ينتهي الـ :attribute بأحد القيم التالية: :values.',
    'exists' => 'الـ :attribute المحدد غير صالح.',
    'file' => 'يجب أن يكون الـ :attribute ملفًا.',
    'filled' => 'يجب أن يحتوي حقل الـ :attribute على قيمة.',
    'gt' => [
        'numeric' => 'يجب أن يكون الـ :attribute أكبر من :value.',
        'file' => 'يجب أن يكون حجم الـ :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute أكبر من :value حرفًا/أحرف.',
        'array' => 'يجب أن يحتوي الـ :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن يكون الـ :attribute أكبر من أو يساوي :value.',
        'file' => 'يجب أن يكون حجم الـ :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute أكبر من أو يساوي :value حرفًا/أحرف.',
        'array' => 'يجب أن يحتوي الـ :attribute على الأقل على :value عناصر/عنصر.',
    ],
    'image' => 'يجب أن يكون الـ :attribute صورة.',
    'in' => 'الـ :attribute المحدد غير صالح.',
    'in_array' => 'حقل الـ :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الـ :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون الـ :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون الـ :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون الـ :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون الـ :attribute نصًا من نوع JSON صالحًا.',
    'lt' => [
        'numeric' => 'يجب أن يكون الـ :attribute أصغر من :value.',
        'file' => 'يجب أن يكون حجم الـ :attribute أصغر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute أصغر من :value حرفًا/أحرف.',
        'array' => 'يجب أن يحتوي الـ :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن يكون الـ :attribute أصغر من أو يساوي :value.',
        'file' => 'يجب أن يكون حجم الـ :attribute أصغر من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute أصغر من أو يساوي :value حرفًا/أحرف.',
        'array' => 'يجب ألا يحتوي الـ :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب ألا يكون الـ :attribute أكبر من :max.',
        'file' => 'يجب ألا يكون حجم الـ :attribute أكبر من :max كيلوبايت.',
        'string' => 'يجب ألا يكون طول الـ :attribute أكبر من :max حرفًا/أحرف.',
        'array' => 'يجب ألا يحتوي الـ :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون الـ :attribute ملفًا من نوع: :values.',
    'mimetypes' => 'يجب أن يكون الـ :attribute ملفًا من نوع: :values.',
    'min' => [
        'numeric' => 'يجب أن يكون الـ :attribute على الأقل :min.',
        'file' => 'يجب أن يكون حجم الـ :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute على الأقل :min حرفًا/أحرف.',
        'array' => 'يجب أن يحتوي الـ :attribute على الأقل على :min عناصر/عنصر.',
    ],
    'not_in' => 'الـ :attribute المحدد غير صالح.',
    'not_regex' => 'صيغة الـ :attribute غير صالحة.',
    'numeric' => 'يجب أن يكون الـ :attribute رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب توفير حقل الـ :attribute.',
    'regex' => 'صيغة الـ :attribute غير صالحة.',
    'required' => 'حقل الـ :attribute مطلوب.',
    'required_if' => 'حقل الـ :attribute مطلوب عندما يكون :other هو :value.',
    'required_unless' => 'حقل الـ :attribute مطلوب إلا إذا كان :other موجودًا في :values.',
    'required_with' => 'حقل الـ :attribute مطلوب عندما يكون :values موجودًا.',
    'required_with_all' => 'حقل الـ :attribute مطلوب عندما تكون جميع :values موجودة.',
    'required_without' => 'حقل الـ :attribute مطلوب عندما لا يكون :values موجودًا.',
    'required_without_all' => 'حقل الـ :attribute مطلوب عندما لا يكون أي من :values موجودًا.',
    'same' => 'يجب أن يتطابق الـ :attribute مع :other.',
    'size' => [
        'numeric' => 'يجب أن يكون الـ :attribute مساويًا لـ :size.',
        'file' => 'يجب أن يكون حجم الـ :attribute مساويًا لـ :size كيلوبايت.',
        'string' => 'يجب أن يكون طول الـ :attribute مساويًا لـ :size حرفًا/أحرف.',
        'array' => 'يجب أن يحتوي الـ :attribute على :size عناصر/عنصر بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ الـ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون الـ :attribute نصًا.',
    'timezone' => 'يجب أن يكون الـ :attribute منطقة زمنية صالحة.',
    'unique' => 'قيمة الـ :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل الـ :attribute.',
    'url' => 'صيغة الـ :attribute غير صالحة.',
    'uuid' => 'يجب أن يكون الـ :attribute رقم UUID صالحًا.',
    
    // Modern Laravel 9/10/11 Rules
    'ascii' => 'يجب أن يحتوي الـ :attribute على أحرف وأرقام ورموز قياسية فقط.',
    'current_password' => 'كلمة المرور الحالية غير صحيحة.',
    'declined' => 'يجب رفض الـ :attribute.',
    'declined_if' => 'يجب رفض الـ :attribute عندما يكون :other هو :value.',
    'doesnt_end_with' => 'يجب ألا ينتهي الـ :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ الـ :attribute بأحد القيم التالية: :values.',
    'enum' => 'الـ :attribute المحدد غير صالح.',
    'lowercase' => 'يجب أن يكون الـ :attribute بحروف صغيرة.',
    'mac_address' => 'يجب أن يكون الـ :attribute عنوان MAC صحيحًا.',
    'missing' => 'يجب أن يكون حقل الـ :attribute مفقودًا.',
    'missing_if' => 'يجب أن يكون حقل الـ :attribute مفقودًا عندما يكون :other هو :value.',
    'missing_unless' => 'يجب أن يكون حقل الـ :attribute مفقودًا إلا إذا كان :other موجودًا في :values.',
    'missing_with' => 'يجب أن يكون حقل الـ :attribute مفقودًا عندما يكون :values موجودًا.',
    'missing_with_all' => 'يجب أن يكون حقل الـ :attribute مفقودًا عندما تكون جميع :values موجودة.',
    'multiple_of' => 'يجب أن يكون الـ :attribute من مضاعفات :value.',
    'prohibited' => 'حقل الـ :attribute محظور.',
    'prohibited_if' => 'حقل الـ :attribute محظور عندما يكون :other هو :value.',
    'prohibited_unless' => 'حقل الـ :attribute محظور إلا إذا كان :other موجودًا في :values.',
    'prohibits' => 'حقل الـ :attribute يمنع :other من التواجد.',
    'required_array_keys' => 'يجب أن يحتوي حقل الـ :attribute على مدخلات لـ: :values.',
    'uppercase' => 'يجب أن يكون الـ :attribute بحروف كبيرة.',

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
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'username' => 'اسم المستخدم',
        'email' => 'البريد الإلكتروني',
        'first_name' => 'الاسم الأول',
        'last_name' => 'اسم العائلة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'البلد',
        'address' => 'العنوان',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'الجنس',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'العنوان',
        'content' => 'المحتوى',
        'description' => 'الوصف',
        'excerpt' => 'الملخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'متاح',
        'size' => 'الحجم',
        'phone_or_email' => 'رقم الهاتف أو البريد الإلكتروني',
    ],

];

