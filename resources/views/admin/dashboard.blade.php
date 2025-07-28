@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome, Admin!</h1>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Patients</h3>
            <p class="text-3xl mt-2">120</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Appointments Today</h3>
            <p class="text-3xl mt-2">18</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Reports Pending</h3>
            <p class="text-3xl mt-2">7</p>
        </div>
    </div>
@endsection

