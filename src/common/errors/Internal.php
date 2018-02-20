<?php

	namespace lbs\common\errors;

	class Internal {

		public static function error($req, $resp, $args) {

			// ajoute ou remplace
			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$rs= $rs->withStatus(500);

			$temp = array("type" => "error", "error" => '500', "message" => "Erreur interne");
			
			$rs->getBody()->write(json_encode($temp));

			return $rs;

		}


}
