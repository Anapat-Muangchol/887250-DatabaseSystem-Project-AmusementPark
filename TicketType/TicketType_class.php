<?php
class TicketType extends db{
	var $idType;
	var $nameType;
	var $priceType;

	function insert(){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO TicketType VALUES
		                          ('".$this->idType."','".$this->nameType."','".$this->priceType."')";
		//echo $sql;
		if($this->results =mysqli_query($this->link , $sql)){
			return true;
		}else{
			echo "Could nor insert data to the database";
			return false;
		}
	}
	function update(){
		mysqli_query($this->link,"SET NAMES UTF8");
		$sql="UPDATE TicketType SET idType='".$this->idType."',nameType='".$this->nameType."',"."priceType='".$this->priceType."' WHERE idType='".$this->idType."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update TicketType ".$this->idType."\n";
			return false;
		}
	}
	function delete($idType){
		$sql="DELETE FROM TicketType WHERE idType='".$idType."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update TicketType".$this->idType."\n";
			return false;
		}
	}
}
?>