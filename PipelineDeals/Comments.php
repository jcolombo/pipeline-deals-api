<?php
namespace PipelineDeals\Comments;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Comment\PipelineDeals_Comment;
use PipelineDeals\Note\PipelineDeals_Note;

/**
 * Comment Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Comments extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Comment\PipelineDeals_Comment';
    protected $resource = 'notes/X/comments';
    protected $note_id = null;

    public function findByNote($note_id)
    {
        $this->note_id = $note_id;
        return $this->find();
    }

    public function countByNote($note_id)
    {
        $this->note_id = $note_id;
        return $this->count();
    }

    /*
     * Overload default count method to insure a note id was provided
     */
    public function count()
    {
        $hc = ($this->note_id > 0);
        if ($hc) {
            $this->resource = "notes/{$this->note_id}/comments";
            return parent::count();
        }
        return false;
    }

    /*
     * Overload default find method to insure a note id was provided
     */
    public function find()
    {
        $hc = ($this->note_id > 0);
        if ($hc) {
            $this->resource = "notes/{$this->note_id}/comments";
            return parent::find();
        }
        return false;
    }

}

