<?php

require_once "Model.php";

class StatusModel extends Model
{
    /**
     * @var string
     */

    protected $table = 'status';

    public function findAll(): array
    {
        $query = $this->db->prepare('
            SELECT
                s.*,
                c.nom
            FROM status s
            JOIN categorie c ON s.categorie_id = c.id
            ORDER BY s.createdAt DESC
        ');

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id)
    {
        $query = $this->db->prepare('
            SELECT
                s.*,
                c.nom
            FROM status s
            JOIN categorie c ON s.categorie_id = c.id
            WHERE status.id = :id
            ORDER BY status.createdAt DESC
        ');
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
