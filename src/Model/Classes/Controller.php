<?php

namespace Yanntyb\Controller\Model\Classes;


use Twig\Environment;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;

/**
 * Every controller that need to render a view should extend this class
 */
class Controller extends Environment
{

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        parent::__construct($loader, [
            'debug' => true,
            'strict_variables' => true,
            'cache' =>  __DIR__ . '/../../var/cache',
            'auto_reload' => true
        ]);

        $this->addExtension(new DebugExtension());
    }

    /**
     * @param string|TemplateWrapper $name
     * @param array $context
     * @return string
     * @throws Error
     */
    public function render($name, array $context = []): string
    {
        try {
            $tpl = parent::render($name, $context);
        }
        catch (LoaderError $e) {
            throw new Error("Error loading template '$name'");
        } catch (RuntimeError $e) {
            throw new Error("Error loading template '$name'");
        } catch (SyntaxError $e) {
            throw new Error("Error loading template '$name'");
        }
        echo $tpl;
        return  $tpl;
    }
}