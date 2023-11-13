<?php
    

class UserModel extends Model  {
    

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
