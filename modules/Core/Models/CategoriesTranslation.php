<?php

namespace Modules\Core\Models;



use App\BaseModel;



class CategoriesTranslation extends BaseModel

{

    protected $table = 'bravo_attrs_translations';

    protected $fillable = [

        'name',

    ];

}