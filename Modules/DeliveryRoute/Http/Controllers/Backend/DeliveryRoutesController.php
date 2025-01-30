<?php

namespace Modules\DeliveryRoute\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class DeliveryRoutesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'DeliveryRoutes';

        // module name
        $this->module_name = 'deliveryroutes';

        // directory path of the module
        $this->module_path = 'deliveryroute::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\DeliveryRoute\Models\DeliveryRoute";
    }

}
