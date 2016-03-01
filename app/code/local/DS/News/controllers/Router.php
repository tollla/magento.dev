<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 21.02.2016
 * Time: 0:10
 */

class DS_News_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{

    public function initControllerRouters($observer)
    {
        die(__FILE__.":".__LINE__);
        $front = $observer->getEvent()->getFront();
        $front->addRouter('dsnews', $this);

    }

    public function match(Zend_Controller_Request_Http $request)
    {die(__FILE__.":".__LINE__);
        $identifier = trim($request->getPathInfo(), '/');
        $cmd = explode('/', $identifier);

        if ($cmd[0] == 'news') {
            if (count($cmd) == 1) {
                return $this->_fillRequest($request);
            } else {
                $model = Mage::getModel('dsnews/news')->load($cmd[1], 'link');
                if ($model->getId()) {
                    $params = array(
                        'id' => $model->getId()
                    );
                    return $this->_fillRequest($request, $params, 'index', 'view');
                }
            }
        }
        return false;
    }

    protected function _fillRequest($request, $cmd = array(), $controller = 'index', $action = 'index')
    {
        $request->setModuleName('news')
            ->setControllerName($controller)
            ->setActionName($action)
            ->setParam('is_routed', 1);
        if (is_array($cmd) && count($cmd)) {
            foreach ($cmd as $key => $value) {
                $request->setParam($key, $value);
            }
        }

        $request->setAlias(Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS, $request->getPathInfo());
        return true;
    }

}