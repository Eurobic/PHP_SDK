<pre>
    <?php
    include_once '../../payments.php';
    include_once '../example_data.php';

    use Payments\Payments;

try {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => "5000",
            "password" => "5678",
        ));
        $auth = $payments->auth();
        $auth->allowOriginUrl("http://google.com/")->
                merchantNotificationUrl("http://google.com/")->
                channel(Payments::CHANNEL_ECOM)->
                userDevice(Payments::USER_DEVICE_DESKTOP)->
                amount("20.00")->
                country("GB")->
                currency("EUR")->
                paymentSolutionId("500")->
                customerId($customer_it_token)->
                specinCreditCardToken($credit_card_token)->
                specinCreditCardCVV($credit_card_cvv);
        $result = $auth->execute();
        var_dump($result);
    } catch (Exception $e) {
        var_dump("Exception");
        var_dump($e->getMessage());
        var_dump($e->getCode());
        var_dump($e->getFile());
        var_dump($e->getLine());
    }
    ?>
</pre>