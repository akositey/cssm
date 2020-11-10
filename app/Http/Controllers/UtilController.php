<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use ZipArchive;

class UtilController extends Controller
{
    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        return Inertia::render('Tools/Export');
    }

    /**
     * @param Request $request
     */
    public function export(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'password' => 'required'
        ]);

        ini_set('max_execution_time', 600); //just in case the pc/server is slow

        if (!$request->month) {
            return redirect(route('home'))->with('error', 'please specify month');
        }

        # gather sql
        $dumpFile = 'dump.json';
        $comments = $signatures = [];
        $feedback = Feedback::where('created_at', 'like', $request->month . '%')->get()
            ->transform(function ($row) use (&$comments, &$signatures) {
                $comments[$row->id] = $row->comments_path ?? $row->comments_path;
                $signatures[$row->id] = $row->signature_path;

                return [
                    // 'id' => null,//can be omitted
                    'service_id' => $row->service_id,
                    'comments' => $row->comments,
                    'comments_path' => $row->comments_path,
                    'signature_path' => $row->signature_path,
                    'user_id' => $row->user_id,
                    'created_at' => $row->created_at->format("Y-m-d H:i:s"),
                    'updated_at' => $row->updated_at->format("Y-m-d H:i:s"),
                    'answers' => $row->answers->transform(function ($answer) {
                        return [
                            // 'feedback_id' => null,//can be omitted
                            'question_id' => $answer->question_id,
                            'answer' => $answer->answer,
                            'created_at' => $answer->created_at->format("Y-m-d H:i:s"),
                            'updated_at' => $answer->updated_at->format("Y-m-d H:i:s")
                        ];
                    })
                ];
            });
        # save json file
        Storage::put($dumpFile, $feedback->toJson());

        # gather images: signatures and comments
        $commentsToExport = [];
        foreach (Storage::files('comments') as $file) {
            if (in_array($file, $comments)) {
                $commentsToExport[] = $file;
            }
        }
        $signaturesToExport = [];
        foreach (Storage::files('signatures') as $file) {
            if (in_array($file, $signatures)) {
                $signaturesToExport[] = $file;
            }
        }

        //zip them
        $zipFileName = 'cssf_dump_' . $request->month . '.zip';
        Storage::delete($zipFileName); //delete if file exists
        $zip = new ZipArchive();
        $open = $zip->open($zipFileName, ZipArchive::CREATE);
        if ($open) {
            $zip->setPassword($request->month);
            $zip->addFile(Storage::path($dumpFile), 'feedback.json');
            $zip->setEncryptionName('feedback.json', ZipArchive::EM_AES_256);

            # add comment images
            foreach ($commentsToExport as $imageFilename) {
                $zip->addFile(Storage::path($imageFilename), $imageFilename);
            }

            # add signature images
            foreach ($signaturesToExport as $imageFilename) {
                $zip->addFile(Storage::path($imageFilename), $imageFilename);
            }

            # close zip file
            $zip->close();

            if (file_exists($zipFileName)) {
                $headers = array('Content-Type: application/zip', 'Content-Length: ' . filesize(Storage::path($imageFilename)));
                return response()->download($zipFileName, $zipFileName, $headers)->deleteFileAfterSend(true);
                // header("Content-Description: File Transfer");
                // header("Content-Type: application/octet-stream");
                // header('Content-Disposition: attachment; filename="' . $zipFileName);
                // header('Content-Length: ' . filesize(Storage::path($imageFilename)));
                // readfile($zipFileName);
            }

            return redirect(route("feedback.index"))->with("error", "Error! Did not succeed in creating archive :(");
        }
        return redirect(route("feedback.index"))->with("error", "Unable to open archive. Zip error code: $open.");

    }

    /**
     * @param Request $request
     */
    public function import(Request $request)
    {
        # import
        $origFilename = $request->file('file')->getClientOriginalName();
        $folder = explode(".", $origFilename)[0];
        $validFilename = preg_match('([0-9]{4}-[0-9]{2})', $origFilename, $matches);
        if (!$validFilename) {
            return redirect(route("feedback.index"))->with("error", "Invalid File.");
        }
        $password = $matches[0];
        // $password = explode("_", $folder)[2]; //old way

        $ctr = 0;

        $zip = new ZipArchive();
        $open = $zip->open($request->file('file'));
        if ($open === true) {
            $zip->setPassword($password);
            if ($zip->extractTo(Storage::path($folder))) {
                $json = Storage::get($folder . '/feedback.json');
                # read json file
                $entries = json_decode($json, true);
                foreach ($entries as $entry) {
                    # check if entry already exists
                    $count = Feedback::where('signature_path', $entry["signature_path"])->where('created_at', $entry["created_at"])->count();
                    if ($count === 0) {
                        $ctr++;
                        $feedback = Feedback::create($entry);
                        $feedback->answers()->createMany($entry["answers"]);
                    }
                }

            }
            $zip->close();
            # clean up
            Storage::deleteDirectory($folder);
            # response
            return redirect(route("feedback.index"))->with("success", "Successfully imported $ctr feedback entries");

        }

        return redirect(route("feedback.index"))->with("error", "Unable to open archive. Zip error code: $open.");
    }
}
