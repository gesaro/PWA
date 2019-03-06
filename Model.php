<?php
	require 'Connection.php';


	class Model {
		protected $table;
		protected $cols;
		protected $connec;

		function __construct(){
			$this->connec=new Connection();
		}
		//Metodo que grega comillas a los Strings para la inserccion [juan,5,11.2,leon]-->["juan",5,11.2,"leon"]
		private function adddoublequotes($parameters){
			$array=[];
			for ($i=0;$i<count($parameters);$i++){
				if (is_string($parameters[$i])) {
					$var="\"".$parameters[$i]."\"";
					array_push($array,$var);
				}
				else {
					array_push($array,$parameters[$i]);
				}
			}
			return $array;

		}
		//Metodo que grega comillas a los Strings para la inserccion [nombre,juan,edad,5]-->[nombre,"juan",edad,5]
		private function adddoublequoteswhere($parameters){
			$array=[];
			for ($i=1;$i<count($parameters);$i+=2){
				array_push($array,$parameters[$i-1]);
				if (is_string($parameters[$i])) {
					$var="\"".$parameters[$i]."\"";
					array_push($array,$var);
				}
				else {
					array_push($array,$parameters[$i]);
				}
			}
			return $array;

		}
		//Agrega los datos del array a un String para hacer la consulta
		private function addwhere($cond){
			$and=false;
			$array=$this->adddoublequoteswhere($cond);
			$query=" where ";
			for ($i=0;$i<count($array); $i+=2) {
				if (!$and){
					$query.=" ".$array[$i]."=".$array[$i+1];
					$and=true;
				}
				else
					$query.=" and ".$array[$i]."=".$array[$i+1];
			}
			return $query;

		}

		protected function find(){
			try {
				$query="select ".implode(",",$this->cols)." from ".$this->table;
				$conn=$this->connec->connect();
				$response=$conn->query($query);
				$conn=$this->connec->disconnect();
				return $response;
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}
		}
		protected function findcond($cols,$cond){
			try {
				$query="select ".(count($cols)>0 ? implode(',',$cols):'*')." from ".$this->table;

				if (count($cond)>0){
					$query.=$this->addwhere($cond);
				}

				$conn=$this->connec->connect();
				$response=$conn->query($query);
				$conn=$this->connec->disconnect();
				return $response;
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}

		}

		protected function add($values){
			try {

				$array=$this->adddoublequotes($values);//Manda array para poner comillas a los que sean string

				$query="insert into ".$this->table." (".implode(",",$this->cols).") values (".implode(",",$array).")";
				$conn=$this->connec->connect();
				$conn->query($query);
				$conn=$this->connec->disconnect();
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}
		}
		protected function edit($cols,$cond){
			try {
				$comma=false;

				$query="update ".$this->table." set ";
				$array=$this->adddoublequoteswhere($cols);

				for ($i=0;$i<count($array); $i+=2) {
					if (!$comma){
						$query.=" ".$array[$i]."=".$array[$i+1];
						$comma=true;
					}
					else
						$query.=",".$array[$i]."=".$array[$i+1];
				}

				if (count($cond)>0){
					$query.=$this->addwhere($cond);
				}

				$conn=$this->connec->connect();
				$conn->query($query);
				$conn=$this->connec->disconnect();
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}
		}
		protected function remove($cond){
			try {
				$query="delete from ".$this->table;

				if (count($cond)>0){
					$query.=$this->addwhere($cond);
				}

				$conn=$this->connec->connect();
				$conn->query($query);
				$conn=$this->connec->disconnect();
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}		
		}
	}
?>