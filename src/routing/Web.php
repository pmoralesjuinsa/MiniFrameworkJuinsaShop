<?php


namespace Juinsa\routing;


use FastRoute\Dispatcher;

class Web
{

    public static function getDispatcher():Dispatcher{
        return \FastRoute\simpleDispatcher(
            function (\Fastroute\RouteCollector $route){
                $entitiesArray = [
                    "Product",
                    "Category",
                    "ProductType",
                    "ProductAttribute",
                    "User",
                    "Customer",
                    "Order"
                ];

                $route->addRoute('GET','/',['Juinsa\controllers\HomeController','index']);
                $route->addRoute('GET','/who',['Juinsa\controllers\WhoController','index']);
                $route->addRoute('GET','/login',['Juinsa\controllers\Auth\CustomerLoginController','index']);
                $route->addRoute('POST','/login',['Juinsa\controllers\Auth\CustomerLoginController','login']);
                $route->addRoute('GET','/logout',['Juinsa\controllers\Auth\CustomerLoginController','logout']);
                $route->addRoute('GET','/register',['Juinsa\controllers\Auth\CustomerRegisterController','index']);
                $route->addRoute('POST','/register',['Juinsa\controllers\Auth\CustomerRegisterController','register']);
                $route->addRoute('GET', '/categories/{id:\d+}[/{name}]', ['Juinsa\controllers\CategoryController', 'showCategoryInfo']);
                $route->addRoute('GET', '/products/{id:\d+}[/{name}]', ['Juinsa\controllers\ProductController', 'showProductInfo']);
                $route->addRoute('POST','/add-to-cart',['Juinsa\controllers\Cart\CartAjaxController','addToCart']);
                $route->addRoute('POST','/cart-modify-quantity',['Juinsa\controllers\Cart\CartAjaxController','cartModifyQuantity']);
                $route->addRoute('GET','/cart',['Juinsa\controllers\Cart\CartController','index']);
                $route->addRoute('POST','/cart-pay',['Juinsa\controllers\Cart\CartPayController','index']);
                $route->addRoute('POST','/cart-pay-confirmation',['Juinsa\controllers\Cart\CartPayConfirmationController','index']);
                $route->addRoute('GET','/myPanel',['Juinsa\controllers\Auth\CustomerPanelController','index']);
                $route->addRoute('GET','/admin/register',['Juinsa\controllers\Auth\UserRegisterController','index']);
                $route->addRoute('POST','/admin/register',['Juinsa\controllers\Auth\UserRegisterController','register']);
                $route->addRoute('GET','/admin/login',['Juinsa\controllers\Auth\UserLoginController','index']);
                $route->addRoute('POST','/admin/login',['Juinsa\controllers\Auth\UserLoginController','login']);
                $route->addRoute('GET','/admin/myPanel',['Juinsa\controllers\Auth\UserPanelController','index']);
                $route->addRoute('GET','/admin/panel',['Juinsa\controllers\Admin\AdminController','index']);
                $route->addRoute('POST','/admin/product/attributes',['Juinsa\controllers\Admin\Product\ProductAjaxAdminController','getAttributes']);
                $route->addRoute('POST','/admin/order/orderlines',['Juinsa\controllers\Admin\Order\OrderAjaxAdminController','getOrderLines']);
                foreach ($entitiesArray as $entity) {
                    $route->addRoute('GET',"/admin/".mb_strtolower($entity)."/list",["Juinsa\controllers\Admin\\".$entity."\\".$entity."ListAdminController",'index']);
                    $route->addRoute('POST',"/admin/".mb_strtolower($entity)."/list",["Juinsa\controllers\Admin\\".$entity."\\".$entity."ListAdminController",'search']);
                    $route->addRoute('GET',"/admin/".mb_strtolower($entity)."/create",["Juinsa\controllers\Admin\\".$entity."\\".$entity."CreateAdminController",'index']);
                    $route->addRoute('POST',"/admin/".mb_strtolower($entity)."/create",["Juinsa\controllers\Admin\\".$entity."\\".$entity."CreateAdminController",'create']);
                    $route->addRoute('GET',"/admin/".mb_strtolower($entity)."/edit/{id:\d+}",["Juinsa\controllers\Admin\\".$entity."\\".$entity."EditAdminController",'edit']);
                    $route->addRoute('POST',"/admin/".mb_strtolower($entity)."/edit/{id:\d+}",["Juinsa\controllers\Admin\\".$entity."\\".$entity."EditAdminController",'editSave']);
                    $route->addRoute('GET',"/admin/".mb_strtolower($entity)."/remove/{id:\d+}",["Juinsa\controllers\Admin\\".$entity."\\".$entity."RemoveAdminController",'remove']);
                }

            }
        );
    }
}