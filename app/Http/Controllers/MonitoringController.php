<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoringData = Monitoring::all();
        //return $monitoringData;

        foreach ($monitoringData as $perangkat) {
            //tesping
            $hasil_test_ping = $this->tesPing($perangkat->alamat_ip);
            //masukkan hasil ke dalam array
            $perangkat->status = $hasil_test_ping;
        }

        return view('monitoring', compact('monitoringData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('monitoring_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat_ip' => 'required',
            'latitude' => ['required', 'regex:/^-?\d+(\.\d+)?$/'],
            // Membolehkan angka dengan atau tanpa tanda minus dan desimal
            'longitude' => ['required', 'regex:/^-?\d+(\.\d+)?$/'],
            // Membolehkan angka dengan atau tanpa tanda minus dan desimal
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $image = $request->file('image');
        $filename = date('Y-m-d') . $image->getClientOriginalName();
        $path = 'photo-user/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($image));

        $monitoringData = [
            'nama' => $request->nama,
            'alamat_ip' => $request->alamat_ip,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $filename,
        ];
        Monitoring::create($monitoringData);

        return redirect()->route('admin.monitoring');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $monitoringData = Monitoring::findOrFail($id);
        return view('monitoring_edit', compact('monitoringData'));

    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat_ip' => 'required',
            'latitude' => ['required', 'regex:/^-?\d+(\.\d+)?$/'],
            // Membolehkan angka dengan atau tanpa tanda minus dan desimal
            'longitude' => ['required', 'regex:/^-?\d+(\.\d+)?$/'],
            // Membolehkan angka dengan atau tanpa tanda minus dan desimal
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Update data pada tabel
        $monitoringData = Monitoring::findOrFail($id);
        $monitoringData->nama = $validatedData['nama'];
        $monitoringData->alamat_ip = $validatedData['alamat_ip'];

        // Pastikan latitude dan longitude ada dalam validatedData
        if (array_key_exists('latitude', $validatedData)) {
            $monitoringData->latitude = $validatedData['latitude'];
        }

        if (array_key_exists('longitude', $validatedData)) {
            $monitoringData->longitude = $validatedData['longitude'];
        }

        // Update gambar/logo jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('Y-m-d') . $image->getClientOriginalName();
            $path = 'photo-user/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));
            $monitoringData->image = $filename;
        }

        $monitoringData->save();

        return redirect()->route('admin.monitoring')->with('success', 'Data monitoring berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $monitoring->delete();

        if ($monitoring) {
            $monitoring->delete();
        }

        return redirect()->route('admin.monitoring');
    }

    public function tesPing($alamat_ip)
    {
        // $alamat_ip="google.com";

        exec("ping -n 1 " . $alamat_ip, $output, $result);

        // print_r($output);

        if ($result == 0)

            return true;
        else

            return false;
    }

    public function tesPingAjax(Request $request)
    {


        exec("ping -n 1 " . $request->ip, $output, $result);

        // print_r($output);

        if ($result == 0)

            return true;
        else

            return false;
    }
}
