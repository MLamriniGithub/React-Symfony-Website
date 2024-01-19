<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\Query;

use App\Entity\Utilisateur;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(EntityManagerInterface $manager): Response
    {
        // $users = $manager->getRepository(Utilisateur::class)->findAll();
        $query = $manager->getRepository(Utilisateur::class)
        ->createQueryBuilder('c')
        ->getQuery();
    $results = $query->getResult(Query::HYDRATE_ARRAY);
    //  print_r($users);
    $users = [];

    foreach($results as $result)
    {
        $users[] = array_values($result);
    }
        return $this->render('utilisateur/index.html.twig', ['users' => json_encode($users)]);
    }

    // #[Route('/test-vite', name: 'app_test_vite')]
    // function testVite()
    // {

    // }
}

/*

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Utilisateur;



class UtilisateurController extends AbstractDashboardController
{
    #[Route('/admin', name: 'dashboard')]
    public function index(): Response
    {
        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Exams');
    }


    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUserIdentifier())
            ->setGravatarEmail($user->getEmail())
         //   ->setAvatarUrl('https://www.clipartmax.com/png/full/405-4050774_avatar-icon-flat-icon-shop-download-free-icons-for-avatar-icon-flat.png')
            ->displayUserAvatar(true);
    }



    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('build/css/admin.css');
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Enseignant', 'fas fa-list', Utilisateur::class);
  
  
    }
}
*/