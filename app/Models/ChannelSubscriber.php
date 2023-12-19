<?php

// app/Models/ChannelSubscriber.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelSubscriber extends Model
{
    protected $fillable = ['user_id', 'channel_name'];
}
