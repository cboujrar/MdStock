<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Component\Mime\Email;
use App\Entity\HistoriqueOperation;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GeneralController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/traces", name:"traces", methods:["GET"])]
    public function traces(Request $request){
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "traces"]);
        }
                //verification de privilege
                // if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"traces")){
                //     $this->addFlash(
                //         'privmessage',
                //         'Vous ne disposez pas des privilèges requis'
                //     );
                //     return $this->redirectToRoute('profile');
                // }
        foreach($ses->get("userId") as $user){
            $userId = $user["id"];
        }
        $user = $this->manager->getRepository(Utilisateur::class)->find($userId);
        $role = $user->getRole();
        $roleTitle = $role->getTitle();
        if($roleTitle == "admin"){
        $traces = $this->manager->getRepository(HistoriqueOperation::class)->findAll();
        return $this->render("traces.html.twig", ["historiques" => $traces]);
    }
    $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            return $this->redirectToRoute('profile');
    }
     /**
     * @Route("/sendmail",methods="GET",name="email")
     */
    public function email(Request $request){
        $password = $request->get('password');
        // dd($password);
        $sendTo = $request->get('email');
        // dd($email);
        $email = (new Email())
        ->from('app@marrakechdest.ma')
        ->to($sendTo)
        ->subject('new password')
        ->text('Your new password is: ' . $password);
        // ->html('<div> <h1> hello</h1> </div>');
        // $sendres=$mailer->send($email);
        $dsn = "gmail://chaimadev92%40gmail.com:eqro%20pnus%20elut%20jbwb@default?verify_peer=0";
        $transport = Transport::fromDsn($dsn);
         $m = new Mailer($transport);
         $sendres=$m->send($email);
         if($sendres == null)
            return $this->json(["message" => "done"]);
        return $this->json(["message" => "error"]);
        
    }
}