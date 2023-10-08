<?php
include "database.php";
class proposalEntity{
    private $id_proposals;
    private $description;
    private $availability;

    public function __construct($id_proposals = '', $description = '', $availability = '')
    {
        $this->id_proposals = $id_proposals;
        $this->description = $description;
        $this->availability = $availability;
    }

    public function getIdProposals(){
        return $this->id_proposals;
    }

    /**
     * @param string $matricule
     */
    public function setIdProposals($id_proposals){
        $this->id_proposals = $id_proposals;
    }

    /**
     * @return string $nom
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @param string $nom
     */
    public function setDescription($name_project){
        $this->description = $description;
    }

    /**
     * @return string $sexe
     */
    public function getAvailability(){
        return $this->getAvailability;
    }
    public function setAvailability(){
        $this->availability = $availability;
    }

    public function save(){
        global $connexion;
        $proposalSaveQuery = "INSERT INTO Proposals (description, availability) VALUES(?, ?)";
        $proposalSave = $connexion->prepare($proposalSaveQuery);
        if(
            $proposalsSave->execute(array("$this->id_proposals", 
            "$this->description", 
            "$this->availability",
            ))
        ){
            return true;
        }else{
            return false;
        }
    }

    public function findByIdProposals(){
        global $connexion;
        $findproposalsQuery = "SELECT * FROM Proposal WHERE id_proposal = ?";
        $findProposal = $connexion->prepare($findproposalsQuery);
        $findProposal->execute(array($this->id_proposal));
        $proposalFound = $findProposal->fetch();
        $this->setIdProposals($proposalFound['id_project']);
        $this->setDescription($proposalFound['description']);
        $this->setAvailability($proposalFound['availability']);
       
    }

    public function findAll() {
        global $connexion;
        $findProposalQuery = "SELECT * FROM Proposal ORDER BY id_proposal DESC";
        $findProposal = $connexion->query($findProposalQuery);
        $proposal= $findProposal->fetchAll();
        return $proposal;
    }


    public function update($id_proposals){
        global $connexion;
        $updateProposalQuery = "UPDATE Project SET id_project = ?, name_project = ?, description = ?, content = ?, date_creation = ?, image_url = ? WHERE id_project = ?";
        $updateProposal = $connexion->prepare($updateProposalQuery);
        if($updateProposal->execute(array("$this->id_proposal", 
        "$this->description", 
        "$this->availability", 
        $id_proposals
        ))){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id_proposals){
        global $connexion;
        $deleteProposalsQuery = "DELETE FROM Proposals WHERE id_proposals = ?";
        $deleteProposal = $connexion->prepare($deleteProposalsQuery);
       if( $deleteProposal->execute(array("$id_proposals"))){
        return true;
       }else{
        return false;
       }
    }

} 
?>