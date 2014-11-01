<?php
namespace Blog\Api\Controller;

use File\Form,
    Eva\Api,
    Eva\Mvc\Controller\ActionController,
    Zend\View\Model\JsonModel;

class CategoryController extends ActionController
{
    public function selectAction($params = null)
    {
        $itemModel = Api::_()->getModel('Blog\Model\Category');
        $items = $itemModel->getCategories();
        
        $select = array();

        foreach($items as $key => $item){
            
            $prefix = '';

            if ($item['level'] > 1) {
                $prefix = str_repeat("-",$item['level']); 
            }
            
            $select[] = array(
                'label' => $prefix . $item['categoryName'],
                'value' => $item['id'],
            );
        }

        return $select;
    }

}
