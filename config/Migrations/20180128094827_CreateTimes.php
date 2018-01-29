<?php
use Migrations\AbstractMigration;

class CreateTimes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('times');
        $table->addColumn('user_id', 'string',[
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('time', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('sum', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->create();
    }
}
