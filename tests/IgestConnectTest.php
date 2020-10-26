<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use IgestConnect\Connection\IgestConnectImpl;

/**
 * Class IgestConnectTest
 */
class IgestConnectTest extends TestCase
{

    /**
     * @var IgestConnectImpl
     */
    protected $igest;

    /**
     * @var string[]
     */
    protected $igestData;

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
        $this->igest = new IgestConnectImpl($this->endpoint, $this->key);

        $this->igestData = [
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
            'Fid' => ''
        ];
    }

    /**
     * @test
     */
    public function verifyContainsInstanceOf()
    {
        $this->assertInstanceOf(IgestConnectImpl::class, new IgestConnectImpl($this->endpoint, $this->key));
    }

    /**
     * @test
     */
    public function verifyContaisInstanceOfDataCompose()
    {
        $this->assertTrue( method_exists( new IgestConnectImpl($this->endpoint, $this->key), 'dataCompose' ), 'Method not found: dataCompose()' );
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     */
    public function verifyExistsAttributs()
    {
        $this->assertObjectHasAttribute('igestData', $this->igest);
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     * @depends verifyExistsAttributs
     */
    public function verifyQuantityKeys()
    {
        $this->assertCount(16, $this->igestData);
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     * @depends verifyExistsAttributs
     */
    public function verifyHasKey()
    {
        $this->assertArrayHasKey('Nome', $this->igestData);
        $this->assertArrayHasKey('Cpf', $this->igestData);
        $this->assertArrayHasKey('DataNascimento', $this->igestData);
        $this->assertArrayHasKey('TelefoneFixo', $this->igestData);
        $this->assertArrayHasKey('TelefoneMovel', $this->igestData);
        $this->assertArrayHasKey('Email', $this->igestData);
        $this->assertArrayHasKey('NomeMae', $this->igestData);
        $this->assertArrayHasKey('EstadoCivil', $this->igestData);
        $this->assertArrayHasKey('EnderecoCep', $this->igestData);
        $this->assertArrayHasKey('EnderecoDescricao', $this->igestData);
        $this->assertArrayHasKey('EnderecoNumero', $this->igestData);
        $this->assertArrayHasKey('EnderecoComplemento', $this->igestData);
        $this->assertArrayHasKey('EnderecoBairro', $this->igestData);
        $this->assertArrayHasKey('EnderecoCidadeNome', $this->igestData);
        $this->assertArrayHasKey('EnderecoCidadeEstado', $this->igestData);
        $this->assertArrayHasKey('Fid', $this->igestData);
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
            'fid' => null
        ];

        $this->assertJson($this->igest->dataCompose($data));
    }
}