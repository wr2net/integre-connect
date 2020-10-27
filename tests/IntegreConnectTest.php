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
     * @var string
     */
    private $host;

    /**
     * Initial setUp to tests
     */
    public function setUp(): void
    {
        $this->host = "";
        $this->endpoint = "";
        $this->key = "";

        $this->integre = new IntegreConnectImpl($this->host, $this->endpoint, $this->key);

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
        $this->assertInstanceOf(IntegreConnectImpl::class, $this->integre);
    }

    /**
     * @test
     */
    public function verifyContainsInstanceOfParseBody()
    {
        $this->assertTrue( method_exists( $this->integre, 'parseBody' ), 'Method not found: parseBody()' );
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
     */
    public function verifyQuantityKeys()
    {
        $this->assertCount(17, $this->integreData);
    }

    /**
     * @test
     * @depends verifyContainsInstanceOf
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

//    /**
//     * @test
//     * @depends verifyContainsInstanceOf
//     * @depends verifyContainsInstanceOfParseBody
//     */
//    public function verifyAsAJson()
//    {
//        $data = [
//            'name' => null,
//            'document' => null,
//            'birth_date' => null,
//            'telephone' => null,
//            'cellphone' => null,
//            'email' => null,
//            'mother_name' => null,
//            'marital_status' => null,
//            'zip_code' => null,
//            'public_place' => null,
//            'number' => null,
//            'complement' => null,
//            'neighborhood' => null,
//            'city' => null,
//            'state' => null,
//            'product_reference' => null,
//            'fid' => null
//        ];
//
//        $this->assertJson($this->integre->parseBody($data));
//    }

//    /**
//     * @test
//     * @depends verifyContainsInstanceOf
//     * @depends verifyContainsInstanceOfParseBody
//     */
//    public function verifyAsAArray()
//    {
//        $data = [
//            'name' => null,
//            'document' => null,
//            'birth_date' => null,
//            'telephone' => null,
//            'cellphone' => null,
//            'email' => null,
//            'mother_name' => null,
//            'marital_status' => null,
//            'zip_code' => null,
//            'public_place' => null,
//            'number' => null,
//            'complement' => null,
//            'neighborhood' => null,
//            'city' => null,
//            'state' => null,
//            'product_reference' => null,
//            'fid' => null
//        ];
//
//        $this->assertIsArray($this->integre->parseBody($data, false));
//    }

    /**
     * @test
     */
    public function verifyContainsInstanceOfSendRequest()
    {
        $this->assertTrue( method_exists( $this->integre, 'sendRequest' ), 'Method not found: sendRequest()' );
    }

//    /**
//     * @test
//     */
//    public function verifyAsAXml()
//    {
//        $data = [
//            'name' => null,
//            'document' => null,
//            'birth_date' => null,
//            'telephone' => null,
//            'cellphone' => null,
//            'email' => null,
//            'mother_name' => null,
//            'marital_status' => null,
//            'zip_code' => null,
//            'public_place' => null,
//            'number' => null,
//            'complement' => null,
//            'neighborhood' => null,
//            'city' => null,
//            'state' => null,
//            'product_reference' => null,
//            'fid' => null
//        ];
//
//        $data = $this->integre->parseBody($data);
//
//        $this->assertNotFalse($this->integre->envelopeBody('test', $data));
//        $this->assertIsString($this->integre->envelopeBody('test', $data));
//    }
}