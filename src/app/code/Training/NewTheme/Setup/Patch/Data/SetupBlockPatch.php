<?php

namespace Training\NewTheme\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Cms\Model\BlockFactory;

class SetupBlockPatch implements DataPatchInterface, PatchRevertableInterface {

    const BLOCK_IDENTIFIER = 'test_block';

    /**
     * @var BlockFactory
     */
    protected $blockFactory;

    /**
     * UpdateBlockData constructor.
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        BlockFactory $blockFactory
    ) {
        $this->blockFactory = $blockFactory;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $bannerData = [
            'title' => 'TestBlock',
            'identifier' => self::BLOCK_IDENTIFIER,
            'content' => '<div class="banner__content">
               <div class="banner__text">Could you be our<br><span class="text-red">next winner</span></div>
               <button class="banner__button-enter"> Enter now </button>
              <img class="banner__image" src="{{media url=&quot;wysiwyg/CAR_ELIPSIS.png&quot;}}" alt="car" width="733" height="388">
            </div>',
            'stores' => [0],
            'is_active' => 1,
        ];
        $bannerBlock = $this->blockFactory
            ->create()
            ->load($bannerData['identifier'], 'identifier');

        /**
         * Create the block if it does not exists, otherwise update the content
         */
        if (!$bannerBlock->getId()) {
            $bannerBlock->setData($bannerData)->save();
        } else {
            $bannerBlock->setContent($bannerData['content'])->save();
        }
    }

    public function revert()
    {
        $bannerBlock = $this->blockFactory
            ->create()
            ->load(self::BLOCK_IDENTIFIER, 'identifier');

        if($bannerBlock->getId()) {
            $bannerBlock->delete();
        }
    }
}
