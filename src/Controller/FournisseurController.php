<?php
namespace App\Controller;

use App\Entity\Fournisseur;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\HistoriqueOperation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/fournisseur")]

class FournisseurController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"fournisseur", methods:["GET"])]
    public function index(Request $request)
    {
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "fournisseur"]);
        }
        
        //verification de privilege
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"fournisseur")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            return $this->redirectToRoute('profile');
        }
        // foreach($ses->get("userId") as $user){
        //     $userId = $user["id"];
        // }
        // $user = $this->manager->getRepository(Utilisateur::class)->find($userId);
        // $role = $user->getRole();
        // $roleTitle = $role->getTitle();
        $fournisseur = $this->manager->getRepository(Fournisseur::class)->findAll();
        return $this->render("gestion_fournisseur.html.twig", ["fournisseur" => $fournisseur]);
    }
    #[Route("/new", name:"new_fournisseur", methods:["post"])]
    public function new(Request $request)
    {
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_fournisseur")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $fournisseur = new Fournisseur();
        $fournisseur->setNomFournisseur($request->get('nom'));
        $fournisseur->setAdresse($request->get('adresse'));
        $fournisseur->setTelephone($request->get('telephone'));
        $fournisseur->setEmail($request->get('email'));
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Fournisseur");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->persist($fournisseur);
        $this->manager->flush();

        return  $this->json(['message' =>'inserted']);
    }
    #[Route("/delete/{id}", name:"delete_fournisseur", methods:["DELETE"])]
    public function delete(Request $request, $id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_fournisseur")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $f = $this->manager->getRepository(Fournisseur::class)->find($id);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Fournisseur");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($f){
            $this->manager->remove($f);
            $this->manager->persist($historique);
            $this->manager->flush();
            return  $this->json(['message' =>'deleted']);
        }
        return  $this->json(['message' =>'erreur']);
    }
    #[Route('/fornisseur/info', name:"info_fournisseur", methods:["post"])]
    function info(Request $request){
        // if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"info_fournisseur")){
        //     $this->addFlash(
        //         'privmessage',
        //         'Vous ne disposez pas des privilèges requis'
        //     );
        //     // return $this->redirectToRoute('profile');
        //     return $this->json(["message" => "priv_error"]);
        // }
        $id = $request->get("id_four");
        // dd($id);
        $fournisseur = $this->manager->getRepository(Fournisseur::class)->find($id);
        // dd($depot);
        return $this->json(['fournisseur' => $fournisseur]);
    }
    #[Route("/update", name:"update_fournisseur", methods:["post"])]
    public function update(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_fournisseur")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("id_four");
        $fournisseur = $this->manager->getRepository(Fournisseur::class)->find($id);
        $nom = $request->get("nom");
        $fournisseur->setNomFournisseur($nom);
        $adresse = $request->get("adresse");
        $fournisseur->setAdresse($adresse);
        $telephone = $request->get("telephone");
        $fournisseur->setTelephone($telephone);
        $email = $request->get("email");
        $fournisseur->setEmail($email);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Fournisseur");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(2);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->flush();
        return $this->json(['message'=> 'updated']);
    }
}