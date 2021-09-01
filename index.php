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
        body {
            font-family: Arial;
        }

        input {
            margin-right: 10px;
        }

        td {
            width: 40%;
            float: top;
        }

        .half {
            display: block;
            width: 80%;
            height: 100%;
            background-color: #202020;

            padding: 20px;

            border-radius: 10px;

            word-wrap: break-word;

            

        }

        textarea {
            width: 100%;
            height: 70%;
            background-color: #202020;
            color: white;
            font-size: 20;
            resize: none;
            overflow-y: scroll;
            border: none;
            
        }

        table {

            color: white;

            width: 95%;
            height: 80%;
            padding-left: 5%;
        }

        input {
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
        
    </style>

    <center>

        <br>
        <p style="font-size: 35px; padding: 0; margin: 0; margin-top: 0px" class="mainfont"> <a target="_blank" rel="noopener noreferrer" href="https://github.com/batscs/Bats-Needlessly-Complicated-Encryption"> Bats' Needlessly Complicated Encryption </a> v<?php echo bnce_getVersion(); ?>: </p>
        <p style="font-size: 30px; padding: 0; margin: 0; margin-bottom: 20px;" class="mainfont"> BNCE ID: #<?php echo bnce_getUniqueID(); ?> </p>

        <table cellspacing="0">
            <tr>

                <td>
                    <div class="half" style=""> 
                        <form method="post">
                            <h1> BNCE Encrypt: </h1>
                            <input type="text" name="text" placeholder="Normal Text" />
                            <input type="text" name="key" placeholder="Passphrase (Optional)" />
                            <input type="submit" name="encrypt" value="Encrypt" />
                            <input onclick="copyToClipboard('encryptField')" type="button" name="decopy" value="Copy" />
                        </form>

                        <textarea id="encryptField"><?php

                                if (isset($_POST["encrypt"])) {
                                    $pass = crc32( $_POST["key"] );
                                    echo bnce_encrypt($_POST["text"], $pass);
                                }

                        ?></textarea>

                    </div>
                </td>

                <td>
                    <div class="half" style=""> 
                        <form method="post">
                            <h1> BNCE Decrypt: </h1>
                            <input type="text" name="words" placeholder="Encrypted Text" />
                            <input type="text" name="key" placeholder="Passphrase (Optional)" />
                            <input type="submit" name="decrypt" value="Decrypt" />
                            <input onclick="copyToClipboard('decryptField')" type="button" name="decopy" value="Copy" />
                        </form>
                        
                        <textarea id="decryptField"><?php

                                if (isset($_POST["decrypt"])) {
                                    $pass = crc32( $_POST["key"] );
                                    echo bnce_decrypt($_POST["words"], $pass);
                                }

                        ?></textarea>

                    </div>
                </td>

            </tr>
        </table>

    </center>

    

    <br><br><br><br><br>

    

</html>

<?php
     

?>

