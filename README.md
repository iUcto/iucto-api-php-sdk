# iUcto PHP SDK
Toto je SDK pro komunikaci s aplikací [iUcto](http://www.iucto.cz/). 

Pro komunikaci je potřeba vytvořit API klíč, který lze generovat v detailu profilu uživatele.

V adresáři __examples__ jsou uvedeny příklady pro volání všech dostupných služeb.

SDK pracuje __výhradně__ s texty v kódování __UTF-8__.

Dokumentace pro PHP je umístěna online na stránkách [iUcto](http://www.iucto.cz/api).

Alternativně lze dokumentaci vygenerovat pomocí aplikace [apigen](http://apigen.org/) příkazem:

```
.\apigen.bat --source C:\dev\php\iucto-sdk\src --destination C:\dev\php\iucto-sdk\docs --access-levels "public,protected,private"
```
Dokumentaci k samotnému API naleznete na serveru [apiary](http://docs.iucto.apiary.io/).
