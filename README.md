magento_get_all_customers
=========================

[Created by Boson](http://www.bosonhuang.com)

Get all customer details from your Magento store.

Output is in table format, including Customer ID, Customer Name, Customer Email, Customer Create Date, Customer Group and other customized customer attribute based on [Custom Attribute Manager](http://www.magentocommerce.com/magento-connect/customer-information-collection-using-customer-attributes.html)

Need help? Email [Boson](mailto:boson@bosonhuang.com)

USAGE
=====

1. Put this script to root of you Magento installation folder.
2. Run file in browser: http://www.yourStoreURL.com/getCustomers.php
3. Put attribute name to (Array type) `$headArray` for output table head row elements. Search `$headArray` for 1st result.
4. Put associated product attribute values to (Array type) `$itemArray` for output content. Search `$itemArray` for 2nd result.

$headArray will be displayed:
-----------------------------

    '#',
    'Customer ID',
    'Customer First Name',
    'Customer Last Name',
    'Customer Email',
    'Member Since',
    'Customer Group',
    'Is Active?',
    'Company Name',
    'ABN',
    'Landlines Number',
    'Mobile Number',
    'Business Type'

Custom customer attributes:
---------------------------

    'Company Name',
    'ABN',
    'Landlines Number',
    'Mobile Number',
    'Business Type'

These attributes are created fro Australian Business.

Install this extension via:
- Get on Magento Connect & search for `Customer Information collection using Customer Attributes`
- Using Magento Downloader - `http://connect20.magentocommerce.com/community/Custom_Attributemanager`

Installed extension will be listed as `Custom_Attributemanager` in Package Name


Table to be displayed in similar format:
----------------------------------------

    # | Customer ID | Customer First Name | Customer Last Name | Customer Email | Member Since | Customer Group | Is Active? | Company Name | ABN | Landlines Number | Mobile Number | Business Type
    --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | ---
