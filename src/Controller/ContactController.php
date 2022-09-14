<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    #[IsGranted('ROLE_USER')]
    public function index(MailerInterface $mailer): Response
    { //team@gmail
       

        if(isset($_POST["email"])){
            $email = (new Email())
            ->from($_POST["email"])
            ->to('tiakotcheungoue@gmail.com')
            ->subject($_POST["subject"])
            ->html($_POST["message"]);

            $mailer->send($email);
        }
        $this->addFlash(
            'success',
            'your message has been taken into account !'
        );
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
