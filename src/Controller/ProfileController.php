<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/profile")]
class ProfileController extends AbstractController{
    private $manager;
    function __construct(EntityManagerInterface $manager)
    {
        $this->manager=$manager;
    }
    #[Route("/", name:"profile", methods:["GET"])]
    public function index(){
        $sess = new Session();
            foreach($sess->get("userId") as $user){
                $id = $user["id"];
            }

        // dd($id);
        $user = $this->manager->getRepository(Utilisateur::class)->find($id);
        return $this->render("gestion_profile.html.twig", ["user" => $user]);
    }
    #[Route("/update", name:"update_profil", methods:["post"])]
    public function update(Request $request){
        $id = $request->get("id_user");
        $user = $this->manager->getRepository(Utilisateur::class)->find($id);
        $user->setNom($request->get("nom"));
        $user->setEmail($request->get("email"));
        if($user->getPassword() == hash("sha256", $request->get("password"))){
            $user->setPassword(hash("sha256", $request->get("Npassword")));
        }
        else{
            return $this->json(["message" => "error"]);
        }
        $this->manager->flush();
        return $this->json(["message" => "updated"]);
    }

}