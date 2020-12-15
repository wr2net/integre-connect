<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use IntegreConnect\Connection\IntegreConnect;
use IntegreConnect\Connection\IncludeHires\ClientHired;
use IntegreConnect\Connection\IncludeHires\ParseBilling;
use IntegreConnect\Connection\IncludeHires\ParseClient;

/**
 * Class IntegreConnectTest
 */
class IntegreConnectTest extends TestCase
{

    /**
     * @var IntegreConnect
     */
    protected $integre;

    /**
     * @var array
     */
    protected $clientData;

    /**
     * @var array
     */
    protected $billingData;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    private $host;

    /**
     * @var ClientHired
     */
    protected $client;

    /**
     * @var ParseBilling
     */
    protected $parseBilling;

    /**
     * @var ParseClient
     */
    protected $parseClient;

    /**
     * Initial setUp to tests
     */
    public function setUp(): void
    {
        $this->host = "";
        $this->endpoint = "";
        $this->key = "";
        $this->action = "";
        $this->version = "";

        $this->clientData = [
            'name' => '',
            'document' => '',
            'birth_date' => '',
            'civil_state' => '',
            'telephone' => '',
            'cellphone' => '',
            'email' => '',
            'mother_name' => '',
            'zip_code' => '',
            'address' => '',
            'number' => '',
            'complement' => '',
            'neighborhood' => '',
            'city' => '',
            'state' => '',
            'product' => '',
            'fid' => '',
        ];

        $this->billingData = [
            'ds_cartao_token' => '',
            'flag' => '',
            'prefix' => '',
            'sufix' => '',
            'shelf_life' => '',
            'client_name' => ''
        ];

        $this->integre = new IntegreConnect($this->host, $this->endpoint, $this->key);
        $this->client = new ClientHired;
    }

    /**
     * @test
     */
    public function verifyContainsInstanceOf()
    {
        $this->assertInstanceOf(IntegreConnect::class, $this->integre);
    }

    /**
     * @test
     */
    public function verifyClientHired()
    {
        $this->assertInstanceof(ClientHired::class, $this->client);
    }

    /**
     * @test
     */
    public function verifyContainsInstanceOfSend()
    {
        $this->assertTrue( method_exists( $this->integre, 'send' ), 'Method not found: send()' );
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     */
    public function verifyQuantityKeys()
    {
        $this->assertCount(6, $this->billingData);
        $this->assertCount(17, $this->clientData);
    }

    /**
     * @test
     */
    public function verifyIsJsonParseBilling()
    {
        $this->assertJson(ParseBilling::parseTransaction($this->billingData));
    }

    /**
     * @test
     */
    public function verifyIsJsonParseClient()
    {
        $this->assertJson(ParseClient::parseClient($this->clientData));
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     */
    public function verifyHasKey()
    {
        $this->assertArrayHasKey('name', $this->clientData);
        $this->assertArrayHasKey('document', $this->clientData);
        $this->assertArrayHasKey('birth_date', $this->clientData);
        $this->assertArrayHasKey('telephone', $this->clientData);
        $this->assertArrayHasKey('cellphone', $this->clientData);
        $this->assertArrayHasKey('email', $this->clientData);
        $this->assertArrayHasKey('mother_name', $this->clientData);
        $this->assertArrayHasKey('civil_state', $this->clientData);
        $this->assertArrayHasKey('zip_code', $this->clientData);
        $this->assertArrayHasKey('address', $this->clientData);
        $this->assertArrayHasKey('number', $this->clientData);
        $this->assertArrayHasKey('complement', $this->clientData);
        $this->assertArrayHasKey('neighborhood', $this->clientData);
        $this->assertArrayHasKey('city', $this->clientData);
        $this->assertArrayHasKey('state', $this->clientData);
        $this->assertArrayHasKey('product', $this->clientData);
        $this->assertArrayHasKey('fid', $this->clientData);
    }
}