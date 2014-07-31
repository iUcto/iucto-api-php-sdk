var roundingType = {
    "key" : {
        dataType: "string",
        description: "Kód zaokrouhlení"
    },
    "value" : {
        dataType: "string",
        description: "Název zaokrouhlení (česky)"
    }
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
                "required": true,
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
    "name" : "ValidationException",
    "description" : "V případě nesprávnosti dat (například že chybí kód měny) aplikace vyhodí ValidationException. Voláním $esception->getErrors() lze získat pole zpráv s chybami (v češtině)" 
};

var connectionExceptions = {
    "name" : "ConnectionException",
    "description" : "V případě jiného návratového kódu požadavku, než je 2xx bude vyhozena výjimka ConnectionException."
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
                "fields": {
                }
            }
        },
        {
            "name": "createCustomer",
            "shortDescription": "Vytvoří nový doklad, odpověd obsahuje detail vytvořeného zákazníka.",
            "parameters": [
                {
                    "name": "customer",
                    "dataType": customerDataType
                }
            ],
            "returns": {
                "isArray": true,
                "dataType": customerDataType
            },
            "throws": [
                validationException,
                connectionExceptions
            ]
        },
        {
            "name": "",
            "shortDescription": "",
            "parameters": [],
            "returns": {
                "isArray": true,
                "dataType": customerDataType
            },
            "throws": [
                validationException,
                connectionExceptions
            ]
        }
    ]
};