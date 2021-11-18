<?php

require_once __DIR__ . '/bnce_encryption.php';

    class API {

        function Select() {

            $response = array(
                "pass" => "",
                "input" => "",
                "numerical" => false,
            );

            if (isset($_GET["pass"])) {
                $pass = $_GET["pass"];
            } else {
                $pass = "";
                $response["error"] = "default_passphrase";
            }

            $numerical = $_GET["numerical"];
            if ($numerical == "true") {
                $numerical = true;
            } else {
                $numerical = false;
            }

            $response["numerical"] = $numerical;
            $response["pass"] = $pass;
            
            if (isset($_GET["encrypt"])) {

                $input = $_GET["encrypt"];
                $response["input"] = $input;

                $encrypted = bnce_encrypt($input, $pass, $response["numerical"]);

                $response["output"] = $encrypted;

            }

            if (isset($_GET["decrypt"])) {

                $input = $_GET["decrypt"];
                $response["input"] = $input;

                $decrypted = bnce_decrypt($input, $pass, $response["numerical"]);

                $response["output"] = $decrypted;

            }
            

            //$string = "hallo";

            return json_encode($response);
        }
    }

    $API = new API;

    header('Content-Type: application/json');
    echo $API->Select();

?>