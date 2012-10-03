<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\View\Renderer\PhpRenderer,
    Zend\View\Model\ViewModel,
    Zend\View\Resolver; 

/**
 * @author Adrien Moiraud
 * @version 03/10/2012
 */
class MakePagination extends AbstractHelper
{
    /**
     * Return pagination
     * 
     * @param int $nbResults, Number of results total
     * @param int $actualPage, Actual page
     * @param int $nbPages, Number of pages
     * @return Zend\View\Renderer\PhpRenderer $renderer, Renderer
     */
    public function __invoke($nbResults, $actualPage, $nbPages)
    {
        // Instanciate PhpRenderer
        $renderer = new PhpRenderer();

        // Instanciate ViewModel and disable layout
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        
        // Send variables to the template
        $viewModel->setVariable('nbResults', $nbResults);
        $viewModel->setVariable('actualPage', $actualPage);
        $viewModel->setVariable('nbPages', $nbPages);
        
        // Mapping the template
        $map = new Resolver\TemplateMapResolver(array(
            'pagination' => __DIR__ . '/templates/pagination.phtml',
        ));

        // Define resolver
        $resolver = new Resolver\TemplateMapResolver($map);
        $renderer->setResolver($resolver);
        
        // Calling template pagination
        $viewModel->setTemplate('pagination');
        
        // Return the renderer
        return $renderer->render($viewModel);
    }
}