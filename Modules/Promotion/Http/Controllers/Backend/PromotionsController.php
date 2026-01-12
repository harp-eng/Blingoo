<?php

namespace Modules\Promotion\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class PromotionsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Promotions';

        // module name
        $this->module_name = 'promotions';

        // directory path of the module
        $this->module_path = 'promotion::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Promotion\Models\Promotion";
    }

}
