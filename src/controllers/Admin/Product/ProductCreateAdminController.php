<?php


namespace Juinsa\controllers\Admin\Product;

use Juinsa\db\entities\Product;
use Juinsa\Services\ProductAttributeService;

class ProductCreateAdminController extends ProductAdminController
{

    /**
     * @Inject
     * @var ProductAttributeService
     */
    protected ProductAttributeService $productAttributeService;

    public function index()
    {
        $this->showCreateProductPage();
    }

    public function create()
    {
        if (!$this->checkIfAllVarsAreValid()) {
            $this->exitAftersShowsCreateProductPage();
        }

        $product = new Product();

        $this->productProcessing($product);

        if (!$product) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar insertar el producto");
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Producto añadido correctamente");
        }

        $this->showCreateProductPage();
    }

    /**
     * @param Product $product
     */
    protected function productProcessing(&$product): void
    {
        $postVars = $_POST['product'];

        $product->setName($postVars['name']);

        $this->setCategoryToProduct((int)$postVars['category'], $product);

        $this->setProductTypeToProduct((int)$postVars['productType'], $product);

        $this->buildAttributesValuesLines($postVars, $product);
    }

}