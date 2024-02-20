<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Controller\DeptTitleController;
use App\Repository\DepartementRepository;
use App\Repository\DeptEmpRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{

    private DeptEmpRepository $deptEmpRepository; 

    public function __construct(DeptEmpRepository $deptEmpRepository)
    {
        $this->deptEmpRepository = $deptEmpRepository;
    }



    #[Route('/departement', name: 'app_departement')]
    public function index(DepartementRepository $dr): Response
    {

        $departementsData = $dr->findAll();



        return $this->render('departement/index.html.twig', [
            'controller_name' => 'DepartementController',
            "departements" => $departementsData

        ]);
    }

    //Affiche les données demandées des départements
    #[Route('/departement/{deptNo}', name: 'app_departement_show')]
    public function show(EntityManagerInterface $em,string $deptNo,DepartementRepository $departementRepository): Response
    {
     
  
        $departement = $departementRepository->findOneBy(['deptNo' => $deptNo]);

        $countEmp = $this->deptEmpRepository->getCountByDeptNo($deptNo);

        dump($countEmp);

        return $this->render('departement/show.html.twig', [
            'department' => $departement,
            'countEmploye' => $countEmp
        ]);
    }
}
