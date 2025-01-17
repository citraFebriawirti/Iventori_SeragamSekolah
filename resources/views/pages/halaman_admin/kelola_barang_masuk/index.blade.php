@extends('layouts.admin.layouts')

@section('content')
    <!-- Start Content barang masuk -->


    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Kelola Data Barang Masuk
            </h2>


            <div class="flex justify-between">
                <!-- Sisi kiri -->
                <ol class="flex items-center whitespace-nowrap min-w-0 " aria-label="Breadcrumb">
                    <li class="text-sm">
                        <a class="flex items-center text-gray-500 hover:text-blue-600" href="#">
                            Dashboard
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                    </li>

                    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                        Kelola Data Barang Masuk
                    </li>
                </ol>

             
            
               
            </div>
          
            <h2 for="tanggal_awal" class="mr-2 mt-5 font-medium" >Filter Tanggal</h2>
          <div class="flex justify-between">
            <div class="mb-10">
                <form action="{{ route('filterBarangMasuk') }}" method="POST" class="">
                    @csrf
                   
                   <div class="flex justify-center mt-2 ">
                   
                    <div class="flex items-center">
                        
                        <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal') }}" class="border p-2" placeholder="Tanggal Awal">
                    </div>
                    <div class="flex items-center">
                        <label for="tanggal_akhir" class="mx-2">S/d</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}" class="border p-2">
                    </div>
                    <button type="submit" class="bg-green-500 text-white p-2 rounded ml-6 px-6 opacity-75">Filter</button>
                    @if($filter === 'true')
                    <a href="filterBarangMasukTanggal/{{ $tanggal_awal }}/{{ $tanggal_akhir }}" class="bg-yellow-500 text-white p-2 rounded  ml-2" target="_blank">Laporan By Filter</a>
                @endif
                   
                   </div>
                 
                </form>
               
            </div>
            <div class="">
               <div class="flex justify-center gap-10 ">
                <div class="my-3" >
                    <a href="{{ route('laporanbarangmasuk.index') }}" class="flex items-center justify-between w-full p-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-500 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-purple">
                       <div class="mr-3">
                        <svg class="w-5 h-5 text-white-800 dark:text-white  " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z"/>
                            <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z"/>
                          </svg>
                       </div>
                        Laporan
                    </a>
                </div>
                
                <div class="my-3 ">
                    <a href="{{ route('barang_masuk.create') }}" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                       <div class="mr-3">
                        <svg class="w-[14px] h-[14px] text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                          </svg>
                       </div>
                        Tambah
                      
                    </a>
                </div>
               </div>
            </div>
          </div>
            
            
         
            

            {{-- @if (session('success'))
                <div class="alert alert-success p-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-success p-3">{{ session('error') }}</div>
            @endif --}}

            <table id="example" class="display border border-slate-200" style="width:100%">
                <thead>
                    <tr>
                        <th class="border border-slate-200 text-center">No</th>
                        <th class="border border-slate-200 text-center">Nama Barang</th>
                        <th class="border border-slate-200  text-center">Jumlah</th>
                        <th class="border border-slate-200 text-center">Harga Per Item</th>
                        <th class="border border-slate-200  text-center">Tanggal Masuk</th>
                        <th class="border border-slate-200 text-center">Nama Ekspedisi</th>
                      
                       
                        <th class="border border-slate-200  text-center w-40">Aksi</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($barang_masuk as $baris)
                        <tr>
                            <td class="border border-slate-200 text-center">{{ $loop->iteration }}</td>
                           
                            <td class="border border-slate-200 whitespace-pre-line text-center">
                                {{ $baris->nama_barang}}
                            </td>
                            <td class="border border-slate-200 whitespace-pre-line text-center">
                                {{ $baris->jumlah_barang_masuk }}
                            </td>
                            <td class="border border-slate-200 whitespace-pre-line text-center">
                                Rp {{ number_format($baris->harga_barang_masuk, 0, ',', '.') }}
                            </td>

                            <td class="border border-slate-200 whitespace-pre-line text-center">
                                {{ $baris->tanggal_barang_masuk }}
                            </td>
                            
                            <td class="border border-slate-200 whitespace-pre-line text-center">
                                {{ $baris->nama_ekspedisi}}
                            </td>
                          

                            <td class="border border-slate-200">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('barang_masuk.edit', $baris->id_barang_masuk) }}">
                                        <button
                                            class="flex items-center mx-auto justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </button>
                                    </a>

                                    {{-- <a href=""
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Eyes">
                                        <!-- Ikon mata SVG dengan Tailwind CSS -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" style="fill: yellow; transform: ; msFilter:;">
                                            <path
                                                d="M8.073 12.194 4.212 8.333c-1.52 1.657-2.096 3.317-2.106 3.351L2 12l.105.316C2.127 12.383 4.421 19 12.054 19c.929 0 1.775-.102 2.552-.273l-2.746-2.746a3.987 3.987 0 0 1-3.787-3.787zM12.054 5c-1.855 0-3.375.404-4.642.998L3.707 2.293 2.293 3.707l18 18 1.414-1.414-3.298-3.298c2.638-1.953 3.579-4.637 3.593-4.679l.105-.316-.105-.316C21.98 11.617 19.687 5 12.054 5zm1.906 7.546c.187-.677.028-1.439-.492-1.96s-1.283-.679-1.96-.492L10 8.586A3.955 3.955 0 0 1 12.054 8c-2.206 0-4 1.794-4 4a3.94 3.94 0 0 1-.587 2.053l-1.507-1.507z">
                                            </path>
                                        </svg>
                                    </a> --}}



                                    <form action="{{ route('barang_masuk.destroy', $baris->id_barang_masuk) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-rose-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
    </main>

    <!-- End Content barang -->
@endsection
