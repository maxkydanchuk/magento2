<?php

namespace Training\NewTheme\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Setup\Exception;

class SetupPagePatch implements DataPatchInterface
{

    const PAGE_IDENTIFIER = 'home';

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     */


    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }

    public static function getDependencies()
    {
        return [
            SetupBlockPatch::class
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $pageData = [
            'title' => 'Home Page',
            'page_layout' => '1column',
            'meta_keywords' => null,
            'meta_description' => null,
            'content_heading' => null,
            'identifier' => self::PAGE_IDENTIFIER,
            'content' => '{{widget type="Training\CompetitionsWidget\Block\Widget\CompetitionsWidget" title="Latest Competitions"}}{{widget type="Training\DescriptionWidget\Block\Widget\DescriptionWidget" title="How It Works" first_step_text="Choose a competition and how many entries you would like" first_step_icon="wysiwyg/touchscreen.png" second_step_text="Answer the qualifying question (be sure to answer correctly!) and complete payment" second_step_icon="wysiwyg/online_payment.png" third_step_text="Tickets for all correct answers are entered into the draw, streamed LIVE on Facebook using Google’s random number generator" third_step_icon="wysiwyg/movie_tickets.png" fourth_step_text="If you win, we may try to contact you whilst live on Facebook, so be prepared!" fourth_step_icon="wysiwyg/winner.png"}}{{widget type="Training\ReviewWidget\Block\Widget\ReviewWidget" first_review_text="&quot;Unbelievable this is a dream come true, no way would I ever think I would own a car like this. What great blokes.Thank you very much!5 star from me!!!&quot;" first_review_author="DANNY CHURCHMAN" first_review_photo="wysiwyg/review_photo.png" second_review_text="second second second second second second second second second second second second" second_review_author="second second second second second second" second_review_photo="wysiwyg/review_photo2.png"}}{{widget type="Training\WinnersWidget\Block\Widget\WinnersWidget" title="Latest Winners" first_winner_text="Ferrari 458" first_winner_date="12 November 2020" first_winner_icon="wysiwyg/image_1.png" second_winner_text="Aquila Gullwing" second_winner_date="9 November 2020" second_winner_icon="wysiwyg/image_2.png" third_winner_text="2020 Audi S5 Coupe" third_winner_date="5 November 2020" third_winner_icon="wysiwyg/image_3.png" fourth_winner_text="Ferrari Purosangue SUV" fourth_winner_date="25 September 2020" fourth_winner_icon="wysiwyg/image_4.png"}}',
            'layout_update_xml' => '',
            'url_key' => null,
            'stores' => [0],
            'is_active' => 1,
            'sort_order' => 0
        ];

        try {

            $homePage = $this->pageFactory->create()->load($pageData['identifier'], 'identifier');

            /**
             * Create the block if it does not exists, otherwise update the content
             */
            if (!$homePage->getId()) {
                $homePage->setData($pageData)->save();
            } else {
                $homePage->setContent($pageData['content'])->save();
            }

        } catch (Exception $e) {

            echo $e->getMessage();
        }

        $this->moduleDataSetup->endSetup();

    }

    public function revert()
    {
        $pageData = [
            'identifier' => self::PAGE_IDENTIFIER,
            'content' => null,
        ];

        try {
            $homePage = $this->pageFactory->create()->load($pageData['identifier'], 'identifier');

            if ($homePage->getId()) {
                $homePage->setData($pageData['content'])->save();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAliases()
    {
        return [];
    }
}

