<?php

/**
 * PHPMaker 2021 configuration file (Development)
 */

return [
    "Databases" => [
        "DB" => ["id" => "DB", "type" => "MYSQL", "qs" => "`", "qe" => "`", "host" => "sql312.main-hosting.eu", "port" => "3306", "user" => "u431482316_sidakuidata", "password" => "Gampang1234", "dbname" => "u431482316_sidakuidata"],
        "sibakul" => ["id" => "sibakul", "type" => "MYSQL", "qs" => "`", "qe" => "`", "host" => "103.83.176.20", "port" => "3402", "user" => "kumkm", "password" => "buk4LAPAK", "dbname" => "sibakul"]
    ],
    "SMTP" => [
        "PHPMAILER_MAILER" => "smtp", // PHPMailer mailer
        "SERVER" => "smtp.gmail.com", // SMTP server
        "SERVER_PORT" => 587, // SMTP server port
        "SECURE_OPTION" => "tls",
        "SERVER_USERNAME" => "sidakuikabbantul@gmail.com", // SMTP server user name
        "SERVER_PASSWORD" => "nnjiqfeekumhlmjd", // SMTP server password
    ],
    "JWT" => [
        "SECRET_KEY" => "u9Voau43alK8x8eu", // API Secret Key
        "ALGORITHM" => "HS512", // API Algorithm
        "AUTH_HEADER" => "X-Authorization", // API Auth Header (Note: The "Authorization" header is removed by IIS, use "X-Authorization" instead.)
        "NOT_BEFORE_TIME" => 0, // API access time before login
        "EXPIRE_TIME" => 600 // API expire time
    ]
];
