<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolios extends Model
{
    use HasFactory;

    protected $table = 'dbo.portfolios';
    protected $primaryKey = 'id_portf';
    protected $fillable = ['title', 'description', 'image', 'dateCreate', 'lastUpdate'];
    public $timestamps = false;

    public function formatdateCreate() {
        return is_null($this->dateCreate) ? '-' : date('d/M/Y H:i', strtotime($this->dateCreate));
    }
    
    public function formatlastUpdate() {
        return is_null($this->lastUpdate) ? '-' : date('d/M/Y H:i', strtotime($this->lastUpdate));
    }
}
