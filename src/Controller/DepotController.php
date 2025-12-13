<?php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Depot;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\HistoriqueOperation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/depot")]
class DepotController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/" , name:"depot", methods:["GET"])]
    public function index(Request $request)
    {
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "depot"]);
        }
           //verification de privilege
           if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"depot")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            return $this->redirectToRoute('profile');
        }
        $depot = $this->manager->getRepository(Depot::class)->findAll();
        return $this->render("gestion_depot.html.twig", ["depot" => $depot]);
    }
    #[Route("/new", name:"new_depot", methods:["GET"])]
    public function new(Request $request)
    {
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_depot")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $depot = new Depot();
        $depot->setAdresse($request->get('adresse'));
        $depot->setCapacite($request->get('capacite'));
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Depot");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        // dd($date);
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->persist($depot);
        $this->manager->flush();
        return $this->json(['message' => 'inserted']);
    }
    #[Route("/delete/{id}", name:"delete_depot", methods:["DELETE"])]
    public function delete(Request $request, $id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_depot")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $d = $this->manager->getRepository(Depot::class)->find($id);
        $articles = $this->manager->getRepository(Article::class)->findBy(["idDepot" => $d]);
        $countArticles = count($articles);
        if($countArticles > 0){
            return $this->json(["message" => "hasArticles"]);
        }
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Depot");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($d){
            $this->manager->remove($d);
            $this->manager->persist($historique);
            $this->manager->flush();
            return  $this->json(['message' =>'deleted']);
        }
        return  $this->json(['message' =>'erreur']);
    }
    #[Route('/depot/info', name:"info_depot", methods:["post"])]
    function info(Request $request){
        $id = $request->get("depot_id");
        // dd($id);
        $depot = $this->manager->getRepository(Depot::class)->find($id);
        // dd($depot);
        return $this->json(['depot' => $depot]);
    }
    #[Route("/update", name:"update_depot", methods:["post"])]
    public function update(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_depot")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("depot_id");
        $depot = $this->manager->getRepository(Depot::class)->find($id);
        $adresse = $request->get("adresse");
        // dd($adresse);
        $depot->setAdresse($adresse);
        $capacite = $request->get("capacite");
        $depot->setCapacite($capacite);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Depot");
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