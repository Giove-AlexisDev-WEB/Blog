<?php

require_once "Model.php";

/**
 * MODEL DES STATUS
 * -----------------
 * Cette classe permet d'accéder à la table des status. Elle dispose de toutes les fonctionalités
 * que possède la classe Model à savoir :
 * - Sélectionner tous les status (findAll())
 * - Sélectionner un status (find($id))
 * - Insérer un nouveau status (insert($data))
 * - Mettre à jour un status (update($data))
 * - Supprimer un status (delete($id))
 */
class StatusModel extends Model
{
    /**
     * OBLIGATOIRE : Le nom de la table que l'on souhaite traiter avec ce model
     *
     * @var string
     */
    protected $table = 'status';
}
