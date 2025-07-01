<?php

declare(strict_types=1);

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function __invoke(): Response
    {
        // ob_start();
        // phpinfo();
        // $phpinfo = ob_get_clean();
        //
        // return new Response($phpinfo);

        return $this->redirectToRoute('app.swagger_ui');
    }
}
