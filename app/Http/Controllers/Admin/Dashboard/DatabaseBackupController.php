<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Brand;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DatabaseBackupController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:database-backups.view', ['only' => ['index']]);
        $this->middleware('permission:database-backups.download', ['only' => ['download']]);
        $this->middleware('permission:database-backups.create', ['only' => ['backup']]);
        $this->middleware('permission:database-backups.delete', ['only' => ['destroy']]);
    }

    public function index(): Response|ResponseFactory
    {
        // Get backup files
        $backupFiles = Storage::disk('local')->allFiles('Multi Seller E-commerce Platform');

        // Process backup files
        $backups = collect($backupFiles)->map(function ($file) {
            return [
                'filename' => basename($file),
                'date' => Carbon::createFromTimestamp(Storage::disk('local')->lastModified($file))->format('j-F-Y ( g:i:s ) A'),
                'location' => 'Local',
                'size' => FormatHelper::humanReadableFilesize(Storage::disk('local')->size($file)),
            ];
        });

        // Disk information
        $disk = 'local';
        $diskHealth = $this->checkDiskHealth($disk);

        // Overall information
        $totalBackupStorage = collect($backupFiles)->sum(function ($file) {
            return Storage::disk('local')->size($file);
        });

        $overAllInformation = [
            'disk' => $disk,
            'health' => $diskHealth,
            'amountOfBackups' => count($backups),
            'usedBackupStorage' => FormatHelper::humanReadableFilesize($totalBackupStorage),
            'lastTimeBackup' => Carbon::createFromTimestamp(Storage::disk('local')->lastModified(end($backupFiles)))->diffForHumans()
        ];

        // Paginator
        $perPage = request('per_page', 5);
        $currentPage = request('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedBackups = array_slice($backups->all(), $offset, $perPage, true);

        $backupsPaginated = new LengthAwarePaginator(
            $paginatedBackups,
            count($backups),
            $perPage,
            $currentPage,
            [
                'path' => route('admin.database-backups.index', ["per_page" => $perPage]),
                "pageName" => "page"
            ]
        );

        return inertia('Admin/DatabaseBackup/Index', compact('backupsPaginated', 'overAllInformation'));
    }

    private function checkDiskHealth(string $disk): string
    {
        // Check if the disk is reachable
        if (Storage::disk($disk)->exists('/')) {
            $freeSpace = disk_free_space(Storage::disk($disk)->path('/'));
            $totalSpace = disk_total_space(Storage::disk($disk)->path('/'));

            $thresholdPercentage = 10; // For example, 10%

            $freeSpacePercentage = ($freeSpace / $totalSpace) * 100;

            return ($freeSpacePercentage >= $thresholdPercentage) ? 'Healthy' : 'Not Healthy';
        }

        return 'Not Reachable';
    }

    public function destroy(Request $request, string $file): RedirectResponse
    {
        Storage::disk("local")->delete("Multi Seller E-commerce Platform/{$file}");

        return to_route('admin.database-backups.index', $this->getQueryStringParams($request))->with('success', 'Backup file deleted successfully');
    }

    public function backup(Request $request): RedirectResponse
    {
        try {
            Artisan::call('backup:run');

        } catch (Exception $e) {
            return to_route('admin.database-backup.index')->with('error', 'Backup failed: ' . $e->getMessage());
        }

        return to_route('admin.database-backups.index', $this->getQueryStringParams($request))->with('success', 'Backup completed successfully');
    }

    public function download(Request $request, string $file): BinaryFileResponse|RedirectResponse
    {
        $filePath = "Multi Seller E-commerce Platform/{$file}";

        try {
            if (Storage::disk('local')->exists($filePath)) {
                return response()->download(storage_path("app/{$filePath}"), $file, [
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' => 'attachment; filename=' . $file,
                ]);
            } else {
                to_route('admin.database-backups.index', $this->getQueryStringParams($request))->with('error', 'Backup file not found');
            }
        } catch (\Exception $e) {
            to_route('admin.database-backups.index', $this->getQueryStringParams($request))->with('error', 'Download failed: ' . $e->getMessage());
        }

    }

}
