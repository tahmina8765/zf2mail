<?php

namespace Zf2mail\Controller;
use Zend\Mvc\Controller\AbstractActionController;

class EmailersController extends AbstractActionController
{

    protected $mailConfig;

    function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        
    }

    /**
     *
     * @param type $options
     *  $options['html_message'];
     *  $options['text_message'];
     *  $options['subject'];
     *  $options['from'];
     *  $options['to'];
     *  $options['cc'];
     *  $options['bcc'];
     * @return type boolien
     */
    public static function sendMail($options = array())
    {

        $return = false;

        /**
         * Data preparation
         */
        $emailer = new \Zf2mail\Controller\EmailersController();
        $siteurl = $emailer->siteURL();
        $predefined_signature = "ZF2Email";
        $message_type = empty($options['message_type']) ? 'html' : $options['message_type'];
        $message = empty($options[$message_type . '_message']) ? '' : $options[$message_type . '_message'];
        $signature = empty($options['signature']) ? '<br><br>' . $predefined_signature : $options['signature'];
        $footer = empty($options['footer']) ? '' : $options['footer'];

        if (!empty($options['to'])) {
            if (is_array($options['to'])) {
                $to = implode(', ', $options['to']);
            } else {
                $to = $options['to'];
            }
        }
        if (!empty($options['cc'])) {
            if (is_array($options['cc'])) {
                $cc = implode(', ', $options['cc']);
            } else {
                $cc = $options['cc'];
            }
        }

        $bcc = empty($options['bcc']) ? '' : implode(', ', $options['bcc']);
        $from = empty($options['from']) ? 'donotreply@yourdomain.com' : trim($options['from']);
        $form_name = empty($options['from_name']) ? 'Your Domain' : trim($options['from_name']);
        $subject = empty($options['subject']) ? '' : trim($options['subject']);
        $returnpath = "-f" . $from;

        if (!empty($message)) {
            $message = $message . $signature . $footer;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= 'From: ' . $form_name . ' <' . $from . '>' . "\r\n";

            if (!empty($cc)) {
                $headers .= 'cc: ' . $cc . '' . "\r\n";
            }
            if (!empty($bcc)) {
                $headers .= 'bcc: ' . $bcc . ' ' . "\r\n";
            }

            $return = mail($to, $subject, $message, $headers, $returnpath);
        }

        return $return;
    }

    public static function siteURL()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return $protocol . $domainName;
    }

}
