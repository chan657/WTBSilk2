<?php

/**

 * Routes configuration 

 *

 * In this file, you set up routes to your controllers and their actions.

 * Routes are very important mechanism that allows you to freely connect

 * different urls to chosen controllers and their actions (functions).

 *

 * PHP 5

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

 * @package       app.Config

 * @since         CakePHP(tm) v 0.2.9

 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)

 */
/**

 * Here, we are connecting '/' (base path) to controller called 'Pages',

 * its action called 'display', and we pass a param to select the view file

 * to use (in this case, /app/View/Pages/home.ctp)...

 */

 $curTime = date('H:i');

// 10 pm = 11:30; 12:15 pm = 13:45
// 10 am = 23:30
/**
if($curTime >= '00:01' && $curTime<= '23:59')
    Router::connect('/', array('controller' => 'users', 'action' => 'demo')); 
else    
   Router::connect('/', array('controller' => 'users', 'action' => 'login'));

//Router::connect('/', array('controller' => 'users', 'action' => 'demo'));   
*/
//    Router::connect('/', array('controller' => 'users', 'action' => 'demo')); 
   Router::connect('/', array('controller' => 'users', 'action' => 'login'));

/**

 * cofig controller ,

 */
//Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/my-look-ups', array('controller' => 'look_ups', 'action' => 'index'));
Router::connect('/my-data', array('controller' => 'datas', 'action' => 'index'));
Router::connect('/action-items/**', array('controller' => 'action_items', 'action' => 'index'));
Router::connect('/my-builders', array('controller' => 'builders', 'action' => 'index'));
Router::connect('/my-builders/:slug', array('controller' => 'builders', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-partners', array('controller' => 'marketing_partners', 'action' => 'index'));
Router::connect('/my-partners/:slug', array('controller' => 'marketing_partners', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-builder-contacts', array('controller' => 'builder_contacts', 'action' => 'index'));
Router::connect('/my-builder-contacts/:slug', array('controller' => 'builder_contacts', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-projects', array('controller' => 'projects', 'action' => 'index'));
Router::connect('/my-projects/:slug', array('controller' => 'projects', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-clients', array('controller' => 'leads', 'action' => 'index'));
Router::connect('/my-clients/:slug', array('controller' => 'leads', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-payments', array('controller' => 'payments', 'action' => 'index'));
Router::connect('/my-payments/:slug', array('controller' => 'payments', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-finance', array('controller' => 'finances', 'action' => 'index'));
Router::connect('/my-finance/:slug', array('controller' => 'finances', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-cities', array('controller' => 'cities', 'action' => 'index'));
Router::connect('/my-channels', array('controller' => 'channels', 'action' => 'index'));
Router::connect('/my-suburbs', array('controller' => 'suburbs', 'action' => 'index'));
Router::connect('/my-areas', array('controller' => 'areas', 'action' => 'index'));
Router::connect('/my-permissions', array('controller' => 'permission_sets', 'action' => 'index'));
Router::connect('/my-groups', array('controller' => 'users', 'action' => 'group'));
Router::connect('/my-roles', array('controller' => 'roles', 'action' => 'index'));
Router::connect('/my-users', array('controller' => 'users', 'action' => 'index'));
Router::connect('/my-agents', array('controller' => 'agents', 'action' => 'index'));
Router::connect('/my-agents/:slug', array('controller' => 'agents', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-deals', array('controller' => 'deals', 'action' => 'index'));
Router::connect('/my-deals/:slug', array('controller' => 'deals', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-owners', array('controller' => 'owners', 'action' => 'index'));
Router::connect('/my-owners/:slug', array('controller' => 'owners', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-owners/edit/:slug-:id', array('controller' => 'owners', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-owners/view/:slug-:id', array('controller' => 'owners', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-consultants', array('controller' => 'consultants', 'action' => 'index'));
Router::connect('/my-consultants/:slug', array('controller' => 'consultants', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-consultants/edit/:slug-:id', array('controller' => 'consultants', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-consultants/view/:slug-:id', array('controller' => 'consultants', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-properties', array('controller' => 'properties', 'action' => 'index'));
Router::connect('/my-properties/:slug', array('controller' => 'properties', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-properties/edit/:slug-:id', array('controller' => 'properties', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-properties/view/:slug-:id', array('controller' => 'properties', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-hotels', array('controller' => 'travel_hotel_lookups', 'action' => 'index'));
Router::connect('/my-hotels/:slug', array('controller' => 'travel_hotel_lookups', 'action' => 'index'), array('pass' => array('slug')));
Router::connect('/my-mappings', array('controller' => 'mappinges', 'action' => 'index'));
Router::connect('/my-mappings/:slug', array('controller' => 'mappinges', 'action' => 'index'), array('pass' => array('slug')));

Router::connect('/my-users/:slug-:id-:mode', array('controller' => 'users', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-roles/:slug-:id-:mode', array('controller' => 'roles', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-groups/:slug-:id-:mode', array('controller' => 'users', 'action' => 'group_edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-areas/:slug-:id-:mode', array('controller' => 'areas', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-suburbs/:slug-:id-:mode', array('controller' => 'suburbs', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-channels/:slug-:id-:mode', array('controller' => 'channels', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-cities/:slug-:id-:mode', array('controller' => 'cities', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-clients/edit/:slug-:id', array('controller' => 'leads', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-clients/view/:slug-:id', array('controller' => 'leads', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-projects/edit/:slug-:id', array('controller' => 'projects', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-projects/view/:slug-:id', array('controller' => 'projects', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-builders/edit/:slug-:id', array('controller' => 'builders', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-builders/view/:slug-:id', array('controller' => 'builders', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-builder-contacts/edit/:slug-:id', array('controller' => 'builder_contacts', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-partners/edit/:slug-:id', array('controller' => 'marketing_partners', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-partners/view/:slug-:id', array('controller' => 'marketing_partners', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-agents/edit/:slug-:id', array('controller' => 'agents', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-agents/view/:slug-:id', array('controller' => 'agents', 'action' => 'view'), array('pass' => array('id', 'slug')));
Router::connect('/my-deals/edit/:slug-:id', array('controller' => 'deals', 'action' => 'edit'), array('pass' => array('id', 'slug')));
Router::connect('/my-deals/view/:slug-:id', array('controller' => 'deals', 'action' => 'view'), array('pass' => array('id', 'slug')));

Router::connect('/my-travel-suburbs', array('controller' => 'travel_suburbs', 'action' => 'index'));
Router::connect('/my-travel-suburbs/:slug-:id-:mode', array('controller' => 'travel_suburbs', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-travel-areas', array('controller' => 'travel_areas', 'action' => 'index'));
Router::connect('/my-travel-areas/:slug-:id-:mode', array('controller' => 'travel_areas', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-travel-chains', array('controller' => 'travel_chains', 'action' => 'index'));
Router::connect('/my-travel-chains/:slug-:id-:mode', array('controller' => 'travel_chains', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-travel-brands', array('controller' => 'travel_brands', 'action' => 'index'));
Router::connect('/my-travel-brands/:slug-:id-:mode', array('controller' => 'travel_brands', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-owner-companies', array('controller' => 'travel_owner_companies', 'action' => 'index'));
Router::connect('/my-owner-companies/:slug-:id-:mode', array('controller' => 'travel_owner_companies', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-travel-cities', array('controller' => 'travel_cities', 'action' => 'index'));
Router::connect('/my-travel-cities/:slug-:id-:mode', array('controller' => 'travel_cities', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-provinces', array('controller' => 'provinces', 'action' => 'index'));
Router::connect('/my-provinces/:slug-:id-:mode', array('controller' => 'provinces', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));
Router::connect('/my-travel-countries', array('controller' => 'travel_countries', 'action' => 'index'));
Router::connect('/my-travel-countries/:slug-:id-:mode', array('controller' => 'travel_countries', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-travel-continents', array('controller' => 'travel_lookup_continents', 'action' => 'index'));
Router::connect('/my-travel-continents/:slug-:id-:mode', array('controller' => 'travel_lookup_continents', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-travel-lookups', array('controller' => 'travel_look_ups', 'action' => 'index'));
Router::connect('/my-hotel-amenities', array('controller' => 'lookup_hotel_amenity', 'action' => 'index'));

Router::connect('/tech-area', array('controller' => 'tech_areas', 'action' => 'index'));
Router::connect('/db-area', array('controller' => 'download_tables', 'action' => 'index'));

Router::connect('/my-persons', array('controller' => 'dig_persons', 'action' => 'index'));
Router::connect('/my-persons/:slug-:id-:mode', array('controller' => 'dig_persons', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-lots', array('controller' => 'dig_lots', 'action' => 'index'));
Router::connect('/my-lots/:slug-:id-:mode', array('controller' => 'dig_lots', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-lot-links', array('controller' => 'dig_lot_links', 'action' => 'index'));
Router::connect('/my-lot-links/:slug-:id-:mode', array('controller' => 'dig_lot_links', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-bases', array('controller' => 'dig_bases', 'action' => 'index'));
Router::connect('/my-bases/:slug-:id-:mode', array('controller' => 'dig_bases', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-accounts', array('controller' => 'dig_accounts', 'action' => 'index'));
Router::connect('/my-accounts/:slug-:id-:mode', array('controller' => 'dig_accounts', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-topics', array('controller' => 'dig_topics', 'action' => 'index'));
Router::connect('/my-topics/:slug-:id-:mode', array('controller' => 'dig_topics', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-levels', array('controller' => 'dig_levels', 'action' => 'index'));
Router::connect('/my-levels/:slug-:id-:mode', array('controller' => 'dig_levels', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-structures', array('controller' => 'dig_structures', 'action' => 'index'));
Router::connect('/my-structures/:slug-:id-:mode', array('controller' => 'dig_structures', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/my-suppliers', array('controller' => 'travel_suppliers', 'action' => 'index'));
Router::connect('/my-suppliers/:slug-:id-:mode', array('controller' => 'travel_suppliers', 'action' => 'edit'), array('pass' => array('id', 'mode', 'slug')));

Router::connect('/s/:id',array('controller'=>'tests', 'action'=>'shorturl'), array('pass'=>array('id')));





Router::connect('/my-permissions/by-controller', array('controller' => 'permission_sets', 'action' => 'byController'));
Router::connect('/my-permissions/edit-by-controller/:id', array('controller' => 'permission_sets', 'action' => 'editByController'),array('pass'=>array('id')));

Router::connect('/my-permissions/by-roles', array('controller' => 'permission_sets', 'action' => 'byRoles'));
Router::connect('/my-permissions/edit-by-role/:id', array('controller' => 'permission_sets', 'action' => 'editByRole'),array('pass'=>array('id')));

//Router::connect('/:shortcode', array('controller' => 'tests', 'action' => 'shorturl'), array('pass'=>array('shortcode')));
//Router::connect('/:id',array('controller'=>'tests', 'action'=>'shorturl'),array('id'=>'\\d+'));
//Router::connect('/s:id',array('controller'=>'tests', 'action'=>'shorturl'),array('pass' => array('id')));

/*

  Router::connect("/message/:storesection/",

  array(

  'controller' => 'messages', 'action' => 'index'

  ),

  array(



  'pass' => array('category', 'productname', 'storesection')

  )

  );

 */

// Router::redirect('/message/:id',array('controller' => 'messages', 'action' => 'index'),array('persistent' => true, 'pass' => array('slug','id')));

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

