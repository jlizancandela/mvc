<?php


namespace App\Helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class sendmail_helper
{
    protected $mail;

    function __construct()
    {
        require 'config/env.php';

        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $host; // Cambia al servidor SMTP correspondiente
        $this->mail->SMTPAuth = $smtp_auth;
        $this->mail->Port = $port;
        $this->mail->setFrom($from, $fromName);
    }

    public function set_properpies($to, $subject, $body)
    {
        $this->mail->addAddress($to);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->isHTML(true);
        $this->mail->CharSet = 'UTF-8';
    }

    public function send()
    {
        try {
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
