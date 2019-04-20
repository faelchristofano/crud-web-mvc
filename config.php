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
    define('CONEXAO', ABSPATH .'\Conexao\Conexao.php');

include_once CONEXAO;

/** caminho para MODEL */
if ( !defined('MODEL') )
    define('MODEL', 'c:\wamp64\www\oficina\Model');

    /* caminho para iMAGENS */
if ( !defined('IMAGENS') )
define('IMAGENS', 'c:\wamp64\www\oficina\pages\img');

/** caminho para CSS BOOTSTRAP */
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

include_once 'functions/functions.php';


