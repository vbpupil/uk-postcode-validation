# UK Postcode Validation

UK postcode validation tool used to determine that a string given is a valid UK Postcode. The object then returned contains the following:
1. Type - __area classification__
2. Head - __first section of the postcode__
3. Tail - __last section of the postcode__

### How to use?

```php
$p = new Postode('SW1A 1AA');
$p->getType(); # returns string UK_MAINLAND
$p->getHead(); # returns string SW1A
$p->getTail(); # returns string 1AA
```