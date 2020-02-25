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
de l'application (paramètre)
  
**Expliquer pourquoi il faut changer le connecteur à la base de données**

> Parce que par défaut le connecteur est lié à MySql (dans le .env)

**Expliquer l'intérêt des migrations d'une base de données**

> Cela permet de faire des backup en cas de problème 
de base de données et de la faire evoluer (changement d
u fonctionnement d'un entité)

**C'est quoi une migration**
> Versionning de la base de données (rollback et eviter de perdre les données).

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
type-hinting.

Voir : *https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html*

## Form

**Qu'est-ce qu'un formulaire Symfony ?**
> Il s'agit d'un composant qui permet de créer un formulaire html (et de le rendre), de valider les données à leur 
>envoient, de gérer le mapping des données avec les données, ... 
 
 **Quels avantages offrent l'usage d'un formulaire ?*
 > Il permet de générer facilement le code html du formulaire, mais aussi de
 convertir les données de retour (submit) dans l'entité correspondante.
 
 > Rendu, Validation et Mapping(formulaire au modèle)

**Quelles sont les différentes personalisations de formulaire qui peuvent être faites dans Symfony ?**
> - Theme global à tout les formulaire
> - Theme unique à un formulaire

## Securité
**Definitions**
> Encoder : Encodé un mot de passe
> Provider : Récupérer l'utilistatueur
> Firewall : Façon d'authentifier un utilisateur
> Access-control : Restreindre/Permettre les accès selon les rôles des utilisateurs
> Role : Niveau de privilège
> Voter : Gérer les accès à l'interieur d'une route 

> Granulariter entre Firewall (Accès global au site), Access-Control (Accès à une route) et le voter privilège dans une route.

**Qu'est-ce que FOSUserBundle ? Pourquoi ne pas l'utiliser ?**
> Gestionnaire d'utilisateur

**Définir les termes suivants : Argon2i, Bcrypt, Plaintext, BasicHTTP**
>  

**Principe du hashage**
> Chiffre un mot de passe que l'on ne peut pas déchiffrer (simplification : un chiffre peut provenir de différente addition)
> 4 :( 2+2 ou 1+3, ou 5+(-1))

**Methodes LoginFormAuthenticator**
*Les méthodes sont appelées dans l'ordre suivant*
> **Support** -> vérifie si les conditions sont respecté
> **GetCredential** -> Définir les identifiants qui proviennent du formulaire
> **GetUser** -> Récupèrer l'utilisateur à partir des crédential
> **checkCrédential** -> Valide les identifiants
> **onAuthentificationSuccess** -> Authentifie si tout ce passe bien.

## Services
**Qu'est ce qu'un service**
> Un service est une classe stateless instancier une seule fois

**À quoi sert un service dans Symfony ?**
> A tout (voir services.yaml exclude) -> coeur du framework

**Avez-vous déjà utilisé des services dans ce projet ? Si oui, lesquels ?**
> EntityManager, Router, quasiment tout 

**Définir les termes suivant : Dependency Injection, Service, Autowiring, Container**
> - Service : Un objet de classe générique à l'application (singleton)
> - DI : Possibilité de modifier le container (gestion des méthodes qui inject les instances dans l'autowiring)
> - Autowiring : Permet d'eviter de passer les services dans le yaml.
> C'est le passage d'un instance dans les paramètres d'une méthode sans avoir à l'instancier.
> - Container : Contient tout les services disponible à l'autowiring (Gère les instances de service)

**Quelle importance a les services dans le fonctionnement de Symfony ?**
> Les services représentent le mécanisme majeur de Symfony.

## Validateurs

**À quoi sert le validateur ?**
> A valider les données envoyés par l'utilisateur afin d'assurer leurs cohérences

**Dans quel contexte peut-on valider des données ?**
> Entrée de formulaire, post via une API, lecture de fichier, insertion en BDD

## Serializer

**Quels sont les différentes parties du Serializer et à quoi servent-elles ?**
> - Le normaliseur (passage d'un objet/json/xml/yaml/csv en tableau)
> -  Le serializer (passage du tableau au format voulu objet/json/xml/yaml/csv)

## Cache
## Translation
## Bundle


