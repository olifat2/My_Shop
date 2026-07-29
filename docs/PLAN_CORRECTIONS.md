# Plan de corrections et d'evolution

## Vision du projet

Le projet doit etre presente comme une application Laravel de gestion de stock et de vitrine e-commerce pour une petite boutique familiale specialisee dans les produits capillaires et les meches/extensions.

L'objectif n'est pas de devenir une marketplace complete a court terme. L'objectif prioritaire est de livrer un projet propre, stable, demonstrable et coherent pour GitHub:

- un admin gere les produits, les stocks, les clients et les commandes;
- un client consulte le catalogue, ajoute au panier et passe une commande;
- chaque vente ou ajustement laisse une trace dans l'historique du stock;
- l'interface est sobre, lisible et adaptee a un usage quotidien.

## Etat actuel

### Deja traite

- Routes publiques nettoyees: plus de requete Eloquent directe dans `routes/web.php`.
- Inscription publique securisee: un visiteur cree toujours un compte client.
- Creation automatique du profil client.
- Routes de commandes limitees aux actions reellement implementees.
- Creation de commande plus fiable: prix recalcules depuis la base, verification du stock, decrement du stock.
- Ajout d'une reference de commande.
- Ajout d'un historique de mouvements de stock.
- Seeders de demo: admin, client, statuts, produits.
- Tests adaptes au projet.
- Style PHP corrige avec Pint.

### Points faibles restants

- Design public/client encore trop generique et peu professionnel.
- Cartes produits trop grandes et peu adaptees a un catalogue dense.
- Page d'accueil trop marketing et pas assez orientee boutique familiale.
- Plusieurs boutons/liens ne sont pas branches.
- Theme sombre admin incomplet.
- Dashboard admin contient encore des statistiques peu fiables ou trop decoratives.
- Gestion d'inventaire visible seulement sur la page produit, pas encore comme module admin complet.
- README vide.
- Donnees produits sans vraies images par produit.

## Priorite 1 - Nettoyage des interactions non branchees

Objectif: supprimer l'impression de prototype incomplet.

### A corriger

- Retirer ou brancher la newsletter sur les pages `home.blade.php` et `client/homeClient.blade.php`.
- Remplacer les liens `href="#"` dans le header public:
  - categories;
  - conditions d'utilisation;
  - politique de confidentialite;
  - mot de passe oublie si la route n'est pas exposee.
- Retirer ou brancher la recherche globale du header public.
- Retirer ou brancher la recherche globale admin dans `layouts/auth-admin/header.blade.php`.
- Retirer le badge notification statique `3` dans l'admin ou creer une vraie logique.
- Remplacer les boutons admin non branches:
  - `Mon profil`;
  - `Parametres`.

### Critere de validation

Chaque bouton visible doit soit fonctionner, soit etre retire temporairement.

## Priorite 2 - Refonte du catalogue produits

Objectif: rendre la vitrine lisible, compacte et credible.

### A corriger

- Reduire la taille des cartes produits.
- Reduire la hauteur des images produit autour de 160-180px.
- Utiliser une grille plus dense: environ `repeat(auto-fit, minmax(220px, 1fr))`.
- Afficher le stock disponible sur chaque carte.
- Retirer les faux avis `(24 avis)` tant qu'il n'y a pas de systeme d'avis.
- Harmoniser les boutons:
  - action principale: `Ajouter`;
  - action secondaire: `Details`.
- Eviter l'image `intro.png` pour tous les produits.
- Prevoir un champ image produit dans une phase ulterieure.

### Critere de validation

La page catalogue doit afficher plus de produits sans defilement excessif et donner une impression de vrai inventaire consultable.

## Priorite 3 - Refonte de la page d'accueil

Objectif: passer d'une landing page generique a une entree claire vers la boutique.

### Structure proposee

1. Bandeau principal sobre:
   - titre: `Boutique capillaire familiale`;
   - texte: `Catalogue, stock et commandes suivis simplement`;
   - bouton: `Voir les produits`.
2. Section produits disponibles:
   - 4 a 8 produits compacts.
3. Section categories utiles:
   - meches/extensions;
   - produits capillaires.
4. Section fonctionnement:
   - stock suivi;
   - commande simple;
   - confirmation par la boutique.

### A retirer ou modifier

- Carousel trop dominant.
- Promesses non garanties:
  - livraison gratuite en euros;
  - paiement securise si pas de paiement;
  - retours 30 jours si non gere.

### Critere de validation

La page d'accueil doit expliquer rapidement le projet et conduire vers le catalogue.

## Priorite 4 - Admin et theme sombre

Objectif: rendre l'espace admin utilisable comme outil de travail.

### A corriger

- Completer le theme sombre sur:
  - formulaires;
  - cartes detail produit;
  - cartes detail client;
  - cartes detail commande;
  - tableaux responsives;
  - inputs/selects.
- Remplacer les fonds blancs fixes par des variables CSS:
  - `var(--bg)`;
  - `var(--surface)`;
  - `var(--surface-alt)`;
  - `var(--border)`;
  - `var(--text)`.
- Rendre les tables plus denses.
- Uniformiser les boutons d'action.
- Retirer les emojis comme systeme principal d'icones ou les rendre coherents.

### Critere de validation

Le theme sombre doit etre lisible sur toutes les pages admin sans cartes blanches incoherentes.

## Priorite 5 - Dashboard admin utile

Objectif: afficher des informations reelles de gestion.

### A corriger

- Retirer les `rand()` dans les statistiques.
- Ajouter des statistiques reelles:
  - nombre total de produits;
  - nombre total de commandes;
  - nombre total de clients;
  - chiffre d'affaires total ou mensuel;
  - valeur estimee du stock;
  - nombre de produits en stock faible;
  - nombre de produits en rupture.
- Charger les relations necessaires pour eviter les requetes N+1.

### Critere de validation

Chaque chiffre du dashboard doit venir de la base et avoir une signification metier.

## Priorite 6 - Module inventaire

Objectif: faire de l'inventaire un vrai module central.

### A ajouter

- Page admin `Inventaire`.
- Liste des produits avec:
  - stock actuel;
  - statut: normal, faible, rupture;
  - derniere mise a jour;
  - lien vers historique.
- Page ou section `Mouvements de stock`.
- Filtres:
  - produit;
  - type de mouvement: initial, adjustment, sale;
  - date;
  - utilisateur.

### A ameliorer

- Ajouter une action dediee `Ajouter du stock`.
- Ajouter une action dediee `Corriger le stock`.
- Ne pas utiliser uniquement le formulaire edit produit pour gerer le stock.

### Critere de validation

Un admin doit pouvoir comprendre pourquoi un stock a change sans ouvrir la base de donnees.

## Priorite 7 - Validation metier

Objectif: eviter les donnees incompletes ou incoherentes.

### A corriger

- Validation conditionnelle dans `AdminProductController`:
  - champs obligatoires pour `meche_extension`;
  - champs obligatoires pour `produit_capillaire`.
- Verification que les relations existent:
  - `technique_pose_id`;
  - `effet_id`;
  - `nature_action_id`.
- Gestion claire des produits sans stock.
- Empecher les quantites negatives.
- Accepter `quantite = 0` lors d'une modification produit.

### Critere de validation

Un produit ne doit pas pouvoir etre cree dans un etat incomplet.

## Priorite 8 - Images produits

Objectif: rendre la vitrine credible.

### A ajouter

- Champ image sur les produits.
- Upload image admin.
- Image placeholder par defaut.
- Affichage image dans:
  - catalogue;
  - detail produit;
  - admin produits.

### Critere de validation

Deux produits differents ne doivent plus afficher systematiquement la meme image.

## Priorite 9 - Tests

Objectif: garder le projet stable pendant les corrections.

### Tests a ajouter

- Admin peut ajuster le stock et creer un mouvement `adjustment`.
- Commande impossible si stock insuffisant.
- Un visiteur ne peut pas creer un compte admin.
- Catalogue public accessible avec produits seedes.
- Dashboard admin accessible par admin seulement.
- Client ne peut pas acceder a l'admin.

### Critere de validation

Les parcours principaux doivent etre couverts avant publication GitHub.

## Priorite 10 - Documentation GitHub

Objectif: rendre le projet presentable.

### A ajouter dans README

- Contexte du projet.
- Fonctionnalites principales.
- Stack technique.
- Installation locale.
- Commandes utiles:
  - `composer install`;
  - `npm install`;
  - `php artisan migrate --seed`;
  - `npm run dev`;
  - `php artisan test`.
- Identifiants de demo:
  - admin: `admin@example.com` / `password`;
  - client: `client@example.com` / `password`.
- Captures d'ecran.
- Roadmap.
- Limites connues.

### Critere de validation

Une personne qui decouvre le repo doit comprendre le projet et pouvoir le lancer.

## Ordre de travail recommande

1. Nettoyer les boutons et liens non branches.
2. Refaire les cartes produits et le catalogue.
3. Refaire la page d'accueil.
4. Corriger le dashboard admin.
5. Completer le theme sombre admin.
6. Ajouter la page inventaire.
7. Renforcer les validations produit.
8. Ajouter les images produits.
9. Ajouter les tests manquants.
10. Rediger le README.

## Definition d'une version presentable GitHub

Le projet pourra etre considere presentable quand:

- `php artisan test` passe;
- `npm run build` passe;
- `php artisan migrate:fresh --seed` cree une demo exploitable;
- aucun bouton visible important ne mene vers `#`;
- le catalogue est lisible;
- l'admin est coherent en theme clair et sombre;
- le README explique clairement le contexte et les identifiants de demo.
