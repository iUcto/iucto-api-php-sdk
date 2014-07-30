var docDefinition = {
    "apiVersion": "0.1",
    "apiName": "iUcto",
    "description": "",
    "services": [
        {
            "name": "getAllDocuments",
            "shortDescription": "Zjednodušený výpis všech dostupných dokladů.",
            "parameters": [],
            "returns": {
                "isArray": true,
                "fields" : {
                    
                }
            }
        },
        {
            "name": "createCustomer",
            "shortDescription": "Vytvoří nový doklad, odpověd obsahuje detail vytvořeného zákazníka.",
            "parameters": [
                    {
                    "name" : "customer",
                    "dataType": {
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
                    }
                }
            ],
            "returns": {
                "isArray": true,
                "type": "customerType"
            },
            "throws": {
            }
        },
        
        {
            "name" : "",
            "shortDescription": "",
            "parameters": [],
            "returns": {
                "isArray": true,
                "type": "customerType"
            },
            "throws": {
            }
        }
    ]
};