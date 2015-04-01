<?php
class HelloWorldPlugin extends Omeka_Plugin_AbstractPlugin{

protected $_filters = array(
 'admin_items_form_tabs',
 'public_navigation_main'
);

protected $_hooks = array(
'install',
'uninstall',
'public_items_show',
'public_head',
'admin_head'
);

public function filterAdminItemsFormTabs($tabs, $args){
// insert the tab before the Miscellaneous tab
        $item = $args['item'];
       $tabs['Message'] =  "<div class='test'>Here is where my code will go.</div>" ;//>Link to an item</a>;//echo uri('items') . $item->id;
        //$tabs['Message'] =  $this->_Admin_Nav_Message($item); $this->referecnes document and functions therein.

        return $tabs;}
        
public function filterPublicNavigationMain($navArray){
	 //$navArray['HelloWorld'] = array('label'=>__('Message'),'uri'=>url('geolocation/map/browse'));
	 //$navArray['HelloWorld'] = array('label'=>__('Message'),'uri'=>url('helloworld'));
return $navArray;
}
   
public function hookInstall() {   
        $db = get_db();
        $sql = "
        CREATE TABLE IF NOT EXISTS `$db->Hello` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `item_id` BIGINT UNSIGNED NOT NULL,
        `hello` TINYINT(1) NULL,
        INDEX (`item_id`)) ENGINE = InnoDB";
        $db->query($sql);
        
          $sql = "
        CREATE TABLE IF NOT EXISTS `$db->Howdy` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `item_id` BIGINT UNSIGNED NOT NULL,
        `req_id`  BIGINT UNSIGNED NOT NULL,
        `howdy` TINYINT(1) NULL,
        INDEX (`item_id`)) ENGINE = InnoDB";
        //FOREIGN KEY (`id_hello`)
        //REFERENCES `$db->Hello->getColumns`) ENGINE = InnoDB";
        $db->query($sql);
}
public function hookUninstall(){
		$db = get_db();
		$sql = "DROP TABLE IF EXISTS `$db->Howdy`";
		$db->query($sql);
		$sql = "DROP TABLE IF EXISTS `$db->Hello`";
		$db->query($sql);
}        

public function hookAdminHead($args){
		 queue_css_file('omeka_css');
		 
}
public function hookPublicHead($args){
		 queue_css_file('omeka_css');
		 
}
        
public function hookPublicItemsShow($args) {
	echo "HELLO!";
}
        
//protected function _Admin_Nav_Message($item){
//echo "<div class='test'>Here is where my code will go.</div>";
//}
}
