<?php

/**
 * File:  rest.php
 * Creation Date: 20/02/2018
 * description:Boniflux Documentation   
 *
 * @author: jordan
 */

/**
 * @api {get} /stream  accéder à tous les streams
 * @apiGroup Stream
 * @apiName stream
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources de type stream :
 * permet d'accéder à la représentation des ressources stream.
 * Retourne une représentation json des ressources.
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection",
 *          stream : {
 *              "id"  : 1 ,
 *              "nom" : "la foret",
 *              "description" : "collecte de champignons",
 *              "latitude" : "2.41112",
 *              "longitude" : "20.65412",
 *              "created_at" : "2018-03-15 14:00:00",
 *              "updated_at" : "2018-03-15 15:05:00",
 *              "deleted_at" : "2018-06-15 20:00:00",
 *              "id_user" : "2",
 *              "id_urgence" : "1"
 *          }
 *     }
 * 
 * @apiError (Erreur : 404) NotFound Pas de stream dans la base de données.
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error',
 *       "error" : 404,
 *       "message" : Ressource non disponible : /streams/"
 *     }
 */

$app->get('/streams[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->stream($req, $resp, $args);
    }
);

/**
 * @api {get} /stream/{id}  accéder à un stream
 * @apiGroup Stream
 * @apiName getStreamID
 * @apiVersion 0.1.0
 *
 * @apiDescription Accès à une ressource de type stream :
 * permet d'accéder à la représentation de la ressource stream désignée.
 * Retourne une représentation json de la ressource.
 *
 * @apiParam {Number} id Identifiant du stream
 * 
 * @apisuccess (Succès : 200) OK Ressource trouvée
 * 
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "object",
 *          stream : {
 *              "id"  : 1 ,
 *              "nom" : "la foret",
 *              "description" : "collecte de champignons",
 *              "latitude" : "2.41112",
 *              "longitude" : "20.65412",
 *              "created_at" : "2018-03-15 14:00:00",
 *              "updated_at" : "2018-03-15 15:05:00",
 *              "deleted_at" : "2018-06-15 20:00:00",
 *              "id_user" : "2",
 *              "id_urgence" : "1"
 *          }
 *     }
 *
 * @apiError (Erreur : 404) NotFound Pas de série dans la base de données.
 * @apiError (Erreur : 400) MissingParameters Donnéees manquante (id)
 * 
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error',
 *       "error" : 404,
 *       "message" : Ressource non disponible : /stream/2"
 *     }
 */

$app->get('/stream/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getstream($req, $resp, $args);
    }
);



/**
 * @api {post} /member/ S'inscrire en tant que membre
 * @apiGroup Member
 * @apiName inscription
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création de la ressource Membre
 * Permet de s'inscrire en tant que membre.
 *
 * @apiParam {String} nom Nom du membre
 * @apiParam {String} prenom Prénom du membre
 * @apiParam {String} mail E-mail du membre
 * @apiParam {String} pseudo Pseudo du membre
 * @apiParam {String} password Mot de passe haché du membre
 * 
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "object",
 *          membre : {
 *              "nom"  : "michel",
 *              "prenom" : "Jean",
 *              "mail" : "michel.jean@mail.com",
 *              "pseudo" : "mimichel",
 *              "password" : "sdifblei894966ssd"
 *          }
 *     }
 * 
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 * 
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (pseudo)"
 *     }
 */

$app->post('/members[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->inscription($req, $resp, $args);
    }
);



/**
 * @api {post} /members/signin  Connexion d'un membre
 * @apiGroup Member
 * @apiName connexion
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type Membre
 * Permet de se connecter en tant que membre.
 * 
 * @apiParam {String} user nom d'utilisateur du membre
 * @apiParam {String} password mot de passe du membre
 * 
 * 
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *      Location: http://api.boniflux/member/signin
 *      Content-Type: application/json;charset=utf8
 *
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (password)"
 *     }
 */

$app->post('/members/signin[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->connexion($req, $resp, $args);
    }
);



/**
 * @api {get} /message/{id}  Obtenir un message
 * @apiGroup Message
 * @apiName getmessage
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Obtention d'un message provenant d'un stream
 * Le message contiendra du texte.
 *
 * @apiParam {Number} id Le texte du message
 * 
 * @apiParam (request parameter) {id}stream Id du stream ou le message est présent
 * 
 * @apiSuccess (Réponse : 200) {json} OK Ressource trouvée.
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "object",
 *          message : {
 *              "id"  : "552",
 *              "texte" : "J'adore ce que tu fais continue !",
 *              "id_stream" : "2",
 *          }
 *     }
 *
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (id)"
 *     }
 */

$app->get('/messages/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getmessage($req, $resp, $args);
    }
);



/**
 * @api {post} /message/{id}  Envoyer un message
 * @apiGroup Message
 * @apiName postmessage
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'un message sur un stream
 * Le message contiendra du texte.
 *
 * @apiParam {String} texte Le texte du message
 * 
 * @apiSuccess (Réponse : 201) {json} Created
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *     Location: http://api.geoquizz.local/message/
 *     Content-Type: application/json;charset=utf8
 *
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (texte)"
 *     }
 */

$app->post('/messages/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->postmessage($req, $resp, $args);
    }
);


/**
 * @api {get} /abonnements/{id}  Obtenir la liste des abonnés d'un streamer
 * @apiGroup Abonnement
 * @apiName getabonnement
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Permet d'obtenir la liste des abonnés d'un streamer
 *
 *
 * @apiSuccess (Réponse : 200) {json} OK ressource trouvée
 * 
 * @apiParam {Number} id_abonne Id de l'abonné
 * @apiParam {Number} id_streamer Id du streamer
 * 
 * @apiSuccess (Réponse : 200) {json} OK Ressource trouvée.
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "object",
 *          abonnement : {
 *              "id"  : "2155",
 *              "id_streamer" : "25",
 *              "id_abonne" : "36",
 *          }
 *     }
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (id)"
 *     }
 */

$app->get('/abonnements/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getabonnements($req, $resp, $args);
    }
);

/**
 * @api {post} /abonnement/ S'abonner à un streamer
 * @apiGroup Abonnement
 * @apiName postabonnement
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type abonnement :
 * Permet de s'abonner à un streamer.
 *
 * @apiSuccess (Réponse : 201) {json} Created
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *     Location: http://api.geoquizz.local/abonnements/
 *     Content-Type: application/json;charset=utf8
 *
 *
 * @apiError (Réponse : 404) NotFound Ressource introuvable
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 NotFound
 *     {
 *       "type": "error",
 *       "error" : 404,
 *       "message" : "NotFound"
 *     }
 */

$app->post('/abonnement[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->postabonnement($req, $resp, $args);
    }
);

/**
 * @api {post} /desabonnement  Se désabonner
 * @apiGroup Abonnement
 * @apiName delabonnement
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Suppression d'une ressource de type abonnement
 * 
 * @apiSuccess(Succès : 204) NoContent Succès.
 * 
 *
 * @apiError (Réponse : 404) NotFound
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 NotFound
 *     {
 *       "type": "error",
 *       "error" : 404,
 *       "message" : "streamer inexistant"
 *     }
 */

$app->post('/desabonnement[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->delabonnement($req, $resp, $args);
    }
);


/**
 * @api {get} /user/{id} Obtenir les informations sur un utilisateur
 * @apiGroup User
 * @apiName getuser
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type user : ressource comportant
 * un id, nom, prenom, pseudo, email, password ...
 *
 *
 * @apiSuccess (Succès : 200) OK Ressource trouvée
 * 
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "object",
 *        	user : {
 *              "id"  : "10",
 *              "nom" : "jean",
 *              "prenom" : "pierre",
 *              "pseudo" : "J-P",
 *              "mail" : "jean@pierre.fr",
 *              "password" : "rssdfbsfdjbkbjsd",
 *              "created_at" : "2018-05-02 10:20:53"
 *              "updated_at" : "2018-25-02 11:21:27"
 *              "deleted_at" : "2018-09-03 20:10:21"
 *        	}
 *     }
 *
 * @apiError (Erreur : 404) NotFound Ressource inconnue.
 * 
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible."
 *     }
 */

$app->get('/user/{id}[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getuser($req, $resp, $args);
    }
);




/**
 * @api {post} /postvideo/  Envoyer une video
 * @apiGroup Stream
 * @apiName postvideo
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Envoi d'une video.
 * 
 * @apiSuccess (Réponse : 201) {json} Created
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *     Location: http://api.geoquizz.local/postvideo/
 *     Content-Type: application/json;charset=utf8
 *
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (texte)"
 *     }
 */


$app->post('/postvideo[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->postvideo($req, $resp, $args);
    }
);



/**
 * @api {post} /createStream/  Créer un Stream
 * @apiGroup Stream
 * @apiName createStream
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'un ressource de type stream.
 * 
 * @apiParam {String} nomStream Nom du stream
 * @apiParam {String} descriptionStream Description du stream
 * @apiParam {Number} etat Etat du stream, 1 = Créer, 2 = Terminer
 * @apiParam {Number} latitude Latitude selon le streamer
 * @apiParam {Number} longitude Longitude selon le streamer
 * 
 * @apiSuccess (Réponse : 201) {json} Created
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *     Location: http://api.geoquizz.local/createStream/
 *     Content-Type: application/json;charset=utf8
 *
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (descriptionStream)"
 *     }
 */

$app->post('/createStream[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->createStream($req, $resp, $args);
    }
);

