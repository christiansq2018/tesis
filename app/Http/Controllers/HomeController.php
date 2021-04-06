<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Aplicacion;
use DB;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $collection_mantenimientos_mes = Aplicacion::selectRaw('monthname(fecha_aplicacion) as mes')
                                            ->selectRaw('count(*) as total')
                                            ->selectRaw('avg(tiempo_respuesta) as promedio_respuesta')
                                            ->selectRaw('avg(TIME_TO_SEC(tiempo_parado_mantenimiento)) / 3600 as promedio_disabled')
                                            ->groupBy('mes')
                                            ->whereBetween('fecha_aplicacion', [\Carbon\Carbon::now()->firstOfMonth()->addMonths(-6), \Carbon\Carbon::now()->lastOfMonth()])
                                            ->get();

    $meses = $collection_mantenimientos_mes->pluck('mes')->toArray();
    $array_mantenimientos_mes          = $collection_mantenimientos_mes->pluck('total')->toArray();
    $array_promedio_respuesta          = $collection_mantenimientos_mes->pluck('promedio_respuesta')->toArray();
    $array_disability                  = $collection_mantenimientos_mes->pluck('promedio_disabled')->toArray();

    $chart_mantenimientos = [
      'type' => 'bar',
      'data' => [
        'labels' => $meses,
        'datasets' => [
          [
            'label' => 'Completados por Mes',
            'data'  => $array_mantenimientos_mes,
            'maxBarThickness' => 5,
            'barThickness'  => 5,
            'minBarLength'  => 0,
            'barPercentage' => 1,
            'backgroundColor' => [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
            ],
            'borderWidth' => 1
          ]
        ]
      ],
      'options' => [
        'scales' => [
          'xAxes' => [
            [
              'barPercentage' => 0.4
            ]
          ],
          'yAxes' => [
            [
              'ticks' => [
                'beginAtZero' => true
              ]
            ]
          ]
        ]
      ]
    ];

    $chart_promedio_respuesta = [
      'type' => 'bar',
      'data' => [
        'labels' => $meses,
        'datasets' => [
          [
            'label' => 'Promedio Respuesta Mensual',
            'data'  => $array_promedio_respuesta,
            'maxBarThickness' => 5,
            'barThickness'  => 5,
            'minBarLength'  => 0,
            'barPercentage' => 1,
            'backgroundColor' => [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
            ],
            'borderWidth' => 1
          ]
        ]
      ],
      'options' => [
        'scales' => [
          'xAxes' => [
            [
              'barPercentage' => 0.4
            ]
          ],
          'yAxes' => [
            [
              'ticks' => [
                'beginAtZero' => true
              ]
            ]
          ]
        ]
      ]
    ];

    $chart_disability = [
      'type' => 'bar',
      'data' => [
        'labels' => $meses,
        'datasets' => [
          [
            'label' => 'Promedio Inhabilidad Por Mtto',
            'data'  => $array_disability,
            'maxBarThickness' => 5,
            'barThickness'  => 5,
            'minBarLength'  => 0,
            'barPercentage' => 1,
            'backgroundColor' => [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
            ],
            'borderWidth' => 1
          ]
        ]
      ],
      'options' => [
        'scales' => [
          'xAxes' => [
            [
              'barPercentage' => 0.4
            ]
          ],
          'yAxes' => [
            [
              'ticks' => [
                'beginAtZero' => true
              ]
            ]
          ]
        ]
      ]
    ];

    return view('home', [
      "chart_mantenimientos"     => $chart_mantenimientos,
      "chart_promedio_respuesta" => $chart_promedio_respuesta,
      "chart_promedio_disabled"  => $chart_disability
    ]);
  }
}
