<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>
    <title>TES - Venturo Camp Tahap 2</title>
</head>
<body>
<div class="container-fluid">
    <div class="card" style="margin: 2rem 0rem;">
        <div class="card-header">
            Venturo - Laporan penjualan tahunan per menu
        </div>
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <select id="my-select" class="form-control" name="tahun">
                                <option value="" {{$year == '' ? 'selected' : ''}}>Pilih Tahun</option>
                                <option value="2021" {{$year == 2021 ? 'selected' : ''}}>2021</option>
                                <option value="2022" {{$year == 2022 ? 'selected' : ''}}>2022</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">
                            Tampilkan
                        </button>
                        <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu" class="btn btn-secondary">
                            Json Menu
                        </a>
                        <a href="http://tes-web.landa.id/intermediate/transaksi?tahun=2021" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                            Json Transaksi
                        </a>
                    </div>
                </div>
            </form>

         @if ($year != '')
         <hr>
         <div class="table-responsive">
             <table class="table table-hover table-bordered" style="margin: 0">
                 <thead>
                     <tr class="table-dark">
                         <th rowspan="2" style="text-align:center; vertical-align:middle; width:250px">
                             Menu
                         </th>
                         <th colspan="12" style="text-align: center;">Periode pada {{$year}}</th>
                         <th rowspan="2" style="text-align:center; vertical-align:middle; width:250px">
                             Total
                         </th>
                     </tr>
                     <tr class="table-dark">
                         <th style="text-align: center;width: 75px;">Jan</th>
                         <th style="text-align: center;width: 75px;">Feb</th>
                         <th style="text-align: center;width: 75px;">Mar</th>
                         <th style="text-align: center;width: 75px;">Apr</th>
                         <th style="text-align: center;width: 75px;">Mei</th>
                         <th style="text-align: center;width: 75px;">Jun</th>
                         <th style="text-align: center;width: 75px;">Jul</th>
                         <th style="text-align: center;width: 75px;">Ags</th>
                         <th style="text-align: center;width: 75px;">Sep</th>
                         <th style="text-align: center;width: 75px;">Okt</th>
                         <th style="text-align: center;width: 75px;">Nov</th>
                         <th style="text-align: center;width: 75px;">Des</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td colspan="14" class="table-secondary">
                             <b>Makanan</b>
                         </td>
                     </tr>
                     @foreach ($foods as $food)
                     <tr>
                        <td>{{$food['menu']}}</td>
                        @foreach (range(1,12) as $month)
                        @if (isset($monthlyTransaction[$food['menu']]))
                           <td style="text-align:right;">{{ $monthlyTransaction[$food['menu']][$month] ? number_format($monthlyTransaction[$food['menu']][$month]) : ''}}</td>
                       @else
                       <td>

                       </td>
                        @endif
                        @endforeach
                        @if (isset($monthlyTransaction[$food['menu']]))
                        <td style="text-align:right;">
                           <b> {{ number_format(array_sum($monthlyTransaction[$food['menu']]))}}</b>
                        </td>
                        @else
                        <td style="text-align:right;">
                            <b>0</b>
                         </td>
                        @endif

                    </tr>
                     @endforeach
                     <tr>
                         <td colspan="14" class="table-secondary">
                             <b>Minuman</b>
                         </td>
                     </tr>
                     @foreach ($drinks as $drink)
                     <tr>
                         <td>{{$drink['menu']}}</td>
                         @foreach (range(1,12) as $month)
                         @if (isset($monthlyTransaction[$drink['menu']]))
                            <td style="text-align:right;">{{ $monthlyTransaction[$drink['menu']][$month] ? number_format($monthlyTransaction[$drink['menu']][$month]) : ''}}</td>
                        @else
                        <td>

                        </td>
                         @endif
                         @endforeach
                         @if (isset($monthlyTransaction[$drink['menu']]))
                         <td style="text-align:right;">
                            <b> {{ number_format(array_sum($monthlyTransaction[$drink['menu']]))}}</b>
                         </td>
                         @else
                        <td style="text-align:right;">
                            <b>0</b>
                            </td>
                         @endif

                     </tr>
                     @endforeach
                     <tr class="table-dark">
                         <td><b>Total</b></td>
                        @foreach (range(1,12) as $month)
                        <td style="text-align: right;">
                            <b>{{ $totalMonthly[$month] ? number_format($totalMonthly[$month]) : ''}}</b>
                        </td>
                        @endforeach
                         <td style="text-align: right;">
                            <b> {{number_format(array_sum($totalMonthly)) ?? 0}}</td></b>

                     </tr>

                 </tbody>
             </table>
         </div>
         @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

