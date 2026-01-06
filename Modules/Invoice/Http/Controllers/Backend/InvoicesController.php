<?php

namespace Modules\Invoice\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class InvoicesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Invoices';

        // module name
        $this->module_name = 'invoices';

        // directory path of the module
        $this->module_path = 'invoice::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Invoice\Models\Invoice";
    }

}
