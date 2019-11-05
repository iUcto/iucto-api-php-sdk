# iÚčto PHP SDK

Officiální SDK knihovna v PHP pro apliakaci [https://www.iucto.cz](https://www.iucto.cz).

Dokumentace je k dispozici na [https://iucto.docs.apiary.io](https://iucto.docs.apiary.io/)

## Instalace knihovny
```bash
composer require iucto/iucto-api-php-sdk
```

## Příklad použití

### Načtení seznamu faktur vydaných
```php
require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');

try {
    $invoiceList = $iUcto->getInvoiceIssued();
    foreach ($invoiceList as $invoice) {
        var_dump($invoice->getId());
    }
} catch (IUcto\ConnectionException $e) {
    // handle connection exception
} catch (\IUcto\ValidationException $e) {
    //handle validation exception
}
```

### Vytvoření kontaktu
```php
require __DIR__ . '/../vendor/autoload.php';

$iUcto = IUcto\IUctoFactory::create('your-secret-key');

try {
    $customer = new \IUcto\Command\SaveCustomer();
    $customer->setName('Jan Novák');
    $customer->setComid('123456');
    $customer->setVatid('CZ123456');
    $customer->setVatPayer(true);
    $customer->setPhone('+420123123123');
    $customer->setUsualMaturity(14);
    $customer->setPreferredPaymentMethod('transfer');
    $customer->setInvoiceLanguage('cs');

    $address = new \IUcto\Dto\Address();
    $address->setCountry('CZ');
    $address->setStreet('Lanova 52/12');
    $address->setCity('Praha');
    $address->setPostalcode('21005');

    // Přiřazení adresy k zákazníkovi
    $customer->setAddress($address);

    $iUcto->createCustomer($customer);
} catch (IUcto\ConnectionException $e) {
    // handle connection exception
} catch (\IUcto\ValidationException $e) {
    //handle validation exception
}
```