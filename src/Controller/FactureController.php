<?php
namespace App\Controller;

use App\Entity\Facture;
use App\Entity\BonSortie;
use App\Entity\BonCommande;
use App\Entity\Utilisateur;
use App\Entity\DetailBonSortie;
use App\Entity\DetailBonCommande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route("/facture")]
class FactureController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"facture", methods:["GET"])]
    function index(Request $request){
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "facture"]);
        }
              //verification de privilege
            if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"facture")){
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
        // if($roleTitle == "admin"){
            $facture = $this->manager->getRepository(Facture::class)->findAll();
            return $this->render("gestion_facture.html.twig", ["facture" => $facture]);
        // }
        // return $this->redirectToRoute('showlogin');
    }
    #[Route("/facture/{id}", name:"factureById", methods:["post"])]
    public function facture(Request $request, $id){
            //verification de privilege
            if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"factureById")){
                $this->addFlash(
                    'privmessage',
                    'Vous ne disposez pas des privilèges requis'
                );
                // return $this->redirectToRoute('profile');
                return $this->json(["message" => "priv_error"]);
            }
        $facture = $this->manager->getRepository(Facture::class)->find($id);
        $bonSortie = $this->manager->getRepository(BonSortie::class)->findBy(["Facture" => $facture]);
        if($bonSortie){
            $detail = $this->manager->getRepository(DetailBonSortie::class)->findBy(["idbs" => $bonSortie]);
        }else{
            $bonCommande = $this->manager->getRepository(BonCommande::class)->findBy(["facture" => $facture]);
            $detail = $this->manager->getRepository(DetailBonCommande::class)->findBy(["bonCommande" => $bonCommande]);
        }

        if($facture)
            return $this->json(["facture" => $facture, "details" => $detail]);
        return $this->json(["message" => "error"]);
    }
}