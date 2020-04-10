<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DataTables;


class HomeController extends Controller
{
    public function index()
    {
        $client = new Client();
        $res = $client->get('https://api.covid19api.com/summary')->getBody();
        $summary = json_decode($res);

        $total_confirmed = 0;
        $total_deaths = 0;
        $total_recovered = 0;
        foreach ($summary->Countries as $country) {
            $total_confirmed += $country->TotalConfirmed;
            $total_deaths += $country->TotalDeaths;
            $total_recovered += $country->TotalRecovered;
        }

        return view('home', compact('total_confirmed', 'total_deaths', 'total_recovered'));
    }

    public function getAllCountries()
    {
        $client = new Client();
        $res = $client->get('https://api.covid19api.com/summary')->getBody();
        $summary = json_decode($res);
        $countries = $summary->Countries;
        return DataTables::of($countries)->addColumn('action', function($row){
        })
        ->rawColumns(['action'])
        ->make(true);
        
        // return $countries;
    }

    public function yourCountry()
    {
        // dd(strlen(request()->ip()));
        $ip = "112.135.2.147";
        $local_ip = request()->ip();
        if(strlen($local_ip) > 3){
            $ip = $local_ip;
        }
        $geoplugin = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
        // Get JSON
        $path =  storage_path() . '/json/countries.json';
        $json = json_decode(file_get_contents($path), true);
        // dd($json[$geoplugin["geoplugin_countryCode"]]);
        // Get slug for country code
        $slug = $json[$geoplugin["geoplugin_countryCode"]];
        $client = new Client();
        // confirmed cases
        $confirmed = $client->get('https://api.covid19api.com/total/country/'.$slug.'/status/confirmed')->getBody();
        $summary = json_decode($confirmed);
        $country_confirmed = end($summary);
        $country_confirmed_all = array_slice($summary, -20, 20, true);
        // recovered cases
        $recovered = $client->get('https://api.covid19api.com/total/country/'.$slug.'/status/recovered')->getBody();
        $summary = json_decode($recovered);
        $country_recovered = end($summary);
        $country_recovered_all = array_slice($summary, -20, 20, true);
        // deaths cases
        $recovered = $client->get('https://api.covid19api.com/total/country/'.$slug.'/status/deaths')->getBody();
        $summary = json_decode($recovered);
        $country_deaths= end($summary);
        $country_deaths_all = array_slice($summary, -20, 20, true);
        // dd($country_deaths_all);
        return view('your-country', compact('country_confirmed', 'country_recovered', 'country_deaths',
                                             'slug', 'country_confirmed_all', 'country_recovered_all', 'country_deaths_all'));
    }

    public function sriLanka()
    {
        return view('sri-lanka');
    }

}
