<?php

use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF Print</title>
  <link href="{{asset('assets/css/pdfCss.css')}}" rel="stylesheet" type="text/css" />
  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <button class="no-print" onclick="window.print()">Print</button>
  @foreach($diamonds as $data)
  <div class="container">
    <div class="row">
      <div class="column">
        <div class="d-flex align-items-center justify-content-center">
          <h1 class="align-center title">{{$company->name}}</h1>
        </div>
        <br />
        <div class="d-flex justify-content-center">
          <strong class="align-center title">Slip</strong>&nbsp;
        </div>
        <br />
        <div class="d-flex justify-content-between">
          <div class="d-flex flex-col">
            <span>Bill Date:</span>
            <span>{{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y H:i:s') }}</span>
          </div>
          <br />
        </div>
        <br />
        <table>
          <thead>
            <tr>
              <th width="50%">Party</th>
              <th width="50%">Dimond Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <p>Party Name: {{ $data->parties->party_code }}</p>
                <p>Dimond Name: {{ $data->dimond_name }}</p>
                <p>Barcode:</p>
                <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
                <script>
                  window.onload = function() {
                    @foreach($diamonds as $d)
                    JsBarcode("#barcode-{{ $d->id }}", "{{ $d->barcode_number }}", {
                      format: "CODE128",
                      displayValue: true,
                      height: 60,
                      width: 3,
                      fontOptions: "bold",
                      fontSize: 30,
                    });
                    @endforeach
                  };
                </script>
                <svg id="barcode-{{ $data->id }}"></svg>
              </td>
              <td>
                <p>Row Weight: {{ $data->weight }}</p>
                <p>Polished Weight: {{ $data->required_weight }}</p>
                <p>Shap: {{ $data->shape }}</p>
                <p>clarity: {{ $data->clarity }}</p>
                <p>color: {{ $data->color }}</p>
                <p>cut: {{ $data->cut }}</p>
                <p>polish: {{ $data->polish }}</p>
                <p>symmetry: {{ $data->symmetry }}</p>
              </td>
            </tr>
          </tbody>
        </table>
        <div>
          <div style="padding-top:50px;"></div>
          <p>Author Sigh</p>
        </div>
      </div>
      <!-- <a href="{{ route('print.slipe', ['id' => $data->id,'action' => 'download']) }}" class="no-print">Download PDF</a> -->
    </div>
  </div>
  @endforeach
</body>

</html>