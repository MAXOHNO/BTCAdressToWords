<html>
    <form>
        <h1> Address to Words Converter: </h1>
        <input type="text" id="fname" name="addy" placeholder="Address">
    </form>

    <?php
        if (isset($_GET["addy"]) && $_GET["addy"] != "") {
            echo "<b> Result: </b> " . "<br>" . convertAddyToWords($_GET["addy"]);
        }
    ?>

    <br><br><br><br><br>

    <form>
        <h1> Words to Address Converter: </h1>
        <input type="text" id="fname" name="words" placeholder="Words">
    </form>

    <?php
        if (isset($_GET["words"]) && $_GET["words"] != "") {
            echo "<b> Result: </b> " . "<br>" . convertWordsToAddy($_GET["words"]);
        }
    ?>
</html>



<?php
     $word_list = file('10kwords.txt');

    function convertWordsToAddy($words) {

        $word_list = file('10kwords.txt');

        $words_split = explode(" ", $words);

        $output = "";

        for ($i = 0; $i < count($words_split); $i++) {

            $line = 0;

            for ($k = 0; $k < count($word_list); $k++) {

                if ( substr_replace($word_list[$k] ,"", -2) == $words_split[$i]) {
                    $line = $k;
                }
            }

            $char = getCharacterValue($line);

            $output = $output . $char;
        }

        return $output;
    }

    function convertAddyToWords($addy) {

        $addy_split = str_split($addy, 2);
        $output = "";

        $word_list = file('10kwords.txt');

        for ($i = 0; $i < count($addy_split); $i++) {

            // ************** SPLITTING SEGMENTS INTO EVEN MORE SEGMENTS TO ADD LATER ***************
            $addy_split_split = str_split($addy_split[$i], 1);

            // ************** SEGMENTS TO NUMBER HASHING ***************
            @$numericAddySegment = (getNumericalValue($addy_split_split[0]) * 75) + (getNumericalValue($addy_split_split[1]) * 1); 
    
            if ($numericAddySegment < 0) {
                $outputWord = "@ERROR@";
            } else {
                $outputWord = $word_list[$numericAddySegment];
            }
            
            $output = $output . " " . $outputWord;
        }

        return $output;
    }

    function getCharacterValue($target) {
        $allowedChar = str_split("abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ", 1); // len = 63

        $firstCharValue = 0;
        $temp_sum = -1;

        for ($i = 0; $i <= $target; $i += 75) {

            $temp_sum = $i;

            if ($i + 75 <= $target) {
                $temp_sum = $i;
                $firstCharValue++;   
            }
        }
        
        $char = $allowedChar[$firstCharValue] .  $allowedChar[$target - $temp_sum];

        return $char;
    }

    function getNumericalValue($target) {

        $allowedChar = str_split("abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ", 1); // len = 63

        for ($i = 0; $i < count($allowedChar); $i++) {
    
            if ($allowedChar[$i] == $target) {
                return $i;
            }
        }

        if ($target == "") {
            return 0;
        }

        return count($allowedChar) + 1;

    }

?>

