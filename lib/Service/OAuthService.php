<?php

namespace Autoinspector\Service;

use Autoinspector\Helper\Helper;
use Error;

class OAuthService
{

    const CLIENT_APP_ID_ENV = 'AUTOINSPECTOR_OAUTH_CLIENT_APP_ID';
    const CLIENT_SECRET_ENV = 'AUTOINSPECTOR_OAUTH_CLIENT_SECRET';

    private $client;

    public function __construct($client)
    {

        $necessaryCredentials = [self::CLIENT_APP_ID_ENV, self::CLIENT_SECRET_ENV];

        foreach ($necessaryCredentials as $credentialKey) {

            if ($this->getEnv($credentialKey) == null) {
                throw new Error("The environment variable " . $credentialKey . " is mandatory to use OAuth Service");
            }
        }

        $this->client = $client;
    }

    private function getEnv($key)
    {
        try {
            return $_ENV[$key];
        } catch (\Throwable $th) {
            return getenv($key);
        }
    }

    private function getOAuthCredentials()
    {

        return [
            'client_app_id' => $this->getEnv(self::CLIENT_APP_ID_ENV),
            'client_secret' => $this->getEnv(self::CLIENT_SECRET_ENV),
        ];
    }

    public function exchangeCodeForAccessToken($code)
    {

        return Helper::requestWrapper(function () use ($code) {
            return $this->client->post('account/oauth/exchange_code', [
                'json' => array_merge($this->getOAuthCredentials(), [
                    'code' => $code
                ])
            ]);
        });
    }

    public function buildAuthorizationLink($scopes)
    {

        return 'https://dashboard.autoinspector.com.ar/oauth/connect?' . http_build_query(
            [
                "scopes" => $scopes,
                "client_app_id" => $this->getOAuthCredentials()['client_app_id']
            ]
        );
    }


    public function refreshAccessToken($refreshToken)
    {

        return Helper::requestWrapper(function () use ($refreshToken) {
            return $this->client->post(
                'account/oauth/refresh_token',
                [
                    'json' => [
                        ...$this->getOAuthCredentials(),
                        'refreshToken' => $refreshToken
                    ]
                ],

            );
        });
    }
}
