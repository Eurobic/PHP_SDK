<?php
use PHPUnit\Framework\TestCase;

class TokenizedTest extends TestCase
{
    public function testTokenize()
    {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => "5000",
            "password" => "5678",
        ));
        $tokenize = $payments->tokenize();
        $tokenize->allowOriginUrl("http://google.com/")->
                number("5454545454545454")->
                nameOnCard("John Doe")->
                expiryMonth("12")->
                expiryYear("2018");
        $result = $tokenize->execute();
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
    }
}
?>