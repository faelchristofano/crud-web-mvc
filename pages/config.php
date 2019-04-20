<?php
if ( !defined('TITULO') )
    define('TITULO', 'RMC Oficina :: Sistema de Gerenciamento de Oficina');

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__));

/** caminho da url do servidor **/
if ( !defined('BASEURL') )
    define('BASEURL', $_SERVER['SERVER_NAME'].'/oficina');

/** caminho para conexao com o Banco de Dados */
if ( !defined('CONEXAO') )
    define('CONEXAO', 'c:\wamp64\www\oficina\Conexao\Conexao.php');

/** caminho para MODEL */
if ( !defined('MODEL') )
    define('MODEL', 'c:\wamp64\www\oficina\Model');

    /* caminho para iMAGENS */
    if ( !defined('IMAGENS') )
    define('IMAGENS', 'c:\wamp64\www\oficina\pages\img');

/** caminho para CONTROLLER */
if ( !defined('CONTROLLER') )
    define('CONTROLLER', 'c:\wamp64\www\oficina\Controller');
    
if ( !defined('CSS_BOOTSTRAP') )
    define('CSS_BOOTSTRAP', BASEURL.'/vendor/bootstrap/css/bootstrap.min.css');

/** caminho para CSS metisMenu */
if ( !defined('CSS_METISMENU') )
    define('CSS_METISMENU', BASEURL.'/vendor/metisMenu/metisMenu.min.css');

/** caminho para CSS custom */
if ( !defined('CSS_CUSTOM') )
    define('CSS_CUSTOM', BASEURL.'/dist/css/sb-admin-2.css');

/** caminho para CSS fonts */
if ( !defined('FONTS') )
    define('FONTS', BASEURL.'/vendor/font-awesome/css/font-awesome.min.css');

/** caminho para JQUERY */
if ( !defined('JQUERY') )
    define('JQUERY', BASEURL.'/vendor/jquery/jquery.min.js');

/** caminho para JQUERY MASK PLUGIN */
if ( !defined('MASK') )
    define('MASK', BASEURL.'/vendor/jquery-mask/jquery.mask.min.js');

/** caminho para JQUERY VALIDATION PLUGIN */
if ( !defined('VALIDATION') )
    define('VALIDATION', BASEURL.'/vendor/jquery-validation/jquery.validate.min.js');
  
/** caminho para JQUERY VALIDATION_ADDITIONAL PLUGIN */
if ( !defined('VALIDATION_ADDITIONAL') )
    define('VALIDATION_ADDITIONAL', BASEURL.'/vendor/jquery-validation/additional-methods.min.js');

/** caminho para JQUERY VALIDATION_ADDITIONAL PLUGIN */
if ( !defined('VALIDAR_CNPJ') )
    define('VALIDAR_CNPJ', BASEURL.'/vendor/jquery-validation/validarCNPJ.js');

/** caminho para JQUERY VALIDATION_LOCALIZATION PLUGIN */
if ( !defined('VALIDATION_LOCALIZATION') )
    define('VALIDATION_LOCALIZATION', BASEURL.'/vendor/jquery-validation/localization/messages_pt_BR.min.js');

/** caminho para JavaScript */
if ( !defined('JS') )
    define('JS', BASEURL.'/vendor/bootstrap/js/bootstrap.min.js');

/** caminho para JavaScript */
if ( !defined('METIS_JS') )
    define('METIS_JS', BASEURL.'/vendor/metisMenu/metisMenu.min.js');

/** caminho para JavaScript */
if ( !defined('THEME_JS') )
    define('THEME_JS', BASEURL.'/dist/js/sb-admin-2.js');

/** caminho para Charts CSS */
if ( !defined('CHARTS_CSS') )
    define('CHARTS_CSS', BASEURL.'/vendor/morrisjs/morris.css');

/** caminho para Charts JavaScript*/
if ( !defined('CHARTS_JS1') )
    define('CHARTS_JS1', BASEURL.'/vendor/raphael/raphael.min.js');
if ( !defined('CHARTS_JS2') )
    define('CHARTS_JS2', BASEURL.'/vendor/morrisjs/morris.min.js');
if ( !defined('CHARTS_JS3') )
    define('CHARTS_JS3', BASEURL.'/data/morris-data.js');

/** DataTables CSS */
if ( !defined('TABLE_CSS') )
    define('TABLE_CSS', BASEURL.'/vendor/datatables-plugins/dataTables.bootstrap.css');
/** DataTables Responsive CSS */
if ( !defined('TABLE_CSS_RESP') )
    define('TABLE_CSS_RESP', BASEURL.'/vendor/datatables-responsive/dataTables.responsive.css');

/** DataTables JavaScript */
if ( !defined('TABLE_JS1') )
    define('TABLE_JS1', BASEURL.'/vendor/datatables/js/jquery.dataTables.min.js');
if ( !defined('TABLE_JS2') )
    define('TABLE_JS2', BASEURL.'/vendor/datatables-plugins/dataTables.bootstrap.min.js');
if ( !defined('TABLE_JS3') )
    define('TABLE_JS3', BASEURL.'/vendor/datatables-responsive/dataTables.responsive.js');


include_once 'c:\wamp64\www\oficina\functions\functions.php';





