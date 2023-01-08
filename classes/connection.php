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

    public function getNewUserId($email){
        $query = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($email));
        return $statement->fetch();
    }

    public function getAlbum($name){
        $query = 'SELECT * FROM albums WHERE album_name = :name AND user_id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'name' => $name,
            'id' => $_SESSION['id']
        ]);
        return $statement->fetchAll();
    }

    public function getUsers($first_name){
        $query = 'SELECT * FROM users WHERE first_name = :first_name';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'first_name' => $first_name,
        ]);
        return $statement->fetchAll();
    }

    public function getAllUsers(){
        $query = 'SELECT * FROM users';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUserProfile($id){
        $query = 'SELECT * FROM users WHERE id = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
        return $statement->fetch();
    }

    public function getPublicAlbums($id){
        $query = 'SELECT * FROM albums WHERE isprivate = 0 AND user_id = ?';
        $statement= $this->pdo->prepare($query);
        $statement->execute(array($id));
        return $statement->fetchAll();
    }

    public function getLikedAlbums($id){
        $query = 'SELECT * FROM albums JOIN albums_likes ON album_id = albums.id AND userlike_id = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
        return $statement->fetchAll();
    }

    public function sendInvite($sender_id, $recipient_id, $album_id, $status){
        $query = 'INSERT INTO invitations (sender_id, recipient_id, album_id, status) VALUES (:sender_id, :recipient_id, :album_id, :status)';
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'sender_id' => $sender_id,
            'recipient_id' => $recipient_id,
            'album_id' => $album_id,
            'status' => $status,
        ]);
    }

    public function getWaitingInvitations($id){
        $query = "SELECT * FROM invitations WHERE recipient_id = ? AND status = 'envoyee' ";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
        return $statement->fetchAll();
    }

    public function getUserName($id){
        $query = 'SELECT first_name FROM users WHERE id = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
        return $statement->fetchAll();
    }

    public function acceptInvite($id){
        $query = "UPDATE invitations SET status = 'acceptee' WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
    }

    public function declineInvite($id){
        $query = "UPDATE invitations SET status = 'refusee' WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
    }

    public function getAcceptedInvitations($id){
        $query = "SELECT * FROM invitations WHERE recipient_id = ? AND status = 'acceptee'";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
        return $statement->fetchAll();
    }


}