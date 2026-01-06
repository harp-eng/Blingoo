<?php

namespace Modules\Container\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class ContainersController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Containers';

        // module name
        $this->module_name = 'containers';

        // directory path of the module
        $this->module_path = 'container::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Container\Models\Container";
    }

}
