## Algorithm description

Problema:
> Se dau bile de n culori.
> In total sunt n x n bile.
> Distributia bilelor pe culori este random.
> Sa se decida daca este posibil si in caz afirmativ sa se prezinte algoritmul general prin care bilele sunt repartizate in n grupe de cate n bile astfel incat in fiecare grupa sa fie bile de maxim 2 culori diferite (sunt permise si grupe cu o singura culoare) indiferent de distributia initiala.

Solutie:
> Se sorteaza crescator distributia initiala de bile.
> Pentru fiecare grupa in parte, se parcurge distributia initiala si se ia cantitatea optima de bile **floor(n/2) + 1** din primul tip de bile disponibil si restul de **floor(n/2)** din urmatoarea pozitie cu suficiente bile disponibile pentru a completa grupa curenta. Daca prima pozitie are mai putine bile decat cantitatea optima, atunci se iau toate bilele disponibile si se cauta urmatoarea pozitie care poate completa grupa.


## Setup

### Get required packages

```sh
$ composer install
```
```sh
$ npm install
```

### Migrate and seed the database
*** Update .env file with database credentials

```sh
$ php artisan migrate
```
```sh
$ php artisan db:seed
```

### Compile assets for production
```sh
$ npm run production
```


## CLI Version
There is also a CLI version available:
```sh
$ php artisan marbles
```
