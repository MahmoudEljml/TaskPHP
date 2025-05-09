<?php


if (!function_exists('send_mail')) {
    /**
     * send_mail Used to send mail to user
     * @param array<string> $mails
     * @param string $subject
     * @param string $message
     * @return bool
     */
    function send_mail(array $mails, string $subject, string $message): bool
    {
        if (config('mail.encrypt') == 'smtp') {
            ini_set('SMTP', config('mail.smtp_domain'));
            ini_set('smtp_port', config('mail.smtp_port'));
        }

        ini_set('sendmail_from', config('mail.FROM_ADDRESS'));

        $headers = 'MIME-Version: 1.0' . '\r\n';
        $headers .= 'Content-type: text/html;charset=UTF-8' . '\r\n';
        $headers .= 'From: ' . config('mail.FROM_ADDRESS') . '\r\n';
        return mail($mails[0], $subject, $message, $headers);
    }
}

// var_dump(
//     send_mail(
//         ['welcome'],
//         "qweqwe",
//         "qweqwe",
//     )
// );
