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

			$series = new serie();
			$series = $series->get();

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = $series;

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}

		public function connexion($req, $resp, $args) {

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = ['member' => 'zfzf', 'token' => 'fzfzzffzzfzf'];

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}

		public function inscription($req, $resp, $args) {

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = '$series';

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}

		public function getmessage($req, $resp, $args) {

			$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$resp= $resp->withStatus(201);

			$tab = ['test', 'test'];

			$resp->getBody()->write(json_encode($tab));
			return $resp;

		}


		public function postmessage($req, $resp, $args) {



		}

	}
