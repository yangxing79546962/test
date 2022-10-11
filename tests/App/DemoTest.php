<?php
/*
 * @Date         : 2022-03-02 14:49:25
 * @LastEditors  : Jack Zhou <jack@ks-it.co>
 * @LastEditTime : 2022-03-02 17:22:16
 * @Description  : 
 * @FilePath     : /recruitment-php-code-test/tests/App/DemoTest.php
 */

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\App\Demo;
use App\Util\HttpRequest;
use App\Service\AppLogger;


class DemoTest extends TestCase
{
    private $demo;

    public function setUp(): void
    {
        $this->demo = new Demo(new HttpRequest(),new AppLogger());
    }


    protected function tearDown(): void
    {
        $this->demo = null;
    }

    public function test_foo()
    {
        $this->assertTrue(true);
    }

    public function test_get_user_info()
    {
        $result = $this->demo->get_user_info();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('username', $result);
        $this->assertIsInt($result['id']);
        $this->assertIsString($result['username']);
        $this->assertNotNull($result['username']);
        $this->assertNull($result['username']);
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('hello word', $result['username']);
        $result1 = $this->get(Demo::URL);
        $this->assertEquals($result1['id'],$result['id']);
        $this->assertEquals($result1['username'],$result1['username']);
        $this->assertTrue(true);
    }

    private function get($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result['data'] ?? [];
    }
}