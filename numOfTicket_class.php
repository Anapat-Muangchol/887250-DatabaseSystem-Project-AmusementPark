<?php
class numOfTicket extends db{
	var $TicketType_idType;
	var $TicketDetail_Ticket_ID;
	var $numOfTicket;

	function insert(){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO numOfTicket VALUES
		                          ('".$this->TicketType_idType."','".$this->TicketDetail_Ticket_ID."',".$this->numOfTicket.")";
		//echo $sql."<br>";
		if($this->results =mysqli_query($this->link , $sql)){
			return true;
		}else{
			echo "Could nor insert data to the database";
			return false;
		}
	}
	function update(){
		mysqli_query($this->link,"SET NAMES UTF8");
		$sql="UPDATE numOfTicket SET TicketType_idType='".$this->TicketType_idType."',TicketDetail_Ticket_ID='".$this->TicketDetail_Ticket_ID."',"."numOfTicket='".$this->numOfTicket."' WHERE TicketDetail_Ticket_ID='".$this->TicketDetail_Ticket_ID."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update numOfTicket ".$this->TicketDetail_Ticket_ID."\n";
			return false;
		}
	}
	function delete($TicketDetail_Ticket_ID){
		$sql="DELETE FROM numOfTicket WHERE TicketDetail_Ticket_ID='".$TicketDetail_Ticket_ID."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update numOfTicket".$this->TicketType_idType."\n";
			return false;
		}
	}
}
?>