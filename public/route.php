<?php

	class Route {

		private $uri = array();
		private $method = array();

		// Creates a list of searchable URls
		public function add($uri, $method=NULL) {

			$this->uri[] = "/" . trim($uri, "/");

			if ($method != NULL) {
				$this->method[] = $method;
			}

		}

		// Loads the class of the matched URI or uses 404 class if no match
		public function submit() {

			$getURIParameters = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
			$match = 0;
			foreach ($this->uri as $key => $value) {
				if (preg_match("#^$value$#", $getURIParameters)) {
					$useMethod = $this->method[$key];
					new $useMethod();
					$match = 1;
					break;
				}
			}
			if ($match !== 1) {
				new NotFound();
			}

		}

	}

?>