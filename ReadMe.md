# Bats' Needlessly Complicated Encryption (BNCE):

## The Encryption can be tested at https://bats.li/bnce

## How to Install BNCE
### Method 1 (Importing)
1. Download the bnce_encryption.php and the 10kwords.txt file.
2. Import both into your project.

### Method 2 (API)
Call the API from `http://bats.li/bnce` (see below)

## Usage of BNCE
To encrypt and decrypt use the following functions:
Note however that the $passphrase has to be a integer!
```php
bnce_encrypt($string_to_encrypt, $passphrase, $numerical);
bnce_decrypt($string_to_decrypt, $passphrase, $numerical);
```
$numerical is optional and can be set to true or false, to change the output from words to numbers when enabled.

You can also call the current Version of BNCE, you also can get a UniqueID Hash for the Encryption, as any decrypting will only work if you use the same 10kwords.txt and the same alphabet, if anything gets changed, the hash will he different, as long as the hash is the same, you can decrypt old messages
```php
bnce_getUniqueID();
bnce_getVersion();
```

## Usage of the API
Encryption:
```php
$json = file_get_contents('http://bats.li/bnce/encrypt/myString/myPass/false');
$json_alt = file_get_contents('http://bats.li/bnce/encrypt/myString/myPass/true');
$obj = json_decode($json);

echo $obj->encrypted;
```

Decryption:
```php
$json = file_get_contents('http://bats.li/bnce/decrypt/norway%20avenue%20ebony%20captured/myPass/false');
$json = file_get_contents('http://bats.li/bnce/decrypt/norway%20avenue%20ebony%20captured/myPass/true');
$obj = json_decode($json);

echo $obj->decrypted;
```

## Example of Front-End usage (index.php)
#### Example of Encrypting and Decrypting with a correct Passphrase
![example gif](https://i.gyazo.com/f76a1b043764df1a4d61751e35d90be5.gif)

#### Example of Encrypting and Decrypting with a incorrect Passphrase
![example gif](https://i.gyazo.com/59a8a5011a103ae05754d60589790df1.gif)
