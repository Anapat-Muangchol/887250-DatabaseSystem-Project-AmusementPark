<?php
class customer extends db{
	var $idCustomer;
	var $nameCustomer;
	var $telCustomer;

	function insert(){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO Customer VALUES
		                          ('".$this->idCustomer."','".$this->nameCustomer."','".$this->telCustomer."')";
		//echo $sql;
		if($this->results =mysqli_query($this->link , $sql)){
			return true;
		}else{
			echo "Could nor insert data to the database";
			return false;
		}
	}
	function update($PK){
		mysqli_query($this->link,"SET NAMES UTF8");
		$sql="UPDATE Customer SET idCustomer='".$this->idCustomer."',nameCustomer='".$this->nameCustomer."',"."telCustomer='".$this->telCustomer."' WHERE idCustomer='".$PK."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update customer ".$this->idCustomer."\n";
			return false;
		}
	}
	function delete($idCustomer){
		$sql="DELETE FROM Customer WHERE idCustomer='".$idCustomer."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update customer".$this->idCustomer."\n";
			return false;
		}
	}
}
?>