<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomesticBooking;
use App\Models\DomesticOrdersProducts;
use App\Models\DomesticRate;
use App\Models\PickupAddress;
use App\Models\PincodeMaster;
use App\Models\StackManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Exists;

class DomesticInvoice extends Controller
{
    //
}
