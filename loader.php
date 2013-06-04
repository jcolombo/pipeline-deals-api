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
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'Account.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'CustomFieldLabel.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'CustomFieldDropdownOption.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'NoteCategory.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'PredefinedContactsTag.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'DealStage.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'LeadSource.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'LeadStatus.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'EventCategory.php');
require_once($object_path.'Admin'.DIRECTORY_SEPARATOR.'User.php');

