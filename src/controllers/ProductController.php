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
        $productInfo = $this->productService->getAllProductInfo($id);
var_dump($productInfo); die();
        $associatedAttributes = [];
        if(!$productInfo) {
            $this->sessionManager->getFlashBag()->add("danger", "No se ha encontrado el producto");
        } else {
            //TODO DEUDA TÉCNICA

//            foreach ($attributes as $attribute) {
////                var_dump($attribute->getValue());
//                $associatedAttributes[$attribute->getProductAttribute()->getId()] = $attribute->getValue();
//            }
        }

        $this->myRenderTemplate("product.twig.html", ["product" => $productInfo, "attributes" => $associatedAttributes]);
    }

}