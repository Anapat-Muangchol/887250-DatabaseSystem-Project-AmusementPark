<?php
class TicketDetail extends db{
	var $Ticket_ID;
	var $orderDate;
	var $receiveDate;
	var $totalPrice;
	var $totalTicket;
	var $Customer_idCustomer1;

	function insert(){
		mysqli_query($this->link,"set names utf8");
		$sql = "INSERT INTO TicketDetail VALUES
		                          ('".$this->Ticket_ID."','".$this->orderDate."','".$this->receiveDate."','".$this->totalPrice."','".$this->totalTicket."','".$this->Customer_idCustomer1."')";
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
		$sql="UPDATE TicketDetail SET Ticket_ID='".$this->Ticket_ID."',orderDate='".$this->orderDate."',"."reciveDate='".$this->receiveDate."',"."totalPrice='".$this->totalPrice."',"."totalTicket='".$this->totalTicket."',"."Customer_idCustomer1='".$this->Customer_idCustomer1."' WHERE Ticket_ID='".$this->Ticket_ID."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update TicketDetail ".$this->Ticket_ID."\n";
			return false;
		}
	}
	function update2($totalPrice,$totalTicket){
		mysqli_query($this->link,"SET NAMES UTF8");
		$sql="UPDATE TicketDetail SET totalPrice='".$totalPrice."',"."totalTicket='".$totalTicket."' WHERE Ticket_ID='".$this->Ticket_ID."'";
		//echo $sql;
		if($this->results = mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update TicketDetail ".$this->Ticket_ID."\n";
			return false;
		}
	}
	function delete($Ticket_ID){
		$sql="DELETE FROM TicketDetail WHERE Ticket_ID='".$Ticket_ID."'";
		//echo $sql;
		if($this->results=mysqli_query($this->link,$sql)){
			return true;
		}else{
			echo "Could not update TicketDetail".$this->Ticket_ID."\n";
			return false;
		}
	}
}
?>