<?php

class User{
    public function __construct(
        public string $email,
        public string $password1,
        public string $password2,
        public string $firstName,
        public string $lastName
    )
    {
    }

    public function verify(): bool
    {
        $isValid = true;

        if($this->email === '' || $this->firstName === '' || $this->lastName === ''){
            $isValid = false;
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $isValid = false;
        }

        if($this->password1 === '' || $this->password1 !== $this->password2){
            $isValid = false;
        }

        return $isValid;
    }

}