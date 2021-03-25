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
		<div style="page-break-after:always;">
			<table class='w-full whitespace-no-wrap bg-white'>
				<tbody class='text-center line'>
					<tr>
						<td class="w-3/12" rowspan="6">
							<div class="h-20 m-auto">
								{!! file_get_contents('img/pgom-logo-100.svg') !!}
							</div>
						</td>
						<td class="h-4"></td>
						<td class="w-3/12" rowspan="6"></td>
					</tr>
					<tr>
						<td class="w-6/12 leading-none">Republic of the Philippines</td>
					</tr>
					<tr>
						<td class="leading-none">Province of Oriental Mindoro</td>
					</tr>
					<tr>
						<td class="leading-none">City of Calapan</td>
					</tr>
					<tr>
						<td class="text-xl font-bold leading-none">Provincial Administrator's Office</td>
					</tr>
					<tr>
						<td class="h-4"></td>
					</tr>
				</tbody>
			</table>

			<div class="my-8 text-xl font-bold text-center">
				<div class="text-xl font-bold leading-none">CONSOLIDATED CLIENT SATISFACTION SURVEY RESULTS</div>
				<div class="text-lg leading-none">for
					@php
					echo date('F', strtotime($month['from'])) . ($month['to'] && $month['from']!=$month['to'] ? date(' -
					F Y',
					strtotime($month['to'])) :
					date(' Y', strtotime($month['from'])));
					@endphp
				</div>
			</div>

			<div class="text-xl font-bold">{!! $office !!}</div>
				<table class='w-full whitespace-no-wrap bg-white'>
					<thead class='bg-gray-200 border border-black '>
						<tr class='border'>
							<th class='px-2 border border-black ' rowspan='3'>
								Service
							</th>
							<th class='px-2 border border-black ' rowspan='3'>
								Question
							</th>
							<th class='w-0 px-2 text-sm whitespace-normal border border-black ' rowspan='3'>
								Clients Served
							</th>
							<th class='px-2 border border-black ' colspan='5'>
								Quality of Service
							</th>
							<th class='px-2 border border-black ' rowspan='3'>
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

					@foreach ( $stats['services'] as $service)
						<tbody class='border border-black'>
							@foreach ($service['questions'] as $x => $question)
								<tr>
									@if ($x === 0)
									<td class='px-2 font-bold whitespace-normal align-top border border-b-0 border-black'
										rowspan='3'>
										{{ $service['name'] }}
									</td>
									@endif
									<td class='px-2 border border-b-0 border-l-0'>
										{{$question['question']}}
									</td>
									@if ($x === 0)
									<td class='px-2 text-center border border-b-0' rowspan='3'>
										{{ $service['clients'] }}
									</td>
									@endif
									
									@foreach ($question['ratings'] as $y => $rating)
									<td class='px-2 text-center border border-b-0'>
										{{ $rating }}
									</td>
									@endforeach
									

									@if ($x === 0)
									<td class='px-2 text-center border border-b-0 border-r-0' rowspan='3'>
										{{ $service['goodRatingPercentage'] }}
									</td>
									@endif
								</tr>
							@endforeach

							<tr>
								<td class='border-r border-black'></td>
								<td class='text-center bg-yellow-300 border border-black'>
									% Per Rating
								</td>
								<td class='bg-yellow-300 border border-black'></td>
								@foreach ($service['totalRatingPercentages'] as $x => $average)
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
					

					<tbody class='border border-black '>
						<tr class='bg-orange-400'>
							<th class='border border-black '></th>
							<th class='border border-black '>
								Total
							</th>
							<th class='border border-black '>
								{{ $stats['total']['clients']}}
							</th>
							<th class='border border-black ' colspan='5'></th>
							<th class='border border-black '>
								{{ $stats['total']['goodRatingPercentage']}}
							</th>
						</tr>
					</tbody>
				</table>
			</div>

			<div style="page-break-inside: avoid;">
				<div class="border border-t-0 border-b-0 border-l-0 border-r-2 border-black">
					<table class='w-full my-4 whitespace-no-wrap bg-white' border="1">
						<thead class='bg-gray-200 '>
							<tr class='border border-black'>
								<th class='px-2 py-1 border-b border-black'>
									Service
								</th>
								<th class='px-2 py-1 border-b border-black'>
									Positive Comments
								</th>
								<th class='px-2 py-1 border-b border-black'>
									Negative Comments
								</th>
							</tr>
						</thead>
						<tbody class="border border-black">
							@php
								$rowCtr=0;
								$untranscribedCtr = 0;
							@endphp
							@foreach ($stats['services'] as $x => $service)
								@php
									$rowCtr+=$service['comments']['maxRows'];
									$untranscribedCtr+=count($service['comments']['untranscribed']);
								@endphp
								@for ($i = 0; $i < $service['comments']['maxRows']; $i++) 
								
									<tr class="border-r border-black">
										@if($i ==0)
											<td class="font-bold align-top" 
												rowspan="{{$service['comments']['maxRows']}}">
												{{ $service['name'] }}
											</td>
										@endif
										<td class="border border-b-0">{{$service['comments']['positive'][$i]['comment'] ?? ''}}</td>
										<td class="border border-b-0">{{$service['comments']['negative'][$i]['comment'] ?? ''}}</td>
										
									</tr>

								
								@endfor

							@endforeach
							
						
							@if ($rowCtr===0)
							<tr class="border border-black">
								<td colspan="3" class="h-1 text-center border border-black">--no additional
									comments/suggestions--</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>



				<div class="flex mt-8">
      <div class="flex-1">
        <div class="mb-10">
          Prepared by:
        </div>
        <div class="font-bold">
          {{$preparer['name']}}
        </div>
        <div class="text-sm">
          {{$preparer['position']}}
        </div>
        <div class="">
          <span class="text-sm">Date:</span>
          <span class="font-mono underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
      </div>
      <div class="flex-1">
        <div class="mb-10">
          Reviewed by:
        </div>
        <div class="font-bold">
          {{$reviewer['name']}}
        </div>
        <div class="text-sm">
          {{$reviewer['position']}}
        </div>
        <div class="">
          <span class="text-sm">Date:</span>
          <span class="font-mono underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
      </div>
      <div class="flex-1">
        <div class="mb-10">
          Noted by:
        </div>
        <div class="font-bold">
          {{$noter['name']}}
        </div>
        <div class="text-sm">
          {{$noter['position']}}
        </div>
        <div class="">
          <span class="text-sm">Date:</span>
          <span class="font-mono underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
      </div>
    </div>

			</div>
		</div>
	</main>
</body>

</html>
