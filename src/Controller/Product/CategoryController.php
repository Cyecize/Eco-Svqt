<?php

namespace App\Controller\Product;

use App\BindingModel\Product\CreateCategoryBindingModel;
use App\Controller\BaseController;
use App\Exception\InternalRestException;
use App\Form\CreateCategoryType;
use App\Service\Lang\LangDbService;
use App\Service\Lang\LocalLanguage;
use App\Service\Product\CategoryService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller\Product
 *
 * @Route(path="/categories")
 * @Security("has_role('ROLE_ADMIN')")
 */
class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var LangDbService
     */
    private $langDbService;

    public function __construct(LocalLanguage $language, CategoryService $categoryService, LangDbService $langDbService)
    {
        parent::__construct($language);
        $this->categoryService = $categoryService;
        $this->langDbService = $langDbService;
    }

    /**
     * @Route(path="/create", name="create_category_get", methods={"GET"})
     */
    public function createCategory()
    {
        $model = $this->getFlashModel(CreateCategoryBindingModel::class);

        if ($model == null) {
            $model = new CreateCategoryBindingModel();
        }

        return $this->render('products/category/create.html.twig', [
            'parentCategories' => $this->categoryService->findAll(),
            'languages' => $this->langDbService->findAll(),
            'model' => $model,
        ]);
    }

    /**
     * @Route(path="/create/post", name="create_category_post", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse
     * @throws InternalRestException
     */
    public function createCategoryPost(Request $request)
    {
        $this->validateToken($request);

        $bindingModel = new CreateCategoryBindingModel();
        $form = $this->createForm(CreateCategoryType::class, $bindingModel);
        $form->handleRequest($request);

        $this->addFlashModel($bindingModel);

        if (!$form->isSubmitted() || count($this->validate($bindingModel)) > 0) {
            return $this->redirectToRoute('create_category_get');
        }

        $this->categoryService->createCategory($bindingModel);

        return $this->redirectToRoute('product_management');
    }
}