<?php

namespace App\Http\Controllers;

use Livewire\Drawer\Utils;

class LivewireFilePreviewController extends Controller
{
    public function handle($filename)
    {
        abort_unless(auth()->check(), 401);
        return Utils::pretendPreviewResponseIsPreviewFile($filename);
    }
}
