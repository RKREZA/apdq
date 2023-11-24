<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'size', 'type', 'path', 'uploaded_from'];


    public function notice()
    {
        return $this->belongsToMany('Modules\Notice\Entities\Notice')->withPivot('file_id','notice_id');
    }

    public function email()
    {
        return $this->belongsToMany('Modules\Email\Entities\Email')->withPivot('file_id','email_id');
    }
}
