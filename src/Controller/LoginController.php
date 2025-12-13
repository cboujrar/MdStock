<?php
namespace App\Controller;

use App\Entity\OublierPass;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController{
    private $manager;
    function __construct(EntityManagerInterface $manager)
    {
        $this->manager= $manager;
    }

    #[Route('/forget/password', name:"forget_password", methods:["GET"])]
    public function forget()
    {
        return $this->render("forgot_password.html.twig");
    }

    public function generateRandomPassword() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 12; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $password;
    }
    #[Route("/forgetpassword", name:"gestion_password", methods:["post"])]
    public function forget_password(Request $request, UtilisateurRepository $userRepo){
        $email = $request->get("email");
        $checkEmail = $userRepo->checkUserEmail($email);
        // dd($checkEmail);
        if(!$checkEmail)
            return $this->json(["message" => "email error"]);
        foreach ($checkEmail as $user) {
            $role = $user->getRole();
        }
        // dd($user);
        $roleId = $role->getId();
        // dd($roleId);
        if($roleId == 1){
            $oublierP = new OublierPass();
            $oublierP->setUtilisateur($user);
            $code =  rand(10, 1000) . time();
            $oublierP->setCode($code);
            $oublierP->setStatus(0);
            $this->manager->persist($oublierP);
            $this->manager->flush();
            // dd($user->getEmail());
            if($this->email($user->getEmail(), $code))
                return $this->json(["message" => "done"]);
            return $this->json(["message" => "probleme_email"]);
        }
        return $this->json(["message" => "error"]);

    }


    private function email($sendTo, $code){
        // dd($sendTo);
        $email = (new Email())
        ->from('app@marrakechdest.ma')
        ->to($sendTo)
        ->subject('new password')
        // ->text('Your new password is: ');
        ->html('<div> <a href="http://127.0.0.1:8000/changerpass/'.$code.'/'.$sendTo.'">cliquer ici pour changer votre mot de passe</a> </div>');
        // $sendres=$mailer->send($email);
        $dsn = "gmail://chaimadev92%40gmail.com:eqro%20pnus%20elut%20jbwb@default?verify_peer=0";
        $transport = Transport::fromDsn($dsn);
         $m = new Mailer($transport);
         $sendres=$m->send($email);
         if($sendres == null)
            return true;
        return false;
        
    }

    #[Route("/changerpass/{code}/{email}", name:"changer_password", methods:["GET"])]
    public function changerPassword($code , $email){
        $oublierP = $this->manager->getRepository(OublierPass::class)->findBy(
            ["code" =>$code , "status" => 0], ["id" => "desc"]
        );
        if(count($oublierP) == 0)
            return $this->redirectToRoute("forget_password");
        $user = $oublierP[0]->getUtilisateur();
        $email = $user->getEmail();
        return $this->render("oublier.html.twig", ["email" =>$email, "code" => $code]);
        // dd($oublierP[0]);
    }

    #[Route("/changerpass", name:"update_password", methods:["post"])]
    public function changer(Request $request){
        $code = $request->get("code");
        $email = $request->get("email");
        $user = $this->manager->getRepository(Utilisateur::class)->findBy(["email" => $email]);
        if(count($user) == 0)
            return $this->json(["message" => "email_incorrect"]);
        $oublierP = $this->manager->getRepository(OublierPass::class)->findBy(
            ["code" =>$code , "status" => 0, "utilisateur" => $user], ["id" => "desc"]
        );
        if(count($oublierP) == 0)
            return $this->json(["message" => "code_invalid"]);
        $oublierP[0]->setStatus(1);
        $password1 = $request->get("pass1");
        $password2 = $request->get("pass2");
        if($password1 != $password2)
            return $this->json(["message" => "password_incorrect"]);
        $user[0]->setPassword(hash("sha256",$password1));
        $this->manager->flush();
        return $this->json(["message" => "done"]);
    }
}