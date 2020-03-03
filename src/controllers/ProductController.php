<?php


namespace Juinsa\controllers;

use Juinsa\Services\ProductService;

class ProductController extends Controller
{

    /**
     * @Inject
     * @var ProductService
     */
    private ProductService $productService;

    public function index()
    {

    }

    public function showProductInfo($id, $name)
    {
        $product = $this->productService->getProduct($id);

        $associatedAttributes = [];
        if(!$product) {
            $this->sessionManager->getFlashBag()->add("danger", "No se ha encontrado el producto");
        } else {
            $attributes = $this->productService->getProductAttributes($id);

            //TODO DEUDA TÉNICA
            foreach ($attributes as $attribute) {
                $associatedAttributes[$attribute['name']] = $attribute['value'];
            }
        }

        $this->myRenderTemplate("product.twig.html", ["product" => $product, "attributes" => $associatedAttributes]);
    }

}