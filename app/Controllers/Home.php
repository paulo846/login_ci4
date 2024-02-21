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
        $client->addScope('openid');
        $client->addScope('profile');
        $client->addScope('email');

        $code = $this->request->getVar('code');

        if ($code) {
            // Troque o código de autorização por tokens de acesso
            $accessToken = $client->fetchAccessTokenWithAuthCode($code);

            if (!isset($accessToken['error'])) {
                // Os tokens de acesso foram obtidos com sucesso

                // Configure o cliente com os tokens de acesso
                $client->setAccessToken($accessToken);

                // Verifique se os tokens ainda são válidos
                if ($client->isAccessTokenExpired()) {
                    // Se os tokens expiraram, você pode tentar renová-los
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                }

                // Crie um serviço para a API do Google Oauth2
                $oauth2Service = new \Google\Service\Oauth2($client);

                // Obtenha as informações do perfil do usuário
                $userInfo = $oauth2Service->userinfo->get();

                // Agora você pode acessar as informações do usuário, como o email
                $email = $userInfo->getEmail();

                echo "<pre>";
                print_r($userInfo);

                // Faça o que for necessário com as informações do usuário
                // Por exemplo, autentique o usuário em seu sistema

                // Exemplo de como imprimir o e-mail do usuário
                //echo "E-mail do usuário: " . $email;
            } else {
                // Houve um erro ao obter os tokens de acesso
                // Trate o erro conforme necessário
                echo "Erro ao obter tokens de acesso: " . $accessToken['error'];
            }
        }
    }

    public function msg()
    {
        if ($this->request->getVar('msg')) {

            // Supondo que você tenha recuperado os dados do banco de dados em um array chamado $clientes
            $clientes = array(
                array("nome" => "Fulano", "email" => "fulano@example.com"),
                array("nome" => "Ciclano", "email" => "ciclano@example.com"),
                // Mais clientes...
            );

            // Simulação de cobranças
            $cobrancas = array(
                "fulano@example.com"  => true,  // Tem cobrança para Fulano
                "ciclano@example.com" => true,  // Tem cobrança para Ciclano
                // Adicione mais cobranças conforme necessário
            );

            // Texto pré-configurado
            $texto = $this->request->getVar('msg');

            // Loop pelos clientes
            foreach ($clientes as $cliente) {
                $nome = $cliente["nome"];
                $email = $cliente["email"];

                // Verifica se há cobrança para este cliente
                if (isset($cobrancas[$email]) && $cobrancas[$email]) {
                    // Substitua as marcações pelos valores dinâmicos
                    $mensagem = str_replace("{nome}", $nome, $texto);
                    $mensagem = str_replace("{email}", $email, $mensagem);
                    //echo $mensagem . '<br>';
                }
            }
        } else {
            $mensagem = false;
        }

        return view('html/msg', ['msg' => $mensagem]);
    }
}
