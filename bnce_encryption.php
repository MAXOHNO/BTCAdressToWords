<?php

    // Bats' Needlessly Complicated Encryption (BNCE)
    // Made by Github.com/MAXOHNO

    $word_list = file('10kwords.txt'); 
    $count = count($word_list);
    $numHashLength = 5;

    // Calculates the unique combination of the $word_list and the $allowedChar, decryption might not work if it wasn't encrypted with the corresponding ID.
    function bnce_getUniqueID() {
        global $word_list;
        global $allowedChar;

        return (md5(serialize($word_list) . serialize($allowedChar) . bnce_getVersion()));
    }

    // Returns the current Version of the BNCE Encryption.
    function bnce_getVersion() {
        $version = "3.0";

        return $version;
    }

    function bnce_encrypt($text, $passphrase, $numerical = false) {

        $text = urlencode($text);
        $text = bnce_stringToAscii($text);

        // Declaration of Variables
        global $word_list;
        global $charMultiplier;
        global $numHashLength;

        $output = ""; 

        // seeding for numHashString
        $lastWord = "";
        $firstWord = "";
        $counter = 0;

        // The given $text String gets splitted into an Array with 2 characters each
        $text_split = explode(" ", $text);

        // Going through each 2 characters in the splitted Text
        for ($i = 0; $i < count($text_split); $i++) {


            $wordIndex = $text_split[$i];


            $numHashString = $passphrase . $counter . $firstWord . $lastWord;
            $securedAddition = bnce_numHash($numHashString, $numHashLength);

            @$wordIndex += $securedAddition;

            $wordIndex = bnce_normalize($wordIndex);

            // the output word gets set to the according word out of the word list.
            if ($numerical) {
                $outputWord = $wordIndex;
            } else {
                $outputWord = $word_list[$wordIndex];
            }

            // This small block is to prevent the output from starting with a space.
            if ($output == "") {
                $output = $outputWord;
            } else {
                // The space between words only gets added once there is a previous word in the string.
                $output = $output . " " . $outputWord;
            }
            
            // Setting up Variables for secure seeding encryption
            if ($firstWord == "")
                $firstWord = preg_replace("/\r|\n/", '', $lastWord);
            $lastWord = preg_replace("/\r|\n/", '', $outputWord);
            $counter++;
        }

        // The line breaks between the words get replaced in the following.
        // After all is done the final output is being returned to the caller.
        return preg_replace("/\r|\n/", "", $output);
    }

    function bnce_decrypt($words, $passphrase, $numerical = false) {

        // Declaration of Variables
        global $word_list;
        global $numHashLength;

        $output = "";

        // seeding for numHashString
        $lastWord = "";
        $firstWord = "";
        $counter = 0;

        // The given Word String gets splitted into an Array for each Word
        $words_split = explode(" ", $words);

        // If Last Word is Empty, remove it.
        if ($words_split[count($words_split) - 1] == "") {
            array_pop($words_split);
        }

        // For Loop going through each single word
        for ($i = 0; $i < count($words_split); $i++) {

            // line Varaible gets declared
            $line = 0;

            if ($numerical) {
                $line = $words_split[$i];
            } else {
                // Searching for The Word inside the Word List.
                for ($k = 0; $k < count($word_list); $k++) {

                    if ( substr_replace($word_list[$k] ,"", -2) == $words_split[$i]) {
                        // The matching Word has been found at the $line.
                        $line = $k;
                    }
                }
            }
            

            $numHashString = $passphrase . $counter . $firstWord . $lastWord;
            $securedAddition = bnce_numHash($numHashString, $numHashLength);

            $line -= $securedAddition;

            $line = bnce_normalize($line);

            // $char is being set to the equivalent value of the Word.
            $char = $line;

            // The Output String gets the new $char attached to the end.
            $output = $output . $char . " ";

            // Setting up Variables for secure seeding encryption
            if ($firstWord == "")
                $firstWord = $lastWord;
            $lastWord = $words_split[$i];
            $counter++;

        }

        // Removing the last Char from the output as it is an empty space " "
        $output = substr($output, 0, -1);

        // Converting Ascii String to normal Text
        $output = bnce_asciiToString($output);

        // Url decoding the output to support special chars
        $output = urldecode($output);

        return $output;
    }

    // Adjusts a value to stay above 0 and under the $max
    function bnce_normalize($current) {
        global $count;
        $done = false;

        while (!$done) {

            if ($current >= $count) {
                $current -= $count;
            } else if ($current < 0) {
                $current += $count;
            } else {
                $done = true;
            }
        }
        return $current;
    }

    // Credit: https://stackoverflow.com/a/23679870/175071
    function bnce_numHash($str, $len=null) {
        $binhash = md5($str, true);
        $numhash = unpack('N2', $binhash);
        $hash = $numhash[1] . $numhash[2];
        if($len && is_int($len)) {
            $hash = substr($hash, 0, $len);
        }
        return $hash;
    }

    function bnce_stringToAscii($str) {
        return implode(' ', unpack("C*", $str));
    }

    function bnce_asciiToString($ascii) {
        $ascii = explode(" ", $ascii);
        $result = "";

        for ($i = 0; $i < count($ascii); $i++) {
            $char = chr($ascii[$i]);

            $result = $result . $char;
        }

        return $result;
    }
?>