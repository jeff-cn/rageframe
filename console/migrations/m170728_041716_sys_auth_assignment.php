<?php

use yii\db\Migration;

class m170728_041716_sys_auth_assignment extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%sys_auth_assignment}}', [
            'item_name' => 'varchar(64) NOT NULL',
            'user_id' => 'varchar(64) NOT NULL',
            'created_at' => 'int(11) NULL',
            'PRIMARY KEY (`item_name`,`user_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色分配表'");
        
        /* 索引设置 */
        
        /* 外键约束设置 */
        $this->addForeignKey('fk_sys_auth_item_828_00','{{%sys_auth_assignment}}', 'item_name', '{{%sys_auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%sys_auth_assignment}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

