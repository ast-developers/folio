<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/4/15
 * Time: 9:07 PM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timelog';

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }
}