<!DOCTYPE html>
<html lang='en'>

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link type='text/css' href='{{ asset('css/app.css') }}' rel='stylesheet'>
  <link type='text/css' href='{{ asset('css/print.css') }}' rel='stylesheet' media="print">
</head>

<body class="font-sans antialiased">
  <main>
    <div class=''>
      <table class='w-full my-4 whitespace-no-wrap bg-white'>
        <thead class='bg-gray-200 border border-black '>
          <tr class='border'>
            <th class='p-2 border border-black ' rowspan='3'>
              Service
            </th>
            <th class='p-2 border border-black ' rowspan='3'>
              Question
            </th>
            <th class='w-0 p-2 text-sm whitespace-normal border border-black ' rowspan='3'>
              Clients Served
            </th>
            <th class='p-2 border border-black ' colspan='5'>
              Quality in Service
            </th>
            <th class='p-2 border border-black ' rowspan='3'>
              % in VS &amp; O
            </th>
          </tr>
          <tr class='border'>
            @for ($i = 1; $i <= 5; $i++) <th class='border border-black '>{{$i}}</th>
              @endfor
          </tr>
          <tr class='border'>
            @foreach (['P', 'F', 'S', 'VS', 'O'] as $letter)
            <th class='border border-black ' width='30'>
              {{$letter}}
            </th>
            @endforeach
          </tr>
        </thead>

        @foreach ( $ratings['services'] as $service)
        <tbody class='border border-black '>
          @foreach ($service['questions'] as $x => $question)
          <tr>
            @if ($x === 0)
            <td class='px-2 font-bold whitespace-normal align-top border border-b-0 border-black' rowspan='3'>
              {{ $service['service'] }}
            </td>
            @endif
            <td class='px-2 border border-b-0 border-l-0'>
              {{$question['question']}}
            </td>
            @if ($x === 0)
            <td class='text-center border border-b-0' rowspan='3'>
              {{ $service['clients'] }}
            </td>
            @endif
            @foreach ($question['ratings'] as $y => $rating)
            <td class='text-center border border-b-0'>
              {{ $rating }}
            </td>
            @endforeach
            @if ($x === 0)
            <td class='text-center border border-b-0 border-r-0' rowspan='3'>
              {{ $service['goodPercent'] }}
            </td>
            @endif
          </tr>
          @endforeach

          <tr>
            <td class='border-r border-black'></td>
            <td class='text-center bg-yellow-300 border border-black'>
              Average (% Rating)
            </td>
            <td class='bg-yellow-300 border border-black'></td>
            @foreach ($service['averagePercent'] as $x => $average)
            <td class='text-center bg-yellow-300 border border-black'>
              {{$average}}
            </td>
            @endforeach
            <td class='bg-yellow-300 border border-black'></td>
          </tr>
          <tr>
            <td colspan='9' class='h-0 border border-black '></td>
          </tr>
        </tbody>
        @endforeach

        <tfoot class='border border-black '>
          <tr class='bg-orange-400'>
            <th class='border border-black '></th>
            <th class='border border-black '>
              Total
            </th>
            <th class='border border-black '>
              {{ $ratings['total']['clients']}}
            </th>
            <th class='border border-black ' colspan='5'></th>
            <th class='border border-black '>
              {{ $ratings['total']['goodPercent']}}
            </th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div>
      <table class='w-full my-4 whitespace-no-wrap bg-white '>
        <thead class='bg-gray-200 border border-black '>
          <tr class='border'>
            <th class='p-2 border border-black '>
              Service
            </th>
            <th class='p-2 border border-black '>
              Positive Comments
            </th>
            <th class='p-2 border border-black '>
              Negative Comments
            </th>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($ratings['services'] as $x => $service)
          {{-- @php dd($ratings['services']); @endphp --}}
          @for ($i = 0; $i < getMaxCommentsRows($service['comments']); $i++)
            <tr class="">
              @if ($i===0)
              <td class="px-2 align-top border border-t-0 border-b-0 border-black " rowspan="{{ getMaxCommentsRows($service['comments']) }}">
                {{ $service['service'] }}
              </td>
              @endif
              <td class="px-1 border border-t-0 border-b-0">
                @isset($service['comments']['positive'][$i]['comment'])
                &bull; {{ $service['comments']['positive'][$i]['comment'] }}
                @endisset
              </td>
              <td class="px-1 text-red-700 border border-t-0 border-b-0 border-black ">
                @isset($service['comments']['negative'][$i]['comment'])
                &bull; {{ $service['comments']['negative'][$i]['comment'] }}
                @endisset
              </td>
            </tr>
          @endfor
          <tr>
            <td
              colspan="9"
              class="h-1 border border-black "
            ></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>
<?php

function getMaxCommentsRows($comments){
  $positiveLen = count($comments['positive']);
  $negativeLen = count($comments['negative']);
  return $positiveLen >= $negativeLen ? $positiveLen: $negativeLen;
}
