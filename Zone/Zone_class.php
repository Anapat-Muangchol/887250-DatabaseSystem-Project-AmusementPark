<?php
class Zone extends db{
	var $idZone;
	var $nameZone;

	function insert(){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO Zone VALUES
		                          ('".$this->idZone."','".$this->nameZone."')";
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
		$sql="UPDATE Zone SET idZone='".$this->idZone."',nameZone='".$this->nameZone."' WHERE idZone='".$this->idZone."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update Zone ".$this->idZone."\n";
			return false;
		}
	}
	function delete($idZone){
		$sql="DELETE FROM Zone WHERE idZone='".$idZone."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update Zone".$this->idZone."\n";
			return false;
		}
	}
}
?>