<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = '';
    public string $fromName   = '';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';
    public string $protocol  = 'mail';
    public string $mailPath  = '/usr/sbin/sendmail';

    public string $SMTPHost = '';
    public string $SMTPUser = '';
    public string $SMTPPass = '';
    public int    $SMTPPort = 25;
    public int    $SMTPTimeout = 60;
    public bool   $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'tls';


    public bool   $wordWrap = true;
    public int    $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'utf-8';
    public bool   $validate = true;
    public int    $priority = 3;

    public string $CRLF = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int  $BCCBatchSize = 200;
    public bool $DSN = false;

    public function __construct()
    {
        // Todas las configuraciones se toman del .env
        $this->SMTPHost = getenv('SMTP_HOST') ?: $this->SMTPHost;
        $this->SMTPUser = getenv('SMTP_USER') ?: $this->SMTPUser;
        $this->SMTPPass = getenv('SMTP_PASS') ?: $this->SMTPPass;
        $this->SMTPPort = (int)(getenv('SMTP_PORT') ?: $this->SMTPPort);
        $this->SMTPCrypto = getenv('SMTP_CRYPTO') ?: $this->SMTPCrypto;

        $this->fromEmail = getenv('MAIL_FROM_EMAIL') ?: $this->fromEmail;
        $this->fromName  = getenv('MAIL_FROM_NAME') ?: $this->fromName;
    }
}
