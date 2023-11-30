@extends('layouts.admin.layouts')

@section('content')
<!-- Start Content Desc Singkat -->


<main class="h-full pb-16 overflow-y-auto">
    <div class="container grid px-6 mx-auto">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Kelola Data Desc Singkat
      </h2>
     
    
      <div class="flex justify-between">
        <!-- Sisi kiri -->
        <ol class="flex items-center whitespace-nowrap min-w-0 " aria-label="Breadcrumb">
          <li class="text-sm">
            <a class="flex items-center text-gray-500 hover:text-blue-600" href="{{route('dashboard.index')}}">
             Dashboard
              <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </a>
          </li>
          <li class="text-sm">
            <a class="flex items-center text-gray-500 hover:text-blue-600" href="{{route('descsingkat.index')}}">
                Kelola Data Desc Singkat
              <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </a>
          </li>
          
          <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
          Tambah Data Desc Singkat
          </li>
        </ol>
      
        <!-- Sisi kanan -->
        
      </div>
      
      
  


    </div>

<section class="max-w-[990px] p-6 mx-auto bg-slate-100 rounded-md shadow-md dark:bg-gray-800 mt-10"><div class="flex">
    <!-- Kolom 1 (Gambar) -->
    <div class="w-1/2 p-4">
      <img src="{{asset('assets_landing/images/blog-02.png')}}" alt="Gambar Anda" class="w-80 h-auto rounded-lg">
    </div>
  
    <!-- Kolom 2 (Nama, Deskripsi, dan Link CV) -->
    <div class="w-1/2 p-4">
        <div class="mb-4">
            <label for="nama" class="block">Nama</label>
            <input type="text" class="w-full px-3 py-2 border rounded" id="nama" value="Nama Admin" disabled>
          </div>
          <div class="mb-4">
            <label for="jenis_kelamin" class="block">Deskripsi</label>
            {{-- <textarea name="" id="" cols="30" rows="10">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo illum cumque ipsum, magnam ex distinctio nesciunt possimus explicabo eos dolorem hic est modi ut praesentium deserunt ratione reprehenderit adipisci dignissimos.</textarea>
            <input type="text" class="w-full px-3 py-2 border rounded" id="jenis_kelamin" value="Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis nam odit illo doloremque itaque nemo mollitia aperiam placeat ea assumenda dolorem saepe sed, eos quia tempora eaque libero exercitationem error." disabled> --}}
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quasi quod repellat distinctio labore quidem porro exercitationem, ex voluptatem ut qui id commodi vel pariatur ab. Minus, eligendi! Perspiciatis, voluptate!</p>
          
          </div>
          <div class="mb-4">
            <label for="alamat" class="block">Link CV</label>
            <input type="url" class="w-full px-3 py-2 border rounded" id="jenis_kelamin" value="Laki-laki" disabled>
          </div>
    </div>
  </div></section>
    
      
      


  </main>

<!-- End Content Desc Singkat -->


@endsection