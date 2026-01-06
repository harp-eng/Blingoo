<?php

namespace Modules\Tax\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class TaxesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Taxes';

        // module name
        $this->module_name = 'taxes';

        // directory path of the module
        $this->module_path = 'tax::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Tax\Models\Tax";
    }

}
