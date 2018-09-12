<?php
declare(strict_types=1);

namespace Tests\Chapter9;

use Acme\Chapter9\AbstractFactory\FileReaderFactory;
use Acme\Chapter9\Exception\FileNotFoundException;
use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    private $factory;

    protected function setUp()
    {
        $this->factory = new FileReaderFactory();
    }

    public function testJsonReader()
    {
        $data = $this->factory->createJsonReader('json')->asArray();

        $this->assertArrayHasKey('hello', $data);
        $this->assertContains('world', $data);
    }

    public function testTxtReader()
    {
        $data = $this->factory->createTxtReader('text')->asArray();

        $this->assertNotContains(PHP_EOL, $data);
        $this->assertContains('hello', $data);
        $this->assertContains('world', $data);

        $dataSplittedByO = $this->factory->createTxtReader('text', 'o')->asArray();
        $this->assertNotContains('o', $dataSplittedByO);
        $this->assertContains('hell', $dataSplittedByO);
    }

    public function testBinaryFile()
    {
        $data = $this->factory->createBinaryReader('binary')->asArray();

        $this->assertNotEmpty($data);
        $this->assertContains('hello', $data);
        $this->assertContains('world', $data);

        $dataSplittedBy012 = $this->factory->createBinaryReader('binary', ' 012')->asArray();

        $this->assertNotEmpty($data);
        $this->assertNotContains(' 012', $dataSplittedBy012);
        $this->assertContains('hello world', $dataSplittedBy012);
    }

    /**
     * @dataProvider fileNotFoundDataProvider
     */
    public function testFileNotFound(string $type, string $filename)
    {
        $this->expectException(FileNotFoundException::class);

        switch ($type) {
            case 'json':
                $this->factory->createJsonReader($filename);
                break;
            case 'text':
                $this->factory->createTxtReader($filename);
                break;
            default:
                trigger_error('Incorrect type provided', E_USER_WARNING);

        }
    }

    public function fileNotFoundDataProvider(): array
    {
        return [
            ['json', 'text'],
            ['text', 'json'],
            ['text', 'text-abrakadabra'],
            ['json', 'json-abrakadabra'],
            ['json', ''],
        ];
    }
}
