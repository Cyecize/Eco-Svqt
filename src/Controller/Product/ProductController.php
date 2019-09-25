<?php

namespace App\Controller\Product;

use App\BindingModel\Product\CreateProductBindingModel;
use App\Controller\BaseController;
use App\Exception\InternalRestException;
use App\Form\CreateProductType;
use App\Service\Lang\LangDbService;
use App\Service\Lang\LocalLanguage;
use App\Service\Product\CategoryService;
use App\Service\Product\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var LangDbService
     */
    private $langDbService;

    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(LocalLanguage $language, CategoryService $categoryService, LangDbService $langDbService, ProductService $productService)
    {
        parent::__construct($language);
        $this->categoryService = $categoryService;
        $this->langDbService = $langDbService;
        $this->productService = $productService;
    }

    /**
     * @Route(path="/manage", name="product_management", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function productManagementAction()
    {
        return $this->render('products/base.html.twig');
    }

    /**
     * @return Response
     * @Route(path="/create", name="create_product_get", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createProductGetAction()
    {
        $model = $this->getFlashModel(CreateProductBindingModel::class);

        if ($model == null) {
            $model = new CreateProductBindingModel();
        }

        return $this->render('products/product/create.html.twig', [
            'categories' => $this->categoryService->findAll(),
            'languages' => $this->langDbService->findAll(),
            'model' => $model,
        ]);
    }

    /**
     * @Route(path="/create/post", name="create_product_post", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return RedirectResponse
     * @throws InternalRestException
     */
    public function createProductPostAction(Request $request)
    {
        $this->validateToken($request);

        $bindingModel = new CreateProductBindingModel();
        $form = $this->createForm(CreateProductType::class, $bindingModel);
        $form->handleRequest($request);

        $this->addFlashModel($bindingModel);

        if (!$form->isSubmitted() || count($this->validate($bindingModel)) > 0) {
            return $this->redirectToRoute('create_product_get');
        }

        $this->productService->createProduct($bindingModel);

        return $this->redirectToRoute('product_management');
    }
}