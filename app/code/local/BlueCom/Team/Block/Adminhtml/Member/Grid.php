<?php
class BlueCom_Team_Block_Adminhtml_Member_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        // Set some defaults for our grid
        $this->setDefaultSort('id');
        $this->setId('bluecom_team_member_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
     
    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'bluecom_team/member_collection';
    }
     
    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }
     
    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'id'
            )
        );
         
        $this->addColumn('firstname',
            array(
                'header'=> $this->__('First Name'),
                'index' => 'firstname'
            )
        );
        $this->addColumn('lastname',
            array(
                'header'=> $this->__('Last Name'),
                'index' => 'lastname'
            )
        );
        $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'index' => 'email'
            )
        );
        $this->addColumn('cellphone',
            array(
                'header'=> $this->__('Cell Phone'),
                'index' => 'cellphone'
            )
        );
        $this->addColumn('skype',
            array(
                'header'=> $this->__('Skype ID'),
                'index' => 'skype'
            )
        );
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}