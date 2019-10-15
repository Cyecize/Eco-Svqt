<?php

namespace App\Controller\Product;

use App\Controller\BaseController;
use App\Service\Lang\LocalLanguage;
use App\Service\Product\ProductService;
use App\Util\Pageable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Product
 *
 * @Route(path="/dashboard")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DashboardController extends BaseController
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(LocalLanguage $language, ProductService $productService)
    {
        parent::__construct($language);
        $this->productService = $productService;
    }

    /**
     * @Route(path="/", name="dashboard_get_action", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function dashboardAction(Request $request)
    {
        $q = $request->get('q');
        if ($q == null) $q = '';

        return $this->render('products/dashboard/dashboard.twig', [
            'page' => $this->productService->searchProduct($q, new Pageable($request))
        ]);
    }
}