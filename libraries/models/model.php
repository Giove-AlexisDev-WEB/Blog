<?php

abstract class Model
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * Représente la table que l'on veut traiter. 
     *
     * @var string
     */
    protected $table;

    /**
     * Constructeur qui vérifie que la table est bien précisée
     * et qui met en place la connexion à la base de données
     */
    public function __construct()
    {
        // 1. On vérifie que le nom de la table est bien précisé !
        if (empty($this->table)) {
            throw new Exception('Vous devez absolument spécifier une propriété <em>protected $table</em> dans votre classe ' . get_called_class() . ' qui hérite de Model et qui contient le nom de la table à attaquer.');
        }

        // 2. Si tout est bon, on créé l'objet PDO en utilisant les données du fichier de configuration
        $this->db = Database::getInstance();
    }

    /**
     * Permet de retrouver un enregistrement grâce à son identifiant
     *
     * @param integer $id
     * @return array|bool|null
     */
    public function find(int $id)
    {
        // Retrouver l'article et le retourner
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id = :id");
        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Permet de récupérer la liste des données
     *
     * @return array
     */
    public function findAll(): array
    {
        // Retourner tous les articles
        $query = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Permet d'insérer un nouvel enregistrement et retourne l'identifiant
     *
     * @param array $data
     * @return integer
     */
    public function insert(array $data): void
    {
        $sql = "INSERT INTO $this->table SET ";

        $columns = array_keys($data);
        $sqlColumns = [];

        foreach ($columns as $column) {
            $sqlColumns[] = "$column = :$column";
        }

        $sql .= implode(",", $sqlColumns);

        $query = $this->db->prepare($sql);

        $query->execute($data);
    }

    /**
     * Permet de mettre à jour un enregistrement
     *
     * @param array $data
     * @return void
     */
    public function update(array $data)
    {
        if (!array_key_exists('id', $data)) {
            throw new Exception("Vous ne pouvez pas appeler la fonction update sans préciser dans votre tableau un champ `id` !");
        }

        $sql = "UPDATE $this->table SET ";

        $columns = array_keys($data);
        $sqlColumns = [];

        foreach ($columns as $column) {
            $sqlColumns[] = "$column = :$column";
        }

        $sql .= implode(",", $sqlColumns);

        $sql .= " WHERE id = :id";

        $query = $this->db->prepare($sql);

        $query->execute($data);
    }

    /**
     * Permet de supprimer un enregistrement
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");

        $query->execute(['id' => $id]);
    }

    public function findAllByCategorieId(int $id): array
    {
        $query = $this->db->prepare('
            SELECT * FROM status WHERE categorie_id = id;
        ');

        $query->execute(['id' => $id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
