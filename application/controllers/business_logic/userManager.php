<?php

include_once "userInfo.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userManager
 *
 * @author Demid
 */
class UserManager {
   function connectDb() {
        
        mysql_connect("localhost", "root", "");
        mysql_select_db("ishop");
        mysql_set_charset("utf8");
    }
    
    function disconnectDb() {
        
        mysql_close();
    }
    
    public function addUser(UserInfo $userInfo){
        $userQuery="INSERT INTO users
            (address, fio, username, password, isAdmin, email) 
            VALUES( (\"$userInfo->address\",
                $userInfo->fio,
                $userInfo->username,
                $userInfo->password,
                $userInfo->isAdmin,
                $userInfo->email\")";
        $this->connectDb();
        mysql_query($userQuery);
        $uid=mysql_insert_id();
        $this->disconnectDb();
        return $uid;
    }
    
    public function checkLogin($login, $password ){
        $result=new UserInfo();
        $getUserInfoQuery=  "SELECT id, address, fio, isAdmin, email 
                            FROM users 
                            WHERE login=\"$login\" AND password=\"$password\"";
        $this->connectDb();
        $queryResults=mysql_query($getUserInfoQuery);
        $row=mysql_fetch_row($queryResults);
        if ($row != FALSE){
            $result->uid=$row[0];
            $result->address=$row[1];
            $result->fio=$row[2];
            $result->login=$login;
            $result->password=$password;
            $result->isAdmin=$row[3];
            $result->email=$row[4];
        }
         else {
             $result=null;
        }        
        $this->disconnectDb();
        return $result;        
    }
}

?>
