<?php

declare(strict_types=1);

namespace PhpChorusPiste;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ChorusPiste
{
    public const AUTH_SANDBOX_URL = 'https://sandbox-oauth.piste.gouv.fr/api/oauth/token';
    public const AUTH_PRODUCTION_URL = 'https://oauth.piste.gouv.fr/api/oauth/token';
    public const API_SANDBOX_URL = 'https://sandbox-oauth.piste.gouv.fr';
    public const API_PRODUCTION_URL = 'https://api.piste.gouv.fr';

    /** @var Client $client */
    private Client $client;

    /**
     * ChorusPiste constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param string $tech_username
     * @param string $tech_password
     * @param bool $sandbox
     * @throws GuzzleException
     */
    public function __construct(
        string $client_id,
        string $client_secret,
        string $tech_username,
        string $tech_password,
        bool $sandbox = true
    ) {
        $authClient = new Client();
        $auth = $authClient->post(
            $sandbox ? self::AUTH_SANDBOX_URL : self::AUTH_PRODUCTION_URL,
            [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                    'scope' => 'openid'
                ]
            ]
        );
        $response = json_decode($auth->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
        $token = $response->access_token;
        $this->client = new Client(
            [
                'base_uri' => $sandbox ? self::API_SANDBOX_URL : self::API_PRODUCTION_URL,
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'cpro-account' => base64_encode($tech_username . ':' . $tech_password),
                    'Content-Type' => 'application/json;charset=utf-8',
                    'Accept' => 'application/json;charset=utf-8'
                ]
            ]
        );
    }

    /**
     * @param string $invoiceId
     * @param string $syntax
     * @return mixed
     * @throws GuzzleException
     */
    public function getStatusDepot(string $invoiceId, string $syntax = IFlux::IN_DP_E2_UBL_INVOICE_MIN): object
    {
        $request = $this->client->post(
            '/cpro/transverses/v1/consulterCRDetaille',
            [
                'json' => [
                    'numeroFluxDepot' => $invoiceId,
                    'syntaxeFlux' => $syntax
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        return json_decode($response, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $template
     * @param bool $avecSignature
     * @param string $syntaxeFlux
     * @param string $nomFichier
     * @return mixed
     * @throws GuzzleException
     */
    public function postFluxFacture(
        string $template,
        bool $avecSignature = false,
        string $syntaxeFlux = IFlux::IN_DP_E2_UBL_INVOICE_MIN,
        string $nomFichier = 'DepotFactureUBLE2V21.xml'
    ): object {
        $request = $this->client->post(
            '/cpro/factures/v1/deposer/flux',
            [
                'json' => [
                    'idUtilisateurCourant' => 0,
                    'fichierFlux' => base64_encode($template),
                    'nomFichier' => $nomFichier . '.xml',
                    'syntaxeFlux' => $syntaxeFlux,
                    'avecSignature' => $avecSignature
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        return json_decode($response, false, 512, JSON_THROW_ON_ERROR);
    }
}
