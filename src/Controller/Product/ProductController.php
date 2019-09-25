<?php

namespace App\Controller\Product;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller\Product
 *
 * @Route(path="/products")
 */
class ProductController extends BaseController
{
    /**
     * @Route(path="/manage", name="product_management", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function productManagementAction()
    {
        return $this->render('products/base.html.twig');
    }
}