<?php

namespace Application\Controller;

use Application\Service\SearchService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    const CONTROLLER_NAME = 'Application\Controller\Index';

    /**
     * This is the home page.
     */
    public function indexAction()
    {
        $viewModel = new ViewModel();
        if ($this->getRequest()->isPost()) {
            $searchTerm = $this->params()->fromPost('searchTerm');
            $searchViewModel = $this->forward()
                ->dispatch(self::CONTROLLER_NAME, ['action' => 'search', 'searchTerm' => $searchTerm]);
            $viewModel->addChild($searchViewModel, 'searchResult');
        }
        return $viewModel;
    }

    /**
     * In this action the search term gets processed and the result will be rendered via the view model.
     */
    public function searchAction()
    {
        /** @var SearchService $searchService */
        $searchService = $this->getServiceLocator()->get(SearchService::class);
        $pictures = $searchService->doSearch($this->params('searchTerm'));
        return new ViewModel(['pictures' => $pictures]);
    }
}
