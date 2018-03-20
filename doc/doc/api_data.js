define({ "api": [
  {
    "type": "post",
    "url": "/desabonnement",
    "title": "Se désabonner",
    "group": "Abonnement",
    "name": "delabonnement",
    "version": "0.1.0",
    "description": "<p>Suppression d'une ressource de type abonnement</p>",
    "success": {
      "fields": {
        "Succès : 204": [
          {
            "group": "Succès : 204",
            "optional": false,
            "field": "NoContent",
            "description": "<p>Succès.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 404": [
          {
            "group": "Réponse : 404",
            "optional": false,
            "field": "NotFound",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 NotFound\n{\n  \"type\": \"error\",\n  \"error\" : 404,\n  \"message\" : \"streamer inexistant\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Abonnement"
  },
  {
    "type": "get",
    "url": "/abonnements/{id}",
    "title": "Obtenir la liste des abonnés d'un streamer",
    "group": "Abonnement",
    "name": "getabonnement",
    "version": "0.1.0",
    "description": "<p>Permet d'obtenir la liste des abonnés d'un streamer</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "OK",
            "description": "<p>ressource trouvée</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"object\",\n     abonnement : {\n         \"id\"  : \"2155\",\n         \"id_streamer\" : \"25\",\n         \"id_abonne\" : \"36\",\n     }\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id_abonne",
            "description": "<p>Id de l'abonné</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id_streamer",
            "description": "<p>Id du streamer</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (id)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Abonnement"
  },
  {
    "type": "post",
    "url": "/abonnement/",
    "title": "S'abonner à un streamer",
    "group": "Abonnement",
    "name": "postabonnement",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type abonnement : Permet de s'abonner à un streamer.</p>",
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "Created",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\nLocation: http://api.geoquizz.local/abonnements/\nContent-Type: application/json;charset=utf8",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 404": [
          {
            "group": "Réponse : 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Ressource introuvable</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 NotFound\n{\n  \"type\": \"error\",\n  \"error\" : 404,\n  \"message\" : \"NotFound\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Abonnement"
  },
  {
    "type": "post",
    "url": "/members/signin",
    "title": "Connexion d'un membre",
    "group": "Member",
    "name": "connexion",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type Membre Permet de se connecter en tant que membre.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>nom d'utilisateur du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>mot de passe du membre</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\n Location: http://api.boniflux/member/signin\n Content-Type: application/json;charset=utf8",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (password)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Member"
  },
  {
    "type": "post",
    "url": "/member/",
    "title": "S'inscrire en tant que membre",
    "group": "Member",
    "name": "inscription",
    "version": "0.1.0",
    "description": "<p>Création de la ressource Membre Permet de s'inscrire en tant que membre.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "prenom",
            "description": "<p>Prénom du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mail",
            "description": "<p>E-mail du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pseudo",
            "description": "<p>Pseudo du membre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Mot de passe haché du membre</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"object\",\n     membre : {\n         \"nom\"  : \"michel\",\n         \"prenom\" : \"Jean\",\n         \"mail\" : \"michel.jean@mail.com\",\n         \"pseudo\" : \"mimichel\",\n         \"password\" : \"sdifblei894966ssd\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (pseudo)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Member"
  },
  {
    "type": "get",
    "url": "/message/{id}",
    "title": "Obtenir un message",
    "group": "Message",
    "name": "getmessage",
    "version": "0.1.0",
    "description": "<p>Obtention d'un message provenant d'un stream Le message contiendra du texte.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Le texte du message</p>"
          }
        ],
        "request parameter": [
          {
            "group": "request parameter",
            "type": "id",
            "optional": false,
            "field": "stream",
            "description": "<p>Id du stream ou le message est présent</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressource trouvée.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"object\",\n     message : {\n         \"id\"  : \"552\",\n         \"texte\" : \"J'adore ce que tu fais continue !\",\n         \"id_stream\" : \"2\",\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (id)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Message"
  },
  {
    "type": "post",
    "url": "/message/{id}",
    "title": "Envoyer un message",
    "group": "Message",
    "name": "postmessage",
    "version": "0.1.0",
    "description": "<p>Création d'un message sur un stream Le message contiendra du texte.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "texte",
            "description": "<p>Le texte du message</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "Created",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\nLocation: http://api.geoquizz.local/message/\nContent-Type: application/json;charset=utf8",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (texte)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Message"
  },
  {
    "type": "post",
    "url": "/createStream/",
    "title": "Créer un Stream",
    "group": "Stream",
    "name": "createStream",
    "version": "0.1.0",
    "description": "<p>Création d'un ressource de type stream.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nomStream",
            "description": "<p>Nom du stream</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "descriptionStream",
            "description": "<p>Description du stream</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "etat",
            "description": "<p>Etat du stream, 1 = Créer, 2 = Terminer</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "latitude",
            "description": "<p>Latitude selon le streamer</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "longitude",
            "description": "<p>Longitude selon le streamer</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "Created",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\nLocation: http://api.geoquizz.local/createStream/\nContent-Type: application/json;charset=utf8",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (descriptionStream)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Stream"
  },
  {
    "type": "get",
    "url": "/stream/{id}",
    "title": "accéder à un stream",
    "group": "Stream",
    "name": "getStreamID",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type stream : permet d'accéder à la représentation de la ressource stream désignée. Retourne une représentation json de la ressource.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant du stream</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressource trouvée</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"object\",\n     stream : {\n         \"id\"  : 1 ,\n         \"nom\" : \"la foret\",\n         \"description\" : \"collecte de champignons\",\n         \"latitude\" : \"2.41112\",\n         \"longitude\" : \"20.65412\",\n         \"created_at\" : \"2018-03-15 14:00:00\",\n         \"updated_at\" : \"2018-03-15 15:05:00\",\n         \"deleted_at\" : \"2018-06-15 20:00:00\",\n         \"id_user\" : \"2\",\n         \"id_urgence\" : \"1\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Pas de série dans la base de données.</p>"
          }
        ],
        "Erreur : 400": [
          {
            "group": "Erreur : 400",
            "optional": false,
            "field": "MissingParameters",
            "description": "<p>Donnéees manquante (id)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error',\n  \"error\" : 404,\n  \"message\" : Ressource non disponible : /stream/2\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Stream"
  },
  {
    "type": "post",
    "url": "/postvideo/",
    "title": "Envoyer une video",
    "group": "Stream",
    "name": "postvideo",
    "version": "0.1.0",
    "description": "<p>Envoi d'une video.</p>",
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "Created",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\nLocation: http://api.geoquizz.local/postvideo/\nContent-Type: application/json;charset=utf8",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (texte)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Stream"
  },
  {
    "type": "get",
    "url": "/stream",
    "title": "accéder à tous les streams",
    "group": "Stream",
    "name": "stream",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type stream : permet d'accéder à la représentation des ressources stream. Retourne une représentation json des ressources.</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"collection\",\n     stream : {\n         \"id\"  : 1 ,\n         \"nom\" : \"la foret\",\n         \"description\" : \"collecte de champignons\",\n         \"latitude\" : \"2.41112\",\n         \"longitude\" : \"20.65412\",\n         \"created_at\" : \"2018-03-15 14:00:00\",\n         \"updated_at\" : \"2018-03-15 15:05:00\",\n         \"deleted_at\" : \"2018-06-15 20:00:00\",\n         \"id_user\" : \"2\",\n         \"id_urgence\" : \"1\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Pas de stream dans la base de données.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error',\n  \"error\" : 404,\n  \"message\" : Ressource non disponible : /streams/\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Stream"
  },
  {
    "type": "get",
    "url": "/user/{id}",
    "title": "Obtenir les informations sur un utilisateur",
    "group": "User",
    "name": "getuser",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type user : ressource comportant un id, nom, prenom, pseudo, email, password ...</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressource trouvée</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"object\",\n   \tuser : {\n         \"id\"  : \"10\",\n         \"nom\" : \"jean\",\n         \"prenom\" : \"pierre\",\n         \"pseudo\" : \"J-P\",\n         \"mail\" : \"jean@pierre.fr\",\n         \"password\" : \"rssdfbsfdjbkbjsd\",\n         \"created_at\" : \"2018-05-02 10:20:53\"\n         \"updated_at\" : \"2018-25-02 11:21:27\"\n         \"deleted_at\" : \"2018-09-03 20:10:21\"\n   \t}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Ressource inconnue.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "User"
  }
] });
