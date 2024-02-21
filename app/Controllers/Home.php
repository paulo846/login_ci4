<?php

namespace App\Controllers;

use Google_Client;

class Home extends BaseController
{
    protected $helpers = ['url'];

    public function index(): string
    {
        return view('html/Home');
    }

    public function google()
    {

        $client = new Google_Client();

        $client->setClientId("9927015839-rl2frbasu89489ik084u4c82im6h5etl.apps.googleusercontent.com");
        $client->setClientSecret("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");
        $client->setRedirectUri('https://login.multidesk.io/googlecallback');

        $client->addScope("email");
        $client->addScope("profile");

        // Definir o escopo para obter o e-mail do usuário
        //$client->setScopes(['email']);

        // Obter a URL de autorização
        $authUrl = $client->createAuthUrl();

        // Redirecionar o usuário para a página de autenticação do Google
        return redirect()->to($authUrl);


        // Gera a URL de autenticação do Google
        //$authUrl = $googleOAuth2->getAuthorizationUrl();

        // Redireciona o usuário para a página de autenticação do Google
        //return redirect()->to($authUrl);
    }

    public function googlecallback()
    {
        $client = new Google_Client();

        $client->setClientId("9927015839-rl2frbasu89489ik084u4c82im6h5etl.apps.googleusercontent.com");
        $client->setClientSecret("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");
        $client->setRedirectUri('https://login.multidesk.io/googlecallback');

        $code = $this->request->getVar('code');

        if ($code) {
            // Troque o código de autorização por tokens de acesso
            //echo $code ;
            $accessToken = $client->fetchAccessTokenWithAuthCode([$code]);

            var_dump($accessToken);

        }
    }
}
