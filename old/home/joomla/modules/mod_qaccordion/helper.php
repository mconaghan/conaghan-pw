<?php

/**
 * Qlue Accordion
 *
 * @author Aaron Harding 
 * @package Qlue Accordion
 * @license GNU/GPL
 * @version 1.5.3
 *
 * QLUE Accordion will bring those dull articles to life in an instant. Just specify what category of articles you want to display and leave the rest up to QLUE Accordion. 
 * Your articles will display inside an accordion with smooth sliding effects whenever you want to read the content.
 */

//no direct access
defined('_JEXEC') or die('Restricted Access');

// Import joomla base library
JLoader::import('joomla.base.object');
JLoader::import('joomla.plugin.helper');

class QAccordion extends JObject {
    
  public $id = 0; 
  private $_params = null;
  private $_articles = null;
  
  public function __construct() {
    // Require article router helper file
    require_once(JPATH_ROOT.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
  }
  
  public static function getInstance($params) {
      
      static $instance;
      
      if(!isset($instance)) {
        $instance = new QAccordion();
      }
      
      // Update the id
      $instance->id++;
      
      // Update the params
      $instance->setParams($params);
      
      return $instance;
  }
  
  public function setParams($params) {
    $this->_params = $params;
  }
  
  public function getArticles() {
      
    // Get the database object
    $db =& JFactory::getDBO();
    
    // Create the query
    $query = $this->_buildQuery();
    
    // Set the query
    $db->setQuery($query, 0, (int)$this->_params->get('countItem', 5));
    
    // Get the data
    $articles = $db->loadObjectList();
    
    // Foreach article get SEF link
    foreach($articles as $key => $item) {
      $articles[$key]->href = ContentHelperRoute::getArticleRoute($item->slug, $item->catslug);
      $articles[$key]->text = JHtml::_('content.prepare', $item->text);
    }
    
    $this->_articles = $articles;
    
    return $this->_articles;
  }
  
  public function addScript() {
    // Load the mootools library if it hasn't already
    JHTML::_('behavior.mootools');
    
    // Get the document object
    $document =& JFactory::getDocument();
    
    // Create the decleration
    $opt = array();
    
    // Get hover parameter
    $hover = $this->_params->get('hover', 0);
    
    // Determine if we are adding a roll over event
    if( $hover ){
      $rollover = "$$('#qaccordion". (int)$this->id ." .acc-header').addEvent('mouseenter', function() { this.fireEvent('click'); });";
    } else {
      $rollover = '';
    }
    
    // Setup some accordion options
    $opt['display'] = (int)$this->_params->get('arrayId', 0);
    $opt['opacity'] = $this->_params->get('opacity', 1) ? '\\true' : '\\false';
    $opt['alwaysHide'] = $this->_params->get('alwaysHide', 0) ? '\\true' : '\\false';
    
    $opt['onActive'] = '\\function(toggle, element){toggle.setProperty("class", "acc-header-active");}';
    $opt['onBackground'] = '\\function(toggle, element){toggle.setProperty("class", "acc-header");}';
    
    $options = self::_getJSObject($opt);
    
    $script = 'window.addEvent( window.ie ? "load" : "domready", function() {';
    $script .= $rollover;
    $script .= 'new Fx.Accordion(".acc-header", ".acc-content", '. $options .');';
    $script .= '});';
    
    $document->addScriptDeclaration($script);
    
    return true;    
  }
  
  private function _buildQuery() {
      
    // Get the database object
    $db =& JFactory::getDBO();
    
    $date = JFactory::getDate();
    
    $now = $date->toMySQL();
    $nullDate = $db->getNullDate();
    
    // Get user object
    $user =& JFactory::getUser();
    
    // Find what group they are in
    $groups = implode(',', $user->getAuthorisedViewLevels());
    
    // Create query variable
    $query = $db->getQuery(true);
    
    // Clear the query
    $query->clear();
    
    // Select our items
    $query->select('a.title AS title, a.metadesc, a.metakey, a.created AS created, '
            .'a.introtext AS text, c.title AS section, '
            .'CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug, '
            .'CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(":", c.id, c.alias) ELSE c.id END as catslug, '
            .'"2" AS browsernav');
                
    // Where are we looking
    $query->from('#__content AS a');
    
    // Join our tables
    $query->innerJoin('#__categories AS c ON c.id = a.catid');
    
    // Set some WHERE values
    $query->where('('. $this->_buildWhere() .') AND a.state = 1 AND c.published = 1 AND a.access IN ('.$groups.') '
            .'AND c.access IN ('.$groups.') '
            .'AND (a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).') '
            .'AND (a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).')');
    
    // Group by article id
    $query->group('a.id');
    
    // What are we ordering by?
    $query->order($this->_buildOrder());

    // return the query
    return $query;
  }
  
  private function _buildWhere() {
          
    $where = array();
    $catId = (int)$this->_params->get('categoryId', 0);
    
    // Sanitize the cat ids array
    JArrayHelper::toInteger($catIds);
    
    $where[] = 'a.catid = '. (int)$catId;
    
    // Implode the where array to string
    $wheres = implode(' AND ', $where);
    
    return $wheres;  
  }
  
  private function _buildOrder() {
      
    switch($this->_params->get('orderBy', 'article')) {
      
      case 'alpha':
        $order = 'a.title ASC';
      break;
      
      case 'hits':
        $order = 'a.hits DESC';
      break;
      
      case 'modified':
        $order = 'a.modified DESC';
      break;
      
      case 'newest':
        $order = 'a.created DESC';
      break;
      
      case 'oldest':
        $order = 'a.created ASC';
      break;
      
      case 'category':
        $order = 'c.title ASC, a.title ASC';
      break;
      
      case 'article':
      default:
        $order = 'a.ordering ASC';
      break;
    }
    
    return $order;
  }
  
  private function _getJSObject($array=array()) {
  
  	// Initialize variables
	$object = '{';

	// Iterate over array to build objects
	foreach ((array)$array as $k => $v) {
		if (is_null($v)) {
			continue;
		}
		if (!is_array($v) && !is_object($v)) {
			$object .= ' '.$k.': ';
			$object .= (is_numeric($v) || strpos($v, '\\') === 0) ? (is_numeric($v)) ? $v : substr($v, 1) : "'".$v."'";
			$object .= ',';
		} else {
			$object .= ' '.$k.': '.self::_getJSObject($v).',';
		}
	}
	if (substr($object, -1) == ',') {
		$object = substr($object, 0, -1);
	}
	$object .= '}';

	return $object;
  }
  
}

?>