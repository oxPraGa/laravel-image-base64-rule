<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class ImageBase64 implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try{
            $extensions = array('jpg', 'jpeg', 'png');
            $data = explode('/',
                explode(':', substr($value, 0, strpos($value, ';')))[1]);
            if($data[0] == 'image' && in_array($data[1] , $extensions)){
                Image::make($value);
                return true;
            }
        }catch (\Exception $exception){
            return false;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be image';
    }
}
