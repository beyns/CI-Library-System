<?php

class Migration_Create_category_table extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dBforge();
    }

    public function up()
    {
        $fields = array(
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE,
                'auto_increment' => TRUE
            ),
            'category' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'sub_category' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),

        );
        
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('category id', TRUE);
            $this->dbforge->create_table('category', TRUE);

    }

    public function down()
    {
        $this->dbforge->drop_table('category', TRUE);
    }

}