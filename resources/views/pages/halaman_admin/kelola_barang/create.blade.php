@extends('layouts.admin.layouts')

@section('content')
    <!-- Start Content barang -->


    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Kelola Data barang
            </h2>


            <div class="flex justify-between">
                <!-- Sisi kiri -->
                <ol class="flex items-center whitespace-nowrap min-w-0 " aria-label="Breadcrumb">
                    <li class="text-sm">
                        <a class="flex items-center text-gray-500 hover:text-blue-600" href="{{ route('dashboard.index') }}">
                            Dashboard
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm">
                        <a class="flex items-center text-gray-500 hover:text-blue-600"
                            href="{{ route('barang.index') }}">
                            Kelola Data barang
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                    </li>

                    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                        Tambah Data barang
                    </li>
                </ol>

                <!-- Sisi kanan -->

            </div>





        </div>

        <!-- component -->
        <section class="max-w-[990px] p-6 mx-auto bg-slate-100 rounded-md shadow-md dark:bg-gray-800 mt-10">
            <h1 class="text-xl font-bold text-slate-900 capitalize dark:text-slate-900">Tambah Data barang</h1>
            @if (session('success'))
                <div class="alert alert-success p-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-success p-3">{{ session('error') }}</div>
            @endif
            <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    @csrf
                    <div class="w-72">
                        <div class="relative h-10 w-full min-w-[450px] mt-5">
                            <input
                                class="peer h-full w-full bg-white border border-gray-300 rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-indigo-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " name="nama_barang" />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-medium leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-indigo-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-indigo-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-indigo-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Nama barang 
                            </label>
                        </div>
                    </div>
                  
                    <div class="w-96 mx-auto me-10 ">

                        <label for="" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-400">Kategori</label>
                            <select  name="id_kategori" id="id_kategori" required  class="w-40 me-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($kategori as $data)
                               <option value="{{$data->id_kategori}}">{{ $data->nama_kategori}}</option>
                           @endforeach
                            
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                    <div class="w-[400px] mx-auto me-48">

                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Gender</label>
                            <select  name="id_gender" id="id_gender" required   class="w-40  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($gender as $data)
                               <option value="{{$data->id_gender}}">{{ $data->nama_gender}}</option>
                           @endforeach
                            
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                    <div class="w-96 mx-auto">

                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Model</label>
                            <select  name="id_model" id="id_model" required  class="w-40  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($model as $data)
                                <option value="{{$data->id_model}}">{{ $data->nama_model}}</option>
                            @endforeach
                            
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                    <div class="w-[400px] mx-auto me-48">

                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Busana</label>
                            <select name="id_busana" id="id_busana" required  class="w-40  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($busana as $data)
                               <option value="{{$data->id_busana}}">{{ $data->nama_busana}}</option>
                           @endforeach
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                    <div class="w-96 mx-auto">

                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Bahan</label>
                            <select  name="id_bahan" id="id_bahan" required class="w-40  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($bahan as $data)
                                <option value="{{$data->id_bahan}}">{{ $data->nama_bahan}}</option>
                            @endforeach
                            
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                    <div class="w-[400px] mx-auto me-48">

                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Ukuran</label>
                            <select name="id_ukuran" id="id_ukuran" required  class="w-40  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($ukuran as $data)
                                <option value="{{$data->id_ukuran}}">{{ $data->nama_ukuran}}</option>
                            @endforeach
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                    <div class="w-96 mx-auto">

                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Jenis</label>
                            <select name="id_jenis" id="id_jenis" required  class="w-40  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($jenis as $data)
                                <option value="{{$data->id_jenis}}">{{ $data->nama_jenis}}</option>
                            @endforeach
                        </select>
                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>
                                       <div class="w-96 mx-auto me-48">
                        <div class="relative h-10 w-full min-w-[250px] mt-5">
                               {{-- <label
                                class=" pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-medium leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-indigo-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-indigo-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-indigo-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 ">
                                Jumlah
                            </label> --}}
                            <input
                                class="peer h-full w-full bg-white border border-gray-300 rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-indigo-500 focus:border-t-transparent focus:outline-0 "
                                placeholder=" " name="jumlah_barang" type="number" hidden value="0" />
                         
                        </div>
                    </div>
                  
                    <div class="w-96 mx-auto ms-[30px] mt-5 "  >
                        <div class="relative  w-full min-w-[250px] ">
                               <label
                                class=" pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-medium leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-indigo-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-indigo-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-indigo-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 ">
                                Harga
                            </label>
                            <input
                                class="peer h-full w-full bg-white border border-gray-300 rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-indigo-500 focus:border-t-transparent focus:outline-0 "
                                placeholder=" " name="harga_barang" type="number"  />
                         
                        </div>
                    </div>

                    <div class="w-96 mx-auto ms-[200px]" >
                        <label class="block text-sm font-medium text-slate-900 ms-12">
                            Gambar
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-[370px] ms-12">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-900" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span class="">Upload a file</span>
                                        <input id="file-upload" name="gambar_barang" type="file" class="sr-only">
                                    </label>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button
                        class="px-6 py-2 leading-5 text-slate-900 transition-colors duration-200 transform bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-gray-600 text-white"
                        type="submit" value="Simpan">Simpan</button>
                </div>
            </form>
        </section>



    </main>

    <!-- End Content Barang -->
@endsection
