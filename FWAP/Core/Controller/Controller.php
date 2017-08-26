<?php

/**
 *
 * APWEB Framework (http://framework.artphoweb.com/)
 * APWEB FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  APWEB  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */
/**
 * @property
 */

namespace FWAP\Core\Controller;


use FWAP\Core\Model\Model;
use FWAP\Core\View\iView;
use FWAP\Core\View\View;
use FWAP\Helpers\Uploads;
use FWAP\Library\Bootstrap;
use FWAP\Helpers\Language;
use FWAP\Library\Log;
use FWAP\Helpers\Security\Session;

/**
 * @property iView iView desacopolamento da View
 * @property iLanguage iLanguage desacopolamento da Language
 */
abstract class Controller extends Model implements iController {

    public $view;
    public $language;
    public $model;
    public $compo;
    public $log;
    public $imagem;
    public $getServiceLocator;
    public $route;


    /**
     * Ap_Controller constructor.
     *  call method function  init
     * View view estancia a class view
     * call method LoadeModel();
     */
    public function __construct( ) {

        Session::init();

        $this->view = new View();
        $this->imagem = new Uploads();


        $this->getModel();
    }

    public function getModel() {

        return $this->model = $this->getloadModel();
    }

}
