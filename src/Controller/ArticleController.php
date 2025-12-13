<?php
namespace App\Controller;

use App\Entity\Depot;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\HistoriqueOperation;
use App\Repository\PrivilegeUtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/article")]
class ArticleController extends AbstractController{
    private $manager;
    private $priv;
    function __construct (EntityManagerInterface $manager,PrivilegeUtilisateurRepository $pur){
        $this->manager =$manager;
        $this->priv =$pur;
    }
    #[Route("/", name:"article", methods:["GET"])]
    public function index(Request $request){
        $ses = new Session();
        if(!$ses->get("userId")){ 
            return $this->redirectToRoute('showlogin', ["message" => "article"]);
        }

        //verification de privilege
        if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"article")){
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
        $categorie = array_filter($allCategories, function($category) {
            return $category->getId() != -1;
        });
        $depot = $this->manager->getRepository(Depot::class)->findAll();
        $article = $this->manager->getRepository(Article::class)->findAll();
    return $this->render("gestion_article.html.twig", ["article" => $article, "categorie" => $categorie, "depot" => $depot]);
    }
    #[Route("/new", name:"new_article", methods:["post"])]
    public function add(Request $request){
        // dd($request->request->all());
        // dd($_FILES['image']);
          //verification de privilege
            if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"new_article")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            return $this->json(["message" => "priv_error"]);
        }
        $article = new Article();
        $final_image_name="default.jpg";
        if ($_FILES['image']) {
            $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
            $path = 'main/images/'; // upload directory
            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            // get uploaded file's extension
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            // can upload same image using rand function
            
            $final_image_name = rand(10, 1000) . time() . '.' . $ext;
            // check's valid format
            if (in_array($ext, $valid_extensions)) {
                $path = $path . strtolower($final_image_name);
                if (move_uploaded_file($tmp, $path)) {
                    $article->setImage($final_image_name);
                }
            }
        }
        $article->setNom($request->get('nom'));
        $article->setDescription($request->get('description'));
        $article->setPrix($request->get('prix'));
        $article->setQuantite($request->get('quantite'));
        $article->setMinQuantite($request->get('minquantite'));
        // $article->setMinQuantite(10); input 
        $idCateg = $request->get("categorie");
        $categorie = $this->manager->getRepository(Categorie::class)->find($idCateg);
        $article->setIdCategorie($categorie);
        $idDepot = $request->get("depot");
        $depot = $this->manager->getRepository(Depot::class)->find($idDepot);
        $article->setIdDepot($depot);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Article");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(1);
        $historique->setType($type);
        $this->manager->persist($article);
        $this->manager->persist($historique);
        $this->manager->flush();
        return  $this->json(['message' =>'inserted']);
    }
    #[Route("/delete/{id}", name:"delete_article", methods:["DELETE"])]
    public function delete(Request $request,$id){
          //verification de privilege
          if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"delete_article")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        $a = $this->manager->getRepository(Article::class)->find($id);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Article");
        $historique->setUtilisateur($nom);
        $date = date("Y-m-d H:i:s");
        $historique->setDate($date);
        $type = $this->manager->getRepository(TypeOperation::class)->find(3);
        $historique->setType($type);
        if($a){
            $this->manager->remove($a);
            $this->manager->persist($historique);
            $this->manager->flush();
            return  $this->json(['message' =>'deleted']);
        }
        return  $this->json(['message' =>'erreur']);
    }
    #[Route("/article/info", name:"info_article")]
    public function info(Request $request){
          //verification de privilege
        //   if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"info_article")){
        //     $this->addFlash(
        //         'privmessage',
        //         'Vous ne disposez pas des privilèges requis'
        //     );
        //     // return $this->redirectToRoute('profile');
        //     return $this->json(["message" => "priv_error"]);
        // }
        $id = $request->get("id_article");
        // dd($id);
        $article =$this->manager->getRepository(Article::class)->find($id);
        $data = [
            'nom' => $article->getNom(),
            'description' => $article->getDescription(),
            'prix' => $article->getPrix(),
            'minquantite' => $article->getMinQuantite(),
            'quantite' => $article->getQuantite(),
            'image' => $article->getImage(),
            'idCategorie' => [
                'nomCategorie' => $article->getIdCategorie()->getNomCategorie(),
            ],
            'idDepot' => [
                'adresse' => $article->getIdDepot()->getAdresse(),
            ],
        ];
        // dd($data);
        return $this->json(["article" => $data]);
    }
    #[Route("/update", name:"update_article", methods:["post"])]
    public function update(Request $request){
          //verification de privilege
          if(!$this->priv->verifPrivilege($request->getSession()->get("userId"),"update_article")){
            $this->addFlash(
                'privmessage',
                'Vous ne disposez pas des privilèges requis'
            );
            // return $this->redirectToRoute('profile');
            return $this->json(["message" => "priv_error"]);
        }
        // dd($_FILES['image']);
        $id = $request->get("id_article");
        $article = $this->manager->getRepository(Article::class)->find($id);
        // dd($article);
        $nom = $request->get("nom");
        $article->setNom($nom);
        $description = $request->get("description");
        $article->setDescription($description);
        $prix = $request->get("prix");
        $article->setPrix($prix);
        $article->setMinQuantite($request->get('minquantite'));
        $quantite = $request->get("quantite");
        $article->setQuantite($quantite);
            if ($_FILES['image']) {
                $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
                $path = 'main/images/'; // upload directory
                $img = $_FILES['image']['name'];
                $tmp = $_FILES['image']['tmp_name'];
                // get uploaded file's extension
                $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                // can upload same image using rand function
                
                $final_image_name = rand(10, 1000) . time() . '.' . $ext;
                // check's valid format
                if (in_array($ext, $valid_extensions)) {
                    $path = $path . strtolower($final_image_name);
                    if (move_uploaded_file($tmp, $path)) {
                        $article->setImage($final_image_name);
                    }
                }
            }
        $IdCateg = $request->get("categorie");
        // dd($IdCateg);
        $categorie = $this->manager->getRepository(Categorie::class)->find($IdCateg);
        $article->setIdCategorie($categorie);
        $IdDepot = $request->get("depot");
        $depot = $this->manager->getRepository(Depot::class)->find($IdDepot);
        $article->setIdDepot($depot);
        $sess = new Session();
        $nom = $sess->get("nom");
        $historique = new HistoriqueOperation();
        $historique->setEntite("Article");
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