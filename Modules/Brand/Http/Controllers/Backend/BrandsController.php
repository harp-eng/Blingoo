<?php

namespace Modules\Brand\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class BrandsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Brands';

        // module name
        $this->module_name = 'brands';

        // directory path of the module
        $this->module_path = 'brand::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Brand\Models\Brand";
    }

}
