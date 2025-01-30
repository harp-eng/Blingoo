<?php

namespace Modules\DeliveryTimeSlot\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class DeliveryTimeSlotsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'DeliveryTimeSlots';

        // module name
        $this->module_name = 'deliverytimeslots';

        // directory path of the module
        $this->module_path = 'deliverytimeslot::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\DeliveryTimeSlot\Models\DeliveryTimeSlot";
    }

}
