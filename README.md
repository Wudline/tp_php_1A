## Projet PHP - Croissantage

- Modèle MVC
- Utilisation de namespace
---

## Composition du projet

- Un dossier "Controllers"
```php
// Regroupe les classes avec les fonctions de vérifications
namespace Controllers;
```
- Un dossier "Models"
```php
// Regroupe les classes avec les fonctions d'appel à la base de données
namespace Models;
```
- Un dossier "Tools"
```php
// Regroupe les classes utiles utilisées en de multiples endroits.
namespace Tools;
```
- Des fichiers à la racine
```php
namespace View;
```

---
## Controllers

### Classe

- Fonction d'affichage d'une classe : non testée, non appelée
- Fonction d'affichage d'un select contenant les classes référencées en BDD : fonctionnelle

### Croissant

- Fonction de référencement d'un nouveau croissantage : fonctionnelle
- Fonction de demande de vienneoiserie pour un croissantage : fonctionnelle
- Fonction d'affichage d'un croissantage : non testée, non appelée
- Fonction d'affichage d'un select contenant les viennoiseries référencées en BDD : fonctionnelle
- Fonction d'affichage de la date de croissantage (et de la date limite) : fonctionnelle


### Deconnexion

- Controlleur appelé pour détruire une session : non testé, non implémenté

### Etudiant

- Fonction de vérifications des informations saisies pour l'ajout d'un étudiant : fonctionnelle
- Fonction de vérifications des informations saisies pour la modification des données d'un étudiant : fonctionnelle
- Fonction de vérifications des informations saisies pour la modification de la classe d'un étudiant : fonctionnelle
- Fonction de vérifications des informations saisies pour la modification du mot de passe d'un étudiant : fonctionnelle
- Fonction de vérifications des informations saisies pour la modification des droits d'un étudiant : fonctionnelle
- Fonction d'affichage d'un select des étudiants référencés en BDD : fonctionnelle
- Fonction d'affichage d'un select de rôle référencés en BDD : fonctionnelle
- Fonction d'affichage des etudiants : fonctionnelle


### Promo

- Fonction d'affichage des promo : non testée, non appelée
- Fonction d'affichage d'un select des promo référencées en BDD : fonctionnelle

### Statistiques

- Fonction d'affichage du meilleur croissanteur : fonctionnelle
- Fonction d'affichage du nombre de fois que la personne connectée a été croissantée : fonctionnelle
- Fonction d'affichage du nombre de fois que la personne connectée a croissanté : fonctionnelle
---
## Models 

### Classe 

- Fonction d'appelle à la BDD pour en récupérer les classes référencées : fonctionnelle
- Fonction d'appelle à la BDD pour en récupérer les étudiants référencées dans certaines classe/promo : fonctionnelle

### Connexion

- Fonction de vérification des identifiants / mot de passe et avec les infos en BDD : fonctionnelle


### Croissant

- Fonction d'insertion d'un croissantage en BDD : fonctionnelle
- Fonction d'appelle à la BDD pour en récupérer les croissantages référencées : fonctionnelle
- Fonction d'appelle à la BDD pour en récupérer les viennoiseries référencées : fonctionnelle
- Fonction d'appelle à la BDD pour en récupérer une date de croissantage pour un croissantage donnée : fonctionnelle
- Fonction d'appelle à la BDD pour en récupérer une date limite de croissantage pour un croissantage donnée : fonctionnelle


### Database (Base de données)

- Fonction de connexion à la base de données : fonctionnelle

### Demande

- Fonction d'insertion d'une demande de viennoiserie en BDD : fonctionnelle
- Fonction d'appelle à la BDD pour en récupérer la liste des demandes référencées : non appelée, fonctionnelle


### Etudiant

- Fonction d'appelle à la BDD pour récupérer le nom d'un etudiant : fonctionnelle
- Fonction d'appelle à la BDD pour récupérer la promo d'un etudiant : fonctionnelle
- Fonction d'insertion d'un etudiant en BDD : fonctionnelle
- Fonction de modification d'un etudiant en BDD : fonctionnelle
- Fonction de modification des droits d'un etudiant en BDD : fonctionnelle
- Fonction de modification du mdp d'un etudiant en BDD : fonctionnelle
- Fonction de modification de la classe d'un etudiant en BDD : fonctionnelle
- Fonction d'appelle à la BDD pour récupérer les etudiants d'une classe/promo données : fonctionnelle
- Fonction d'appelle à la BDD pour récupérer les etudiants croissantés : fonctionnelle
- Fonction d'appelle à la BDD pour récupérer les rôles référencés : fonctionnelle

### Promo

- Fonction d'appelle à la BDD pour récupérer les promo référencées : fonctionnelle

### Statistiques

- Fonction d'appelle à la BDD pour récupérer le nombre de croissantage sur la personne connectée : fonctionnelle
- Fonction d'appelle à la BDD pour récupérer le nombre de croissantage par la personne connectée : fonctionnelle
- Fonction d'appelle à la BDD pour récupérer le meilleur croissanteur : fonctionnelle

---

## Tools

### CRSF

- non implémenté
- non fonctionnel

### Session

- dans le cas où les sessions avaient été fonctionnelles : systemes de redirection en fonction des roles utilisateurs
- non implémenté

### Utils

Fonction de ResultRequest : fonctionnelle
> Pour éviter de devoir retaper à chaque fois les commandes ***prepare, execute, rowcount*** et les tests associés
```php
function ResultRequest($db, $request, $msgNullCmpt, $msgNullExec)
{
    $this->rslt = NULL;

    $stmt = $db->prepare($request);
    $exec = $stmt->execute();
    $cmpt = $stmt->rowCount();
    
        if ( $exec )
        {
            if ( $cmpt>0 )
            {
                $this->rslt = $stmt->fetchAll();
            }
            else
            {
                $this->rslt = $msgNullCmpt;
            }
        }
        else
        {
            $this->rslt = $msgNullExec;
        }

        return $this->rslt;
    }
}
```

---

## Views

### Index

- Appelle à la fonction de test de connexion
- Affichage des données statistiques
- En fonction du rôle utilisateur : inclusion de la page accueil ou admin

### Accueil

- Un etudiant non administrateur peut croissanté quelqu'un en son nom uniquement
- Un etudiant non administrateur peut voter pour indiqué la viennoiserie de son choix si quelqu'un a été croissanté
- Un etudiant non administrateur peut passer commande s'il a été croissanté
- Un etudiant non administrateur peut voir les etudiants de la meme classe et de la meme promotion que lui

### Admin

- Un etudiant administrateur peut ajouter un etudiant
- Un etudiant administrateur peut modifier un etudiant
- Un etudiant administrateur peut référencer un croissantage de n'importe qui sur n'importe qui
- Un etudiant administrateur peut voter pour indiqué la viennoiserie de son choix si quelqu'un a été croissanté
- Un etudiant administrateur peut passer commande s'il a été croissanté
- Un etudiant administrateur peut voir la totalité des étudiants référencés.
 
--- 

## Conclusion

Sans le problème de session les fonctions requises sont fonctionnelles.