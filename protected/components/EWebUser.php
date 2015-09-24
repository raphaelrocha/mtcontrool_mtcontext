<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EWebUser extends CWebUser{
 
    protected $_model;
 
    function isAdmin(){
        $user = $this->loadUser();
        if ($user){
           return $user->level==ManageLevel::ADMIN;
        }else{
        return false;
        }
    }
    
    function isTester(){
        $user = $this->loadUser();
        if ($user){
           return $user->level==ManageLevel::TESTER;
        }else{
        return false;
        }
    }
 
    // Load user model.
    protected function loadUser()
    {
        if ( $this->_model === null ) {
                $this->_model = Users::model()->findByPk( $this->id );
                
        }
        return $this->_model;
    }
}