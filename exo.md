// EXERCICE POUR MERCREDI
1. Ajoutez l'''entité livre (cf. schéma) et mettre à jour la bdd
2. Ajouter une route pour afficher tous les livres et un route pour afficher
 	un livre selon son identifiant dans un nouveau contrôleur Livre.

3. pour remplir la table livre :
INSERT INTO livre (id, titre, resume) VALUES
(1, '1984', 'Un monde dystopique où tout le monde est surveillé par Big Brother et où les enfants dénoncent leurs parents'),
(4, 'Akira', 'Une bande de motards dans la ville de Neo-Tokyo en 2010'),
(5, 'Fondation et Empire', 'suite de Fondation'),
(6, 'Gunnm', 'Manga futuriste'),
(7, 'I, robot', 'Des robots se fondent dans la masse...'),
(8, 'Le Messie de Dune', 'Le héros de Dune prend un rôle plus mystique'),
(9, 'un livre', 'ecrit par quelqu\'un'),
(10, 'Développez en JAVA', 'Devenez expert en programmation JAVA'),
(11, 'La ferme des animaux', 'Satire politique se passant dans une ferme'),
(12, 'Fondation', 'L\'histoire de la psycho-histoire');







// EXERCICE 1
1. Ajouter un contrôleur nommé Test
symfony console make:controller


2. Dans ce controleur ajoutez une route pour le chemin
	/test/nombres-au-carre
    
    Cette route doit afficher tous les nombres de 1 à 100 suivi de la valeur de leur carré dans une <table> (utilisez un fichier nommé test/carre.html.twig)
    
    ex:
    
    ╔════════╦══════════╗
    ║ Nombre ║ Carré   ║
    ╠════════╬══════════╣
    ║    1  ║    1    ║
    ║    2  ║    4    ║
    ║    3  ║    9    ║
        ... ║
    ║  100  ║   10000  ║
    
    
    
 // EXERCICE 2
 Modifiez l''affichage pour la route "/auteur" pour afficher un tableau contenant tous les auteurs dans une table
 avec une colonne id, nom, bio  (dans la colonne nom, vous affichez le prenom et nom concaténé)