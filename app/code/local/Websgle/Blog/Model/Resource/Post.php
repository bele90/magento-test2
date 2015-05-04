<?php

class Websgle_Blog_Model_Resource_Post extends Mage_Eav_Model_Entity_Abstract
{
    public function _construct()
    {
        $resource = Mage::getSingleton('core/resource');

        $this->setType(Websgle_Blog_Model_Post::ENTITY);
        $this->setConnection(
            $resource->getConnection('blog_read'),
            $resource->getConnection('blog_write')
        );
    }
}
