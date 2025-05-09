<?php

return [
    'FROM_NAME' => 'phpanonymous',
    'FROM_ADDRESS' => 'norplay@php.net',
    'encrypt' => 'smtp', // sendmail , SSL, or TSL
    'smtp_domain' => 'localhost', // MailHog يعمل على localhost
    'smtp_username' => '', // لا حاجة لاسم مستخدم مع MailHog
    'smtp_password' => '', // لا حاجة لكلمة مرور مع MailHog
    'smtp_port' => 1025, // المنفذ الافتراضي لـ MailHog
];