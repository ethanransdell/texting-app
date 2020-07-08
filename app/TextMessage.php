<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TextMessage
 *
 * @property int                             $id
 * @property string                          $message_id
 * @property string                          $to
 * @property string                          $from
 * @property string                          $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TextMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TextMessage extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
