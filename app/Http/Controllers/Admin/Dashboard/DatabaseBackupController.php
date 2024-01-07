<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DatabaseBackupController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $backupFiles = Storage::disk('local')->allFiles('Multi Seller E-commerce Platform');

        $backups = collect($backupFiles)->map(function ($file) {
            return [
                'filename' => basename($file),
                'date' => Carbon::parse(now())->format('j-F-Y ( g:i:s ) A'),
                'location' => 'Local',
                'size' => FormatHelper::humanReadableFilesize(Storage::disk('local')->size($file)),
            ];
        });

        return inertia('Admin/DatabaseBackup/Index', compact('backups'));
    }

    public function destroy(string $file): RedirectResponse
    {
        Storage::disk("local")->delete("Multi Seller E-commerce Platform/{$file}");

        return to_route('admin.database-backups.index')->with('success', 'Backup file deleted successfully');
    }

    public function backup(): RedirectResponse
    {
        try {
            Artisan::call('backup:run');

        } catch (Exception $e) {
            return to_route('admin.database-backup.index')->with('error', 'Backup failed: ' . $e->getMessage());
        }

        return to_route('admin.database-backups.index')->with('success', 'Backup completed successfully');
    }

    public function download(string $file)
    {
        $filePath = "Multi Seller E-commerce Platform/{$file}";

        try {
            if (Storage::disk('local')->exists($filePath)) {
                return response()->download(storage_path("app/{$filePath}"), $file, [
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' => 'attachment; filename=' . $file,
                ]);
            } else {
                return redirect()->route('admin.database-backups.index')->with('error', 'Backup file not found');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.database-backups.index')->with('error', 'Download failed: ' . $e->getMessage());
        }
    }

}
