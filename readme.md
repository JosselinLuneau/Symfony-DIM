# Blog avec Symfony

### Objectif
Réaliser un système de blog avec Symfony. Ce système de blog est destiné à des webzines, elle gère des auteurs qui vont écrire des articles. Les membres inscrits pourront commenter les articles mais non en écrire.

### Fonctionnalités
* Publier un article
* S'inscrire/Se connecter
* Consulter un article
* Commenter un article

### Permissions
Il y aura un administrateur qui aura accès à un back-office de gestion des utilisateurs. L'administrateur pourra également dé-publier un article.

Les auteurs pourront poster des articles et commenter d'autres.

Les utilisateurs pourront se connecter et commenter les articles du site.

Les visiteurs pourront regarder les articles et voir les commentaires.

## Doctrine
>Quelles relations existent entre les entités (Many To One/Many To Many/...) ? Faire un schéma de la base de données.

##### Post
- Post ManyToOne User (author)
- Post OneToMany

##### User
- User OneToMany Comment
- User (author) OneToMany Post

##### Comment
- Comment ManyToOne Post
- Comment ManyToOne User

###### Shema
![](https://i.imgur.com/UEIzOQw.png)

> Expliquer ce qu'est le fichier .env

le fichier .env correspond aux variable d'environnement
de l'application
  
> Expliquer pourquoi il faut changer le connecteur à la base de données

Parce que par défaut le connecteur est lié à MySql

> Expliquer l'intérêt des migrations d'une base de données

Cela permet de faire des backup en cas de problème de base de données

## Administration