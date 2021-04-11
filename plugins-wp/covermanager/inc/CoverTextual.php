<?php namespace Inc;

class CoverTextual extends Core\Model implements Interfaces\iHandleTable
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->setPrefixTable( PLUGIN_SLUG.'_textual' );
    }

    public function scriptCreateTable()
    {
        return "CREATE TABLE {$this->table} (
                `id` TINYINT(3) unsigned NOT NULL AUTO_INCREMENT,
                `titulo` VARCHAR(128) DEFAULT NULL,
                `descripcion` TEXT DEFAULT NULL,
                `updated_at` DATETIME NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    }

    public function defaultsTable()
    {
        return $this->store([
            'updated_at' => DATETIME_NOW,
        ]);
    }

    public function save( $request )
    {
        return $this->update([
            'titulo'      => strip_tags( trim($request['titulo']) ),
            'descripcion' => strip_tags( trim($request['descripcion']) ),
            'updated_at'  => DATETIME_NOW,
        ], ['id' => 1]);
    }

    public function content()
    {
        return $this->find(1);
    }
}