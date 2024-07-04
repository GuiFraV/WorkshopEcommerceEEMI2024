# Comment lancer le projet ? 


## Requierements :
- XAMP ou WAMP (nécessaire)

## Configuration de la BDD (MySQL) :
- Dans le fichier .env ajouter la ligne

```php
DATABASE_URL="mysql://username:password@127.0.0.1:3306/lottery?serverVersion=8.0.32&charset=utf8mb4"

```

- remplacer username par identifiant MYSQL
- remplacer password par le mot de passe MYSQL

## Lancer le projet

- ouvrir le terminal dans le projet 

 ```bash
 symfony server:start
 ```
- ensuite ouvrir un autre terminal :

```bash
cd frontend
```

- puis lancer la commande suivante : 

```bash
npm run dev
```

et se rendre dans le localhost:3000
