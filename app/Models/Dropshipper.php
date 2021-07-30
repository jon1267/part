<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//class Dropshipper extends Model
class Dropshipper extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'dropshippers';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $hidden = ['pass', 'remember_token',];

    public function getAuthPassword()
    {
        return $this->pass;
    }
}
