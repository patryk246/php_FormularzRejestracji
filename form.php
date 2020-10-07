<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     
        <title>Index</title>
    </head>
    <body>
        <form action="form.php" method="POST">
            <h1>Formularz rejestracji:</h1>
            <table>
                <tr><td>Nazwa użytkownika: </td><td><input type="text" name="userName"></td></tr>
                <tr><td>Hasło: </td><td><input type="password" name="passwd"></td></tr>
                <tr><td>Nazwisko i imię: </td><td><input type="text" name="fullName"></td></tr>
                <tr><td>Email: </td><td><input type="email" name="email"></td></tr>
            </table>
            <input type="submit" name="rejestruj" value="Rejestruj">
            <input type="reset" name="anuluj" value="Anuluj">
        </form>
        
    </body>

<?php
include_once 'index.php';
    if(filter_input(INPUT_POST, "rejestruj")) { 
        $usr=User::checkForm();
        if($usr!=NULL){
             //$usr->show();
             $usr->save();
             $usr->getAllUsers();
        }
    }
?>