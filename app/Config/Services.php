<?php

namespace Config;

use CodeIgniter\Config\BaseService;

use Google_Client;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function googleOAuth2()
    {
        
        $client = new Google_Client([
            'clientId'     => '9927015839-rl2frbasu89489ik084u4c82im6h5etl.apps.googleusercontent.com',
            'clientSecret' => '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',
            'redirectUri'  => 'https://login.multidesk.io/googlecallback',
        ]);

        return $client ;

        /*return new \Google\Client([
            'clientId'     => '9927015839-rl2frbasu89489ik084u4c82im6h5etl.apps.googleusercontent.com',
            'clientSecret' => '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',
            'redirectUri'  => 'https://login.multidesk.io/googlecallback',
        ]);*/



        
    }
}
