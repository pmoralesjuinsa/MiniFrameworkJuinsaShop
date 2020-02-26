<?php
declare(strict_types=1);

namespace Juinsa;


class ViewManager
{

    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
        $this->twig = new \Twig\Environment($loader, [
//            'cache' => dirname(__DIR__) . '/cache/views'
        ]);
    }

    public function render($view, $args = [])
    {
        if ($args != null) {
            extract($args, EXTR_SKIP);
        }
        $file = dirname(__DIR__) . '/templates/' . $view;
        if (is_readable($file)) {
            require $file;
        } else {
            throw  new \InvalidArgumentException();
        }

    }

    public function renderTemplate($template, $args = [])
    {
        $customerAuthed = (array)getAuthenticatedCustomer();
        $argsWithSession = array_merge($args, ["customerAuthed" => $customerAuthed]);

//        \Kint::dump($argsWithSession);
        echo $this->twig->render($template, $argsWithSession);
    }


}