<?php
	require 'Connection.php';


	class Model {
		protected $table;
		protected $cols;
		protected $connec;

		function __construct(){
			$this->connec=new Connection();
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
		protected function add(...$parameters){
			try {
				$cont=0;
				$array[]=1;
				while ($cont<count($parameters)) {
					if (is_string($parameters[$cont])) {
						$var="\"".$parameters[$cont]."\"";
						array_push($array,$var);
					}
					else {
						array_push($array,$parameters[$cont]);
					}
					$cont+=1;
				}
				array_shift($array);
				$query="insert into ".$this->table." (".implode(",",$this->cols).") values (".implode(",",$array).")";
				$conn=$this->connec->connect();
				$conn->query($query);
				$conn=$this->connec->disconnect();
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}
		}
		protected function edit($columnSet,$new,$columnWhere,$id){
			try {
				if (is_string($new)) {
						$new="\"".$new."\"";
				}
				if (is_string($id)) {
						$id="\"".$id."\"";
				}
				$query="update ".$this->table." set ".$columnSet."=".$new." where ".$columnWhere."=".$id;
				$conn=$this->connec->connect();
				$conn->query($query);
				$conn=$this->connec->disconnect();
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}
		}
		protected function remove($column,$id){
			try {
				if (is_string($id)) {
						$id="\"".$id."\"";
				}
				$query="delete from ".$this->table." where ".$column."= ".$id;
				$conn=$this->connec->connect();
				$conn->query($query);
				$conn=$this->connec->disconnect();
			} catch (Exception $e) {
				echo 'Ocurrio un error';
			}		
		}
	}
?>