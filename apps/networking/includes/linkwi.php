<?php

  // Assign file paths to PHP constants admin folder
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("INCLUDES", dirname(__FILE__));   //dir to includes folder
  define("PROJECT_PATH", dirname(INCLUDES)); //dir to root folder
  
  define("ADMIN_PAGE_PATH", PROJECT_PATH . '/admin/includes'); //dir to pages folder
  define("ADMIN_FUNCTIONS_PATH", PROJECT_PATH . '/includes/functions'); //dir to functions folder
  define("ADMIN_VIEW_PATH", PROJECT_PATH . '/admin/pages/view'); //dir to pages folder
  define("ADMIN_EDIT_PATH", PROJECT_PATH . '/admin/pages/edit'); //dir to pages folder
  define("ADMIN_NEW_PATH", PROJECT_PATH . '/admin/pages/new'); //dir to pages folder
  define("ADMIN_LOGIN_PATH", PROJECT_PATH . '/admin/logins'); //dir to files folder
  define("ADMIN_FUNCTION_PATH", PROJECT_PATH . '/admin/includes/functions'); //dir to files folder
    define("ADMIN_INCLUDES_PATH", PROJECT_PATH . '/admin/includes'); //dir to files folder
  
   // Assign file paths to PHP constants linkwi folder
  define("LINKWI_PATH", PROJECT_PATH . '/linkwi'); //dir to linkwi folder
  define("LINKWI_INCLUDES_PATH", PROJECT_PATH . '/linkwi/includes'); //dir to pages folder
  define("LINKWI_PAGE_PATH", PROJECT_PATH . '/linkwi/pages'); //dir to pages folder
  define("LINKWI_FUNCTIONS_PATH", PROJECT_PATH . '/linkwi/includes/functions'); //dir to functions folder
  define("LINKWI_VIEW_PATH", PROJECT_PATH . '/linkwi/pages/view'); //dir to pages folder
  define("LINKWI_EDIT_PATH", PROJECT_PATH . '/linkwi/pages/edit'); //dir to pages folder
  define("LINKWI_NEW_PATH", PROJECT_PATH . '/linkwi/pages/new'); //dir to pages folder
  define("LINKWI_AJAX_PATH", PROJECT_PATH . '/linkwi/ajax'); //dir to ajax folder
  define("LINKWI_FORMCLASS_PATH", PROJECT_PATH . '/linkwi/pages/formclass'); //dir to formclass folder
  define("LINKWI_IMG_PATH", PROJECT_PATH . '/linkwi/images'); //dir to img folder
  define("LINKWI_IDCARD_PATH", PROJECT_PATH . '/linkwi/img/idcards'); //dir to img folder
  define("LINKWI_FILES_PATH", PROJECT_PATH . '/linkwi/files'); //dir to files folder
  define("LINKWI_CLASSES_PATH", PROJECT_PATH . '/linkwi/includes/classes'); //dir to files folder
  define("LINKWI_LOGIN_PATH", PROJECT_PATH . '/linkwi/logins'); //dir to files folder
  
  define("SECRET_KEY", 'ABCDEFG');
  define("SECRET_IV", '123456789');
  
  // define("FRONT_VIEW_PATH", PROJECT_PATH . '/linkwi/views'); //dir to pages folder
  
  require (LINKWI_CLASSES_PATH .'/db.connect.php');
  require (LINKWI_FUNCTIONS_PATH . '/helper.functions.php');