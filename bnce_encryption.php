<?php

    // ************************************************** NOTE ***************************************************
    // *
    // * the $passphrase has to be a integer! You need to convert the passphrase into an integer yourself.
    // * Only the full english alphabet, numbers 0 to 10, and very few other characters are supported as of now.
    // *
    // ************************************************************************************************************

    $word_list = file('10kwords.txt');
    $allowedChar = str_split(" abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ.,-_+#äüöÜÄÖ!?", 1);

    function bnce_encrypt($text, $passphrase) {

        // Declaration of Variables
        global $word_list;
        srand($passphrase);
        $output = "";

        // The given $text String gets splitted into an Array with 2 characters each
        $text_split = str_split($text, 2);

        // Going through each 2 characters in the splitted Text
        for ($i = 0; $i < count($text_split); $i++) {

            // Once again splitting the splitted text to extract both characters and have them individually.
            $text_split_split = str_split($text_split[$i], 1);

            // The numericTextSegment gets assigned the combined calculated value of each character, the first one is valued 130x as much as the first to avoid collisions.
            // ==> Collisions: The first character has to be at all cost bigger than the second character, I chose 130x to allow future expension with bigger alphabets.
            @$numericTextSegment = (bnce_getNumericalValue($text_split_split[0]) * 130) + (bnce_getNumericalValue($text_split_split[1]) * 1); 

            // The rand() function gets the given Passphrase as Seed, a random Number between 1 and 10000 gets added to increase security.
            $randomizedAddition = rand(1, 10000);
            $numericTextSegment += $randomizedAddition;

            // The $numericTextSegment Variable is being adjusted until it is neither bigger than 10000 or smaller than 0.
            $done = false;
            while (!$done) {

                if ($numericTextSegment > 10000) {
                    $numericTextSegment -= 10000;
                } else if ($numericTextSegment < 0) {
                    $numericTextSegment += 10000;
                } else {
                    $done = true;
                }

            }

            // $outputWord is being assigned the numericTextSegment-th Word out of the Word List, and gets added to the final output.
            $outputWord = $word_list[$numericTextSegment];
            $output = $output . " " . $outputWord;
        }

        // After all is done the final output is being returned to the caller.
        return $output;
    }

    function bnce_decrypt($words, $passphrase) {

        // Declaration of Variables
        global $word_list;
        srand($passphrase);
        $output = "";

        // The given Word String gets splitted into an Array for each Word
        $words_split = explode(" ", $words);

        // If Last Word is Empty, remove it.
        if ($words_split[count($words_split) - 1] == "") {
            array_pop($words_split);
        }

        // For Looping going through each single word
        for ($i = 0; $i < count($words_split); $i++) {

            // line Varaible gets declared
            $line = 0;

            // Searching for The Word inside the Word List.
            for ($k = 0; $k < count($word_list); $k++) {

                if ( substr_replace($word_list[$k] ,"", -2) == $words_split[$i]) {
                    // The matching Word has been found at the $line.
                    $line = $k;
                }
            }

            // For Passphrase Encryption a preditable random Number is being chosen,
            // based on the Passphrase as Seed for the rand() function.

            $randomizedAddition = rand(1, 10000);
            $line -= $randomizedAddition;

            // The $line Variable is being adjusted until it is neither bigger than 10000
            // or smaller than 0

            $done = false;
            while (!$done) {

                if ($line > 10000) {
                    $line -= 10000;
                } else if ($line < 0) {
                    $line += 10000;
                } else {
                    $done = true;
                }
            }

            // $char is being set to the equivalent value of the Word.
            $char = bnce_getCharacterValue($line);

            // The Output String gets the new $char attached to the end.
            $output = $output . $char;
        }


        // The final Output is being returned to the caller.
        return $output;
    }

    function bnce_getCharacterValue($target) {

        // Declaring all allowed Characters and splitting them into an Array for each Character.
        global $allowedChar;

        // Declaring start Variables.
        $firstCharValue = 0;
        $temp_sum = -1;

        // As in the encrypt function the first character has been multiplied with 130, it is now being tested how often the
        // number 130 fits into the given $target Value in order to reverse engineer the seperate values of each character.
        for ($i = 0; $i <= $target; $i += 130) {

            $temp_sum = $i;

            if ($i + 130 <= $target) {
                $temp_sum = $i;
                $firstCharValue++;   
            }
        }
        
        // The final char is being calculated with both values and is being returned.
        @$char = $allowedChar[$firstCharValue] .  $allowedChar[$target - $temp_sum];

        return $char;
    }

    function bnce_getNumericalValue($target) {

        // Declaring all allowed Characters and splitting them into an Array for each Character.
        global $allowedChar;

        // Finding the spot of the character in the $allowedChar List which is the numerical Value of the Character.
        for ($i = 0; $i < count($allowedChar); $i++) {

            if ($allowedChar[$i] == $target) {
                // if the numerical Value of the Character has been found it will be returned here.
                return $i;
            }
        }
        
        // If the Character has not been found a number higher than the possible array is being returned which will result in a corrupted end result.
        return count($allowedChar) + 1;

    }
?>