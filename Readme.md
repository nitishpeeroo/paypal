Payer avec Paypal Express Checkout

Version minimum :
 - PHP 7.0
 - git 2.7.4
 - composer 1.0.0

Liens à utiliser :
 - https://developer.paypal.com
 - https://www.sandbox.paypal.com/fr/home
 - https://packagist.org/packages/paypal/rest-api-sdk-php

Commande à utiliser :
 - php -S localhost:8000

Etape 1 : Créer un compte Paypal

Etape 2 : Initialiser un projet en PHP avec cette architecture
    - index.php : Démarrage du site
    - paypal.php : Clé d'authentification à Paypal

Etape 3 : Se connecter sur https://developer.paypal.com puis aller dans 
Sandbox->Accounts. Tu trouveras 2 comptes créer par Paypal : un compte acheteur
de type PERSONAL (buyer) et un vendeur de type BUSINESS (facilitator). Change le
compte du compte facilicator en allant sur l'email -> profil -> change password.

Etape 4 : Cliquez sur Dashboard -> My Apps & Credentials. Dans la section 
REST API apps cliquez sur Create App. Donnez un nom puis créer l'app. Notes 
l'id et le secret-id dans un tableau dans paypal.php

Etape 5: Charger la librairie paypal/rest-api-sdk-php :
-> composer  init
-> composer require paypal/rest-api-sdk-php



