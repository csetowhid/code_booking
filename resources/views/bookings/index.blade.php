<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <div class="flex-1">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Table List') }}
                            </h2>
                            
                                      <table>
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-2 text-xs text-gray-500">
                                                    Table Name
                                                </th>
                                                <th class="px-6 py-2 text-xs text-gray-500">
                                                    Availability
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @forelse ($tables as $table)
                                            <tr class="whitespace-nowrap">
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    {{$table->name}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">
                                                        <a href="{{route('bookings.create',$table->id)}}">Book Now</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <td class="px-6 py-4 text-sm text-gray-500" colspan="3">
                                                {{__('No Data Found')}}
                                            </td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                 
                                <div class="flex-2">
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                        {{ __('Booking History') }}
                                    </h2>
                                    <table>
                                      <thead class="bg-gray-50">
                                          <tr>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                User Name
                                            </th>
                                              <th class="px-6 py-2 text-xs text-gray-500">
                                                  Table Name
                                              </th>
                                              <th class="px-6 py-2 text-xs text-gray-500">
                                                Date
                                            </th>
                                              <th class="px-6 py-2 text-xs text-gray-500">
                                                  Start Time
                                              </th>
                                              <th class="px-6 py-2 text-xs text-gray-500">
                                                End Time
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Status
                                            </th>
                                          </tr>
                                      </thead>
                                      <tbody class="bg-white">
                                          @forelse ($bookings as $key => $book)
                                          <tr class="whitespace-nowrap">
                                              <td class="px-6 py-4 text-sm text-gray-500">
                                                  {{$book->userName->name}}
                                              </td>
                                              <td class="px-6 py-4 text-sm text-gray-500">
                                                {{$book->tableName->name}}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{$book->date}}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{$book->start_time}}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{$book->end_time}}
                                            </td>
                                            
                                                @if ($currentTime = date('H:i:s') < $book->end_time)
                                                <td class="px-6 py-4 text-sm text-red-500">
                                                    {{-- Remaining {{$book->end_time}} --}}
                                                    {{-- Remaining {{$book->end_time}} --}}
                                                    @php
                                                $d1 = strtotime($currentTime = date('H:i:s'));
                                                $d2 = strtotime($book->end_time);
                                                $totalSecondsDiff = abs($d1-$d2);
                                                $totalMinutesDiff = $totalSecondsDiff/60;
                                                    @endphp
                                                    {{round($totalMinutesDiff)}} Min Remaning
                                                </td>
                                                @else
                                                <td class="px-6 py-4 text-sm text-green-500 rounded">
                                                    End
                                                </td>
                                                @endif
                                                
                                            
                                          </tr>
                                          @empty
                                          <td class="px-6 py-4 text-sm text-gray-500" colspan="3">
                                              {{__('No Data Found')}}
                                          </td>
                                          @endforelse
                                      
                                       
                  
                                      </tbody>
                                  </table>
                              </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
