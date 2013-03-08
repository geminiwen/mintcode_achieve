<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'excel_reader2.php';
class Timeline extends CI_Controller {

	function __construct()
	{
		parent :: __construct();
		session_start();
	}

	public function upload() {
		$path = "./upload/tempfile.xls";
		$data = file_get_contents('php://input'); 	
		$success = file_put_contents($path, $data);
		do {
			if( $success === FALSE ) {
				echo 'failed';
			}
		
			$success = $this->deal_with_excel($path);

		} while( false );
	}

	private function deal_with_excel($filename) {
		$affcted_rows = 0;
		$data = new Spreadsheet_Excel_Reader($filename);
		$row_count = $data->rowcount();
		$timeline_array = array();
		for( $i = 2; $i <= $row_count; $i++ ) {
			$name = $data->val($i,1);
			$datetime_string = $data->val($i,2);

			$kind = 0;
			//echo "content :" . $name . "at " . $datetime. "\n";
			$datetime = DateTime::createFromFormat("Y/m/d G:i:s",$datetime_string);

			$office_time_hour = (int)$datetime->format("G");

			$office_time_minute = (int)$datetime->format("i");

			$office_time_second = (int)$datetime->format("s");

			$flag = false;
			if($office_time_hour < 6) {
				$flag = true;
				$datetime->sub(new DateInterval("P1D"));
			}

			$office_date = $datetime->format("Y-m-d");

			// if work after 24:00;
			if( $flag ) {
				$office_time_hour += 24;
			}

			if( $office_time_hour >= 12 )  {
				$kind = 1;
			} else {
				$kind = 0;
			}

			$office_time = vsprintf("%02d:%02d:%02d",array($office_time_hour,$office_time_minute,$office_time_second));

			$timeline_data = array(
								'kind' => $kind,
								'time' => $office_time,
								'date' => $office_date,
								'username' => $name
								);

			$this->load->model("Timeline_model");
			array_push($timeline_array,$timeline_data);
			
			
			
		}
		
		$affcted_rows += $this->Timeline_model->insert_timeline($timeline_array);
		header("Content-Type: application/json; charset=utf-8");
		$result_data = array();
		if( $affcted_rows === 0 ) {
			$result_data['result'] = FALSE;
		} else {
			$result_data['result'] = TRUE;
			$result_data['count']  = $affcted_rows;
		}
		echo json_encode($result_data);
		
	}


}