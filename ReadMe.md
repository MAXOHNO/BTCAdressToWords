# Bats' Needlessly Complicated Encryption (BNCE):

## The Encryption can be tested at https://bats.li/bnce

## How to Install BNCE
### Method 1 (Importing)
1. Download the bnce_encryption.php and the 10kwords.txt file.
2. Import both into your project.

### Method 2 (API)
Call the API from ```http://bnce.bats.li/api.php```

## Usage of BNCE
To encrypt and decrypt use the following functions:
Note however that the $passphrase has to be a integer!
```php
bnce_encrypt($string_to_encrypt, $passphrase);
bnce_decrypt($string_to_decrypt, $passphrase);
```

You can also call the current Version of BNCE, you also can get a UniqueID Hash for the Encryption, as any decrypting will only work if you use the same 10kwords.txt and the same alphabet, if anything gets changed, the hash will he different, as long as the hash is the same, you can decrypt old messages
```php
bnce_getUniqueID();
bnce_getVersion();
```

## Usage of the API
Encryption:
```php
$json = file_get_contents('http://bnce.bats.li/api.php?encrypt=myString&pass=secret');
$obj = json_decode($json);

echo $obj->encrypted;
```

Decryption:
```php
$json = file_get_contents('http://bnce.bats.li/api.php?decrypt=norway%20avenue%20ebony%20captured&pass=secret');
$obj = json_decode($json);

echo $obj->decrypted;
```

![bnce_explanation](https://user-images.githubusercontent.com/31670615/131718259-dae1483e-d97e-4f98-b0ce-dcf609a89b15.png)

## Example of Front-End usage (index.php)
#### Example of Encrypting and Decrypting with a correct Passphrase
![example gif](https://i.gyazo.com/28ff4dfd22c6f8c6ba1767e03cd6f46a.gif)

#### Example of Encrypting and Decrypting with a incorrect Passphrase
![example gif](https://i.gyazo.com/a96ec0202ddcd9ec3780b8c69ef74656.gif)
