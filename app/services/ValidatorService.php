<?php

class ValidatorService{
    
    public static function validate_user($user_info){
        $emailRegex="[A-z0-9\._]+@[A-z]+\.[A-z]+";

        $emailTest=Validator::make(
          ['email'=>$user_info['email']],
          ['email'=>['required','min:5','email']]//,'pattern:'.$emailRegex]]
        );

        $uniqueEmail=Validator::make(
            ['email'=>$user_info['email']],
            ['email'=>['unique:tblclients,email']]
        );

        $firstnameTest=Validator::make(

            ['firstname'=>$user_info['firstname']],
            ['firstname'=>['required','min:2']]

        );

        $passwordTest=Validator::make(

            ['password'=>$user_info['password']],
            ['password'=>['required','min:5']]

        );

        $invalid_error=[];
        $invalid_error['status']=true;

        if($emailTest->fails()){
            $invalid_error['email']=['Email is invalid',"Email must contain at least 5 characters","Email must be in example@domain.com format"];
            $invalid_error['status']=false;
        }

        if($uniqueEmail->fails()){
            $invalid_error['unique_email']='Sorry Email is unavailable';
        }

        if($firstnameTest->fails()){
            $invalid_error['firstname']=["Firstname is required","Firstname must be 2 characters"];
            $invalid_error['status']=false;
        }

        if($passwordTest->fails()){
            $invalid_error['password']=['Password invalid','Password must be atleast 5 characters long'];
            $invalid_error['status']=false;
        }
        return $invalid_error;
    }
}