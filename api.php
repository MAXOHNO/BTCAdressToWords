<?php

require_once __DIR__ . '/bnce_encryption.php';

    class API {

        function Select() {

            $response = array(
                "pass" => "no_input",
                "encrypted" => "no_output",
                "decrypted" => "no_output",
                "error" => "no_error",
            );

            if (isset($_GET["pass"])) {

                $pass = crc32( $_GET["pass"] );
            } else {

                $pass = crc32( "" );
                $response["error"] = "default_passphrase";
            }
            
            if (isset($_GET["encrypt"])) {

                $encrypt = $_GET["encrypt"];
                $encrypted = bnce_encrypt($encrypt, $pass);

                $response["pass"] = $pass;
                $response["encrypted"] = $encrypted;

            }

            if (isset($_GET["decrypt"])) {

                $decrypt = $_GET["decrypt"];
                $decrypted = bnce_decrypt($decrypt, $pass);

                $response["pass"] = $pass;
                $response["decrypted"] = $decrypted;

            }
            

            //$string = "hallo";

            return json_encode($response);
        }
    }

    $API = new API;

    header('Content-Type: application/json');
    echo $API->Select();

?>