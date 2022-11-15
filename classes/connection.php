<?php

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=filmographia;host=127.0.0.1', 'root', 'root');
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO users (email,password, first_name, last_name)
                    VALUES (:email, :password, :first_name, :last_name)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'email' => $user->email,
            'password' => md5($user->password1 . 'SALT'),
            'first_name' =>$user->firstName,
            'last_name' => $user->lastName,
        ]);

        $this->pdo->execute($statement);
    }


    public function login($email)
    {
        $recup = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $recup->execute(array($email));
        $data = $recup->fetch();
        return $data;

    }




}
