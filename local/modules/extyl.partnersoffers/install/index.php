<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\EventManager;

require_once __DIR__ . '/../include.php';

class extyl_partnersoffers extends \CModule
{
    public $MODULE_VERSION = '0.1.0';
    public $MODULE_VERSION_DATE = '2019-12-15 00:00:00';
    public $MODULE_NAME = null;
    public $MODULE_DESCRIPTION = null;
    public $MODULE_ID = 'extyl.partnersoffers';

    public function __construct()
    {
        $this->MODULE_NAME = 'Extyl - Спасибо от Сбербанка';
        $this->MODULE_DESCRIPTION = '';
    }

    /**
     * @param \Bitrix\Main\Entity\DataManager|string $entity
     *
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\SystemException
     */
    private function createTable($entity)
    {
        global $DB;
        $query = $entity::query()->getEntity()->compileDbTableStructureDump();
        $query = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $query[0]);
        $DB->Query($query);
    }

    public function installDb()
    {
        // $this->createTable(Namespace\Orm\SomeTable::class);
    }

    public function installFiles()
    {
        $sourceDir = __DIR__ . '/files/';
        $destDir = $_SERVER['DOCUMENT_ROOT'];

        if ( ! file_exists($sourceDir)) return;

        $dirIterator = new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $object) {
            $destPath = $destDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            if ($object->isDir()) {
                mkdir($destPath, 0775);
            } else {
                copy($object, $destPath);
            }
        }
    }

    public function uninstallFiles()
    {
        $sourceDir = __DIR__ . '/files/';

        if ( ! file_exists($sourceDir)) return;

        $destDir = $_SERVER['DOCUMENT_ROOT'];

        $dirIterator = new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($iterator as $object) {
            $destPath = $destDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            if ($object->isDir()) {
                rmdir($destPath);
            } else {
                unlink($destPath);
            }
        }
    }

    public function DoInstall()
    {
        $this->installDb();
        $this->installFiles();
        RegisterModule($this->MODULE_ID);

        EventManager::getInstance()->registerEventHandler('main', 'OnProlog', $this->MODULE_ID);
    }

    public function DoUninstall()
    {
        $this->uninstallFiles();

        EventManager::getInstance()->unRegisterEventHandler('main', 'OnProlog', $this->MODULE_ID);

        UnRegisterModule($this->MODULE_ID);
    }
}
