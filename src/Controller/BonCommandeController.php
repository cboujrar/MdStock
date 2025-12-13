<?php
namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Entity\Facture;
use App\Entity\StatusBc;
use App\Entity\BonCommande;
use App\Entity\Fournisseur;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\DetailBonCommande;
use App\Entity\HistoriqueOperation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route("/boncommande")]
class BonCommandeController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"boncommande", methods:["GET"])]
    function index(Request $request){
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "boncommande"]);
        }
            //verification de privilege
            if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"boncommande")){
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
        $bonComandes = $this->manager->getRepository(BonCommande::class)->findAll();
        $fournisseur = $this->manager->getRepository(Fournisseur::class)->findAll();
        $status = $this->manager->getRepository(StatusBc::class)->findAll();
        $article = $this->manager->getRepository(Article::class)->findAll();
        // dd($status);
        return $this->render("gestion_bon_commande.html.twig", ["bonComandes" => $bonComandes,
        "fournisseurs" => $fournisseur, 
        "status" => $status,
        "articles" => $article
    ]);
    }
    #[Route("/new", name:"new_bon_commande", methods:["post"])]
    public function new(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_bon_commande")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $BonCommande = new BonCommande();
        $facture = new Facture();
        $dateC = $request->get("dateCommande");
        $datecommande = new DateTime($dateC);
        $datel = $request->get("dateLivraison");
        $datelivraison = new DateTime($datel);
        $BonCommande->setObservation($request->get('observation'));
        $BonCommande->setDateCommande($datecommande);
        $BonCommande->setDateLivraison($datelivraison);
        $idStatus =$request->get("status");
        $status = $this->manager->getRepository(StatusBc::class)->find($idStatus);
        $BonCommande->setCodeStatus($status);
        $idFourn = $request->get("fournisseur");
        $fourn = $this->manager->getRepository(Fournisseur::class)->find($idFourn);
        $BonCommande->setIdFournisseur($fourn);
        $BonCommande->setFacture($facture);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Bon commande");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->persist($BonCommande);
        $this->manager->flush();
        return $this->json(["message" => "inserted"]); 
    }
    #[Route("/delete_bonC/{id}", name:"delete_bonC", methods:["DELETE"])]
    public function delete_bonS(Request $request ,$id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_bonC")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $b = $this->manager->getRepository(BonCommande::class)->find($id);
        $details = $this->manager->getRepository(DetailBonCommande::class)->findBy(["bonCommande" => $b]);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Bon commande");
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
    #[Route('/boncommande/info', name:"info_bon_commande")]
    function info(Request $request){
        $id = $request->get("bon_commande_id");
        // dd($id);
        $bonCommande = $this->manager->getRepository(BonCommande::class)->find($id);
        $codeStatus = $this->manager->getRepository(StatusBc::class)->findAll();
        return $this->json(['bonCommande' => $bonCommande, "codeStatus" => $codeStatus]);
    }
    #[Route("/update", name:"update_bon_commande", methods:["post"])]
    public function update(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_bon_commande")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("bon_commande_id");
        // dd($request->request->all());
        $BonCommande = $this->manager->getRepository(BonCommande::class)->find($id);
        $observation = $request->get("observation");
        $BonCommande->setObservation($observation);
        $dateC = $request->get("dateCommande");
        $datecommande = new DateTime($dateC);
        $datel = $request->get("dateLivraison");
        $datelivraison = new DateTime($datel);
        $BonCommande->setDateCommande($datecommande);
        $BonCommande->setDateLivraison($datelivraison);
        $idStatus =$request->get("status");
        $status = $this->manager->getRepository(StatusBc::class)->find($idStatus);
        $BonCommande->setCodeStatus($status);
        $idFourn = $request->get("fournisseur");
        $fourn = $this->manager->getRepository(Fournisseur::class)->find($idFourn);
        $BonCommande->setIdFournisseur($fourn);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Bon commande");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(2);
        $historique->setType($type);
        $this->manager->persist($historique);
        $this->manager->flush();
        return $this->json(['message'=> 'updated']);
    }

    #[Route("/detail/{id}", name:"details_bon_commande", methods:["post"])]
    public function details(Request $request ,$id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"details_bon_commande")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $bonCommande = $this->manager->getRepository(BonCommande::class)->find($id);
        $detail = $this->manager->getRepository(DetailBonCommande::class)->findBy(["bonCommande" => $bonCommande]);
        // dd($detail);
        return $this->json(["detail" => $detail]);
    }

    #[Route("/new_detail", name:"new_detail_bon_commande", methods:["post"])]
    public function newDetail(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_detail_bon_commande")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("bon_sortD_id");
        $detail = new DetailBonCommande();
        $detail->setQuantite($request->get('quantite'));
        $detail->setPrix($request->get('prix'));
        $idArticle = $request->get('article');
        $article = $this->manager->getRepository(Article::class)->find($idArticle);
        $bonCommade = $this->manager->getRepository(BonCommande::class)->find($id);
        $Facture = $bonCommade->getFacture();
        $price = $Facture->getTotale();
        if($bonCommade->getCodeStatus()->getLibelle() == "valide"){
            $Aqauntite = $article->getQuantite();
            $article->setQuantite($Aqauntite + $request->get('quantite'));
        }
        $Facture->setTotale($price + ($request->get('prix') * $request->get('quantite')));//to be checked
        $details = $this->manager->getRepository(DetailBonCommande::class)->findBy([ "bonCommande" => $bonCommade , "article" => $article]);
        if($details){
            return $this->json(['message' => 'erreur']);
        }
        $detail->setArticle($article);
        $detail->setBonCommande($bonCommade);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Detail bon commande");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($detail);
        $this->manager->persist($historique);
        $this->manager->flush();
        return $this->json(['message' => 'inserted']);
    }
    #[Route("/delete_detail/{id}", name:"delete_detail_bonC", methods:["DELETE"])]
    function delete_detail(Request $request ,$id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_detail_bonC")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $d = $this->manager->getRepository(DetailBonCommande::class)->find($id);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Detail bon commande");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($d){
            $bonCommande = $d->getBonCommande();
            $facture = $bonCommande->getFacture();
            $total = $facture->getTotale();
            $facture->setTotale($total - ($d->getQuantite() * $d->getPrix()));
            $this->manager->remove($d);
            $this->manager->persist($historique);
            $this->manager->flush();
            return $this->json(["message" => "deleted"]);
        }
        return $this->json(["message" => "erreur"]);
    }

    #[Route("/facture/{id}", name:"facture_listC", methods:["post"])]
    public function facture(Request $request ,$id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"facture_listC")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $bonCommande = $this->manager->getRepository(BonCommande::class)->find($id);
        $detail = $this->manager->getRepository(DetailBonCommande::class)->findBy(["bonCommande" => $bonCommande]);
        $facture = $bonCommande->getFacture();
        if($detail){
            return $this->json(["facture" => $facture, "details" => $detail]);
        }
        return $this->json(["message" => "error"]);
    }
}