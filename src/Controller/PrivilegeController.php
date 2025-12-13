<?php

namespace App\Controller;

use App\Entity\Privilege;
use App\Entity\Utilisateur;
use App\Entity\TypeOperation;
use App\Entity\HistoriqueOperation;
use App\Entity\PrivilegeUtilisateur;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/privilege")]
class PrivilegeController extends AbstractController
{
    private $manager;
    function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    #[Route("/", name: "privilege", methods: ["GET"])]
    public function index()
    {
        $ses = new Session();
        if (!$ses->get("userId")) {
            return $this->redirectToRoute('showlogin', ["message" => "privilege"]);
        }
                foreach($ses->get("userId") as $user){
            $userId = $user["id"];
        }
        $user = $this->manager->getRepository(Utilisateur::class)->find($userId);
        $role = $user->getRole();
        $roleTitle = $role->getTitle();
        if($roleTitle == "admin"){
            $privilegeU = $this->manager->getRepository(PrivilegeUtilisateur::class)->findAll();
            $utilisateur = $this->manager->getRepository(Utilisateur::class)->findAll();
            $privilege = $this->manager->getRepository(Privilege::class)->findAll();
            return $this->render("gestion_privilege.html.twig", ["privilegesU" => $privilegeU, "privileges" => $privilege, "utilisateur" => $utilisateur]);
        }
        $this->addFlash(
            'privmessage',
            'Vous ne disposez pas des privilèges requis'
        );
        return $this->redirectToRoute('profile');
    }
    #[Route("/new", name: "new_privilege_utilisateur", methods: ["post"])]
    public function add(Request $request)
    {
        //kan 3ndo maghaidch ndir insert
        //makanch ghaid ndir insert
        //ila 3ndo chi hqjq mqchi f liste params ghqdi tsupprima


        //dd($request->request->all());
        $date = date("Y-m-d H:i:s");
        $utilisateur = $this->manager->getRepository(Utilisateur::class)->find($request->get("utilisateur"));
        $idprivparams = $request->get("privid");
        // dd($idprivparams);
        $privilege = $this->manager->getRepository(PrivilegeUtilisateur::class)->findby(["idUtilisateur" => $utilisateur]);
        $dejaExistPrivIds = [];

        //supprimer les privilges decoche deja et sauvegrader les non modifie
        foreach ($privilege as $priv) {
            if (!in_array($priv->getIdPriv()->getId(), $idprivparams)) {
                //supprimer privu
                $this->manager->remove($priv);
            } else {
                $dejaExistPrivIds[] = $priv->getIdPriv()->getId();
            }
        }



        //si privilige coche n exist pas a lutilisateur ajouter le

        foreach ($idprivparams as $p) {
            if (!in_array($p, $dejaExistPrivIds)) {
                $dateadd= new DateTime(datetime:"now");
                $privilegeU = new PrivilegeUtilisateur();
                $privilegeU->setDateAdd($dateadd);
                $privilegeU->setIdUtilisateur($utilisateur);
                $privilege = $this->manager->getRepository(Privilege::class)->find($p);
                $privilegeU->setIdPriv($privilege);
                $historique = new HistoriqueOperation();
                $historique->setEntite("privilege_utilisateur");
                $historique->setUtilisateur($utilisateur->getNom());
                $historique->setDate($date);
                $type = $this->manager->getRepository(TypeOperation::class)->find(1);
                $historique->setType($type);
                $this->manager->persist($privilegeU);
                $this->manager->persist($historique);
            }
        }


        $this->manager->flush();
        return  $this->json(['message' => 'inserted']);
    }

    #[Route("/privilege_utilisateur", name:"privilege_utilisateur", methods:["post"])]
    public function privUser(Request $request){
        $privileges = $this->manager->getRepository(Privilege::class)->findBy([],["titre"=> "ASC"] );
        // dd($privileges);
        $idUser = $request->get("userId");
        // dd($idUser);
        $user = $this->manager->getRepository(Utilisateur::class)->find($idUser);
        // dd($user);
        $privUser = $this->manager->getRepository(PrivilegeUtilisateur::class)->findBy(["idUtilisateur" => $user]);
        // dd($privUser);
        return $this->json(["privileges" => $privileges, "privUser" => $privUser]);
    }
    #[Route("/privilege_utilisateur_infos", name:"privilege_utilisateur_infos", methods:["post"])]
    public function infos(Request $request){
        $id = $request->get("privId");
        $privilege = $this->manager->getRepository(Privilege::class)->find($id);
        $privUsers = $this->manager->getRepository(PrivilegeUtilisateur::class)->findBy(["idPriv" => $privilege]);
        return $this->json(["privUsers" =>$privUsers]);
    }
}
