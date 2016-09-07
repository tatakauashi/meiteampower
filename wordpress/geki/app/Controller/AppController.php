<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Session');
	
	// サマリーを参照可能な、最低投票数
	public $UNDER_VOTES = 20;
	
    public function beforeRender() {
     	$this->_setupSession();
    	$this->set("site_name","酒井選対票確保状況");
    }

    public function _getHash($pass) {
        return substr(hash('SHA256', $pass . 'xGzu:03|Cz4~S7<@l+Z4yl"Mv4S"d5iYhrMFRj&o'), 0, 8);
    }

    // ログインチェックとログインID取得
    function _checkLogin() {

    	$nowDateString = date("Y-m-d H:i:s", time());
    	if ("2016-06-17 15:00:00" < $nowDateString && $nowDateString < "2016-06-18 21:00:00") {
    		$this->redirect('http://mixi.jp/view_community.pl?id=6265369');
    		return false;
    	}
    	
//     	$loginId = $this->Cookie->read('loginId');
//    	$loginId = $this->Session->read('loginId');
    	$loginId = CakeSession::read('loginId');
//    	if (empty($loginId)) {
//    		$this->redirect('../login/');
//    	}
    
    	return $loginId;
    }

    function _setupSession() {
    	Configure::write('Session', array(
    					'default' => 'php',
    					'cookie' => 'geki',
    					'timeout' => 10080,		// 1 week
    					'autoRegenerate' => true,
    					'ini' => array(
    									'session.cookie_secure' => false
    					)
    	));
    }
    
}
