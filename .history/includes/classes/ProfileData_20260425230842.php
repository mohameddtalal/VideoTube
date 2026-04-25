<?php
class ProfileData{

private $con,$profileUsername;
public function __construct($con,$userLoggedInObj,$profileUsername)
{
$this->con=$con;
$this->userLoggedInObj=$userLoggedInObj;
$this->profileUsername=$profileUsername;
}
}


?>