# Bats' Needlessly Complicated Encryption (BNCE):

### The Encryption can be tested at https://haron.gay/max

## How to Install BNCE
1. Download the bnce_encryption.php file.
2. Import it into your project.

OR

```php
require("https://raw.githubusercontent.com/batscs/Bats-Needlessly-Complicated-Encryption/main/bnce_encryption.php");
```
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

![bnce_explanation](https://user-images.githubusercontent.com/31670615/131717712-1873935a-a1ec-43a2-9504-5991360de16e.png)

## Example of Front-End usage (index.php)
#### Example of Encrypting and Decrypting with a correct Passphrase
![example gif](https://i.gyazo.com/28ff4dfd22c6f8c6ba1767e03cd6f46a.gif)

#### Example of Encrypting and Decrypting with a incorrect Passphrase
![example gif](https://i.gyazo.com/a96ec0202ddcd9ec3780b8c69ef74656.gif)
