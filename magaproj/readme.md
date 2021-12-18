- s'inscrire : auteur, estimateur, critique, acheteur

# Entités
- User
    - email: string
    - password: string
    - role: json
    - favoris: Production[]
    + commandes: Commande[]
    - type: string

- ProfilEstimateur
    - utilisateur: User
    - resume: string
    - isValidated: boolean

- ProfileAcheteur
    - utilisateur: User
    - adresse: string
    - ville: string
    - zipcode: string

- Devis
    - auteur: User
    - demande: text
    - email: string
    - phone: string
    - reference: string
    - prix: float

- Categorie
    - titre: string
    - description: text
    + productions: Production[]

- Production
    - categorie: Categorie
    - auteur: User
    - contenu: text
    - prixFinal: float
    + estimations: Estimation[]
    + critiques: Critique[]

!! ne pas oublier d'ajouter les favoris dans user

- Estimation
    - production: Production
    - estimateur: User
    - prix: float

- Critique
    - production: Production
    - critique: User
    - commentaire: text
    - note: integer

- CommandeDetail
    - production: Production
    - quantite: integer
    + commande: Commande

- Commande
    - acheteur: User
    - prixTotal: float
    - details: CommandeDetail[]
    - isPaid: boolean
    - createdAt: DateTimeImmutable
    - paidAt: DateTimeImmutable

1. créer user
2. créer l'inscription + login
3. créer mes entités
4. espace admin

5. reflechir aux pages
X page de login
X page d'inscription
X catalogue : affiche toutes les categories
X productions : affiche les productions dans une cateogire
X detail-production : affiche en détail 1 production + critques + notes + estimations
X auteurs : affiche tous les auteurs
X detail-auteur : liste des productions d'un auteur
X critques : affiche tous les critiques
X estimateurs : affiche tous les estimateurs
X demande-devis : affiche un formulaire de demande de devis
X favoris : liste des favoris
X profil : pour modifier ses infos
X commandes : liste des commandes passées