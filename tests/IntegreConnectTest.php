<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use IntegreConnect\Connection\IntegreConnectImpl;

/**
 * Class IntegreConnectTest
 */
class IntegreConnectTest extends TestCase
{

    /**
     * @var IntegreConnectImpl
     */
    protected $integre;

    /**
     * @var string[]
     */
    protected $integreData;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $key;

    /**
     * Initial setUp to tests
     */
    public function setUp(): void
    {
        $this->endpoint = "";
        $this->key = "";
        $this->integre = new IntegreConnectImpl($this->endpoint, $this->key);

        $this->integreData = [
            'Nome' => '',
            'Cpf' => '',
            'DataNascimento' => '',
            'TelefoneFixo' => '',
            'TelefoneMovel' => '',
            'Email' => '',
            'NomeMae' => '',
            'EstadoCivil' => '',
            'EnderecoCep' => '',
            'EnderecoDescricao' => '',
            'EnderecoNumero' => '',
            'EnderecoComplemento' => '',
            'EnderecoBairro' => '',
            'EnderecoCidadeNome' => '',
            'EnderecoCidadeEstado' => '',
            'Produto' => '',
            'Fid' => ''
        ];
    }

    /**
     * @test
     */
    public function verifyContainsInstanceOf()
    {
        $this->assertInstanceOf(IntegreConnectImpl::class, new IntegreConnectImpl($this->endpoint, $this->key));
    }

    /**
     * @test
     */
    public function verifyContaisInstanceOfDataCompose()
    {
        $this->assertTrue( method_exists( new IntegreConnectImpl($this->endpoint, $this->key), 'dataCompose' ), 'Method not found: dataCompose()' );
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     */
    public function verifyExistsAttributs()
    {
        $this->assertObjectHasAttribute('integreData', $this->integre);
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     * @depends verifyExistsAttributs
     */
    public function verifyQuantityKeys()
    {
        $this->assertCount(17, $this->integreData);
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     * @depends verifyExistsAttributs
     */
    public function verifyHasKey()
    {
        $this->assertArrayHasKey('Nome', $this->integreData);
        $this->assertArrayHasKey('Cpf', $this->integreData);
        $this->assertArrayHasKey('DataNascimento', $this->integreData);
        $this->assertArrayHasKey('TelefoneFixo', $this->integreData);
        $this->assertArrayHasKey('TelefoneMovel', $this->integreData);
        $this->assertArrayHasKey('Email', $this->integreData);
        $this->assertArrayHasKey('NomeMae', $this->integreData);
        $this->assertArrayHasKey('EstadoCivil', $this->integreData);
        $this->assertArrayHasKey('EnderecoCep', $this->integreData);
        $this->assertArrayHasKey('EnderecoDescricao', $this->integreData);
        $this->assertArrayHasKey('EnderecoNumero', $this->integreData);
        $this->assertArrayHasKey('EnderecoComplemento', $this->integreData);
        $this->assertArrayHasKey('EnderecoBairro', $this->integreData);
        $this->assertArrayHasKey('EnderecoCidadeNome', $this->integreData);
        $this->assertArrayHasKey('EnderecoCidadeEstado', $this->integreData);
        $this->assertArrayHasKey('Produto', $this->integreData);
        $this->assertArrayHasKey('Fid', $this->integreData);
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     * @depends verifyContaisInstanceOfDataCompose
     */
    public function verifyAsAJson()
    {
        $data = [
            'name' => null,
            'document' => null,
            'birth_date' => null,
            'telephone' => null,
            'cellphone' => null,
            'email' => null,
            'mother_name' => null,
            'marital_status' => null,
            'zip_code' => null,
            'public_place' => null,
            'number' => null,
            'complement' => null,
            'neighborhood' => null,
            'city' => null,
            'state' => null,
            'product_reference' => null,
            'fid' => null
        ];

        $this->assertJson($this->integre->dataCompose($data));
    }
}