<?php

include "database.php";

class UserEntity {
    private $id_users;
    private $fullname;
    private $description;
    private $phoneNumber;
    private $sexe;
    private $social_media;
    private $stars;
    private $skills;
    private $avatar_url;
    private $date_creation;

    public function __construct($id_users = '', $fullname = '', $description = '', $phoneNumber = '', $sexe = '', $social_media = '', $stars = '', $skills = '', $avatar_url = '', $date_creation = '') {
        $this->id_users = $id_users;
        $this->fullname = $fullname;
        $this->description = $description;
        $this->phoneNumber = $phoneNumber;
        $this->sexe = $sexe;
        $this->social_media = $social_media;
        $this->stars = $stars;
        $this->skills = $skills;
        $this->avatar_url = $avatar_url;
        $this->date_creation = $date_creation;
    }

    public function getIdUsers() {
        return $this->id_users;
    }

    public function setIdUsers($id_users) {
        $this->id_users = $id_users;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function getSocialMedia() {
        return $this->social_media;
    }

    public function setSocialMedia($social_media) {
        $this->social_media = $social_media;
    }

    public function getStars() {
        return $this->stars;
    }

    public function setStars($stars) {
        $this->stars = $stars;
    }

    public function getSkills() {
        return $this->skills;
    }

    public function setSkills($skills) {
        $this->skills = $skills;
    }

    public function getAvatarUrl() {
        return $this->avatar_url;
    }

    public function setAvatarUrl($avatar_url) {
        $this->avatar_url = $avatar_url;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }

    public function save() {
        global $connexion;
        $userSaveQuery = "INSERT INTO Users (fullname, description, phoneNumber, sexe, social_media, stars, skills, avatar_url, date_creation) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $userSave = $connexion->prepare($userSaveQuery);
        if(
            $userSave->execute(array("$this->id_users",
            "$this->fullname", 
            "$this->description", 
            "$this->phoneNumber", 
            "$this->sexe", 
            "$this->social_media",
            "$this->skills",
            "$this->avatr_url",
            "$this->date_creation"

            ))
        ){
            return true;
        }else{
            return false;
        }
        
    }
    public function findByIdUsers($id_users) {
        global $connexion;
        $query = "SELECT * FROM Users WHERE id_users = ?";
        $findUsers = $connexion->prepare($finduserQuery);
        $findUsers->execute(array($this->id_users));
        $userFound = $findusers->fetch();
        $this->setIdUsers($userFound['id_users']);
        $this->setFullname($userFound['fullname']);
        $this->setDescription($userFound['description']);
        $this->setPhoneNumber($userFound['phoneNumber']);
        $this->setSexe($userFound['sexe']);
        $this->setSocialMedia($userFound['social_media']);
        $this->setSkills($userFound['skills']);
        $this->setAvatarUrl($userFound['avatar_url']);
        $this->setDateCreation($userFound['date_creation']);
    }
    public function findAll() {
        global $connexion;
            $findUsersQuery = "SELECT * FROM Users ORDER BY id_users DESC";
            $findUsers = $connexion->query($findUsersQuery);
            $users= $findUsers->fetchAll();
            return $users;
        
    }

    public function update($id_users){
        global $connexion;
        $updateUsersQuery = "UPDATE Users SET id_users = ?, fullname = ?, description = ?, phoneNumber = ?, sexe = ?, social_media = ?, stars = ?, skills = ?,  avatar_url = ?, date_creation = ?  WHERE id_users = ?";
        $updateUsers = $connexion->prepare($updateUsersQuery);
        if($updateUsers->execute(array("$this->id_users", 
        "$this->fullname", 
        "$this->description", 
        "$this->phoneNumber", 
        "$this->sexe", 
        "$this->social_media",
        "$this->skills",
        "$this->avatr_url",
        "$this->date_creation",
        $id_users
        ))){
            return true;
        }else{
            return false;
        }
    }


    public function delete($id_users){
        global $connexion;
        $deleteUsersQuery = "DELETE FROM Users WHERE id_users = ?";
        $deleteUsers = $connexion->prepare($deleteUsersQuery);
       if( $deleteUsers->execute(array("$id_users"))){
        return true;
       }else{
        return false;
       }
    }

}

?>
