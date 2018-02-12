<?php
class TicketTypeDetail extends db{
	var $Type_idType;

	function insert($idZone){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO TicketTypeDetail VALUES ('".$this->Type_idType."','".$idZone."')";
		//echo $sql;
		if($this->results =mysqli_query($this->link , $sql)){
			//return true;
		}else{
			echo "Could nor insert data to the database";
			//return false;
		}
	}
		
	/*
	function update(){
		mysqli_query($this->link,"SET NAMES UTF8");
		$sql = "DELETE FROM TicketTypeDetail WHERE Type_idType='".$Type_idType."'";
		echo $sql;
		$this->results =mysqli_query($this->link , $sql);
		insert();
	}
	*/
	function delete($Type_idType){
		$sql="DELETE FROM TicketTypeDetail WHERE Type_idType='".$Type_idType."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			//return true;
		}else{
			echo "Could not update TicketTypeDetail".$this->Type_idType."\n";
			//return false;
		}
	}
}
?>