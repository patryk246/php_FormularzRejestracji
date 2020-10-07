<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class User {
const STATUS_USER = 1;
const STATUS_ADMIN = 2;
protected $userName;
private $password;
protected $fullName;
protected $email;
protected $date;
protected $status;

        function __construct($userName, $fullName, $email, $passwd ){
//implementacja konstruktora
$this->status=User::STATUS_USER;
$this->userName=$userName;
$this->fullName=$fullName;
$this->email=$email;
$this->password= $passwd;
$this->date=(new DateTime(date('Y-m-d')))->format("d-m-Y");
}
function show() {
echo $this->status;
echo "  ";
echo $this->userName;
echo "  ";
echo $this->fullName;
echo "  ";
echo $this->email;
echo "  ";
echo $this->password;
echo "  ";
echo $this->date;
echo "<br/>";

}
function set_user_name($name_user){
    $this->userName=$name_user;
}
function get_user_name(){
    return $this->userName;
}
static function checkForm() {
    $args = array(
 'userName' => ['filter' => FILTER_VALIDATE_REGEXP,
 'options' => ['regexp' => '/^[A-Za-z0-9]+$/']],
 'fullName' => ['filter' => FILTER_VALIDATE_REGEXP,
 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}+\s[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
 'passwd' => ['filter' => FILTER_VALIDATE_REGEXP,
 'options' => ['regexp' => '/^[A-Za-z0-9]+$/']],
 'email' => ['filter' => FILTER_VALIDATE_EMAIL]
 );
    $myinputs=  filter_input_array(INPUT_POST, $args);
    $validateError="";
foreach($myinputs as $key=>$val){
 if ($val===false or $val===NULL)
 {$validateError.=$key." ";}
 }
 if ($validateError===""){
 echo "<br>Dane poprawne";
 $usr = new User($myinputs['userName'], $myinputs['fullName'], $myinputs['email'], $myinputs['passwd']);
 return $usr;
 }
 else {
 echo "<br>Niepoprawnie dane: ".$validateError."<br>Rejestracja nie powiodła się";
 return NULL;
 }
    /*$error="";
    if(!$userName = filter_input(INPUT_POST, 'userName', FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[A-Za-z0-9]+$/'))))
		{
			$error.='Nazwa użytkownika jest nieprawidłowa! ';
		}
    if(!$passwd = filter_input(INPUT_POST, 'passwd'))
		{
			$error.='Wpisz hasło! ';
		}
    if(!$fullName = filter_input(INPUT_POST, 'fullName', FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}+\s[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/'))))
		{
			$error.='Imię i/lub nazwisko nieprawidłowe! ';
		}
     if(!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
		{
			$error.='Email jest nieprawidłowy! ';
		}
  
 if ($error===""){
 echo "<br>Dane poprawne";
 $usr = new User($userName, $fullName, $email, $passwd);
 $usr->show();
 $usr->save();
 $usr->getAllUsers();
 return $usr;
 }
 else {
 echo "<br>Nie poprawnie dane: ".$error;
 return NULL;
 }*/
}
function save(){
    $xml = simplexml_load_file('users.xml');
 //dodajemy nowy element user i tworzymy uchwyt do tego elementu:
 $xmlCopy=$xml->addChild("user");
 //do elementu dodajemy dziecko o określonej nazwie i treści
 $xmlCopy->addChild("username", $this->userName);
$xmlCopy->addChild("passwd", $this->password);
$xmlCopy->addChild("fullnamename", $this->fullName);
$xmlCopy->addChild("email", $this->email);
$xmlCopy->addChild("date", $this->date);
$xmlCopy->addChild("status", $this->status);
 $xml->asXML('users.xml'); 
}
static function getAllUsers(){
 $allUsers = simplexml_load_file('users.xml');
 echo "<br>Zarejestrowani użytkownicy:<br>";
 echo "<ul>";
 foreach ($allUsers as $user):
 $userName=$user->username;
 $date=$user->date;
 echo "<li>$userName, $date</li>";
 endforeach;
 echo "</ul>";

}
}
        ?>
    </body>
</html>
