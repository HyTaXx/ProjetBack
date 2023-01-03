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

      //  $this->pdo->execute($statement);
    }


    public function login($email)
    {
        $recup = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $recup->execute(array($email));
        $data = $recup->fetch();
        return $data;

    }

    public function createAlbum(Album $album)
    {
        $query = 'INSERT INTO albums (album_name, user_id, isprivate)
                    VALUES (:album_name, :user_id, :isprivate)';
        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'album_name' => $album->album_name,
            'user_id' => $_SESSION['id'],
            'isprivate' => $album->isprivate,
        ]);
    }

    public function getAlbums()
    {
        $query = 'SELECT * FROM albums WHERE user_id = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($_SESSION['id']));
        return $statement;
    }

    public function addFilm($film, $album)
    {
        $query = 'INSERT INTO movies_albums (movie_id, album_id)
                  VALUES(:movie_id, :album_id)';

        $statement = $this->pdo->prepare($query);
        return $statement->execute([
            'movie_id' => $film,
            'album_id' => $album,
        ]);
    }

    public function getMovies($album){
        $query = 'SELECT * FROM movies_albums WHERE album_id = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($album));
        return $statement;
    }







}
