<?php

namespace App\Models;

use App\Models\Traits\Listable;
use App\Models\Traits\Sortable;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use Listable, Sortable;

    protected static $allowSortFields = ['name', 'display_name', 'order'];
    protected static $allowSearchFields = ['name', 'display_name', 'description'];
}
