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
			$stream = $stream->limit(5)->get();

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

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);
				//password_hash($password, PASSWORD_DEFAULT);
			$tab = '$series';

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}

		public function getmessage($req, $resp, $args) {

			$messages = new \boniflux\common\models\Message();
			$messages = $messages->where('id_stream', '=', $args['id'])->limit(10)->get();

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = $messages;

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}


		public function postmessage($req, $resp, $args) {



		}

	}
