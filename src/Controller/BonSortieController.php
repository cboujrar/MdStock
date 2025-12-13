<?php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Facture;
use App\Entity\BonSortie;
use App\Entity\ModePaiment;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\DetailBonSortie;
use Doctrine\ORM\EntityManager;
use App\Entity\HistoriqueOperation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/bonsortie")]
class BonSortieController extends AbstractController{

    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"bonsortie", methods:["GET"])]
    function index(Request $request){
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "bonsortie"]);
        }
           //verification de privilege
           if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"bonsortie")){
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
        $bonSorties = $this->manager->getRepository(BonSortie::class)->findAll();
        $article = $this->manager->getRepository(Article::class)->findAll();
        $methodP = $this->manager->getRepository(ModePaiment::class)->findAll();
        return $this->render("gestion_bon_sortie.html.twig", ["bonSorties" => $bonSorties, "articles" => $article, "modePayement" => $methodP]);
    }
    #[Route("/detail/{id}", name:"details_bon_sortie", methods:["post"])]
    public function details(Request $request ,$id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"details_bon_sortie")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $bonSortie = $this->manager->getRepository(BonSortie::class)->find($id);
        $detail = $this->manager->getRepository(DetailBonSortie::class)->findBy(["idbs" => $bonSortie]);
        return $this->json(["detail" => $detail]);
    }
    #[Route("/facture/{id}", name:"facture_list")]
    public function facture(Request $request,$id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"facture_list")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $bonSortie = $this->manager->getRepository(BonSortie::class)->find($id);
        $detail = $this->manager->getRepository(DetailBonSortie::class)->findBy(["idbs" => $bonSortie]);
        $facture = $bonSortie->getFacture();
        if($detail){
            return $this->json(["facture" => $facture, "details" => $detail]);
        }
        return $this->json(["message" => "error"]);
    }
    #[Route("/new", name:"new_bon_sortie", methods:["post"])]
    public function new(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_bon_sortie")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $BonSortie = new BonSortie();
        $facture = new Facture();
        $BonSortie->setObservation($request->get('observation'));
        $modeP = $this->manager->getRepository(ModePaiment::class)->find($request->get('MethodeP'));
        // dd($request->get('MethodeP'));
        $facture->setModePaiment($modeP);
        $BonSortie->setFacture($facture);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Bon sortie");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->persist($BonSortie);
        $this->manager->flush();
        return $this->json(["message" => "inserted"]); 
    }

    #[Route("/new_detail", name:"new_detail_bon_sortie", methods:["post"])]
    public function newDetail(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_detail_bon_sortie")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("bon_sortD_id");
        $detail = new DetailBonSortie();
        $detail->setQuantite($request->get('quantite'));
        // $detail->setPrix($request->get('prix'));
        $idArticle = $request->get('article');
        $article = $this->manager->getRepository(Article::class)->find($idArticle);
        $bonSortie = $this->manager->getRepository(BonSortie::class)->find($id);
        $Facture = $bonSortie->getFacture();
        $price = $Facture->getTotale();
        $Aqauntite = $article->getQuantite();
        
        // $Facture->setTotale($price + $request->get('prix'));
        $details = $this->manager->getRepository(DetailBonSortie::class)->findBy(["article" => $article , "idbs" => $bonSortie]);
        $quantite = $request->get('quantite');
        if ($quantite > $Aqauntite)
        {
            return $this->json(['message' => 'quantite']);
        }
        if($details){
            return $this->json(['message' => 'erreur']);
        }
        $Facture->setTotale($price + ($article->getPrix() * $quantite));
        $article->setQuantite($Aqauntite - $quantite);
        $detail->setIdbs($bonSortie);
        $detail->setArticle($article);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Detail bon sortie");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->persist($detail);
        $this->manager->flush();
        return $this->json(['message' => 'inserted']);
    }

    #[Route("/delete_detail/{id}", name:"delete_detail_bonS", methods:["DELETE"])]
    function delete_detail(Request $request, $id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_detail_bonS")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $d = $this->manager->getRepository(DetailBonSortie::class)->find($id);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Detail bon sortie");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($d){
            $bonSorte = $d->getIdbs();
            $facture = $bonSorte->getFacture();
            $article = $d->getArticle();
            $total = $facture->getTotale();
            $facture->setTotale($total - ($article->getPrix() * $d->getQuantite()));
            $this->manager->remove($d);
            $this->manager->persist($historique);
            $this->manager->flush();
            return $this->json(["message" => "deleted"]);
        }
        return $this->json(["message" => "erreur"]);
    }

    #[Route("/delete_bonS/{id}", name:"delete_bonS", methods:["DELETE"])]
    public function delete_bonS(Request $request, $id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_bonS")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $b = $this->manager->getRepository(BonSortie::class)->find($id);
        $details = $this->manager->getRepository(DetailBonSortie::class)->findBy(["idbs" => $b]);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Bon sortie");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($b){
            foreach( $details as $d){
                $this->manager->remove($d);
            }
            $this->manager->remove($b);
            $this->manager->persist($historique);
            $this->manager->flush();
            return $this->json(["message" => "deleted"]);
        }
        return $this->json(["message" => "erreur"]);
    }

    #[Route('/bonsortie/info', name:"info_bon_sort", methods:["post"])]
    function info(Request $request){
        // if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"info_bon_sort")){
        //     $this->addFlash(
        //         'privmessage',
        //         'Vous ne disposez pas des privilèges requis'
        //     );
        //     // return $this->redirectToRoute('profile');
        //     return $this->json(["message" => "priv_error"]);
        // }
        $id = $request->get("bon_sort_id");
        // dd($id);
        $bonSortie = $this->manager->getRepository(BonSortie::class)->find($id);
        return $this->json(['bonSort' => $bonSortie]);
    }
    #[Route("/update", name:"update_bon_sort")]
    public function update(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_bon_sort")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("bon_sort_id");
        // dd($request->request->all());

        $bonSort = $this->manager->getRepository(BonSortie::class)->find($id);
        $facture = $bonSort->getFacture();
        $observation = $request->get("observation");
        $bonSort->setObservation($observation);
        $modeP = $this->manager->getRepository(ModePaiment::class)->find($request->get('eMethodeP'));
        // dd($request->get('MethodeP'));
        $facture->setModePaiment($modeP);
        $bonSort->setFacture($facture);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("bon sortie");
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