<?php
    class Basetut_Salestaff_Block_Adminhtml_Staff_Grid extends Mage_Adminhtml_Block_Widget_Grid {
        public function __construct() {
            parent::__construct();
            $this->setId('staffGrid');
            $this->setDefaultSort('staff_id');
            $this->setDefaultDir('DESC');
            $this->setSaveParametersInSession(true);
        }

        public function _prepareCollection() {
            $collection = Mage::getModel('salestaff/staff')->getCollection();
            $this->setCollection($collection);
            return parent::_prepareCollection();
        }

        public function _prepareColumns() {
            $this->addColumn('staff_id', array(
               'header' => Mage::helper('salestaff')->__('ID'),
                'align' => 'center',
                'width' => '50px',
                'index' => 'staff_id',
            ));

            $this->addColumn('firstname', array(
               'header' => Mage::helper('salestaff')->__('First Name'),
                'align' =>'left',
                'index' => 'firstname',
            ));

            $this->addColumn('lastname', array(
                'header' => Mage::helper('salestaff')->__('Last Name'),
                'align' =>'left',
                'index' => 'lastname',
            ));

            $this->addColumn('birthday', array(
               'header' => Mage::helper('salestaff')->__('Birthday'),
                'width' => '150px',
                'index' => 'birthday',
                'type' => 'date',
            ));

            $this->addColumn('sex', array(
               'header' => Mage::helper('salestaff')->__('Sex'),
                'align' => 'left',
                'width' => '80px',
                'index' => 'sex',
                'type' => 'options',
                'options' => array(
                    1 => 'Male',
                    2 => 'Female',
                ),
            ));

            $this->addColumn('status', array(
               'header' => Mage::helper('salestaff')->__('Status'),
                'align' => 'left',
                'width' => '80px',
                'index' => 'status',
                'type' => 'options',
                'options' => array(
                    1 => 'Enable',
                    2 => 'Disable',
                ),
            ));

            $this->addExportType('*/*/exportCsv', Mage::helper('salestaff')->__('CSV'));
            $this->addExportType('*/*/exportXml', Mage::helper('salestaff')->__('XML'));
            return parent::_prepareColumns();
        }

        public function getRowUrl($row) {
            return $this->getUrl('*/*/edit', array('id' => $row->getId()));
        }

        public function _prepareMassaction() {
            $this->setMassactionIdField('staff_id');
            $this->getMassactionBlock()->setFormFieldName('staff');

            //mass delete
            $this->getMassactionBlock()->addItem('delete', array(
               'label' => Mage::helper('salestaff')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('salestaff')->__('Are you sure ?'),
            ));

            //mass change status
            $statuses = array(
                1 => Mage::helper('salestaff')->__('Enable'),
                2 => Mage::helper('salestaff')->__('Disable'),
            );
            array_unshift($statuses, array('label' => '', 'value' => ''));
            $this->getMassactionBlock()->addItem('status', array(
               'label' => Mage::helper('salestaff')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('salestaff')->__('Status'),
                        'values' => $statuses
                    )
                )
            ));
            return $this;
        }
    }