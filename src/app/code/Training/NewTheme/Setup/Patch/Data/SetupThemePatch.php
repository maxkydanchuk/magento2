<?php


namespace Training\NewTheme\Setup\Patch\Data;


use _HumbugBoxe8a38a0636f4\Nette\Neon\Exception;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Theme\Model\ResourceModel\Theme\CollectionFactory;

class SetupThemePatch implements DataPatchInterface, PatchRevertableInterface
{
    const THEME_NAME = 'Training/new_theme';
    const SCOPE_TYPE_DEFAULT = 'default';

    private CollectionFactory $collectionFactory;
    protected ModuleDataSetupInterface $moduleDataSetup;
    protected WriterInterface $writer;


    public function __construct(WriterInterface $writer, CollectionFactory $collectionFactory, ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->writer = $writer;
        $this->collectionFactory = $collectionFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        try {
            $themes = $this->collectionFactory->create()->loadRegisteredThemes();

            foreach ($themes as $theme) {
                if ($theme->getCode() == self::THEME_NAME) {
                    $this->writer->save('design/theme/theme_id', $theme->getId(), SCOPE_TYPE_DEFAULT);
                }
            }
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $this->moduleDataSetup->endSetup();
    }

    public function revert()
    {
        $this->moduleDataSetup->startSetup();

        try {
            $theme = $this->themeList->getThemeByFullPath('frontend/Magento/luma');

            if ($theme->getId()) {
                $this->writer->save('design/theme/theme_id', $theme->getId(), SCOPE_TYPE_DEFAULT);
            }
        }
        catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
