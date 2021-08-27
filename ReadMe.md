# Bats' Needlessly Complicated Encryption (BNCE):
## Example of Encrypting and Decrypting with a correct Passphrase
![example gif](https://i.gyazo.com/28ff4dfd22c6f8c6ba1767e03cd6f46a.gif)

## Example of Encrypting and Decrypting with a incorrect Passphrase
![example gif](https://i.gyazo.com/a96ec0202ddcd9ec3780b8c69ef74656.gif)

## How to Use
1. Download the bnce_encryption.php file.
2. Import it into your project.
3. To encrypt and decrypt use the following functions:
```php
bnce_encrypt($string_to_encrypt, $passphrase);
bnce_decrypt($string_to_decrypt, $passphrase);
```
Note: the input given to the passphrase has to be a integer.
