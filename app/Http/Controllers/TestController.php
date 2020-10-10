<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\psychologicalcounseling;
use App\User;
class TestController extends Controller
{
    function getAllMonths(){
		$month_array = array();
		$posts_dates = User::orderBy( 'created_at', 'desc' )->pluck( 'created_at' );
		$posts_dates = json_decode( $posts_dates );
		if ( ! empty( $posts_dates ) ) {
			foreach ( $posts_dates as $unformatted_date ) {
				$date = new \DateTime( $unformatted_date );
				$month_no = $date->format( 'd' );
				$month_name = $date->format( 'D' );
				$month_array[ $month_no ] = $month_name;
			}
		}
		return $month_array;
	}
	function getMonthlyPostCount( $month ) {
		$monthly_post_count = User::whereDay( 'created_at', $month )->get()->count();
		return $monthly_post_count;
	}
	function getMonthlyPostData() {
		$monthly_post_count_array = array();
		$month_array = $this->getAllMonths();
		$month_name_array = array();
		if ( ! empty( $month_array ) ) {
			foreach ( $month_array as $month_no => $month_name ){
				$monthly_post_count = $this->getMonthlyPostCount( $month_no );
				array_push( $monthly_post_count_array, $monthly_post_count );
				array_push( $month_name_array, $month_name );
			}
		}
		$max_no = max( $monthly_post_count_array );
		$max = round(( $max_no + 10/2 ) / 10 ) * 10;
		$monthly_post_data_array = array(
			'months' => $month_name_array,
			'post_count_data' => $monthly_post_count_array,
			'max' => $max,
		);
		return $monthly_post_data_array;
    }
}