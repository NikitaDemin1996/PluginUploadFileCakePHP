<?php
namespace PluginUploadFileCakePHP\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use PluginUploadFileCakePHP\Model\Table\FilesTable;

/**
 * PluginUploadFileCakePHP\Model\Table\FilesTable Test Case
 */
class FilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \PluginUploadFileCakePHP\Model\Table\FilesTable
     */
    public $Files;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.plugin_upload_file_cake_p_h_p.files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Files') ? [] : ['className' => 'PluginUploadFileCakePHP\Model\Table\FilesTable'];
        $this->Files = TableRegistry::get('Files', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Files);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
