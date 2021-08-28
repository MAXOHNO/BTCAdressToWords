<?php
    require("bnce_encryption.php");
?>

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
        <p style="font-size: 35px; padding: 0; margin: 0; margin-top: 0px" class="mainfont"> Bats' Needlessly Complicated Encryption v<?php echo bnce_getVersion(); ?>: </p>
        <p style="font-size: 30px; padding: 0; margin: 0; margin-bottom: 20px;" class="mainfont"> BNCE ID: #<?php echo bnce_getUniqueID(); ?> </p>

        <table cellspacing="0">
            <tr>

                <td>
                    <div class="half" style=""> 
                        <form method="post">
                            <h1> BNCE Encode: </h1>
                            <input type="text" name="text" placeholder="Normal Text" />
                            <input type="text" name="key" placeholder="Passphrase" required />
                            <input type="submit" name="encode" value="Encode" />
                        </form>

                        <p>
                            <?php
                                if (isset($_POST["encode"])) {
                                    $pass = crc32( $_POST["key"] );
                                    echo "<b> Result: </b> " . "<br>" . bnce_encrypt($_POST["text"], $pass);
                                }
                            ?>
                        </p>

                    </div>
                </td>

                <td>
                    <div class="half" style=""> 
                        <form method="post">
                            <h1> BNCE Decode: </h1>
                            <input type="text" name="words" placeholder="Encrypted Text" />
                            <input type="text" name="key" placeholder="Passphrase" required />
                            <input type="submit" name="decode" value="Decode" />
                        </form>
                        
                        <p>
                            <?php
                                if (isset($_POST["decode"])) {
                                    $pass = crc32( $_POST["key"] );
                                    echo "<b> Result: </b> " . "<br>" . bnce_decrypt($_POST["words"], $pass);
                                }
                            ?>
                        </p>

                    </div>
                </td>

            </tr>
        </table>

    </center>

    

    <br><br><br><br><br>

    

</html>

<?php
     

?>

