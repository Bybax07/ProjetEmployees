<?php

namespace App\Controller;

use App\Entity\DeptTitle;
use App\Repository\DeptTitleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Knp\Component\Pager\PaginatorInterface as PaginationInterface;

class DeptTitleController extends AbstractController
{
    // Méthode pour afficher la liste des postes disponibles en fonction des filtres
    #[Route('/dept_title', name: 'app_dept_title')]
    public function index(Request $request, 
                            DeptTitleRepository $dr,
                            MailerInterface $mailer,
                            PaginationInterface $paginator
                            ): Response
    { 

        // Récupération des filtres pour le département et le titre
        $departmentFilter = $request->get('department', 'all');
        $titleFilter = $request->get('title');


        // Conditions pour appliquer les filtres et récupérer les données appropriées
        if ($departmentFilter !== 'all') {
            $pagination = $paginator->paginate($dr->findByDepartment($departmentFilter), $request->query->get('page', 1), 5);
        } elseif ($titleFilter !== null && $titleFilter !== 'all') {
            $pagination = $paginator->paginate($dr->findByTitle($titleFilter), $request->query->get('page', 1), 5);
        } else {
            $pagination = $paginator->paginate($dr->findAll(), $request->query->get('page', 1), 5);
        }

        // Rendu de la vue pour afficher les postes filtrés
        return $this->render('dept_title/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    // Méthode pour afficher les détails d'un poste spécifique en fonction de son ID
    #[Route('/dept_title/{id}', name: 'app_dept_title_show')]
    public function show(EntityManagerInterface $entityManager, int $id, DeptTitleRepository $deptTitleRepository): Response
    {
        // Récupération du poste spécifique selon son ID
        $poste = $deptTitleRepository->find($id);

        // Vérification si le poste existe, sinon renvoyer une erreur 404
        if (!$poste) {
            throw new NotFoundHttpException('Poste non trouvé');
        }

        // Rendu de la vue pour afficher les détails du poste
        return $this->render('dept_title/show.html.twig', [
            'title' => 'Le poste',
            'poste' => $poste
        ]);
    }


    /*mail

    $email = (new Email())
    ->from('hello@example.com')
    ->to('you@example.com')
    //->cc('cc@example.com')
    //->bcc('bcc@example.com')
    //->replyTo('fabien@example.com')
    //->priority(Email::PRIORITY_HIGH)
    ->subject('Time for Symfony Mailer!')
    ->text('Sending emails is fun again!')
    ->html('<p>See Twig integration for better HTML integration!</p>');

    $mailer->send($email);
*/
}
