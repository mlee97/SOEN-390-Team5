<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{

    /**
     * Redirects to log management view.
     */
    public function goToLogManagement(Request $request)
    {
        $logs = Log::all()->sortByDesc('created_at');

        $msg_str = 'Logging page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
             ]);

        return view('Logging.log-page', ['logs' => $logs]);
    }

    /**
     * Exports the log table in a CSV file.
     */
    public function exportLogsCSV(Request $request)
    {
        $fileName = 'logs'.date('Y_m_d_H_i_s').'.csv';
        $logs = Log::all()->sortByDesc('created_at');

        // Name of the headers in the CSV file.
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // Name of the columns in the CSV file.
        $columns = array('Type', 'Timestamp', 'User', 'IP Address', 'Message', 'Request Type');

        $callback = function() use($logs, $columns) {
            
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logs as $log) {
                $row['Type']  = $log->log_type;
                $row['Timestamp'] = $log->created_at;
                $row['User'] = strlen($log->user_id) > 0 ? DB::table('users')->where('id',$log->user_id)->value('email') : "N/A";
                $row['IP Address']  = $log->ip_address;
                $row['Message']  = $log->message;
                $row['Request Type']  = $log->request_type;

                fputcsv($file, array($row['Type'], $row['Timestamp'], $row['User'], $row['IP Address'], $row['Message'], $row['Request Type']));
            }
            fclose($file);
        };

        $msg_str = 'System logs exported as CSV with filename "' . $fileName . '"';
        
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
             ]);

        return response()->stream($callback, 200, $headers);
    }

    //function to convert logs to html
    function convert_logs_to_html()
    {
        //$logs: variable that returns all the logs in logs table and sorts them in descending order of created time
        $logs = Log::all()->sortByDesc('created_at'); 

        //$output below defines a table in html format and identifies the header of each column 
        $output = '
        <h3 align="center">Logs in PDF format</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <th style="border: 1px solid; padding:1px;" width="10%">Type</th>
        <th style="border: 1px solid; padding:1px;" width="20%">TimeStamp</th>
        <th style="border: 1px solid; padding:1px;" width="10%">IP Address</th>
        <th style="border: 1px solid; padding:1px;" width="20%">Message</th>
        <th style="border: 1px solid; padding:1px;" width="20%">Request Type</th>
        </tr>
        ';  

        //this fills each row of the table with the specified elements from the logs table in each respective column
        foreach($logs as $log) {
            $output .= '
            <tr>
            <td style="border: 1px solid; padding:1px;">'.$log->log_type.'</td>
            <td style="border: 1px solid; padding:1px;">'.$log->created_at.'</td>
            <td style="border: 1px solid; padding:1px;">'.$log->ip_address.'</td>
            <td style="border: 1px solid; padding:1px;">'.$log->message.'</td>
            <td style="border: 1px solid; padding:1px;">'.$log->request_type.'</td>
            </tr>
            ';
        }
        //this returns the table
        $output .= '</table>';
        return $output;
    }

    //pdf function to converts the html table above to pdf using a PDF plugin called domPDF that was added with composer 
    //$pdf will first make a pdf '$pdf = \App::make('dompdf.wrapper');', then use the conversion function above '$pdf-> loadHTML($this->convert_logs_to_html());' for the content in the PDF
    //and finally return the pdf 'return $pdf->stream();'
    function exportLogsPDF(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_logs_to_html());
        $fileName = 'logs'.date('Y_m_d_H_i_s').'.pdf';
        
        $msg_str = 'System logs exported as PDF';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
             ]);
      
        return $pdf->download($fileName);
    }
}
