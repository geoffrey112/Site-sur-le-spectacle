<?php


namespace App;


use App\Entity\Contact;
use Twig\Environment;

class Notification
{
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function  notify(Contact $contact) {
        $message = (new \Swift_Message())
            ->setFrom($contact->getEmail())
            ->setTo('webmasson.d@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('template_email_form.html.twig', [
                'contact' => $contact
            ]), 'text/html');
            $this->mailer->send($message);
    }
}