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
> Il permet l'instanciation direct d'un id en une entité indiqué
dans la signature de la méthode. Cela ce fait grâce au 
type-hinting

Voir : *https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html*

## Form

**Qu'est-ce qu'un formulaire Symfony ?**
> Il s'agit d'un composant qui permet de créer un formulaire html (et de le rendre), de valider les données à leur 
>envoient, de gérer le mapping des données avec les données, ... 
 
 **Quels avantages offrent l'usage d'un formulaire ?*
 > Il permet de générer facilement le code html du formulaire, mais aussi de
 convertir les données de retour (submit) dans l'entité correspondante.

**Quelles sont les différentes personalisations de formulaire qui peuvent être faites dans Symfony ?**
> - Theme global à tout les formulaire
> - Theme unique à un formulaire
## Services

**À quoi sert un service dans Symfony ?**
> Faire des scripts réutilisables

**Avez-vous déjà utilisé des services dans ce projet ? Si oui, lesquels ?**
> EntityManager, Request, Response, Doctrine ..

**Définir les termes suivant : Dependency Injection, Service, Autowiring, Container**
> - Service : Un objet de classe générique à l'application
> - DI : Permet l'injection de classe définit comme des services
> - Autowiring : C'est le passage d'un isntance dans les paramètres d'une méthode sans avoir à l'instancier.
> - Container : Contient tout les services disponible à l'autowiring

**Quelle importance a les services dans le fonctionnement de Symfony ?**
> Eviter de réecrire du code

## Validateurs

**À quoi sert le validateur ?**
> A valider les données

**Dans quel contexte peut-on valider des données ?**
> Lors d'un insertion en bdd

## Serializer

**Quels sont les différentes parties du Serializer et à quoi servent-elles ?**
> - Le normaliseur (passage d'un objet/json/xml/yaml/csv en tableau)
> -  Le serializer (passage du tableau au format voulu objet/json/xml/yaml/csv)


