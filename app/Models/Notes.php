<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class Notes extends Model
{
    use HasFactory;    

    protected $fillable = ['title', 'note', 'importance'];

    /* public function setNotesAtribute($value)
    {
        $this->attributes['encrypted_notes'] = Crypt::encryptString($value);
    }

    public function getNotesAttributes()
    {
        return Crypt::decryptString($this->attributes['encrypted_notes']);
    } */

    /*  public function getCreatedAtAttribute($date)   // NOTE musí být přesně - getCreatedAt = created_at column
    {
        return Carbon::parse($date)->format('d M Y H:i:s e');
    }  */
 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
