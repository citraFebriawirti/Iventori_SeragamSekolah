@extends('layouts.admin.layouts')

@section('content')
    <!-- Start Content Busana -->


    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Kelola Data Busana
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
                        <a class="flex items-center text-gray-500 hover:text-blue-600" href="{{ route('busana.index') }}">
                            Kelola Data Busana
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                    </li>

                    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                        Tambah Data Busana
                    </li>
                </ol>

                <!-- Sisi kanan -->

            </div>





        </div>

        <!-- component -->
        <section class="max-w-[990px] p-6 mx-auto bg-slate-100 rounded-md shadow-md dark:bg-gray-800 mt-10">
            <h1 class="text-xl font-bold text-slate-900 capitalize dark:text-slate-900">Tambah Data Busana</h1>
            @if (session('success'))
                <div class="alert alert-success p-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-success p-3">{{ session('error') }}</div>
            @endif
            <form action="{{ route('busana.store') }}" method="post" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    @csrf
                    <div class="w-72">
                        <div class="relative h-10 w-full min-w-[450px] mt-5">
                            <input
                                class="peer h-full w-full bg-white border border-gray-300 rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-indigo-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " name="nama_busana" />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-medium leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-indigo-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-indigo-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-indigo-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Nama busana
                            </label>
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
