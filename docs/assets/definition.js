var contractsType = {
    "fields": [
        {
            "name": "id",
            "description": "ID zakázky",
            "dataType": "int",
            "required": null,
        },
        {
            "name": "code",
            "description": "Kód zakázky",
            "dataType": "string",
            "required": null,
        },
        {
            "name": "name",
            "description": "Název zakázky",
            "dataType": "string",
            "required": null,
        },
        {
            "name": "description",
            "description": "Popis zakázky",
            "dataType": null,
            "required": null,
        }
    ]
}

var statesType = {
    "key": {
        dataType: "string",
        description: "Kód státu"
    },
    "value": {
        dataType: "string",
        description: "Název státu (česky)"
    }
}


var availiblePaymentMethodType = {
    "key": {
        dataType: "string",
        description: "Kód dostupné metody platby"
    },
    "value": {
        dataType: "string",
        description: "Název dostupné metody platby"
    }
}


var accountVATsType = {
    "key": {
        dataType: "string",
        description: "Kód účtu DPH"
    },
    "value": {
        dataType: "string",
        description: "Název účtu DPH (česky)"
    }
}

var availibleAccountsType = {
    "key": {
        dataType: "string",
        description: "Kód dostupného účtu"
    },
    "value": {
        dataType: "string",
        description: "Název dostupného účtu (česky)"
    }
}

var VATsType = {
    "key": {
        dataType: "string",
        description: "Kód typu DPH"
    },
    "value": {
        dataType: "string",
        description: "Název typu DPH (česky)"
    }
}

var bankAccountType = {
    "key": {
        dataType: "string",
        description: "Kód bankovní položky"
    },
    "value": {
        dataType: "string",
        description: "Název bankovní položky (česky)"
    }
}

var VATRatesOnType = {
    "fields": [
        {
            "name": null,
            "description": "Seznam kurzů DPH",
            "dataType": "int",
            "required": null,
        }
    ]
}

var paymentMethodType = {
    "key": {
        dataType: "string",
        description: "Kód metody plateb"
    },
    "value": {
        dataType: "string",
        description: "Název metody (česky)"
    }
}

var roundingType = {
    "key": {
        dataType: "string",
        description: "Kód zaokrouhlení"
    },
    "value": {
        dataType: "string",
        description: "Název zaokrouhlení (česky)"
    }
}

var currencyType = {
    "fields": [
        {
            "name": null,
            "description": "Kód měny",
            "dataType": "string",
            "required": null,
        }
    ]
}

var bankAccountType = {
    "fields": [
        {
            "name": "id",
            "description": "ID bankovního účtu",
            "dataType": "int",
            "required": null,
        },
        {
            "name": "name",
            "description": "Název",
            "dataType": "string",
            "required": null,
        },
        {
            "name": "number",
            "description": "Číslo účtu",
            "dataType": "string",
            "required": null,
        },
        {
            "name": "currency",
            "description": "Měna",
            "dataType": "string",
            "required": null,
        },
        {
            "name": "isdefault",
            "description": "Příznak, zda je účet nastaven jako výchozí",
            "dataType": "bool",
            "required": null,
        }
    ]
}

var documentType = {
    "fields": [
        {
            "name": "id",
            "description": "ID dokladu",
            "dataType": "int(11)",
            "required": false,
        },
        {
            "name": "sequence_code",
            "description": "Číslo dokladu",
            "dataType": "string (45)",
            "required": false,
        },
        {
            "name": "variable_symbol",
            "description": "Variabilní symbol",
            "dataType": "string (42)",
            "required": true,
        },
        {
            "name": "customer_id",
            "description": "Id zákazníka",
            "dataType": "int(11)",
            "required": true,
        },
        {
            "name": "customer_bank-account",
            "description": "Bankovní účet zákazníka",
            "dataType": "string (45)",
            "required": false,
        },
        {
            "name": "date",
            "description": "Datum vystavení",
            "dataType": "timestamp",
            "required": true,
        },
        {
            "name": "maturity_date",
            "description": "Datum splatnosti",
            "dataType": "timestamp",
            "required": true,
        },
        {
            "name": "payment_type",
            "description": "Forma úhrady",
            "dataType": "int(1)",
            "required": false,
        },
        {
            "name": "bank_account_id",
            "description": "ID bankovního účtu pro příjem platby",
            "dataType": "int(11)",
            "required": false,
        },
        {
            "name": "currency",
            "description": "Měna dokladu",
            "dataType": "string (3)",
            "required": true,
        },
        {
            "name": "price",
            "description": "Celková částka bez DPH",
            "dataType": "int(11)",
            "required": false,
        },
        {
            "name": "price_czk",
            "description": "Celková částka v CZK bez DPH",
            "dataType": "int(11)",
            "required": false,
        },
        {
            "name": "price_inc_vat",
            "description": "Celková částka s DPH",
            "dataType": "int(11)",
            "required": false,
        },
        {
            "name": "price_inc_vat_czk",
            "description": "Celková částka v CZK s DPH",
            "dataType": "int(11)",
            "required": false,
        },
        {
            "name": "to_be_paid",
            "description": "Zbývající částka k úhradě (v měně dokladu)",
            "dataType": "int",
            "required": false,
        },
        {
            "name": "date_vat",
            "description": "Datum zdanitelného plnění",
            "dataType": "timestamp",
            "required": true,
        },
        {
            "name": "date_vat_prev",
            "description": "Datum předchozí sazby DPH",
            "dataType": "timestamp)",
            "required": false,
        },
        {
            "name": "description",
            "description": "Poznámka",
            "dataType": "string",
            "required": false,
        },
        {
            "name": "rounding_type",
            "description": "Způsob zaokrouhlení",
            "dataType": "string",
            "required": false,
        },
        {
            "name": "items",
            "description": "Položky dokladu",
            "dataType": {
                "isArray": true,
                "fields": [
                    {
                        "name": "id",
                        "description": "ID položky",
                        "dataType": "int(11)",
                        "required": false,
                    },
                    {
                        "name": "amount",
                        "description": "Počet",
                        "dataType": "decimal(12,2)",
                        "required": true,
                    },
                    {
                        "name": "unit",
                        "description": "Jednotka",
                        "dataType": "string(10)",
                        "required": false,
                    },
                    {
                        "name": "price",
                        "description": "Cena za jednotku",
                        "dataType": "decimal(12,2)",
                        "required": true,
                    },
                    {
                        "name": "text",
                        "description": "Popis",
                        "dataType": "string(255)",
                        "required": true,
                    },
                    {
                        "name": "vat",
                        "description": "DPH",
                        "dataType": "decimal(5,2)",
                        "required": false,
                    },
                    {
                        "name": "acountentrtype_id",
                        "description": "Typ účetní položky",
                        "dataType": "int(11)",
                        "required": true,
                    },
                    {
                        "name": "vattype",
                        "description": "Typ DPH",
                        "dataType": "int(11)",
                        "required": true
                    },
                    {
                        "name": "chart_account_id",
                        "description": "Účet účetní osnovy",
                        "dataType": "int(11)",
                        "required": false
                    },
                    {
                        "name": "vat_chart_id",
                        "description": "Účet DPH",
                        "dataType": "int(11)",
                        "required": false
                    },
                    {
                        "name": "department_id",
                        "description": "Středisko",
                        "dataType": "int(11)",
                        "required": false
                    },
                    {
                        "name": "contract_id",
                        "description": "Zakázka",
                        "dataType": "int(11)",
                        "required": false
                    }
                ]

            },
            "required": true,
        },
        {
            "name": "accounted",
            "description": "Doklad je zaúčtován",
            "dataType": "bool",
            "required": false
        },
        {
            "name": "deleted",
            "description": "Doklad je smazaný",
            "dataType": "bool",
            "required": false
        }

    ]
}

var customerDataType = {
    "isArray": false,
    "fields": [
        {
            "name": "name",
            "description": "",
            "dataType": "string",
            "required": true,
        },
        {
            "name": "email",
            "description": "",
            "dataType": "string",
            "required": true,
        },
        {
            "name": "address",
            "description": "",
            "dataType": {
                "isArray": false,
                "fields": [
                    {
                        "name": "street",
                        "description": "",
                        "dataType": "string",
                        "required": true,
                    },
                    {
                        "name": "city",
                        "description": "",
                        "dataType": "string",
                        "required": true,
                    },
                    {
                        "name": "postalcode",
                        "description": "",
                        "dataType": "string",
                        "required": true,
                    },
                    {
                        "name": "country",
                        "description": "",
                        "dataType": "string",
                        "required": true,
                    },
                ]
            },
            "required": true,
        },
        {
            "name": "vatid",
            "description": "",
            "dataType": "string",
            "required": true,
        },
        {
            "name": "vat_payer",
            "description": "",
            "dataType": "boolean",
            "required": true,
        },
        {
            "name": "usual_maturity",
            "description": "",
            "dataType": "integer",
            "required": true,
        },
        {
            "name": "preferred_payment_method",
            "description": "",
            "dataType": "string",
            "required": true,
        },
        {
            "name": "invoice_language",
            "description": "",
            "dataType": "string",
            "required": true,
        },
    ]
};

var validationException = {
    "name": "ValidationException",
    "description": "V případě nesprávnosti dat (například že chybí kód měny) aplikace vyhodí ValidationException. Voláním $esception->getErrors() lze získat pole zpráv s chybami (v češtině)"
};

var connectionExceptions = {
    "name": "ConnectionException",
    "description": "V případě jiného návratového kódu požadavku, než je 2xx bude vyhozena výjimka ConnectionException."
}

var docDefinition = {
    "apiVersion": "0.1",
    "apiName": "iUcto api dokumentace",
    "description": "",
    "services": [
        {
            "name": "getAllDocuments",
            "shortDescription": "Zjednodušený výpis všech dostupných dokladů.",
            "parameters": [],
            "returns": {
                "isArray": true,
                "dataType": {}
            },
            "throws": [
            ],
            "see": null
        },
        {
            "name": "createNewDocument",
            "shortDescription": "Vytvoří nový doklad, odpověd obsahuje detail dokladu.",
            "parameters": [
                {
                    "name": "data",
                    "dataType": documentType
                }
            ],
            "returns": {
                "isArray": true,
                "dataType": customerDataType
            },
            "throws": [
                validationException,
                connectionExceptions
            ],
            "see": null
        }       
    ]
};