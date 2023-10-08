<?php

    include "database.php";

    class projectEntity{
        
        private $chat_id;
        private $name_project;
        private $description;
        private $content;
        private $date_creation;
        private $image_url;
     


        /**
         * @param string $matricule -> Numero matricule de l'étudiant
         * @param string $nom -> Nom de l'etudiant
         * @param string $prenom -> Prenom de l'étudiant
         * @param string $sexe -> Sexe de l'étudiant
         * @param string $dateDeNaissance -> Date de Naissance de l'étudiant
         * @param number $telephone -> Numero de téléphone de l'étudiant
         */
        public function __construct($id_project = '', $name_project = '', $description = '', $content = '', $date_creation= '', $image_url= '')
        {
            $this->id_project = $id_project;
            $this->name_project = $name_project;
            $this->description = $description;
            $this->content = $content;
            $this->date_creation = $date_creation;
            $this->image_url = $image_url;
        }

        /**
         * @return string $matricule
         */
        public function getIdProject(){
            return $this->id_project;
        }

        /**
         * @param string $matricule
         */
        public function setIdProject($id_project){
            $this->id_project = $id_project;
        }

        /**
         * @return string $nom
         */
        public function getNomProjet(){
            return $this->name_project;
        }

        /**
         * @param string $nom
         */
        public function setNomProjet($name_project){
            $this->name_project = $name_project;
        }

        /**
         * @return string $prenom
         */
        public function getDescription(){
            return $this->description;
        }

        /**
         * @param string $prenom
         */
        public function setDescription($description){
            $this->description = $description;
        }

        /**
         * @return string $sexe
         */
        public function getContent(){
            return $this->content;
        }

        /**
         * @param string $sexe
         */
        public function setContent($content){
            $this->content = $content;
        }

        /**
         * @return date $dateDeNaissance
         */
        public function getDateCreation(){
            return $this->date_creation;
        }

        /**
         * @param date $dateDeNaissance
         */
        public function setDateCreation($dateDeNaissance){
            $this->date_creation = $date_creation;
        }

        /**
         * @return number $telephone
         */
        public function getImageUrl(){
            return $this->image_url;
        }

        /**
         * @param number $telephone
         */
        public function setImageUrl($image_url){
            $this->telephone = $image_url;
        }

        public function save(){
            global $connexion;
            $projectSaveQuery = "INSERT INTO Project (name_project, description, content, date_creation, image_url) VALUES(?, ?, ?, ?, ?)";
            $projectSave = $connexion->prepare($projectSaveQuery);
            if(
                $projectSave->execute(array("$this->id_project",
                "$this->name_project", 
                "$this->description", 
                "$this->content", 
                "$this->date_creation", 
                "$this->image_url"
                ))
            ){
                return true;
            }else{
                return false;
            }
            
        }

        public function findByIdProject(){
            global $connexion;
            $findprojectQuery = "SELECT * FROM Project WHERE id_project = ?";
            $findProject = $connexion->prepare($findprojectQuery);
            $findProject->execute(array($this->id_project));
            $projectFound = $findProject->fetch();
            $this->setIdProject($projectFound['id_project']);
            $this->setNomProjet($projectFound['name_project']);
            $this->setDescription($projectFound['description']);
            $this->setContent($projectFound['content']);
            $this->setDateCreation($projectFound['date_creation']);
            $this->setImageUrl($projectFound['image_url']);
        }

        public function findAll() {
            global $connexion;
            $findProjectQuery = "SELECT * FROM Project ORDER BY id_project DESC";
            $findProjects = $connexion->query($findProjectQuery);
            $projects= $findProjects->fetchAll();
            return $projects;
        }
        public function findByUserID(){
            global $connexion;
            $findUserProjectQuery = "SELECT * FROM Project, Users WHERE Project.user_id = Users.id_users"
            $findProjectsUser = $connexion->query($findUserProjectQuery);
            $projectsByUser= $findProjectsUser->fetchAll();
            return $projectsByUser;
        }

        public function update($id_project){
            global $connexion;
            $updateProjectQuery = "UPDATE Project SET id_project = ?, name_project = ?, description = ?, content = ?, date_creation = ?, image_url = ? WHERE id_project = ?";
            $updateProject = $connexion->prepare($updateProjectQuery);
            if($updateProject->execute(array("$this->id_project", 
            "$this->name_project", 
            "$this->description", 
            "$this->content",
            "$this->date_creation", 
            "$this->image_url",
            $id_project
            ))){
                return true;
            }else{
                return false;
            }
        }

        public function delete($id_project){
            global $connexion;
            $deleteProjectQuery = "DELETE FROM Project WHERE id_project = ?";
            $deleteProject = $connexion->prepare($deleteProjectQuery);
           if( $deleteProject->execute(array("$id_project"))){
            return true;
           }else{
            return false;
           }
        }


    }




?>