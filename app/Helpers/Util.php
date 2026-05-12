<?php

namespace App\Helpers;

use App\Models\ConfiguracionModel;
use App\Models\MensajeModel;
use App\Models\PedidoDetalleModel;
use App\Models\PedidoModel;

class Util
{
    protected $email;
    protected $mailFromEmail;
    protected $mailFromName;
    public function __construct()
    {
        $this->email = \Config\Services::email();
        helper('filesystem');


        $config['protocol'] = 'smtp';
        $config['charset']  = 'utf-8';
        $config['SMTPHost'] = getenv('SMTP_HOST');
        $config['SMTPUser'] = getenv('SMTP_USER');
        $config['SMTPPass'] = getenv('SMTP_PASS');
        $config['SMTPPort'] = (int) getenv('SMTP_PORT');
        $config['SMTPTimeout'] = 30;
        $config['mailType'] = 'html';
        $config['wordwrap'] = true;

        // 🔹 Capturar los datos del remitente desde el .env
        $this->mailFromEmail = getenv('MAIL_FROM_EMAIL');
        $this->mailFromName  = getenv('MAIL_FROM_NAME');

        $this->email->initialize($config);
    }

    public static function urls_amigables($url)
    {

        // Tranformamos todo a minusculas

        $url = strtolower($url);
        //Rememplazamos caracteres especiales latinos
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n');
        $url = str_replace($find, $repl, $url);

        $find = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
        $repl = array('A', 'E', 'I', 'O', 'U', 'N');
        $url = str_replace($find, $repl, $url);

        // Añaadimos los guiones
        $find = array(' ', '&', '\r\n', '\n', '+');
        $url = str_replace($find, '-', $url);
        // Eliminamos y Reemplazamos demás caracteres especiales
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $repl = array('', '-', '');
        $url = preg_replace($find, $repl, $url);
        return $url;
    }

    public static function generatePassword($length)
    {
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $length; $i++) {
            $key .= substr($pattern, mt_rand(0, $max), 1);
        }
        return $key;
    }

    public function compararExtension($extension)
    {
        $extImage = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'tiff', 'bmp', 'ai', 'cmp', 'avif', 'heif', 'webp', 'jpg'];
        $extPowerPoint = ['pptx', 'ppt', 'ppsx', 'odp', 'pps'];
        $extPdf = ['pdf'];
        $extExcel = ['xlsx', 'xls', 'csv', 'xlsm', 'xlsb', 'pps', 'xltx', 'xltm', 'xlt'];
        $extWord = ['doc', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'xltm', 'html'];
        $extAudio = ['mp3', 'wav', 'ogg', 'webm', 'aac'];
        $extVideo = ['mp4', 'webm', 'mov', 'wmv', 'avi', 'flv', 'mkv'];
        $extZip = ['zip', 'gzip', 'bzip2', 'tar', 'rar', '7z'];

        if (in_array($extension, $extImage)) {
            return "imagen";
        } else if (in_array($extension, $extPowerPoint)) {
            return "powerPoint";
        } else if (in_array($extension, $extPdf)) {
            return "pdf";
        } else if (in_array($extension, $extExcel)) {
            return "excel";
        } else if (in_array($extension, $extWord)) {
            return "word";
        } else if (in_array($extension, $extAudio)) {
            return "audio";
        } else if (in_array($extension, $extVideo)) {
            return "video";
        } else if (in_array($extension, $extZip)) {
            return "compress";
        } else {
            return "archivo";
        }
    }

    public static function reemplazo($valor1, $valor2, $cadena)
    {
        return str_replace($valor1, $valor2, $cadena);
    }

  
}
