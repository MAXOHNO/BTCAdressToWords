<?php
    require("bnce_encryption.php");
?>

<script>
    function copyToClipboard(elementID) {
        var copyText = document.getElementById(elementID);

        copyText.select();
        copyText.setSelectionRange(0, 9999999999);

        navigator.clipboard.writeText(copyText.value);

    } 
</script>

<html>
    <style>
        
        .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        }

        .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #CB453A;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: #3ACB97;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #3ACB97;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }

        #key {
            width: 200px;
            margin-left: 25px;
            margin-bottom: 15px;
        }

        body {
            font-family: Arial;
        }

        input {
            width: 200px;
            padding: 5px;
            margin: 10px;
            border-radius: 5px;

            cursor: pointer;
        }

        .half {
            background-color: #202020;
            color: white;

            padding: 30px;
            border-radius: 15px;
        }

        input {
            padding: 10px;
            border-radius: 10px;
            border-color: transparent;

            font-size: 16px;
            font-weight: bold;
        }

        #card {
            padding: 10px;
            border-radius: 10px;
            border-color: transparent;

            font-size: 16px;
            font-weight: bold;
        }

        .shadow {
            box-shadow: 3px 3px 8px 0px #303030;
        }

        .ascii {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            background-color: #E9E9ED; 
            color: black; 

            padding-right: 20px;
            padding-left: 10px;
            padding-top: 6px;
            padding-bottom: 6px;
            
            margin-left: 23px; 
            
            border-radius: 10px;
        }

        .asciiText {
            padding-left: 3px;
            font-size: 16px;
            font-weight: bold;
        }

        textarea {
            background-color: #353535;
            color: white;
            border-color: transparent;

            border-radius: 15px;
            padding: 10px;
            width: 500px;
            height: 600px;

            font-size: 20px;
            
        }

        p {
            
            display: block; /* or inline-block, at least its a block element */
            width: 100%; /* or width is certain by parent element */
            height: auto; /* height cannot be defined */
            word-break: break-word; /*  */
            word-wrap: break-word; /* if you want to cut the complete word */
            white-space: normal; /* be sure its not 'nowrap'! ! ! :/ */

            font-size: 20px;
            
        }

        .mainfont {
            font-family: Arial;
            color: black;
            font-weight: bold;
        }

        .arrow {
            border: solid black;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
        }

        .right {
            transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
        }

        .left {
            transform: rotate(135deg);
            -webkit-transform: rotate(135deg);
        }

        .up {
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }

        .down {
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }
        

    </style>

    <?php
        // init
        $selfhosted = true;
        $numerical = true;
    ?>

    <center>
        <form method="post">
        <br>
        <p style="font-size: 35px; padding: 0; margin: 0; margin-top: 0px" class="mainfont"> <a target="_blank" rel="noopener noreferrer" href="https://github.com/batscs/Bats-Needlessly-Complicated-Encryption"> Bats' Needlessly Complicated Encryption </a> v<?php echo bnce_getVersion(); ?>: </p>
        <p style="font-size: 30px; padding: 0; margin: 0;" class="mainfont"> BNCE ID: #<?php echo bnce_getUniqueID(); ?> </p>
        <p style="font-size: 30px; padding: 0; margin: 0; margin-bottom: 40px; font-size: 15px; color: gray" class="mainfont">  * Note: If decrypting doesnt work then enable numerical, this happens due to technical limitations of the webserver provider</p>

        <table cellspacing="0">
            <tr>

                <td>
                    <div class="half shadow" style=""> 
                        
                            <h1> BNCE Plaintext: </h1>

                            <textarea name="plaintext" id="encryptField"><?php

                                if (isset($_POST["decrypt"])) {
                                                                    
                                    $pass = $_POST["key"] ;
                                    $enctext = $_POST["wordtext"];

                                    if (isset($_POST["numericalCheck"]))
                                            $numerical = true;
                                        else
                                            $numerical = false;

                                    // Small switch to toggle selfhosted encryption or API encryption.
                                    if ($selfhosted) {
                                        // Use this if you host your own bnce_encryption.php file
                                        echo bnce_decrypt($enctext, $pass, $numerical);
                                    } else {
                                        // Use this if you want to use the bnce.bats.li API
                                        $json = file_get_contents('http://bnce.bats.li/api.php?pass=' . $pass . '&decrypt=' . preg_replace("/\s+/", "%20", $_POST["words"]) );
                                        $obj = json_decode($json);
                                        echo $obj->decrypted;
                                    }

                                }

                            ?></textarea>

                            
                            <!-- <input onclick="copyToClipboard('encryptField')" type="button" name="decopy" value="Copy" /> -->
                    </div>
                </td>

                <td>
                    <div class="half" style="background-color: transparent">

                        <input type="text" name="key" id="key" placeholder="Passphrase" class="shadow" value="<?php
                                if (isset($_POST["key"])) {
                                    echo $_POST["key"];
                                }
                            ?>"/> <br>

                            <div class="shadow ascii" style="display: inline-block;">
                                <table cellspacing="0"> 
                                    <tr>
                                        <td>
                                            
                                            <div class="asciiText">
                                                Numerical
                                            </div>
                                            
                                        </td>

                                        <td>
                                            <label class="switch" style="display: inline-block; margin-left: 25px; margin-bottom: 0px;">
                                                <input type="checkbox" name="numericalCheck" value="true" <?php
                                                            if (isset($_POST["numericalCheck"])) {
                                                                echo "checked";
                                                            }
                                                        ?>>
                                                <span class="slider round"></span>
                                            </label> <br>
                                        </td>
                                    </tr>
                                </table>
                            </div> <br>
                            

                        <i class="arrow right"></i> <input type="submit" name="encrypt" class="shadow" value="Encrypt" /> <i class="arrow right"></i> <br>
                        <i class="arrow left"></i> <input type="submit" name="decrypt" class="shadow" value="Decrypt" /> <i class="arrow left"></i>
                        
                    </div>
                </td>

                <td>
                    <div class="half shadow" style=""> 
                            <h1> BNCE Encrypted: </h1>
                        
                            <textarea name="wordtext" id="decryptField"><?php

                                    if (isset($_POST["encrypt"])) {

                                        // This is required, otherwise there are problems if $pass if the Passphrase Input is empty
                                        $pass = $_POST["key"];
                                        $plaintext = $_POST["plaintext"];

                                        if (isset($_POST["numericalCheck"]))
                                            $numerical = true;
                                        else
                                            $numerical = false;
                                        

                                        // Small switch to toggle selfhosted encryption or API encryption.
                                        if ($selfhosted) {

                                            // Use this if you host your own bnce_encryption.php file
                                            echo bnce_encrypt($plaintext, $pass, $numerical);
                                        } else {

                                            // Use this if you want to use the bnce.bats.li API
                                            $json = file_get_contents('http://bnce.bats.li/api.php?pass='.$pass.'&encrypt='.$_POST["text"]);
                                            $obj = json_decode($json);
                                            echo $obj->encrypted;
                                        }
                                        
                                    }

                            ?></textarea>

                            <!-- <input onclick="copyToClipboard('decryptField')" type="button" name="decopy" value="Copy" /> -->

                    </div>
                </td>

            </tr>
        </table>
    </form>
    </center>

    

    <br><br><br><br><br>

    

</html>

<?php
     

?>

