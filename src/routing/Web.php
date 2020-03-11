<?php


namespace Juinsa\routing;


use FastRoute\Dispatcher;

class Web
{
    public static function getDispatcher():Dispatcher{
        return \FastRoute\simpleDispatcher(
            function (\Fastroute\RouteCollector $route){
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
                $route->addRoute('GET','/admin/products',['Juinsa\controllers\Admin\Product\ProductListAdminController','index']);
                $route->addRoute('POST','/admin/products',['Juinsa\controllers\Admin\Product\ProductListAdminController','search']);
                $route->addRoute('GET','/admin/product/create',['Juinsa\controllers\Admin\Product\ProductCreateAdminController','index']);
                $route->addRoute('POST','/admin/product/create',['Juinsa\controllers\Admin\Product\ProductCreateAdminController','create']);
                $route->addRoute('POST','/admin/product/attributes',['Juinsa\controllers\Admin\Product\ProductAjaxAdminController','getAttributes']);
                $route->addRoute('GET','/admin/product/edit/{id:\d+}',['Juinsa\controllers\Admin\Product\ProductEditAdminController','edit']);
                $route->addRoute('POST','/admin/product/edit/{id:\d+}',['Juinsa\controllers\Admin\Product\ProductEditAdminController','editSave']);
                $route->addRoute('GET','/admin/product/remove/{id:\d+}',['Juinsa\controllers\Admin\Product\ProductRemoveAdminController','remove']);
                $route->addRoute('GET','/admin/categories',['Juinsa\controllers\Admin\Category\CategoryListAdminController','index']);
                $route->addRoute('POST','/admin/categories',['Juinsa\controllers\Admin\Category\CategoryListAdminController','search']);
                $route->addRoute('GET','/admin/category/create',['Juinsa\controllers\Admin\Category\CategoryCreateAdminController','index']);
                $route->addRoute('POST','/admin/category/create',['Juinsa\controllers\Admin\Category\CategoryCreateAdminController','create']);
                $route->addRoute('GET','/admin/category/edit/{id:\d+}',['Juinsa\controllers\Admin\Category\CategoryEditAdminController','edit']);
                $route->addRoute('POST','/admin/category/edit/{id:\d+}',['Juinsa\controllers\Admin\Category\CategoryEditAdminController','editSave']);
                $route->addRoute('GET','/admin/category/remove/{id:\d+}',['Juinsa\controllers\Admin\Category\CategoryRemoveAdminController','remove']);
            }
        );
    }
}