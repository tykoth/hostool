<?php
class UsersController extends AppController {
   var $name = 'Users';
   
   
   function login()
   {
   	$this->layout = 'login';
   }
}
?>