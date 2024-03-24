# CERIcar - Projet de Développement Web

Ce repository contient le projet CERIcar, développé dans le cadre de l'UE de programmation web. L'objectif de ce projet est de créer une application web de covoiturage, mettant en œuvre les concepts de programmation web ainsi que l'architecture MVC (Modèle Vue Contrôleur) et l'utilisation de technologies telles que HTML, PHP, JavaScript, AJAX, Doctrine, etc.

---

## Description du Projet :

CERIcar est une application de covoiturage qui permet aux utilisateurs de proposer des voyages sur des trajets prédéfinis, avec des contraintes telles que le tarif, le nombre de places disponibles, etc. Les conducteurs doivent créer un profil et se connecter pour proposer des voyages, tandis que les voyageurs peuvent consulter l'application pour trouver des trajets qui leur conviennent et réserver leur place.

---

## Contenu du Repository :

1. **Étape 1 : Prise en Main**
   - Fichiers de base du projet avec une architecture MVC simplifiée.
   - Déploiement de l'application.
   - Implémentation d'une action de test.
   - Ajout d'un bandeau de notification dans le layout.

2. **Étape 2 : Modèle de Données et Doctrine**
   - Implémentation des classes entités : utilisateur, trajet, voyage, réservation.
   - Développement des classes fonctionnelles : utilisateurTable, trajetTable, voyageTable, réservationTable.
   - Intégration de Doctrine pour la gestion des entités et des relations.

3. **Étape 3 : Rechercher un Voyage**
   - Développement de la vue et du contrôleur pour la recherche de voyages directs.
   - Mise en place du layout et des vues dynamiques.
   - Utilisation de PHP pour afficher les données dans les vues.

4. **Étape 4 : Intégration d'Ajax**
   - Mise en place de requêtes Ajax pour les actions liées au modèle et à l'affichage.
   - Utilisation de jQuery pour les requêtes Ajax côté client.
   - Mise à jour du layout et des vues de manière partielle via Ajax.

5. **Étape 5 : Contraintes Trajets**
   - Utilisation de PL/pgSQL pour récupérer les correspondances de voyages.
   - Écriture et appel de fonctions PL/SQL depuis le modèle PHP.
   - Gestion des correspondances et des trajets multiples dans la recherche de voyages.

6. **Étape 6 : Réservation d'un Voyage**
   - Développement des modules d'inscription et de connexion.
   - Implémentation du module de réservation de voyages.
   - Gestion des réservations et mise à jour des places disponibles.

7. **Étape 7 : Proposer un Voyage**
   - Création du module de proposition de voyages pour les conducteurs.
   - Spécification des détails du voyage : trajet, heure de départ, tarif, contraintes, etc.

---

**Note :** Ce README fournit une vue d'ensemble du projet CERIcar. Pour des détails spécifiques sur chaque étape du projet, veuillez vous référer à la documentation fournie dans les dossiers correspondants.

**Pour toute question ou assistance supplémentaire, n'hésitez pas à me contacter.**

**Auteur : Mejai Wajdi**
