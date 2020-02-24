<?php

namespace App\Service;


use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerManager
{
    /** @var MailerInterface  */
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function confirmRegistration(User $user, $plainPassword)
    {
        $email = (new TemplatedEmail())
            ->from('josselinluneau@gmail.com')
            ->to(new Address($user->getEmail()))
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Congratulation you made the best choice !')
            // path of the Twig template to render
            ->htmlTemplate('emails/signup.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => $user->getUsername(),
                'pwd' => $plainPassword,
            ]);

        $this->mailer->send($email);
    }
}