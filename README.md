# af-wikilike

##Pré Requis
* Commande symfony, composer
* PHP >= 8.1

```
symfony console EQUIVALENT DE php bin/console
```

## Récupérer le projet

```
git clone https://github.com/noex59/af-wikilike.git && cd af-wikilike && composer install
```

* Dans le fichier **.env**, mettre ses propres identifiants bdd

* Créer la bdd & charger les informations

```
symfony console server:start OU php -S 127.0.0.1:8000 -t public
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console make:migration
```

* Charger les fixtures (Si il y a)
```
php bin/console doctrine:fixtures:load
```
