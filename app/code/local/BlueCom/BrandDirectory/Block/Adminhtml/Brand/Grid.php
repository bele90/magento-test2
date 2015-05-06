<?php
    class BlueCom_BrandDirectory_Block_Adminhtml_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid {

        protected function _prepareCollection() {
            $collection = Mage::getResourceModel('bluecom_branddirectory/brand_collection');
            $this->setCollection($collection);
            return parent::_prepareCollection();
        }

        public function getRowUrl($row) {
            return $this->getUrl(
                'bluecom_branddirectory_admin/brand/edit',
                array(
                    'id' => $row->getId(),
                )
            );
        }

        protected function _prepareColumns() {
            $this->addColumn('entity_id',array(
                'header' => $this->_getHelper()->__('ID'),
                'type'  => 'number',
                'index' => 'entity_id',
            ));

            $this->addColumn('create_at', array(
                'header' => $this->_getHelper()->__('Created'),
                'type'  => 'datetime',
                'index' => 'create_at',
            ));

            $this->addColumn('update_at', array(
                'header' => $this->_getHelper()->__('Updated'),
                'type' => 'datetime',
                'index' => 'update_at',
            ));

            $this->addColumn('name', array(
                'header' => $this->_getHelper()->__('Name'),
                'type' => 'text',
                'index' => 'name',
            ));

            $this->addColumn('image', array(
                'header' => $this->_getHelper()->__('Image'),
                'align' => 'center',
                'index' => 'image',
                'filter' => false,
                'width' => '70',
                'renderer' => 'BlueCom_BrandDirectory_Block_Adminhtml_Brand_Grid_Renderer_Image',
            ));

            $this->addColumn('url_key', array(
                'header' => $this->_getHelper()->__('Url Key'),
                'type' => 'text',
                'index' => 'url_key',
            ));

            $brandSingleton = Mage::getSingleton(
                'bluecom_branddirectory/brand'
            );

            $this->addColumn('visibility', array(
                'header' => $this->_getHelper()->__('Visibility'),
                'type' => 'options',
                'index' => 'visibility',
                'options' => $brandSingleton->getAvailableVisibilies(),
            ));

            $this->addColumn('action', array(
                'header' => $this->_getHelper()->__('Action'),
                'width' => '50px',
                'type' => 'action',
                'actions' => array(
                    array(
                        'caption' => $this->_getHelper()->__('Edit'),
                        'url' => array(
                            'base' => 'bluecom_branddirectory_admin'.'/brand/edit',
                        ),
                        'field' => 'id'
                    ),
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'entity_id',
            ));

            return parent::_prepareColumns();
        }

        protected function _getHelper() {
            return Mage::helper('bluecom_branddirectory');
        }
    }