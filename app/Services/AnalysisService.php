<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;

class AnalysisService
{
    public static function perDay($subQuery)
    {
        $query = $subQuery->where('status', true)->
        groupBy('id')->
        selectRaw('SUM(subtotal) AS totalPerPurchase, DATE_FORMAT(created_at, "%Y%m%d") AS date');

        $data = DB::table($query)->orderBy('date')->
        groupBy('date')->selectRaw('date, sum(totalPerPurchase) as total')->get();

        $labels = $data->pluck('date');
        $totals = $data->pluck('total');

        return [
            $data, $labels, $totals,
        ];
    }

    public static function perMonth($subQuery)
    {
        $query = $subQuery->where('status', true)->
        groupBy('id')->
        selectRaw('SUM(subtotal) AS totalPerPurchase, DATE_FORMAT(created_at, "%Y%m") AS date');

        $data = DB::table($query)->orderBy('date')->
        groupBy('date')->selectRaw('date, sum(totalPerPurchase) as total')->get();

        $labels = $data->pluck('date');
        $totals = $data->pluck('total');

        return [
            $data, $labels, $totals,
        ];
    }

    public static function perYear($subQuery)
    {
        $query = $subQuery->where('status', true)->
        groupBy('id')->
        selectRaw('SUM(subtotal) AS totalPerPurchase, DATE_FORMAT(created_at, "%Y") AS date');

        $data = DB::table($query)->orderBy('date')->
        groupBy('date')->selectRaw('date, sum(totalPerPurchase) as total')->get();

        $labels = $data->pluck('date');
        $totals = $data->pluck('total');

        return [
            $data, $labels, $totals,
        ];
    }
}