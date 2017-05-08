<pre>
    <?php
    include '../../payments.php';

    use Payments\Payments;

try {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => "5000",
            "password" => "5678",
        ));
        $purchase = $payments->purchase();
        $purchase->allowOriginUrl("http://google.com/")->
                merchantNotificationUrl("http://google.com/")->
                channel(Payments::CHANNEL_ECOM)->
                userDevice(Payments::USER_DEVICE_DESKTOP)->
                amount("20.00")->
                country("GB")->
                currency("EUR")->
                paymentSolutionId("500");
        $token = $purchase->token();
        ?>
    </pre>
    <!DOCTYPE html>  
    <html><head>  
            <style>  
                #ipgCashierDiv{  
                    width: 600px;  
                    height: 400px;  
                    border: 1px solid gray;  
                    margin: 10px;  
                } 
                label {  
                    width: 10em;  
                    display: inline­block;  
                    margin: 0 0 0.5em 0;  
                } 
                input {  
                    width: 15em;  
                } 

            </style>  
            <script type="text/javascript"  
            src="<?= $purchase->javaScriptUrl() ?>"></script>  
            <script type="text/javascript">
                var cashier = com.myriadpayments.api.cashier();
                cashier.init(
                        {baseUrl: '<?= $purchase->BaseUrl() ?>'}
                );
                function handleResult(data) {
                    alert(JSON.stringify(data));
                }
                function pay() {
                    var token = document.getElementById("tokenIn").value;
                    var merchantId = document.getElementById("merchantIdIn").value;
                    cashier.show(
                            {
                                containerId: "ipgCashierDiv",
                                merchantId: merchantId,
                                token: token,
                                successCallback: handleResult,
                                failureCallback: handleResult,
                                cancelCallback: handleResult
                            }
                    );
                }
                ;
            </script>  
        </head>  
        <body>  
            <h3>Simple Javascript integration example</h3>  
            <h4>simpleJsIntegration</h4>  
            <div> 
                <label>token:</label><input id="tokenIn" value="<?= $token->token ?>"/><br/>  
                <label>merchantId:</label><input id="merchantIdIn" value="<?= $token->merchantId ?>"/><br/>  
                <button onclick="pay()">Pay</button>  
            </div>  
            <div id="ipgCashierDiv"></div>  
        </body>  
    </html>  
    <?php
} catch (Exception $e) {
    ?>
    <pre>
        <?php
        var_dump("Exception");
        var_dump($e->getMessage());
        var_dump($e->getCode());
        var_dump($e->getFile());
        var_dump($e->getLine());
        ?>
    </pre>
    <?php
}
