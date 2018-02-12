<?php
class db{
    private $host= "localhost";
    private $username="it57160033";
    private $password="fomfomza";
    private $dbname="it57160033_Project";
    public $link;
    public $results;

    function connect(){
        if($this->link=mysqli_connect($this->host,$this->username,$this->password,$this->dbname)){
            return ($this->link);
        }else{
            echo "Could not connect to the database!!!";
            return false;
        }
    }


    function query($sql){
        //echo $sql;
        mysqli_query($this->link,"set names utf8");
        if($this->results=mysqli_query($this->link,$sql)){
            return ($this->results);
        }else{
            echo "Could not query data from database";
            return false;
        }
    }

    function close(){
        mysqli_close($this->link);
    }
}

?>