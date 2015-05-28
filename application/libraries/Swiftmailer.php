<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//require_once(APPPATH . 'third_party/Swiftmailer/swift_required.php');
require_once('/home/libs/Swiftmailer/swift_required.php');

class CI_Swiftmailer {

    private $CI;
    public $sender;
    public $bcc;
    public $send_bcc = FALSE;
    public $emails_debug = FALSE;
    public $bcc_debug = FALSE;
    public $emails_debug_to = "pierre@greenpig.be";
    public $emails_dir;
    public $reply_to;

    public function __construct() {
        $this->CI = & get_instance();
        $this->sender = array($this->CI->config->item('email_addr') => $this->CI->config->item('email_name'));
        $this->bcc = array();
        $this->emails_dir = APPPATH . 'views/emails/';

        if (config_item('emails_debug')) {
            $this->emails_debug = config_item('emails_debug');
        }
        if (config_item('emails_debug_bcc')) {
            $this->bcc_debug = config_item('emails_debug_bcc');
        }
        if (config_item('emails_debug_addr')) {
            $this->emails_debug_to = config_item('emails_debug_addr');
        }
    }

    private function senderName($id_franchise = 0) {
        $id_franchise = ($id_franchise) ? $id_franchise : $this->CI->data['user']->id_franchise;
        if ($id_franchise > 0) {
            $franchise = $this->CI->data['franchises'][$id_franchise];
            $this->sender = $this->bcc = array($franchise->franchise_email => $franchise->franchise_name);
        } else {
            $this->sender = $this->bcc = array(config_item('email_addr') => config_item('email_name'));
        }
    }

    private function senderNameCompta($id_franchise = 0) {
        $id_franchise = ($id_franchise) ? $id_franchise : $this->CI->data['user']->id_franchise;
        if ($id_franchise > 0) {
            $franchise = $this->CI->data['franchises'][$id_franchise];
            $this->sender = $this->bcc = array($franchise->franchise_email_compta => $franchise->franchise_name);
        } else {
            $this->sender = $this->bcc = array(config_item('email_addr') => config_item('email_name'));
        }
    }

    // Send mail method
    public function send($to, $subject, $content, $attachfile = "", $id_franchise = "", $compta = FALSE) {
        if ($compta) {
            $this->senderNameCompta($id_franchise);
        } else {
            $this->senderName($id_franchise);
        }
        if ($this->emails_debug) {
            if (empty($this->emails_debug_to)) {
                die('IMPOSSIBLE D\'ENVOYER L\'EMAIL : VEUILLEZ DEFINIR &laquo; $this->emails_debug_to &raquo;');
            }
            $to = $this->emails_debug_to;
        }
        // Encoding check
        if (!mb_detect_encoding($subject, 'UTF-8', true)) {
            $subject = utf8_encode($subject);
        }
        if (!mb_detect_encoding($content, 'UTF-8', true)) {
            $content = utf8_encode($content);
        }
        $reply_to = ($this->reply_to) ? $this->reply_to : $this->sender;
        // Start up swiftmailer
        $transport = Swift_MailTransport::newInstance();
        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        // Create the message
        $message_sent = Swift_Message::newInstance()
                // Give the message a subject
                ->setSubject($subject)
                // Set the From address with an associative array
                ->setFrom($this->sender)
                // Set the To addresses with an associative array
                ->setTo($to)
                ->setReplyTo($reply_to)
                // Give it a body
                ->setBody($content, 'text/html');
        if (MY_DEBUG) {
            //$this->bcc['pierre@greenpig.be'] = "Pierre Greenpig";
        }
        if (!$this->bcc_debug && !empty($this->bcc) && $this->send_bcc) {
            $message_sent->setBcc($this->bcc);
        }
        // Optionally add any attachments
        if (!empty($attachfile)) {
            if (is_array($attachfile)) {
                foreach ($attachfile AS $v) {
                    $message_sent->attach(Swift_Attachment::fromPath($v));
                }
            } else {
                $message_sent->attach(Swift_Attachment::fromPath($attachfile));
            }
        }
        if (MY_DEBUG) {
            //echo '<pre>' . print_r($message_sent, true) . '</pre>';
            //die();
        }
        return $mailer->send($message_sent);
    }

    public function getEmailTemplate($tpl_name, $data = "") {
        $templateDir = $this->CI->smarty->smarty->getTemplateDir();
        $this->CI->smarty->smarty->setTemplateDir($this->emails_dir);
        $str = $this->CI->smarty->get_content('extends:_canvas.tpl|' . $tpl_name, $data);
        $this->CI->smarty->smarty->setTemplateDir($templateDir);
        return $str;
    }

    public function getEmailLayout($template_id, $data = "") {
        if (!is_object($this->CI->emails_templates_contents_model)) {
            $this->CI->load->model('emails_templates_contents_model');
        }
        if (!is_object($this->CI->emails_templates_model)) {
            $this->CI->load->model('emails_templates_model');
        }
        if (!empty($template_id)) {
            if (!is_array($template_id)) {
                $template_id = array($template_id);
            }
            $data['templates'] = $this->CI->emails_templates_model->get(array('where_in' => array("template_id" => $template_id)));
            $content = "";
            foreach ($data['templates'] AS $template) {
                $data['template'] = $template;
                $blocks = $this->CI->emails_templates_contents_model->get_by_template_id($template->template_id);
                foreach ($blocks AS $v) {
                    $data['block'] = ObjToArray($v);
                    $content .= $this->CI->smarty->fetch('template_editor.tpl', $data);
                }
            }
        }
        $canvas = ($data['template']->template_type == "contact") ? "_canvas_contact" : "_canvas";
        $canvas = "_canvas_contact";
        // Layout
        $templateDir = $this->CI->smarty->smarty->getTemplateDir();
        $this->CI->smarty->smarty->setTemplateDir($this->emails_dir);
        $str = $this->CI->smarty->get_content('extends:' . $canvas . '.tpl|eval:<{block name="content"}>' . $content . '<{/block}>', $data);
        // Replacement
        $str = str_replace('%%MARDI_1%%', getNextMardi(), $str);
        $str = str_replace('%%MARDI_2%%', getNextMardi(2), $str);
        $form_inscr_url = site_url(array('castings/formulaire'), FALSE) . '?d=' . $data['request_encrypted'] . '&i=' . $data['request_id'];
        $str = str_replace('http://%%FORM_INSCRIPTION%%', $form_inscr_url, $str);
        // Reset TPL dir
        $this->CI->smarty->smarty->setTemplateDir($templateDir);
        return $str;
    }

    public function getFullEmailTemplate($tpl_name, $data = "") {
        $templateDir = $this->CI->smarty->smarty->getTemplateDir();
        $this->CI->smarty->smarty->setTemplateDir($this->emails_dir);
        $str = $this->CI->smarty->get_content($tpl_name, $data);
        $this->CI->smarty->smarty->setTemplateDir($templateDir);
        return $str;
    }

}

?>