<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Student extends Model //because of this extends Models we can use eloquent methods like :all(), :find() //how does it know for which model which DB? -> Model: Student = table : Students
{
    protected $fillable = [ //Mass assignment through operations such as create() and update().
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
    ];

    protected function casts(): array //in StudentResource.php We can use format() there because we have converted date_of_birth into a date object using casts() 
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    protected function age(): Attribute //age is accessor (custom calculated attribute) so, we don't need age col separtely in table, //In student resource this.age -> 'age' => $this->age works as it comes there from here
    {
        return Attribute::get(
            fn () => $this->date_of_birth?->age
        );
    }
}
