<?php

namespace yupdesign\AF;

use Psr\Log\LogLevel;
use Contao\CoreBundle\Monolog\ContaoContext;

class GeneratePDF extends \Frontend
{
	/**
     * Initialize the object (do not remove)
     */
    public function __construct()
    {
        parent::__construct();

        // See #4099
        if (!defined('BE_USER_LOGGED_IN'))
        {
            define('BE_USER_LOGGED_IN', false);
        }
        if (!defined('FE_USER_LOGGED_IN'))
        {
            define('FE_USER_LOGGED_IN', false);
        }
    }

    /**
     * Run the controller
     *
     * @return string
     */
    public function getPDF($lastname, $firstname) {
    echo 'blar';
    \System::getContainer()
    ->get('monolog.logger.contao')
    ->log(LogLevel::INFO, 'Ein Log-Eintrag', array(
    'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_GENERAL
    )));
    return 'blar';
    }
}