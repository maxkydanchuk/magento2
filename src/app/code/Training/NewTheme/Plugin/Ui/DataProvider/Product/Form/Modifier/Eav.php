<?php


namespace Training\NewTheme\Plugin\Ui\DataProvider\Product\Form\Modifier;


class Eav
{
    /**
     * Set 'add_widgets' to true for the description attribute in order to display the "Insert Widget..." button
     *
     * @param \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav $subject
     * @param \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav $result
     * @return \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSetupAttributeMeta(
        \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav $subject,
        $result
    ) {
        if (isset($result['arguments']['data']['config']['code']) &&
            $result['arguments']['data']['config']['code'] == 'editor') {
            $result['arguments']['data']['config']['wysiwygConfigData'] = [
                'add_variables' => false,
                'add_widgets' => true,
                'add_directives' => true,
                'use_container' => true,
                'container_class' => 'hor-scroll'
            ];
        }

        return $result;
    }
}
