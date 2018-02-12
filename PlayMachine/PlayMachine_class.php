<?php
class PlayMachine extends db{
	var $idPlayMachine;
	var $namePlayMachinecol;
	var $Zone_idZone;
	var $detail;
	var $engineer;
	var $supplier;

	function insert(){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO PlayMachine VALUES
		                          ('".$this->idPlayMachine."','".$this->namePlayMachinecol."','".$this->Zone_idZone."','".$this->detail."','".$this->engineer."','".$this->supplier."')";
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
		$sql="UPDATE PlayMachine SET idPlayMachine='".$this->idPlayMachine."',namePlayMachinecol='".$this->namePlayMachinecol."',"."Zone_idZone='".$this->Zone_idZone."',"."detail='".$this->detail."',"."engineer='".$this->engineer."',"."supplier='".$this->supplier."' WHERE idPlayMachine='".$PK."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update PlayMachine ".$this->idPlayMachine."\n";
			return false;
		}
	}
	function delete($idPlayMachine){
		$sql="DELETE FROM PlayMachine WHERE idPlayMachine='".$idPlayMachine."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update PlayMachine".$this->idPlayMachine."\n";
			return false;
		}
	}
}
?>