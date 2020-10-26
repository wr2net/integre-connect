<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use IntegreConnect\Util\SendExec;

class SendExecTest extends TestCase
{
    /**
     * @var SendExec
     */
    protected $sendExec;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string[]
     */
    protected $header;

    /**
     * @var string
     */
    protected $data;

    public function setUp(): void
    {
        $this->sendExec = new SendExec;
        $this->endpoint = null;
        $this->key = null;
        $this->data = null;
    }

    /**
     * @test
     */
    public function verifyContainsInstanceOf()
    {
        $this->assertInstanceOf(SendExec::class, new SendExec($this->endpoint, $this->key, $this->data));
    }

    /**
     * @test
     */
    public function verifyContaisInstanceOfSendexec()
    {
        $this->assertTrue( method_exists( new SendExec($this->endpoint, $this->key, $this->header, $this->data), 'sendExec' ), 'Method not found: sendExec()' );
    }

    /**
     * @test
     */
    public function verifyContaisInstanceOfEnvelopeBody()
    {
        $this->assertTrue( method_exists( new SendExec($this->endpoint, $this->key, $this->header, $this->data), 'envelopeBody' ), 'Method not found: envelopeBody()' );
    }

    /**
     * @test
     */
    public function verifyContaisInstanceOfSetCurl()
    {
        $this->assertTrue( method_exists( new SendExec($this->endpoint, $this->key, $this->header, $this->data), 'setCurl' ), 'Method not found: setCurl()' );
    }

    /**
     * @test
     */
    public function verifyAsAXml()
    {
        $this->assertNotFalse($this->sendExec->envelopeBody($this->key, $this->data));
        $this->assertIsString($this->sendExec->envelopeBody($this->key, $this->data));
    }
}