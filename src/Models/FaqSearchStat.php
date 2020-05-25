<?php

namespace Newelement\Faqs\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class FaqSearchStat extends Model
{
    use Sortable;

    public $sortable = [
        'query',
        'result_count',
        'faq_id'
    ];
}
