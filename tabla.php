<?php
	require 'Model.php';


	class --tabla-- extends Model {
		function __construct() {
			parent::__construct();
			$this->table='--tabla--';
			$this->cols=[--cols--];
		}
		public function find(){
			return parent::find();
		}
		public function findcond($cols,$cond){
			return parent::findcond($cols,$cond);
		}
		public function add($values){
			parent::add($values);
		}
		public function edit($cols,$cond){
			parent::edit($cols,$cond);
		}
		public function remove($cond){
			parent::remove($cond);
		}
	}