<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadfile extends Model
{
    use HasFactory;
    protected $table = 'uploadfile';
    protected $fillable = ['upload_name','upload_path','id_user'];
    protected $primaryKey = 'id_upload';

}
