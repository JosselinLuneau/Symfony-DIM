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
**Quelles relations existent entre les entités (Many To One/Many To Many/...) ?**

##### Post
- Post ManyToOne User (author)
- Post OneToMany

##### User
- User OneToMany Comment
- User (author) OneToMany Post

##### Comment
- Comment ManyToOne Post
- Comment ManyToOne User

**Faire un schéma de la base de données.**
![](https://i.imgur.com/UEIzOQw.png)

**Expliquer ce qu'est le fichier .env**

> le fichier .env correspond aux variable d'environnement
de l'application
  
**Expliquer pourquoi il faut changer le connecteur à la base de données**

> Parce que par défaut le connecteur est lié à MySql

**Expliquer l'intérêt des migrations d'une base de données**

> Cela permet de faire des backup en cas de problème 
de base de données et de la faire evoluer (changement d
u fonctionnement d'un entité)

## Administration

**Faire une recherche sur les différentes solutions disponibles pour l'administration dans Symfony**
- AdminBundle
- EasyAdmin
- Sonata

#### EasyAdmin
**Travail préparatoire : Qu'est-ce que EasyAdmin ?**
> EasyAdmin est un composant qui permet de mettre en place
facilement un back-office

**Pourquoi doit-on implémenter des méthodes to string dans nos entités?**
> Le composant se base sur le __toString de l'entitié 
en question afin d'affiche les informations sur le back-office.

## Controller

**Qu'est-ce que le ParamConverter ?**
> Il l'instanciation direct d'un id en une entité indiqué
dans la signature de la méthode. Cela ce fait grâce au 
type-hinting

Voir : *https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html*

## Form

**Qu'est-ce qu'un formulaire Symfony ?**
> Il s'agit d'un composant qui permet de créer un formulaire
 html (et de le rendre), de valider les données à leur envoie, de gérer le mapping
 des données avec les données, ... 
 
 *Quels avantages offrent l'usage d'un formulaire ?*
 > Il permet de générer facilement le code html du formulaire, mais aussi de
 convertir les données de retour (submit) dans l'entité correspondante.

