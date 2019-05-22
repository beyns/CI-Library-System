<?php

class Migration_Create_users_table extends CI_Migration
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dBforge();
    }

    public function up()
    {
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE,
                'auto_increment' => TRUE
            ),
            'school_number' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'firstname' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'lastname' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'username' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'email' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'password' => array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            );
        
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('users', TRUE);

    }

    public function down()
    {
        $this->dbforge->drop_table('users', TRUE);
    }

}