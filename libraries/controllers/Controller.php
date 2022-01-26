<?php

/**
 * LA CLASSE DE BASE D'UN CONTROLLER
 * --------------------------------
 */
abstract class Controller
{
    /**
     * C'est l'objet Model qui servira à toutes nos actions dans un controller, c'est lui qui fait le lien avec une table de la base de données
     *
     * @var Model
     */
    protected $model;

    /**
     * C'est le nom de la classe Model qu'on veut dans $this->model
     *
     * @var string
     */
    protected $modelName;

    /**
     * Le constructeur a pour seul but de vérifier la validité du model demandé et de créer un objet issu de la classe demandée
     */
    public function __construct()
    {

        if (empty($this->modelName)) {
            throw new Exception('Vous avez oublié de fournir un <em>protected $modelName</em> dans la classe ' . get_called_class() . " hors il est obligatoire de fournir le nom du Model à utiliser !");
        }


        $chemin = "libraries/models/{$this->modelName}.php";

        if (!file_exists($chemin)) {

            throw new Exception("Le model défini dans " . get_called_class() . " ({$this->modelName}) n'existe pas ! Nous n'avons pas trouvé le fichier qui aurait du se trouver ici : $chemin !");
        }

        require_once $chemin;
        $this->model = new $this->modelName();
    }

    /**
     * La fonction view() permet d'afficher un template PHTML avec le header.phtml et le footer.phtml qui l'accompagnent.
     *
     * @param string $template Le chemin vers le fichier PHTML, sans l'extension .phtml
     * @param array $variables Le tableau associatif contenant les variables utilisées dans le template PHTML
     * @return void
     */
    protected function view(string $template, array $variables = [])
    {
        /**
         * EXTRACTION DES VARIABLES :
         * --------------------------
         */
        extract($variables);

        // Inclusion du header
        require_once dirname(__FILE__) . '/../templates/partials/header.phtml';

        // Inclusion du fichier principal
        require_once dirname(__FILE__) . "/../templates/$template.phtml";

        // Inclusion du footer
        require_once dirname(__FILE__) . '/../templates/partials/footer.phtml';
    }
}
