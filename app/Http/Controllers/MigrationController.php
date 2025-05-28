<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function runAll(Request $request)
    {
        if ($request->key !== 'secret-key') {
            abort(403, 'Unauthorized.');
        }

        Artisan::call('migrate', ['--force' => true]);

        return response()->json([
            'status' => true,
            'message' => 'All migrations run successfully.',
            'output' => Artisan::output()
        ]);
    }

    public function runSpecific(Request $request)
    {
        $path = $request->path;

        if (!$path || !file_exists(base_path($path))) {
            return response()->json([
                'status' => false,
                'message' => 'Migration file not found.'
            ]);
        }

        try {
            Artisan::call('migrate', [
                '--path' => $path,
                '--force' => true
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Specific migration executed.',
                'output' => Artisan::output()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error running migration.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
