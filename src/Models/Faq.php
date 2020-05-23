<?php

namespace Newelement\Faqs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    public function group()
    {
        return $this->hasOne('\Newelement\Faqs\Models\FaqGroup');
    }
}
