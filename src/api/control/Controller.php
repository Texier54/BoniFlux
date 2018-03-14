<?php

	namespace boniflux\api\control;

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

	use Ramsey\Uuid\Uuid;



	class Controller {

		private $container;

		public function  __construct(\Slim\Container $c)
		{
			$this->container = $c;
		}

		public function stream($req, $resp, $args) {

			$stream = new \boniflux\common\models\Stream();
			$stream = $stream->limit(5)->where('etat', '=', 1)->get();

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = $stream;

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}


		public function getstream($req, $resp, $args) {

			$stream = new \boniflux\common\models\Stream();

			try {
			$stream = $stream->where('id', '=', $args['id'])->firstOrFail();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = $stream;

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}

		public function connexion($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$user = new \boniflux\common\models\User();

			try {
				$user = $user->where('email', '=', $parsedBody['email'])->firstOrFail();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			if(password_verify($parsedBody['password'], $user->password))
			{
				$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

				$resp= $resp->withStatus(201);

				$tab = ['member' => $user, 'token' => 'fzfzzffzzfzf'];

				$resp->getBody()->write(json_encode($tab));
				return $resp;
			}
			else
			{
				$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

				$resp= $resp->withStatus(404);

				$tab = ['message' => 'Mauvaise authentification'];

				$resp->getBody()->write(json_encode($tab));
				return $resp;
			}

		}

		public function inscription($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$inscription = new \boniflux\common\models\User();
			$inscription->nom = $parsedBody['nom'];
			$inscription->prenom = $parsedBody['prenom'];
			$inscription->pseudo = $parsedBody['pseudo'];
			$inscription->email = $parsedBody['email'];
			$inscription->password = password_hash($parsedBody['password'], PASSWORD_BCRYPT);

			try {
				$inscription->save();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			$resp= $resp->withStatus(201);

			$tab = $inscription;

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}

		public function getmessage($req, $resp, $args) {

			$messages = new \boniflux\common\models\Message();
			$messages = $messages->where('id_stream', '=', $args['id'])->limit(30)->get();

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = $messages;

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}


		public function postmessage($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$message = new \boniflux\common\models\Message();
			$message->id_user = $parsedBody['id_user'];
			$message->id_stream = $parsedBody['id_stream'];
			$message->texte = $parsedBody['message'];

			try {
				$message->save();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			$resp= $resp->withStatus(201);

			$tab = $messages;

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}


		public function getabonnements($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$abonnements = new \boniflux\common\models\Abonnement();
			$abonnements = $abonnements->where('id_abonne', '=', $args['id'])->get();


			$resp= $resp->withStatus(201);

			$tab = $abonnements;

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}

		public function postabonnement($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$abonnement = new \boniflux\common\models\Abonnement();
			$abonnement->id_abonne = $parsedBody['id_abonne'];
			$abonnement->id_streamer = $parsedBody['id_streamer'];

			try {
				$abonnement->save();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			$resp= $resp->withStatus(201);

			$tab = $messages;

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}

		public function delabonnement($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$abonnement = new \boniflux\common\models\Abonnement();
			$abonnement = $abonnement->where('id_streamer', '=', $parsedBody['id_streamer'])->where('id_abonne', '=', $parsedBody['id_abonne'])->firstOrFail();
			$abonnement->delete();

			try {
				$abonnement->save();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			$resp= $resp->withStatus(201);

			$tab = $abonnement;

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}


		public function getuser($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();

			$user = new \boniflux\common\models\User();
			$user = $user->where('id', '=', $args['id'])->firstOrFail();


			$resp= $resp->withStatus(201);

			$tab = $user;

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}


		public function postvideo($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();


			$resp= $resp->withStatus(201);



			$tab = $parsedBody['image'];

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}

		public function createStream($req, $resp, $args) {

			//LE PROXY (a enlever si pas sur les machines de l'iut)
			
			$opts = array('http' => array('proxy'=> 'tcp://www-cache.iutnc.univ-lorraine.fr:3128', 'request_fulluri'=> true));
			$context = stream_context_create($opts);

			//RECUPERATION DES DONNEES GPS
			$str = file_get_contents("http://ip-api.com/xml", NULL, $context);
			$xml = simplexml_load_string($str, 'SimpleXMLElement',LIBXML_NOCDATA);

			$parsedBody = $req->getParsedBody();

			//Creation du stream
			$createStream = new \boniflux\common\models\Stream();
			$createStream->nom = $parsedBody['nomStream'];
			$createStream->description = $parsedBody['descriptionStream'];
			//GESTION ETAT
			//1 = Créer
			//2 = Terminer
			//A voir pour d'autres codes d'état
			$createStream->etat = 1;
			//GESTION ETAT
			$createStream->latitude = $xml->lat;
			$createStream->longitude = $xml->lon;
			$createStream->id_user = $parsedBody['id_user'];

			//Enregistrement de la creation du stream
			try {
				$createStream->save();
			} catch(\Exception $e) {
				echo $e->getmessage();
			}

			if($parsedBody['urgence'] == true){
				//Récupération du dernier ID ajouter dans la table stream
				$stream = new \boniflux\common\models\Stream();
				$stream = $stream->select("id")
									->take(1)
									->orderBy("id", "DESC")
									->get();

				//Ajoute dans la table urgence le dernier stream
				//COMMENTAIRE : Peut poser problème si 2 stream sont ajouter en même temps. Il faut trouver quelque chose de plus propre
				$addUrgence = new \boniflux\common\models\Urgence();
				$addUrgence->nom = $parsedBody['nomStream'];
				$addUrgence->id_stream = substr($stream, 7, -2);

				//Enregistrement du stream dans le mode urgence
				try {
					$addUrgence->save();
				} catch(\Exception $e) {
					echo $e->getmessage();
				}
			}

			$resp= $resp->withStatus(201);

			//$tab = $messages;

			$resp->getBody()->write(json_encode($tab));
			return $resp;
		}

	}
