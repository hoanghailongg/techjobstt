<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'level',
        'salary_start',
        'salary_end',
        'experience',
        'languages',
        'gender',
        'content',
        'state',
        'size',
        'date_end',
        'city_id',
        'company_id',
        'count',
        'is_active',
    ];

    protected function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    protected function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function getLanguageAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setLanguageAttribute($value)
    {
        $this->attributes['languages'] = json_encode($value);
    }

    public function getLanguageNamesAttribute()
    {
        $languageIds = $this->getLanguageAttribute($this->languages);
        $languages = Language::whereIn('id', $languageIds)->pluck('name');
        return $languages->implode(', ');
    }

    protected function scopeActive($query)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        return $query->where('is_active', '=', 1)
            ->where('date_end', '>=', $currentDate);
    }
}
