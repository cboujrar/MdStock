<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Entity\Article;
use App\Entity\StatusBc;
use App\Entity\BonSortie;
use App\Entity\BonCommande;
use App\Entity\Fournisseur;
use App\Entity\Utilisateur;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BonCommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"dashboard", methods:["GET"])]
    function index(ArticleRepository $articleRepository, BonCommandeRepository $bonCommandeRepo, Request $request){
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin');
        }
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"dashboard")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            return $this->redirectToRoute('profile');
            // return $this->json(["message" => "priv_error"]);
        }
        // foreach($ses->get("userId") as $user){
        //     $userId = $user["id"];
        // }
        // $user = $this->manager->getRepository(Utilisateur::class)->find($userId);
        // $role = $user->getRole();
        // $roleTitle = $role->getTitle();
        // if($roleTitle == "admin"){
                 // dd($articleRepository->articleByCateg());
        $articlesByCat=$articleRepository->articleByCateg();
        $fourn =$this->manager->getRepository(Fournisseur::class)->count();
        // dd($fourn);
        $bonCommdes =$this->manager->getRepository(BonCommande::class)->count();
        $bonSort =$this->manager->getRepository(BonSortie::class)->count();
        $articles =$this->manager->getRepository(Article::class)->count();
        $depots =$this->manager->getRepository(Depot::class)->count();
        $bonCommEnAtt = $bonCommandeRepo->findBonCommEnAtt();
        $countBonCommEnAtt = count($bonCommEnAtt);
        $bonCommValide = $bonCommandeRepo->findBonCommValide();
        $countBonCommValide = count($bonCommValide);
        $ArticlesEpuise =$articleRepository->findArticleEpuise();
        $articleEpuise = count($ArticlesEpuise);
        $bonCommParStatus = $bonCommandeRepo->bonCommandeParStatus();
        return $this->render("dashboard.html.twig",[
            "fourn" => $fourn,
            "bonCommdes" => $bonCommdes,
            "bonSortie" => $bonSort,
            "articles" => $articles,
            "depots" => $depots,
            "articlesByCat"=>$articlesByCat,
            "bonCommEnAtt"=>$countBonCommEnAtt,
            "bonCommValide"=>$countBonCommValide,
            "articleEpuise" =>$articleEpuise,
            "bonCommParStatus" =>$bonCommParStatus
            // "role" => $roleTitle
        ]);
        // }
        // return $this->redirectToRoute('showlogin');
    }

}