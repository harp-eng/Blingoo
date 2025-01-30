<?php

namespace Modules\SubscriptionPlan\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class SubscriptionPlansController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'SubscriptionPlans';

        // module name
        $this->module_name = 'subscriptionplans';

        // directory path of the module
        $this->module_path = 'subscriptionplan::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\SubscriptionPlan\Models\SubscriptionPlan";
    }

}
