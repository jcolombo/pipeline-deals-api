<?php

/* Include this file if you do not have an auto-loading class model in place. This
 * file simply includes all the required classes for the API bundle.
 *
 * If using autoloading techniques, the library uses the Zend Naming conventions
 * and the "PipelineDeals" package can just be dropped in your autoload system
 */

$object_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'PipelineDeals'.DIRECTORY_SEPARATOR;

require_once($object_path.'Queue.php');
require_once($object_path.'BaseAbstract.php');
require_once($object_path.'RequestAbstract.php');
require_once($object_path.'EntityAbstract.php');
require_once($object_path.'Connection.php');
require_once($object_path.'Deals.php');
require_once($object_path.'Deal.php');
require_once($object_path.'Companies.php');
require_once($object_path.'Company.php');
require_once($object_path.'People.php');
require_once($object_path.'Person.php');
require_once($object_path.'Notes.php');
require_once($object_path.'Note.php');
require_once($object_path.'Documents.php');
require_once($object_path.'Document.php');
require_once($object_path.'Comments.php');
require_once($object_path.'Comment.php');
