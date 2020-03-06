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

        $productData = [];
        if(!$productInfo) {
            $this->sessionManager->getFlashBag()->add("danger", "No se ha encontrado el producto");
        } else {

            foreach ($productInfo as $infos) {
                $productData['id'] = $infos->id;
                $productData['name'] = $infos->name;
                $productData['attributes'][$infos->attributeId]['name'] = $infos->attributeName;
                $productData['attributes'][$infos->attributeId]['values'][] = $infos->attributeValue;
            }

        }

        $this->myRenderTemplate("product.twig.html", ["product" => $productData]);
    }

}