INSERT INTO auteur (id, prenom, nom, bio, naissance) VALUES
(1, 'Isaac', 'Asimov', 'Américain d\'origine russe', NULL),
(2, 'Franck', 'Herbert', '', NULL),
(3, 'George', 'Orwell', NULL, NULL),
(4, 'Katsuhiro', 'Otomo', NULL, NULL),
(5, 'Yukito', 'Kishiro', NULL, NULL);


wamp/bin/php/php_xxx

Variable système : PATH

COMPOSER 	https://getcomposer.org/download/
GIT
SYMFONY CLI 	https://symfony.com/download

 symfony new <nomDuDossier> --version="5.4.*" --webapp
 
// Configurer GIT
git config --global user.name <nomUtilisateur>
git config --global user.email <emailUtilisateur>


// Démarrer le serveur
symfony server:start -d

// 
composer install




ORM : Object Relational Mapping
Doctrine

// Créer la bdd
symfony console doctrine:database:create

// Créer une migration (en comparant les entités du projet et les tables de la bdd)
symfony console make:migration

// Exécuter les migrations (= mise à jour de la base de données)
symfony console doctrine:migrations:migrate
symfony console d:m:m


CRUD : Create Read Update Delete

// Pour installer un Certificat d'Autorité local
symfony server:ca:install


/////
    #[Route('/auteur/test', name: 'app_auteur_test')]
    public function test()
    {
        return $this->render("base.html.twig");
    }





// EXERCICE 1
1. Ajouter un contrôleur nommé Test
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
 Modifiez la route "/auteur" pour afficher un tableau contenant tous les auteurs dans une table
 avec une colonne id, nom, bio  (dans la colonne nom, vous affichez le prenom et nom concaténé)



null coalescent
$a = 5;

$b = $a ?? 0; test pour savoir si la valeur si a n'est pas nul il mettra $a dans $b sinon il metta 0

https://www.php.net/manual/fr/migration70.new-features.php
