<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact/success", name="contact_success")
     */
    public function success(): Response
    {
        return $this->render('contact/success.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();
            $email = (new Email())
                ->from($data['email']) // ca doit être adresse du visiteur
                ->to('michael@xonatis.com') // notre adresse admin de reception
                ->subject('Demande de contact') // objet du mail
                ->text($data['message']) // corps du mail
                ->html($data['message']); // aussi le corps du mail

            $mailer->send($email);

            return $this->redirectToRoute('contact_success', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form
        ]);
    }
}
