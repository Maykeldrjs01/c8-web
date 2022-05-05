<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlastSubscribers extends Model
{
    use HasFactory;

    /* Disable timestamps in blast subscribers table
     *
     */

    public $timestamps = false;

    protected $fillable = [
        'GROUP_ID',
        'NAME',
        'SUBSCRIBER_NUMBER',
        'TOKEN',
    ];
}
