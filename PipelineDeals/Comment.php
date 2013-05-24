<?php
namespace PipelineDeals\Comment;

use PipelineDeals\EntityAbstract\PipelineDeals_EntityAbstract;

/**
 * Comment Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Comment extends PipelineDeals_EntityAbstract
{

    protected $object_key = 'comment';
    protected $note_id = null;

    public function __construct($id = null, PipelineDeals_Connection $pdc = null)
    {
        if (!is_null($id) && (!is_array($id) || count($id)!=2)) {
            // @todo throw error requiring the id to be a 2 element array with comment_id and note_id
            die("Comments require a two element array as an id if attempting to load through the API");
        }
        list($comment_id, $note_id) = $id;
        if (isset($id['note_id'])) { $note_id = $id['note_id']; }
        if (isset($id['comment_id'])) { $comment_id = $id['comment_id']; }
        if (isset($id['id'])) { $comment_id = $id['id']; }
        $this->setNoteId($note_id);
        parent::__construct($comment_id, $pdc);
    }

    public function setNoteId($note_id)
    {
        $this->note_id = $note_id;
    }

    /*
     * Load a comment from the API based on an ID property in the instance
     */
    public function load()
    {
        $this->data = $this->pdc->executeRequest("notes/{$this->note_id}/comments/{$this->id}", 'get');
    }

    public function loadFromEntry($entry_data)
    {
        parent::loadFromEntry($entry_data);
        $this->note_id = (int)$this->get('note_id');
    }

}