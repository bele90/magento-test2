<?php
class BlueCom_BrandExample_Model_Source_Brand extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        $brandCollection = Mage::getModel('bluecom_branddirectory/brand')->getCollection()
            ->setOrder('entity_id', 'ASC');
        
        $options = array(
            array(
                'label' => '',
                'value' => '',
            ),
        );
        
        foreach ($brandCollection as $_brand) {
            $options[] = array(
                'label' => $_brand->getName(),
                'value' => $_brand->getId(),
            );
        }
        
        return $options;
    }
}