<?php

namespace Newelement\Faqs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Newelement\Searchable\SearchableTrait;

class FaqGroup extends Model
{
    use SoftDeletes, SearchableTrait;

    protected $searchable = [
        'columns' => [
            'faqs.title' => 10,
            'faqs.answer' => 10,
            'faqs.keywords' => 5,
            'faq_groups.title' => 5,
        ],
        'joins' => [
            'faqs' => ['faq_groups.id','faqs.faq_group_id'],
        ],
    ];

    public function faqs()
    {
        return $this->hasMany('\Newelement\Faqs\Models\Faq');
    }
}
