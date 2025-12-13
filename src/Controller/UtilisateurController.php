<?php
namespace App\Controller;

use App\Entity\Role;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping\Id;
use App\Entity\TypeOperation;
use Symfony\Component\Mime\Email;
use App\Entity\HistoriqueOperation;
use App\Entity\PrivilegeUtilisateur;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/utilisateur')]
class UtilisateurController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:("utilisateur"), methods:["GET"])]
    function index(Request $request){
        //check if user logged in or redirect to login
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "utilisateur"]);
        }
              //verification de privilege
            //   if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"utilisateur")){
            //     $this->addFlash(
            //         'privmessage',
            //         'Vous ne disposez pas des privilèges requis'
            //     );
            // }
        foreach($ses->get("userId") as $user){
            $userId = $user["id"];
        }
        $user = $this->manager->getRepository(Utilisateur::class)->find($userId);
        $role = $user->getRole();
        $roleTitle = $role->getTitle();
        // //check role if admin //later
        if($roleTitle == "admin"){
            $utilisateur = $this->manager->getRepository(Utilisateur::class)->findAll();
            $role = $this->manager->getRepository(Role::class)->findAll();
            return $this->render("gestion_utilisateur.html.twig", ["utilisateur" => $utilisateur, "role" => $role]);
        }
        return $this->redirectToRoute('profile');
    }
    #[Route('/new', name:"new_utilisateur", methods:["post"])]
    function new(Request $request, UtilisateurRepository $userRepo){
              //verification de privilege
              if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_utilisateur")){
                $this->addFlash(
                    'privmessage',
                    'Vous ne disposez pas des privilèges requis'
                );
                // return $this->redirectToRoute('profile');
                return $this->json(["message" => "priv_error"]);
            }
        $utilisateur = new Utilisateur();
        $utilisateur->setNom($request->get('nom'));
        $utilisateur->setEmail($request->get('email'));
        $emails = $userRepo->getAllEmails();
        foreach ($emails as $emailInfo) {
            if($request->get('email') == $emailInfo['email'])
                return $this->json(['message' => "email error"]);
        }
        $utilisateur->setPassword(hash("sha256",$request->get('email')));
        $idRole = $request->get("role");
        $role = $this->manager->getRepository(Role::class)->find($idRole);
        $utilisateur->setRole($role);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Utilisateur");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->persist($utilisateur);
        $this->manager->flush();
        return $this->json(['message' => "inserted"]);
    }
    #[Route('/info', name:"info_utilisateur", methods:["post"])]
    function info(Request $request){
              //verification de privilege
            //   if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"info_utilisateur")){
            //     $this->addFlash(
            //         'privmessage',
            //         'Vous ne disposez pas des privilèges requis'
            //     );
            //     // return $this->redirectToRoute('profile');
            //     return $this->json(["message" => "priv_error"]);
            // }
        $id = $request->get("id_utiliu");
        // dd($id);
        $utilisateur = $this->manager->getRepository(Utilisateur::class)->find($id);
        return $this->json(['utilisateur' => $utilisateur]);
    }
    #[Route("/update", name:"update_utilisateur", methods:["post"])]
    public function update(Request $request){
              //verification de privilege
              if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_utilisateur")){
                $this->addFlash(
                    'privmessage',
                    'Vous ne disposez pas des privilèges requis'
                );
                // return $this->redirectToRoute('profile');
                return $this->json(["message" => "priv_error"]);
            }
        $id = $request->get("id_utiliu");
        // dd($id);
        $utilisateur = $this->manager->getRepository(Utilisateur::class)->find($id);
        // dd($utilisateur);
        $nom = $request->get("nom");
        // dd($nom);
        $utilisateur->setNom($nom);
        $email = $request->get("email");
        $utilisateur->setEmail($email);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Utilisateur");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(2);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->flush();
        return $this->json(['message'=> 'updated']);
    }
    #[Route("/delete/{id}", name:"delete_utilisateur", methods:["DELETE"])]
    public function delete(Request $request, $id){
              //verification de privilege
              if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_utilisateur")){
                $this->addFlash(
                    'privmessage',
                    'Vous ne disposez pas des privilèges requis'
                );
                // return $this->redirectToRoute('profile');
                return $this->json(["message" => "priv_error"]);
            }
        $utilisateur = $this->manager->getRepository(Utilisateur::class)->find($id);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Utilisateur");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        $privU = $this->manager->getRepository(PrivilegeUtilisateur::class)->findBy(["idUtilisateur" => $utilisateur]);
        // dd($privU);
        foreach($privU as $priv){
            $this->manager->remove($priv);
        }
        if($utilisateur){
            $this->manager->remove($utilisateur);
            $this->manager->persist($historique);
            $this->manager->flush();
            return  $this->json(['message' =>'deleted']);
        }
        return  $this->json(['message' =>'erreur']);
    }

    #[Route("/loginShow", name:"showlogin", methods:["GET"])]
    public function showlogin(Request $request){
        $message = $request->query->get('message');
        return $this->render("login.html.twig", ["message" => $message]);
    }

    public function generateRandomPassword() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 8; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $password;
    }
    
    #[Route("/login", name:"userlogin", methods:["post"])]
    public function login(Request $request, UtilisateurRepository $userRepo){
        //check data if null or empty
        $email = $request->get("email");
        $password = $request->get("password");
        if(!$email || !$password || empty($email) || empty($password))
            return $this->json(["message" => 'erreur']);
        //check email if exist

        //check user login is correct
        $userId = $userRepo->getUserId($email);
        $checkEmail = $userRepo->checkUserEmail($email);
        $checkPassword = $userRepo->checkUsersPassword(hash("sha256",$password), $email);
        // dd($checkEmail);
        foreach ($checkEmail as $user) {
            $nom = $user->getNom();
        }
        // dd($nom);
        if(empty($checkEmail))
            return $this->json(["message" => 'email incorrect']);
        if(empty($checkPassword))
            return $this->json(["message" => 'password incorrect']);
        
        
        //remove dots (.) from the two emails before  //it needs repository TODO:(youssef)
        
        
        
        //store user id and name and email in session
        $ses = new Session();
        $ses ->set("userEmail", $email);
        $ses ->set("userId", $userId);
        $ses->set("nom", $nom);
        if($password ==  $email)
            return  $this->json(['message' =>'done!']);

        return  $this->json(['message' =>'done']);

    }

    private function email($sendTo, $password){
        $email = (new Email())
        ->from('app@marrakechdest.ma')
        ->to($sendTo)
        ->subject('new password')
        ->text('Your new password is: ' . $password);
        $dsn = "gmail://chaimadev92%40gmail.com:eqro%20pnus%20elut%20jbwb@default?verify_peer=0";
        $transport = Transport::fromDsn($dsn);
         $m = new Mailer($transport);
         $sendres=$m->send($email);
         if($sendres == null)
            return 1;
        return 0;
    }
    
    #[Route("/resetPassword", name:"reset_password", methods:["POST"])]
    function reset(Request $request, UtilisateurRepository $userRepo){
        // $email = $request->get("Remail");
        // $checkEmail = $userRepo->checkUserEmail($email);
        // if(empty($checkEmail))
        //     return $this->json(["message" =>"email error"]);
        // foreach($checkEmail as $user){
        //     $id = $user->getId();
        // }
        // dd($request->get("userId"));
        $user = $this->manager->getRepository(Utilisateur::class)->find($request->get("userId"));
        $email = $user->getEmail();
        // dd($email);
        $password =  $this->generateRandomPassword();
        $user->setPassword(hash("sha256", $password));
        $this->manager->flush();
        if($this->email($email, $password) == 0)
            return $this->json(["message" => "erreur"]);
        return $this->json(["message" => "done" , "password" => $password]);
    }
    #[Route("/logout", name:"logout")]
    function logout(){
        $session = new Session();
        $session->remove("userEmail");
        $session->remove("userId");
        $session->remove("nom");
        return $this->redirectToRoute('showlogin');
    }
}