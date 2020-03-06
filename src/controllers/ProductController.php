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
            //TODO DEUDA TÉCNICA
            $attributes = $product->getAttributes();
foreach ($attributes as $att) {
    var_dump($att->getName());
    foreach ($att->getValues() as $value) {
        var_dump($value->getValue());
    }
}
die();
            foreach ($attributes as $attribute) {
//                var_dump($attribute->getValue());
                $associatedAttributes[$attribute->getProductAttribute()->getId()] = $attribute->getValue();
            }
        }

        $this->myRenderTemplate("product.twig.html", ["product" => $product, "attributes" => $associatedAttributes]);
    }

}