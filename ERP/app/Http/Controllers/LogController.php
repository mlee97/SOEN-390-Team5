<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function goToLogManagement()
    {
        $logs = Log::all()->sortByDesc('created_at');
        return view('Logging.log-page', ['logs' => $logs]);
    }

    public function exportLogs(Request $request){

        $fileName = 'logs'.date('Y_m_d_H_i_s').'.csv';
        $logs = Log::all()->sortByDesc('created_at');

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

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

        return response()->stream($callback, 200, $headers);

    }

    //functions to create PDF
    function get_logs()
    {
     $logs = DB::table('logs')
         ->limit(10)
         ->get();
     return $logs;
    }

    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_logs_to_html());
     return $pdf->stream();
    }

    function convert_logs_to_html()
    {
     $logs = $this->get_logs();
     $output = '
     <h3 align="center">logs</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
      <th style="border: 1px solid; padding:12px;" width="10%">Type</th>
      <th style="border: 1px solid; padding:12px;" width="20%">TimeStamp</th>
      <th style="border: 1px solid; padding:12px;" width="20%">IP Address</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Message</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Request Type</th>
      </tr>
      ';  

     foreach($logs as $log)
        {
        $output .= '
        <tr>
        <td style="border: 1px solid; padding:12px;">'.$log->log_type.'</td>
        <td style="border: 1px solid; padding:12px;">'.$log->created_at.'</td>
        <td style="border: 1px solid; padding:12px;">'.$log->ip_address.'</td>
        <td style="border: 1px solid; padding:12px;">'.$log->message.'</td>
        <td style="border: 1px solid; padding:12px;">'.$log->request_type.'</td>
        </tr>
        ';
        }

     $output .= '</table>';
     return $output;
    }
}
