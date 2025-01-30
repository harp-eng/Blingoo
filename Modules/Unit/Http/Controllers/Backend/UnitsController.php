<?php

namespace Modules\Unit\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class UnitsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Units';

        // module name
        $this->module_name = 'units';

        // directory path of the module
        $this->module_path = 'unit::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Unit\Models\Unit";
    }

}
