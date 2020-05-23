<?php

namespace Newelement\Faqs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqGroup extends Model
{
    use SoftDeletes;

    public function faqs()
    {
        return $this->hasMany('\Newelement\Faqs\Models\Faq');
    }
}
