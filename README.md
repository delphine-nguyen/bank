# bank

La banque Banque souhaite mettre en place un système de gestion des comptes bancaires pour ses
clients. Vous êtes chargé de concevoir et d'implémenter un programme PHP orienté objet pour gérer ces
comptes.

Sachant que le compte bancaire contient les informations suivantes :

- Numéro de compte (11 chiffres)
- Client (Identifiant client, nom, prénom, date de naissance, email)
- Solde
- Découvert autorisé (Oui/Non)

Il existe trois types de comptes possibles :

1. Compte Courant ( Frais de tenue de compte : 25 euros/an )
2. Livret A (Frais de tenue de compte : Frais de tenue de compte + 10% de l'épargne/an )
3. Plan Épargne Logement (PEL) ( Frais de tenue de compte : Frais de tenue de compte + 2,5% de
l'épargne/an )

Contraintes : 

- Les Livret A et Plan Épargne doivent posséder une méthode de calcule d’intérêt
-Chaque client de la banque peut posséder au maximum trois comptes.
- Le numéro de compte bancaire doit être composé de 11 chiffres.
- L'identifiant client doit être alphanumérique et composé de deux caractères majuscules suivi de six
chiffres.

Fonctionnalités :

- Méthode de Retrait : Les clients pourront retirer de l'argent de leur compte, sous réserve de
disponibilité de fonds et du respect du découvert autorisé (si applicable).
- Méthode d'Alimentation d'un Compte : Les clients pourront déposer de l'argent sur leur compte.
- Méthode de Virement : Les clients pourront effectuer des virements entre deux comptes, sous
réserve des fonds disponibles sur le compte source et du respect du découvert autorisé (le cas
échéant).
- Méthode d'affichage d'une fiche client tel que :

    ```
    Fiche client
    Numéro client : AF657545
    Nom : Nom_du_client
    Prénom : Prénom_du_client
    Date de naissance : Date de naissance du client
    Liste de compte
    Numéro de compte | Solde
    01345267891 1500 euros :-)
    -----------------------------
    23445566778 6733 euros :-)
    -----------------------------
    23445966211 - 45 euros :-(
    ```