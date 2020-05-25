<?php

namespace Newelement\Faqs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Newelement\Searchable\SearchableTrait;

class Faq extends Model
{
    use SoftDeletes, Sortable, SearchableTrait;

    public $sortable = [
        'title',
        'helpful',
        'not_helpful',
        'faq_groups_id',
        'sort'
    ];

    protected $searchable = [
        'columns' => [
            'title' => 10,
            'answer' => 10,
            'keywords' => 8
        ]
    ];

    public function group()
    {
        return $this->hasOne('\Newelement\Faqs\Models\FaqGroup', 'id', 'faq_group_id');
    }

    public function helpfulVotes()
    {
        return $this->hasMany('\Newelement\Faqs\Models\FaqVote')->selectRaw('SUM(faq_votes.helpful) as total');
    }

    public function notHelpfulVotes()
    {
        return $this->hasMany('\Newelement\Faqs\Models\FaqVote')->selectRaw('SUM(faq_votes.not_helpful) as total');
    }
}
