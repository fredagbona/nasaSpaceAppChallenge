<?php
include "database.php";
class skillEntity{
    private $skill_id;
    private $nom_skill;

    public function __construct($skill_id = '', $nom_skill = '')
    {
        $this->skill_id = $skill_id;
        $this->nom_skill = $nom_skill;

    }

    public function getIdSkill(){
        return $this->$skill_id;
    }

    public function setIdSkill($skill_id){
        $this->skill_id = $skill_id;
    }
   
    public function getNomSkill(){
        return $this->$nom_skill;
    }

    public function setNomSkill($nom_skill){
        $this->nom_skill = $nom_skill;
    }

    public function save(){
        global $connexion;
        $skillSaveQuery = "INSERT INTO Skill (skill_id, nom_skill) VALUES(?, ?)";
        $skillSave = $connexion->prepare($skillSaveQuery);
        if(
            $skillSave->execute(array("$this->skill_id", 
            "$this->nom_skill", 

            ))
        ){
            return true;
        }else{
            return false;
        }
    }

    public function findByIdSkill(){
        global $connexion;
        $findskillQuery = "SELECT * FROM Skill WHERE skill_id = ?";
        $findskill = $connexion->prepare($findskillQuery);
        $findskill->execute(array($this->skill_id));
        $skillFound = $findskill->fetch();
        $this->setIdSkill($skillFound['skill_id']);
        $this->setDescription($skillFound['nom_skill']); 
    }

    public function findAll() {
        global $connexion;
        $findSkillQuery = "SELECT * FROM Skill ORDER BY skill_id DESC";
        $findSkill = $connexion->query($findSkillQuery);
        $skill = $findSkill->fetchAll();
        return $skill;
    }

    
    public function update($id_skill){
        global $connexion;
        $updateSkillQuery = "UPDATE Project SET id_project = ?, name_project = ?, description = ?, content = ?, date_creation = ?, image_url = ? WHERE id_project = ?";
        $updateSkill = $connexion->prepare($updateSkillQuery);
        if($updateSkill->execute(array("$this->skill_id", 
        "$this->nom_skill",  
        $id_proposals
        ))){
            return true;
        }else{
            return false;
        }
    }

    public function delete($skill_id){
        global $connexion;
        $deleteSkillQuery = "DELETE FROM Skill WHERE skill_id = ?";
        $deleteSkill = $connexion->prepare($deleteSkillQuery);
       if( $deleteSkill->execute(array("$skill_id"))){
        return true;
       }else{
        return false;
       }
    }
}

?>