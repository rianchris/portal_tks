
<?php

namespace App\Http\Controllers;

use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\Drawer\Utils;

class LivewireFilePreviewController extends Controller
{
    public function handle($filename)
    {
        // Skip signature validation karena Hostinger memotong query string
        // Ganti dengan session auth check
        abort_unless(auth()->check(), 401);

        return Utils::pretendResponseIsFile($filename);
    }
}
