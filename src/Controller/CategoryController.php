<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\HistoriqueOperation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrivilegeUtilisateurRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/category")]
class CategoryController extends AbstractController
{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"category", methods:["GET"])]
    public function index(Request $request)
    {
        $ses = new Session();
        if(!$ses->get("userId")){
            return $this->redirectToRoute('showlogin', ["message" => "category"]);
        }
          //verification de privilege
          if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"category")){
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
        $allCategories = $this->manager->getRepository(Categorie::class)->findAll();
        $categories = array_filter($allCategories, function($category) {
            return $category->getId() != -1;
        });
        // dd($allCategories);
        return $this->render("gestion_category.html.twig", ["categories" => $categories]);
    }
    #[Route("/new", name:"new_category", methods:["post"])]
    public function new(Request $request)
    {
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_category")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("categorie");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        // dd($date);
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        // dd($type);
        $historique->setType($type);
        $categorie = new Categorie();
        $categorie->setNomCategorie($request->get('nom'));
        $this->manager->persist($historique);
        $this->manager->persist($categorie);
        $this->manager->flush();

        return  $this->json(['message' =>'inserted']);
    }
    #[Route("/delete/{id}", name:"delete_category", methods:["DELETE"])]
    public function delete(Request $request, $id){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_category")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }

        $c = $this->manager->getRepository(Categorie::class)->find($id);
        $articles = $this->manager->getRepository(Article::class)->findBy(["idCategorie" => $c]);
        $hasArticles = count($articles);
        $defaulCateg = $this->manager->getRepository(Categorie::class)->find(-1);
        foreach($articles as $article){
            $article->setIdCategorie($defaulCateg);
        }
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("categorie");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($c){
            $this->manager->remove($c);
            $this->manager->persist($historique);
            $this->manager->flush();
            return  $this->json(['message' =>'deleted', "countArticle" => $hasArticles]);
        }
        return  $this->json(['message' =>'erreur']);
    }
    #[Route('/categ/info', name:"info_categ")]
    function info(Request $request){
        // if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"info_categ")){
        //     $this->addFlash(
        //         'privmessage',
        //         'Vous ne disposez pas des privilèges requis'
        //     );
        //     // return $this->redirectToRoute('profile');
        //     return $this->json(["message" => "priv_error"]);
        // }
        $id = $request->get("categ_id");
        // dd($id);
        $categ = $this->manager->getRepository(Categorie::class)->find($id);
        return $this->json(['categorie' => $categ]);
    }
    #[Route("/update", name:"update_categ", methods:["post"])]
    public function update(Request $request){
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_categ")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $id = $request->get("categ_id");
        // dd($request->request->all());
        $categ = $this->manager->getRepository(Categorie::class)->find($id);
        // dd($categ);
        $nom = $request->get("nom");
        // dd($nom);
        $categ->setNomCategorie($nom);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("categorie");
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

