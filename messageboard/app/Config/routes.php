<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/* Hello World*/
	Router::connect('/hello', array('controller' => 'hello', 'action' => 'index'));

	Router::connect('/testitem', array('controller' => 'test_items', 'action' => 'index'));

	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/mypage', array('controller' => 'users', 'action' => 'mypage'));
	Router::connect('/register', array('controller' => 'users', 'action' => 'register'));
	Router::connect('/profile', array('controller' => 'users', 'action' => 'profile'));
	Router::connect('/messages', array('controller' => 'messages', 'action' => 'index'));
	Router::connect('/messages/add', array('controller' => 'messages', 'action' => 'add'));
	Router::connect(
    	'/messages/delete/:id',
    	array('controller' => 'messages', 'action' => 'delete'),
    	array('pass' => array('id'), 'id' => '[0-9]+')
	);
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

	Router::mapResources('messages');

	Router::resourceMap(array(
    array('action' => 'delete', 'method' => 'DELETE', 'id' => true),
));

	Router::connect('/profile_view', array('controller' => 'users', 'action' => 'profile_view'));

	Router::connect(
    '/messageboard/messages/add',
    array('controller' => 'messages', 'action' => 'add')
	);

	Router::connect('/messageboard/messages/:action/*', ['controller' => 'messages']);


	Router::connect('/users/ajax_photo_upload', array('controller' => 'users', 'action' => 'ajax_photo_upload'));


