<?php //Inside Resources, controls only what student information we return to the client (Postman, mobile application) //Requests = incomming, Resources = outgoing

namespace App\Http\Resources; //registering the class

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array //  :array = return type , toArray() converts studentObj to php array and while returning converting that to JSON
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'age' => $this->age,
        ];
    }
}