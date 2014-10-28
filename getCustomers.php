<?php
/*
 *
 * NOTICE OF LICENSE
 *
 * There is no license at all. Free to use.
 * Credit to Boson @ bosonhuang.com
 *
 *
 * USAGE
 *
 * This script generates table-viewed all categories output on screen.
 * 
 * 1. Put this file to root of your Magento installation folder.
 * 2. Put attribute name to(Array type) $headArray for output table head row elements.
 *    Search '$headArray' for 1st result.
 * 3. Put associated product attribute values to(Array type) $itemArray for output content.
 *    Search '$itemArray' for 2nd result.
 * 4. DO NOT CHANGE OR MODIFY OTHER CODES.
 * 
 */

// define Magento root path & get Mage class
define('MAGENTO', realpath(dirname(__FILE__)));
require_once MAGENTO . '/app/Mage.php';
Mage::app();

umask(0);

// get customer collection
$customers  = mage::getModel('customer/customer')->getCollection();

if($customers) {
  /*
   * Define table output head row elements
   *
   * @var array
   */
  $headArray = array(
    '#',
    'Customer ID',
    'Customer First Name',
    'Customer Last Name',
    'Customer Email',
    'Member Since',
    'Customer Group',
    'Is Active?',
    
    /*
     * Attributes below are custom customer attributes
     * They are not default Magento customer attributes
     * These attributes are for Australian Business
     */
    'Company Name',
    'ABN',
    'Landlines Number',
    'Mobile Number',
    'Business Type'
  );
  
  $itemArray = array();
  $index     = 1;
  
  foreach($customers as $customer) {
    
    // load customer data, @var array
    $cData   = Mage::getModel('customer/customer')->load($customer->getId())->getData();
    
    $customerArray = array(
      $index,
      $cData['entity_id']             ? $cData['entity_id']                  : '',
      $cData['firstname']             ? $cData['firstname']                  : '',
      $cData['lastname']              ? $cData['lastname']                   : '',
      $cData['email']                 ? $cData['email']                      : '',
      $cData['created_at']            ? convertDate($cData['created_at'])    : '',
      $cData['group_id']              ? getCustomerGroup($cData['group_id']) : '',
      $cData['is_active'] == 1        ? 'Yes'                                : 'No',
      
      /*
       * Attributes below are custom customer attributes
       * They are not default Magento customer attributes
       * These attributes are for Australian Business
       */
      $cData['company_name']          ? $cData['company_name']               : '',
      $cData['abn_number']            ? $cData['abn_number']                 : '',
      $cData['company_landline']      ? $cData['company_landline']           : '',
      $cData['company_mobile_number'] ? $cData['company_mobile_number']      : '',
      $cData['business_type']         ? $cData['business_type']              : ''
    );
    
    // add each product output array to table content row array
    array_push($itemArray, $customerArray);
    
    $index++;
  }
  
  // output configurable product table
  echo getTable($headArray, $itemArray);
}


/*
 * Retrieve customer group name
 *
 * @param string $groupID - customer group id number
 * @return string
 */
function getCustomerGroup($groupID) {
  return Mage::getModel('customer/group')->load($groupID)->getCustomerGroupCode();
}


/*
 * Convert full date string to dd-Mon-YYYY format
 *
 * @param string $dateString - customer create date
 * @return string
 */
function convertDate($dateString) {
  return date('d-M-Y', strtotime($dateString));
}


/*
 * Generate table output
 *
 * @param array $headArray - table head elements
 * @param array $itemArray - table content elements
 * @return string
 */
function getTable($headArray, $itemArray) {
  $countHead   = itemCount($headArray);
  $countItem   = itemCount($itemArray);
  $tableString = '<table>';
  
  for($i = 0; $i < $countHead; $i++) {
    $tableString .= '<col width="auto">';
  }
  
  if($countHead > 0 && $countItem > 0) {
    $tableString .= getTableRow($headArray, 'th', $countHead);
    $tableString .= getTableRow($itemArray, 'td', $countHead);
  } else
    $tableString .= getTableRow(array());
  
  $tableString .= '</table>';
  
  return $tableString;
}


/*
 * Generate table rows output
 *
 * @param array $arrayList - table row elements
 * @param String $flag     - table row HTML tags
 * @param int $arrayCount  - table row elements size
 * @return string
 */
function getTableRow($arrayList, $flag = '', $arrayCount = 0) {
  if(empty($flag)) {
    $startTag = '<td align="right">';
    $endTag   = '</td>';
  } elseif($flag === 'th') {
    $startTag = '<th align="right">';
    $endTag   = '</th>';
  } elseif($flag === 'td') {
    $startTag = '<td align="right">';
    $endTag   = '</td>';
  }
  
  $tableHeadString = '';
  // output table head
  if(itemCount($arrayList) == $arrayCount) {
    $tableHeadString .= '<tr>';
    foreach($arrayList as $arrayItem) {
      $tableHeadString .= $startTag . $arrayItem . $endTag;
    }
    $tableHeadString .= '</tr>';
  }
  // output table content
  else {
    foreach($arrayList as $listItem) {
      $tableHeadString .= '<tr>';
      if(itemCount($listItem) == $arrayCount) {
        foreach($listItem as $item) {
          $tableHeadString .= $startTag . $item . $endTag;
        }
      }
      $tableHeadString .= '</tr>';
    }
  }
  
  return $tableHeadString;
}


/*
 * count row element size
 *
 * @param array $arrayList - table row elements
 * @return int
 */
function itemCount($arrayList) {
  if(is_array($arrayList) && !empty($arrayList))
    return count($arrayList);
  else
    return 0;
}
